<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueryProgressEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $msg;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        //
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if( $this->msg != null &&  $this->msg !="" ) {
            $data = array(
                'msg' => serialize( $this->msg)
            );

            //Send email to department
            foreach( $this->msg->mQuery->toDepartment->users as $us) {
                if($us->email !="" && $us->status !='Inactive')
                {
                    $emails = $us->email;

                    $emailData = array(
                        'msg' => serialize( $this->msg),
                        'emails' => $emails
                    );

                    \Mail::queue('emails.queryprogress', $data, function ($message) use ($emailData) {

                        //Fetch emails of users to wchich query was sent
                        $msg = unserialize($emailData['msg']);
                        $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                        $message->to($emailData['emails'])->subject('Issue Event Details for :'.$msg->mQuery->query_code.' -- Attendance Notification  (Status : '.$msg->mQuery->status.')');
                    });
                }

            }

            //Send email from department
            if($this->msg->mQuery->from_unit != null && $this->msg->mQuery->from_unit != "")
            {
                foreach( $this->msg->mQuery->fromUnit->users as $us) {
                    if($us->email !="" && $us->status !='Inactive')
                    {
                        $emails = $us->email;

                        $emailData = array(
                            'msg' => serialize( $this->msg),
                            'emails' => $emails
                        );

                        \Mail::queue('emails.queryprogress', $data, function ($message) use ($emailData) {

                            //Fetch emails of users to wchich query was sent
                            $msg = unserialize($emailData['msg']);
                            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                            $message->to($emailData['emails'])->subject('Issue Event Details for :'.$msg->mQuery->query_code.' -- Attendance Notification  (Status : '.$msg->mQuery->status.')');
                        });
                    }

                }
            }
            else
            {
                foreach( $this->msg->mQuery->fromDepartment->users as $us) {
                    if($us->email !="" && $us->status !='Inactive')
                    {
                        $emails = $us->email;

                        $emailData = array(
                            'msg' => serialize( $this->msg),
                            'emails' => $emails
                        );

                        \Mail::queue('emails.queryprogress', $data, function ($message) use ($emailData) {

                            //Fetch emails of users to wchich query was sent
                            $msg = unserialize($emailData['msg']);
                            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                            $message->to($emailData['emails'])->subject('Issue Event Details for :'.$msg->mQuery->query_code.' -- Attendance Notification  (Status : '.$msg->mQuery->status.')');
                        });
                    }

                }
            }

        }
    }
}
