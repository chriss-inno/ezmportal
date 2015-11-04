<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Query;
use App\QueryEmail;
use App\SystemSetup;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class unAssignedQueryReminder extends Job implements SelfHandling, ShouldQueue
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
        //Get query

        $sysset=SystemSetup::all()->first();
        if($sysset !=null)
        {   //Check for new day
            if(date("H:i") >="00:00" && date("H:i") <="04:00") {

                $date=date("Y")."-".date("m")."-".date("d")." 09:00";
                $sysset->query_nextexe_check = date("Y-m-d H:i",strtotime($date));
                $sysset->save();
            }

            //Automation time  time

            if(date("H:i") >="09:00" && date("H:i") <="20:00") {

                if($sysset->query_nextexe_check == null || $sysset->query_nextexe_check == "" || date("Y-m-d H:i",strtotime($sysset->query_nextexe_check)) == date("Y-m-d H:i"))
                {
                    $departments=\App\Department::where('receive_query','=','1')->get();
                    foreach($departments as $dp)
                    {
                        /*$queries=\DB::select(" SELECT * FROM prt_queries WHERE id not in(SELECT query_id FROM prt_query_assignments)
                                             AND to_department ='".$dp->id."'");

                        */

                        $queries=Query::where('assigned','=',0)->where('to_department','=',$dp->id)
                            ->where(\DB::raw('MINUTE(TIMEDIFF(sysdate(),reporting_Date))'), '>=', 15)->get();

                        if($queries != null && $queries !="" && count($queries)>0 ) {

                            //Send email

                            $emails=QueryEmail::where('department_id','=',$dp->id)->get();

                            if($emails != null && $emails != "" && count($emails) > 0)
                            {
                                //Get emails from department
                                $data = array(
                                    'queries' => serialize($queries),
                                    'department' => $dp->department_name
                                );

                                foreach($emails as $em)
                                {
                                    $email= $em->email;
                                    \Mail::queue('emails.unassignedqueries', $data, function ($message) use ($email) {

                                        //Fetch emails of users to wchich query was sent
                                        $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                                        $message->to($email)->subject('Remainder unassigned queries for past 15 minutes');
                                    });
                                }




                            }


                        }

                    }

                    $sysset->query_nextexe_check=date("Y-m-d H:i",strtotime("+15 minutes",strtotime( $sysset->query_nextexe_check)));
                    $sysset->save();

                }
            }


        }
        else
        {
            $sysset=new SystemSetup;
            $sysset->query_nextexe_check=date("Y-m-d H:i",strtotime("+15 minutes",strtotime( date("Y-m-d H:i"))));
            $sysset->save();
        }


    }
}
