<?php

namespace App\Http\Controllers;

use App\QueryEmail;
use App\User;
use App\Query;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QueryEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emails=QueryEmail::all();
        return view('queryemails.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('queryemails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try
        {
            $input = array('email' =>  $request->email);

            $rules = array(
                'email' => 'required|email|unique:query_emails'
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {

                return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    Save failed, email already exist Submit failed
                </div>';
            }
            else
            {
                $email = new QueryEmail;
                $email->email = $request->email;
                $email->department_id = $request->department_id;
                $email->status = $request->status;
                $email->input_by = Auth::user()->username;
                $email->save();

                return "Email saved successfully";
            }
        }catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $email=QueryEmail::find($id);
        return view('queryemails.show',compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $email=QueryEmail::find($id);
        return view('queryemails.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try
        {
            $email=QueryEmail::find($id);
            $email->email=$request->email;
            $email->department_id=$request->department_id;
            $email->status=$request->status;
            $email->input_by=Auth::user()->username;
            $email->save();

            return "<h3 class='text-info'>Email saved successfully</h3>";
        }catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
        $email=QueryEmail::find($id);
        $email->delete();
            return "Delete successfully";
        }catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }

   //Sending emails

    public static function sendQueryLaunchedEmail($query)
    {
        if($query != null && $query !="" && count($query)>0 ) {
            $data = array(
                'query' => serialize($query)
            );

            //Send email
            foreach($query->toDepartment->users as $us) {
                if($us->email !="")
                {
                    $emails = $us->email;

                    $emailData = array(
                        'query' => serialize($query),
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

    //Query Assignment

    public static function sendQueryAssignmentEmail($query)
    {
        if($query != null && $query !="" >0 ) {
            $data = array(
                'query' => serialize($query)
            );

            //Send email
            foreach($query->toDepartment->users as $us) {
                if($us->email !="")
                {
                    $emails = $us->email;

                    $emailData = array(
                        'query' => serialize($query),
                        'emails' => $emails
                    );

                    \Mail::queue('emails.newquery', $data, function ($message) use ($emailData) {

                        //Fetch emails of users to wchich query was sent
                        $query = unserialize($emailData['query']);
                        $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                        $message->to($emailData['emails'])->subject('Issue Event Details for :'.$query->query_code.' -- Assignment (Status : '.$query->status.')');
                    });
                }

            }
        }
    }

    //
    public static function sendQueryProgressEmail($msg)
    {
        if($msg != null && $msg !="" >0 ) {
            $data = array(
                'msg' => serialize($msg)
            );

            //Send email
            foreach($msg->mQuery->toDepartment->users as $us) {
                if($us->email !="")
                {
                    $emails = $us->email;

                    $emailData = array(
                        'msg' => serialize($msg),
                        'emails' => $emails
                    );

                    \Mail::queue('emails.queryprogress', $data, function ($message) use ($emailData) {

                        //Fetch emails of users to wchich query was sent
                        $msg = unserialize($emailData['msg']);
                        $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                        $message->to($emailData['emails'])->subject('Issue Event Details for :'.$msg->mQuery->query_code.' -- Attendance  (Status : '.$msg->mQuery->status.')');
                    });
                }

            }
        }
    }
}
