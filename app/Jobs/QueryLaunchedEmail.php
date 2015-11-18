<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueryLaunchedEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $query;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($query)
    {
        //
        $this->query = $query;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if( $this->query != null &&  $this->query !="" && count( $this->query)>0 ) {
            $data = array(
                'query' => serialize($this->query)
            );

            //Send email to department
            foreach($this->query->toDepartment->users as $us) {
                if($us->email !="")
                {
                    $emails = $us->email;

                    $emailData = array(
                        'query' => serialize($this->query),
                        'emails' => $emails
                    );

                    \Mail::queue('emails.newquery', $data, function ($message) use ($emailData) {

                        //Fetch emails of users to wchich query was sent
                        $query = unserialize($emailData['query']);
                        $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                        $message->to($emailData['emails'])->subject('Issue Event Details for :'.$query->query_code.' -- New Request (Status : '.$query->status.')');
                    });
                }

            }

            //Send email from department
            if($this->query->from_unit != "" && $this->query->from_unit != null)
            {
                foreach($this->query->fromUnit->users as $us) {
                    if($us->email !="")
                    {
                        $emails = $us->email;

                        $emailData = array(
                            'query' => serialize($this->query),
                            'emails' => $emails
                        );

                        \Mail::queue('emails.newquery', $data, function ($message) use ($emailData) {

                            //Fetch emails of users to wchich query was sent
                            $query = unserialize($emailData['query']);
                            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                            $message->to($emailData['emails'])->subject('Issue Event Details for :'.$query->query_code.' -- New Request (Status : '.$query->status.')');
                        });
                    }

                }
            }
            elseif($this->query->from_department != null && $this->query->from_department != null)
            {
                foreach($this->query->fromDepartment->users as $us) {
                    if($us->email !="")
                    {
                        $emails = $us->email;

                        $emailData = array(
                            'query' => serialize($this->query),
                            'emails' => $emails
                        );

                        \Mail::queue('emails.newquery', $data, function ($message) use ($emailData) {

                            //Fetch emails of users to wchich query was sent
                            $query = unserialize($emailData['query']);
                            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                            $message->to($emailData['emails'])->subject('Issue Event Details for :'.$query->query_code.' -- New Request (Status : '.$query->status.')');
                        });
                    }

                }
            }

        }
    }
}
