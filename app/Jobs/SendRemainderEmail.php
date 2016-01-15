<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Reminder;
use App\ReminderEmail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\SystemSetup;
use Illuminate\Support\Facades\Mail;

class SendRemainderEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $reminder_title;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->reminder_title="";
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
            if($sysSet->reminder_status != null &&
                $sysSet->reminder_status != "" &&
                $sysSet->reminder_status =="enabled" &&
                $sysSet->reminder_start_tm != null &&
                $sysSet->reminder_start_tm !=""  &&
                $sysSet->reminder_end_tm !="" &&
                $sysSet->reminder_end_tm != null
            )
            {

                $sys=SystemSetup::all()->first();
                if(date("H:i") >= date("H:i",strtotime( $sysSet->reminder_start_tm)) && date("H:i") <= date("H:i",strtotime( $sysSet->reminder_end_tm)))
                {
                    echo "Date check ok now sending <br/>";

                    $reminders= Reminder::where("status",'=','Enabled')->get();
                    if($reminders != null && count($reminders) > 0)
                    {
                       foreach($reminders as $reminder) {

                           $data = array(
                               'reminder' => $reminder
                           );
                           $dataemail = array();

                           $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                           if (count($emails) > 0 && $emails != null) {

                               foreach($emails as $email)
                               {

                                   Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                       $message->from('bankmportal@bankm.com', 'Bank M  Support portal');
                                       $message->to($email)->subject('DAILY LOG OF CUSTOMER ISSUES');
                                       $message->attach($this->pathToFile);

                                   });
                               }


                           }
                       }
                    }
                }
            }
        }

    }
}
