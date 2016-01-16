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
                        echo "Reminder  checked ok now sending <br/>";
                        foreach($reminders as $reminder) {

                           $data = array(
                               'reminder' => $reminder
                           );
                            echo "Processing reminder [".$reminder->rm_title."]  <br/>";
                           $this->reminder_title=$reminder->rm_title;

                           //Daily reminder
                           if($reminder->recurrence_pattern == "Daily")
                           {
                               echo "Processing reminder [".$reminder->rm_title."] in daily mode <br/>";

                              if(strtotime($reminder->start_date) >= strtotime(date("Y-m-d")) &&  strtotime(date("Y-m-d")) <= strtotime($reminder->end_date))
                              {
                                  echo "In date range processing reminder [".$reminder->rm_title."] in daily mode <br/>";
                                  $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                  if (count($emails) > 0 && $emails != null) {

                                      echo "Email found <br/>";
                                      foreach($emails as $emaildt)
                                      {
                                          echo $emaildt->email." Email found <br/>";
                                          $email= $emaildt->email;
                                          Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                              $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                              $message->to($email)->subject(" Reminder for ".$this->reminder_title);

                                          });
                                      }
                                      $reminder->send_status="Yes"; //Reminder was sent
                                      $reminder->save();
                                  }
                              }
                               else
                               {
                                   echo "Not in date range processing reminder [".$reminder->rm_title."] in daily mode <br/>";
                                   echo "Date time 1=".strtotime($reminder->start_date)."End date time 2 is".strtotime(date("Y-m-d"))."<br/>";
                                   echo  "different is".((strtotime($reminder->end_date)) - (strtotime(date("Y-m-d"))))."<br/>";
                               }
                           }
                           if($reminder->recurrence_pattern == "Monthly")
                           {
                               echo "Processing reminder [".$reminder->rm_title."] in Monthly mode <br/>";

                              if($reminder->next_exc_date !="")
                              {
                                  if(strtotime($reminder->next_exc_date) >= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime($reminder->end_date)) {

                                      echo "In date range processing reminder [".$reminder->rm_title."] in Monthly mode <br/>";
                                      $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                      if (count($emails) > 0 && $emails != null) {

                                          foreach($emails as $emaildt)
                                          {
                                              echo $emaildt->email." Email found <br/>";
                                              $email= $emaildt->email;

                                              Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                  $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                  $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                 

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
                                   if(strtotime($reminder->start_date) >= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime($reminder->end_date) )
                                   {
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $emaildt)
                                           {
                                               echo $emaildt->email." Email found <br/>";
                                               $email= $emaildt->email;

                                              Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                  

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
                           if($reminder->recurrence_pattern == "Yearly")
                           {
                               echo "Processing reminder [".$reminder->rm_title."] in Yearly mode <br/>";
                               if($reminder->next_exc_date !="")
                               {
                                   if(strtotime($reminder->next_exc_date)>= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime($reminder->end_date) ) {

                                       echo "In date range processing reminder [".$reminder->rm_title."] in Yearly mode <br/>";
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $emaildt)
                                           {
                                               echo $emaildt->email." Email found <br/>";
                                               $email= $emaildt->email;

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                  

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
                                   if(strtotime($reminder->start_date)>= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime($reminder->end_date) )
                                   {
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $emaildt)
                                           {
                                               echo $emaildt->email." Email found <br/>";
                                               $email= $emaildt->email;

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                  

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
                           if($reminder->recurrence_pattern == "Weekly")
                           {
                               echo "Processing reminder [".$reminder->rm_title."] in Weekly mode <br/>";
                               if($reminder->next_exc_date !="")
                               {
                                   if(strtotime($reminder->next_exc_date)>= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime($reminder->end_date) ) {

                                       echo "In date range processing reminder [".$reminder->rm_title."] in Yearly mode <br/>";
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $emaildt)
                                           {
                                               echo $emaildt->email." Email found <br/>";
                                               $email= $emaildt->email;

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                  

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
                                   if(strtotime($reminder->start_date)>= strtotime(date("Y-m-d")) && strtotime(date("Y-m-d")) <= strtotime($reminder->end_date) )
                                   {
                                       $emails = ReminderEmail::where('rmd_id', '=',$reminder->id)->get();
                                       if (count($emails) > 0 && $emails != null) {

                                           foreach($emails as $emaildt)
                                           {
                                               echo $emaildt->email." Email found <br/>";
                                               $email= $emaildt->email;

                                               Mail::send('emails.reminder', $data, function ($message) use ($email) {

                                                   $message->from('bankmportal.reminder@bankm.com', 'Bank M  Service portal');
                                                   $message->to($email)->subject(" Reminder for ".$this->reminder_title);
                                                  

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
                    else
                    {
                        echo "No Reminder found stop sending<br/>";

                    }
                }
                else
                {
                    $reminders= Reminder::where("status",'=','Enabled')->where("send_status",'=','No')->get();
                    foreach($reminders as $reminder)
                    {
                        $reminder->send_status="No"; //Reminder was sent
                        $reminder->save();
                    }

                }
            }
        }

    }
}
