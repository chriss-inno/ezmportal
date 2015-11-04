<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\OracleSupport;
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
        //

        $issues=OracleSupport::where('status','=','Opened')->where('email_sent','=','N')->get(); //retrieve all opened issues

        //Send every day at 9 pm, the email is sent to support
        echo date("H:i");
        if(date("H:i") >="09:00" && date("H:i") <="09:30") {

            if(count($issues) >0 ) {
                $data = array(
                    'supportissues' => $issues,
                );
                //Send email
                \Mail::queue('emails.oracle', $data, function ($message) {

                    $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                    $message->to('chriss.innocent@gmail.com')->subject('DAILY ISSUES LOGGED');
                });
                echo "Sent";
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
            echo " not Sent";
        }

    }
}
