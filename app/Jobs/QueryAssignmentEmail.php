<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueryAssignmentEmail extends Job implements SelfHandling, ShouldQueue
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

            //Send to department email
            foreach($this->query->toDepartment->users as $us) {
                if($us->email !="")
                {
                    $emails = $us->email;

                    $emailData = array(
                        'query' => serialize($this->query),
                        'emails' => $emails
                    );

                    \Mail::queue('emails.queruassigned', $data, function ($message) use ($emailData) {

                        //Fetch emails of users to wchich query was sent
                        $query = unserialize($emailData['query']);
                        $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                        $message->to($emailData['emails'])->subject('Issue Event Details for :'.$query->query_code.' -- Assignment (Status : '.$query->status.')');
                    });
                }

            }

            //Send from department email
            foreach($this->query->fromDepartment->users as $us) {
                if($us->email !="")
                {
                    $emails = $us->email;

                    $emailData = array(
                        'query' => serialize($this->query),
                        'emails' => $emails
                    );

                    \Mail::queue('emails.queruassigned', $data, function ($message) use ($emailData) {

                        //Fetch emails of users to wchich query was sent
                        $query = unserialize($emailData['query']);
                        $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                        $message->to($emailData['emails'])->subject('Issue Event Details for :'.$query->query_code.' -- Assignment (Status : '.$query->status.')');
                    });
                }

            }
        }
    }
}
