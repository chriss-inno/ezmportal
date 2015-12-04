<?php

namespace App\Jobs;

use App\CustomerIssues;
use App\Jobs\Job;
use App\SDEmail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\SystemSetup;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class SDDaily extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $pathToFile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        //
        $sysSet=SystemSetup::all()->first();
        if($sysSet !=null && $sysSet != "")
        {
            if($sysSet->automation_status != null &&
                $sysSet->automation_status != "" &&
                $sysSet->automation_status =="enabled" &&
                $sysSet->automation_start_tm != null &&
                $sysSet->automation_start_tm !=""  &&
                $sysSet->automation_end_tm !="" &&
                $sysSet->automation_end_tm != null
            )
            {
                $sys=SystemSetup::all()->first();
                if(date("H:i") >= date("H:i",strtotime( $sysSet->automation_start_tm)) && date("H:i") <= date("H:i",strtotime( $sysSet->automation_end_tm)))
                {
                    echo "Date check ok now sending <br/>";

                    $issues= CustomerIssues::where("date_created",'=',date("Y-m-d"))->orwhere("closed",'=','No')->get();
                    if($issues != null && count($issues) > 0)
                    {
                        $sd_report="daily_customer_issues_".date('YmdHis');
                        Excel::create($sd_report, function($excel) use($issues)  {

                            $excel->sheet('sheet', function($sheet) use($issues){
                                $sheet->loadView('excels.sd')->with('issues', $issues);

                            });

                        })->store('xls', storage_path('exports/excel'));

                        $this->pathToFile=storage_path('exports/excel')."/".$sd_report.".xls";

                        //Send email

                        $data = array(
                            'issues' => $issues
                        );
                        $dataemail=array();

                        $emails=SDEmail::where('status','=','Active')->select('email')->get()->toArray();
                        if(count($emails) >0 && $emails != null)
                        {

                            $dataemail = array_pluck($emails, 'email');


                        }

                        if($dataemail !="")
                        {

                            \Mail::send('emails.sd', $data, function ($message) use($dataemail) {

                                $message->from('bankmportal@bankm.com', 'Bank M  Support portal');
                                $message->to($dataemail)->subject('DAILY LOG OF CUSTOMER ISSUES');
                                $message->attach($this->pathToFile);

                            });
                            //Remove generated file
                            File::delete( $this->pathToFile);
                        }
                    }
                }
            }
        }

    }
}