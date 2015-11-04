<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Service;
use App\SMEmails;
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

        $services=Service::where('email_sent','=','N')->get();



        if(date("H:i") >="09:00" && date("H:i") <="09:50") {
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
