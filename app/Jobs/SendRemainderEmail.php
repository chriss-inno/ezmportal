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

                    $reminders= Reminder::where("status",'=','Enabled')->where("send_status",'=','No')->get();
                    if($reminders != null && count($reminders) > 0)
                    {
                       foreach($reminders as $reminder) {

                           $data = array(
                               'reminder' => $reminder
                           );

                           $this->reminder_title=$reminder->rm_title;

                           //Daily reminder
                           if($reminder->recurrence_pattern="Daily")
                           {
                              if(strtotime($reminder->start_date)>= strtotime(date("Y-m-d")) && strtotime($reminder->end_date) <= strtotime(date("Y-m-d")) )
                              {
                                  $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                  if (count($emails) > 0 && $emails != null) {

                                      foreach($emails as $email)
                                      {

                                          Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                              $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                              $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                              $message->attach($this->pathToFile);

                                          });
                                      }
                                      $reminder->send_status="Yes"; //Reminder was sent
                                      $reminder->save();
                                  }
                              }
                           }
                           if($reminder->recurrence_pattern= "Monthly")
                           {

                              if($reminder->next_exc_date !="")
                              {
                                  if(strtotime($reminder->next_exc_date)>= strtotime(date("Y-m-d")) && strtotime($reminder->end_date) <= strtotime(date("Y-m-d")) ) {


                                      $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                      if (count($emails) > 0 && $emails != null) {

                                          foreach($emails as $email)
                                          {

                                              Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                  $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                  $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                  $message->attach($this->pathToFile);

                                              });
                                          }
                                          $time = strtotime($reminder->next_exc_date);
                                          $final = date("Y-m-d", strtotime("+1 month", $time));
                                          $reminder->send_status = "Yes"; //Reminder was sent
                                          $reminder->next_exc_date = $final;
                                          $reminder->save();
                                      }

                                  }
                              }
                               else
                               {
                                   if(strtotime($reminder->start_date)>= strtotime(date("Y-m-d")) && strtotime($reminder->end_date) <= strtotime(date("Y-m-d")) )
                                   {
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $email)
                                           {

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                   $message->attach($this->pathToFile);

                                               });
                                           }
                                           $time = strtotime($reminder->start_date);
                                           $final = date("Y-m-d", strtotime("+1 month", $time));
                                           $reminder->send_status="Yes"; //Reminder was sent
                                           $reminder->next_exc_date=$final;
                                           $reminder->save();
                                       }
                                   }

                               }

                           }
                           if($reminder->recurrence_pattern= "Yearly")
                           {

                               if($reminder->next_exc_date !="")
                               {
                                   if(strtotime($reminder->next_exc_date)>= strtotime(date("Y-m-d")) && strtotime($reminder->end_date) <= strtotime(date("Y-m-d")) ) {


                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $email)
                                           {

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                   $message->attach($this->pathToFile);

                                               });
                                           }
                                           $time = strtotime($reminder->next_exc_date);
                                           $final = date("Y-m-d", strtotime("+1 year", $time));
                                           $reminder->send_status = "Yes"; //Reminder was sent
                                           $reminder->next_exc_date = $final;
                                           $reminder->save();
                                       }

                                   }
                               }
                               else
                               {
                                   if(strtotime($reminder->start_date)>= strtotime(date("Y-m-d")) && strtotime($reminder->end_date) <= strtotime(date("Y-m-d")) )
                                   {
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $email)
                                           {

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                   $message->attach($this->pathToFile);

                                               });
                                           }
                                           $time = strtotime($reminder->start_date);
                                           $final = date("Y-m-d", strtotime("+1 year", $time));
                                           $reminder->send_status="Yes"; //Reminder was sent
                                           $reminder->next_exc_date=$final;
                                           $reminder->save();
                                       }
                                   }

                               }

                           }
                           if($reminder->recurrence_pattern= "Weekly")
                           {

                               if($reminder->next_exc_date !="")
                               {
                                   if(strtotime($reminder->next_exc_date)>= strtotime(date("Y-m-d")) && strtotime($reminder->end_date) <= strtotime(date("Y-m-d")) ) {


                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $email)
                                           {

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                   $message->attach($this->pathToFile);

                                               });
                                           }
                                           $time = strtotime($reminder->next_exc_date);
                                           $final = date("Y-m-d", strtotime("+1 week", $time));
                                           $reminder->send_status = "Yes"; //Reminder was sent
                                           $reminder->next_exc_date = $final;
                                           $reminder->save();
                                       }

                                   }
                               }
                               else
                               {
                                   if(strtotime($reminder->start_date)>= strtotime(date("Y-m-d")) && strtotime($reminder->end_date) <= strtotime(date("Y-m-d")) )
                                   {
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $email)
                                           {

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                   $message->attach($this->pathToFile);

                                               });
                                           }
                                           $time = strtotime($reminder->start_date);
                                           $final = date("Y-m-d", strtotime("+1 week", $time));
                                           $reminder->send_status="Yes"; //Reminder was sent
                                           $reminder->next_exc_date=$final;
                                           $reminder->save();
                                       }
                                   }

                               }

                           }


                       }
                    }
                }
                else
                {
                    $reminders= Reminder::where("status",'=','Enabled')->where("send_status",'=','No')->get();
                    foreach($reminders as $reminder)
                    {
                        $reminder->send_status="Yes"; //Reminder was sent
                        $reminder->save();
                    }

                }
            }
        }

    }
}
