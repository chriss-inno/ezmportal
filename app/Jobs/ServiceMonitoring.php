<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Service;
use App\SMEmails;
use App\SystemSetup;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceMonitoring extends Job implements SelfHandling, ShouldQueue
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
        //
        echo "Email job started checking for permitted time<br/>";
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

                    $services=Service::where('email_sent','=','N')->get();   //Get all services

                    echo "Date check ok now proceeding service count<br/>";

                    if(count($services) >0 ) {
                        //Send email
                        $data = array(
                            'service' => $services,
                        );
                        $dataemail=array();
                        $dtemail="";

                        echo "Service count  check ok now proceeding  emails count<br/>";

                        $emails=SMEmails::where('status','=','Active')->select('email')->get()->toArray();

                        if(count($emails) >0 && $emails != null)
                        {

                            $dataemail = array_pluck($emails, 'email');

                            echo "Email count is ok, there are ". count($emails)."Emails for sending <br/>";

                        }

                        if($dataemail !="")
                        {
                            echo "Now sending emails <br/>";

                            \Mail::queue('emails.servicestartus', $data, function ($message) use($dataemail) {

                                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                                $message->to($dataemail)->subject('SYSTEM SERVICE STATUS REPORT AS OF '.date("d F Y"));

                            });



                        }

                        echo "Email sending completed update all services to send state of Y <br/>";

                        $services=Service::all();
                        foreach($services as $issue)
                        {
                            $issue->email_sent='Y';
                            $issue->save();
                        }
                    }
                }
                else
                {
                    echo "Emails not send  update all services to send state of N <br/>";
                    $services=Service::all();
                    foreach($services as $issue)
                    {
                        $issue->email_sent='N';
                        $issue->save();
                    }
                }
            }

        }
    }
}
