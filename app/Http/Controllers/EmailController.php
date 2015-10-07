<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OracleSupport;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
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
    public function cronejob()
    {
        //
        $this->serviceStarts(); //Send service starts
        $this->olacle(); //Send oracle logged issues
    }


    //
    public function serviceStarts()
    {
        //

        $services=Service::where('email_sent','=','N')->get();
        if(date("H:i") =="21:00") {
            if(count($services) >0 ) {
                //Send email
                $data = array(
                    'service' => $services,
                );

                \Mail::queue('emails.servicestartus', $data, function ($message) {

                    $emails = ['adolph.mwakalinga@bankm.com','innocent.christopher@bankm.com']; //List emails
                    $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                    $message->to($emails)->subject('SYSTEM SERVICE STATUS REPORT AS OF '.date("d F Y"));

                });

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
              echo date("H:i");
             
             //Send every day at 9 pm, the email is sent to support
              if(date("H:i") =="23:15") {
                  if(count($issues) >0 ) {
                      $data = array(
                          'issues' => $issues,
                      );
                      //Send email
                      \Mail::queue('emails.oracle', $data, function ($message) {

                          $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

                          $message->to('innocent.christopher@bankm.com')->subject('DAILY ISSUES LOGGED');
                     echo "Email sent";
                      });
					   
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
				echo "Email not sent";
				 
             }
			 




    }

}
