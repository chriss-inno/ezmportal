<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\OracleSupport;
use App\SystemSetup;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceOracle extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

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
                if(date("H:i") >= date("H:i",strtotime( $sysSet->automation_start_tm)) && date("H:i") <= date("H:i",strtotime( $sysSet->automation_end_tm))) {

                    $issues=OracleSupport::where('status','=','Opened')->where('email_sent','=','N')->get(); //retrieve all opened issues

                    if(count($issues) >0 ) {
                        $data = array(
                            'supportissues' => $issues,
                        );
                        //Send email
                        \Mail::queue('emails.oracle', $data, function ($message) {

                            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                            $message->to('innocent.christopher@bankm.com')->subject('DAILY ISSUES LOGGED');
                        });
                    }


                }
                else
                {
                    $issues1=OracleSupport::where('status','=','Opened')->where('email_sent','=','Y')->get(); //retrieve all opened issues
                    //Prevent all unsent messages
                    foreach($issues1 as $issue)
                    {
                        $issue->email_sent='N';
                        $issue->save();
                    }

                }
            }

        }

    }
}
