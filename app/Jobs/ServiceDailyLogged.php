<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Query;
use App\QueryEmail;
use App\SystemSetup;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ServiceDailyLogged extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $pathToFile;
    protected $depatment;
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

                    if($sys->dailyquery_sent =="N")
                    {
                        echo "No status found proceeding sending <br/>";

                        $departments=\App\Department::where('receive_query','=','1')->get();
                        foreach($departments as $dp)
                        {

                            $queries=Query::where('to_department','=',$dp->id)->where('today_date','=',date("Y-m-d"))->orwhere('closed','=',0)->get(); //Get all queries under this department

                            $queries_report="daily_logged_queries_".date('YmdHis');

                            Excel::create($queries_report, function($excel) use($queries)  {

                                $excel->sheet('sheet', function($sheet) use($queries){
                                    $sheet->loadView('excels.dailyqueries')->with('queries', $queries);

                                });

                            })->store('xls', storage_path('exports/excel'));

                            $this->pathToFile=storage_path('exports/excel')."/".$queries_report.".xls";
                            $this->depatment=$dp->department_name;

                            if($queries != null && $queries !="" && count($queries)>0 ) {

                                //Send email

                                $emails=QueryEmail::where('department_id','=',$dp->id)->get();

                                if($emails != null && $emails != "" && count($emails) > 0)
                                {
                                    //Get emails from department
                                    $data = array(
                                        'queries' => $queries,
                                        'department' => $dp->department_name,
                                        'did' => $dp->id
                                    );

                                    foreach($emails as $em)
                                    {
                                        $email= $em->email;
                                        \Mail::send('emails.dailyquery', $data, function ($message) use ($email) {

                                            //Fetch emails of users to wchich query was sent
                                            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                                            $message->to($email)->subject($this->depatment.' DAILY ISSUES LOGGED');
                                            $message->attach($this->pathToFile);
                                        });
                                    }

                                    //Remove generated file
                                    File::delete( $this->pathToFile);





                                }


                            }


                        }
                        $sys2=SystemSetup::all()->first();
                        $sys2->dailyquery_sent = "Y";
                        $sys2->save();
                    }
                    else
                    {
                        echo "Y status was found No sending as in the time range <br/>";
                    }


                }
                else
                {

                    $sys1=SystemSetup::all()->first();
                    $sys1->dailyquery_sent = "N";
                    $sys1->save();

                    echo "Not in time range updated to N and no sending at all <br/>";
                }
            }

        }

    }
}
