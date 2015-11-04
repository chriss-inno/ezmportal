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

                    if(count($services) >0 ) {
                        //Send email
                        $data = array(
                            'service' => $services,
                        );
                        $dataemail=array();
                        $dtemail="";



                        $emails=SMEmails::where('status','=','Active')->select('email')->get()->toArray();

                        if(count($emails) >0 && $emails != null)
                        {

                            $dataemail = array_pluck($emails, 'email');


                        }
                        else
                        {

                        }
                        if($dataemail !="")
                        {

                            \Mail::queue('emails.servicestartus', $data, function ($message) use($dataemail) {

                                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                                $message->to($dataemail)->subject('SYSTEM SERVICE STATUS REPORT AS OF '.date("d F Y"));

                            });



                        }


                    }
                }
                else
                {

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
