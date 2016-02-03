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
                    echo "Date check ok now check send status <br/>";
                    if($sysSet->sd_email_issent=="No")
                    {
                        echo "Status ok send now<br/>";

                        $issues= CustomerIssues::where("date_created",'=',date("Y-m-d"))->orwhere("closed",'=','No')->get();
                        if($issues != null && count($issues) > 0)
                        {
                            $sd_report="daily_customer_issues_".date('YmdHis');
                            Excel::create($sd_report, function($excel) use($issues)  {

                                $excel->sheet('sheet', function($sheet) use($issues){
                                    $sheet->loadView('excels.sd')->with('issues', $issues);
                                    $sheet->setWidth(array(
                                        'A'     =>  10,
                                        'B'     =>  25,
                                        'C'     =>  20,
                                        'D'     =>  25,
                                        'E'     =>  25,
                                        'F'     =>  20,
                                        'G'     =>  50,
                                        'H'     =>  25,
                                        'I'     =>  30,
                                        'J'     =>  25,
                                        'K'     =>  50,
                                        'L'     =>  50,
                                        'M'     =>  20,
                                        'N'     =>  50,
                                        'O'     =>  25,
                                        'P'     =>  25,
                                        'Q'     =>  25,
                                        'R'     =>  25,
                                        'S'     =>  25,
                                        'T'     =>  25

                                    ));
                                    $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
                                    //$sheet->setAutoFilter('E2:F2');

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
                                    $message->to($dataemail)->subject('DAILY LOG OF CUSTOMER ISSUES: New portal');
                                    $message->attach($this->pathToFile);

                                });
                                //Remove generated file
                                File::delete( $this->pathToFile);
                            }
                        }

                        echo "After send update status now to Yes<br/>";
                        //Update system
                        $sysSet->sd_email_issent="Yes";
                        $sysSet->save();

                    }
                    else
                    {
                        //Update system
                        $sysSet->sd_email_issent="Yes";
                        $sysSet->save();
                    }

                }
                else
                {
                    echo "Date check no update status now to No <br/>";
                    //Update system
                    $sysSet->sd_email_issent="Yes";
                    $sysSet->save();
                }
            }
        }

    }
}
