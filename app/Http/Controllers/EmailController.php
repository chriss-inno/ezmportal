<?php

namespace App\Http\Controllers;

use App\Jobs\SDDaily;
use App\Jobs\ServiceDailyLogged;
use App\Jobs\ServiceMonitoring;
use App\Jobs\ServiceOracle;
use App\Jobs\unAssignedQueryReminder;
use App\Service;
use App\SMEmails;
use App\SystemSetup;
use Illuminate\Http\Request;
use App\QueryEmail;
use App\User;
use App\Query;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OracleSupport;
use PhpSpec\Exception\Exception;
use Maatwebsite\Excel\Facades\Excel;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $pathToFile="";
    protected $depatment="";

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    //
    public function cronejob()
    {
        //
        try
        {

            $job = (new ServiceMonitoring())->delay(10);
            $this->dispatch($job);

            $job1 = (new ServiceOracle())->delay(10);
            $this->dispatch($job1);

            $job2 = (new ServiceDailyLogged())->delay(10);
            $this->dispatch($job2);

           // $job3 = (new unAssignedQueryReminder())->delay(10);
          //   $this->dispatch($job3);
           // $job4 = (new SDDaily())->delay(10);
           // $this->dispatch($job4);

        }catch (\Exception $ex)
        {
            echo  $ex->getMessage();
        }
        finally
        {

            $job = (new ServiceMonitoring())->delay(10);
            $this->dispatch($job);

            $job1 = (new ServiceOracle())->delay(10);
            $this->dispatch($job1);

            $job2 = (new ServiceDailyLogged())->delay(10);
            $this->dispatch($job2);

           // $job3 = (new unAssignedQueryReminder())->delay(10);
           // $this->dispatch($job3);

            // $this->serviceStarts(); //Send service starts
            //$this->olacle(); //Send oracle logged issues
            //$this->unAssignedQueryReminder(); //Send reminder for unassigned queries
        }

    }

    //Process daily logged email
    public function dailyLogged()
    {
        if(date("H:i") =="21:00") {

            $departments=\App\Department::where('receive_query','=','1')->get();
            foreach($departments as $dp)
            {

                $queries=Query::where('to_department','=',$dp->id)->where('today_date','=',date("Y-m-d"))->orwhere('closed','=',0)->get(); //Get all queries under this department

                $queries_report="daily_logged_queries_".date('YmdHis');
                Excel::create($queries_report, function($excel) use($queries)  {

                    $excel->sheet('sheet', function($sheet) use($queries){
                        $sheet->loadView('excels.excel')->with('queries', $queries);

                    });

                })->store('xls', storage_path('exports/excel'));

                $this->pathToFile=storage_path('exports/excel').$queries_report.".xls";
                $this->depatment=$dp->department_name;

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
                            \Mail::queue('emails.dailyquery', $data, function ($message) use ($email) {

                                //Fetch emails of users to wchich query was sent
                                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                                $message->to($email)->subject($this->depatment.' DAILY ISSUES LOGGED');
                                $message->attach($this->pathToFile);
                            });
                        }




                    }


                }


            }
        }


    }
    //
    public function serviceStarts()
    {
        //

        $services=Service::where('email_sent','=','N')->get();



        if(date("H:i") >="07:00" && date("H:i") <="08:30") {
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

                    echo "emails".dump($dataemail);
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


    //Oracle issues
    public function olacle()
    {
        //
        $issues=OracleSupport::where('status','=','Opened')->where('email_sent','=','N')->get(); //retrieve all opened issues

             //Send every day at 9 pm, the email is sent to support
          echo date("H:i");
              if(date("H:i") =="21:00") {

                  if(count($issues) >0 ) {
                      $data = array(
                          'supportissues' => $issues,
                      );
                      //Send email
                      \Mail::queue('emails.oracle', $data, function ($message) {

                          $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                          $message->to('support@bankm.com')->subject('DAILY ISSUES LOGGED');
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

    //Send reminder Query unassigned reminder
    public  function unAssignedQueryReminder()
    {
        //Get query
        $sysset=SystemSetup::all()->first();
        if($sysset->query_nextexe_check == null || $sysset->query_nextexe_check == "" || $sysset->query_nextexe_check == date("H:i"))
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

            $sysset->query_nextexe_check=strtotime('+15 minutes',$sysset->query_nextexe_check);
            $sysset->save();

        }
        else
        {
            $sysset->query_nextexe_check=strtotime('+15 minutes',$sysset->query_nextexe_check);
            $sysset->save();
        }


    }

}
