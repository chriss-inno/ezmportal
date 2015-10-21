<?php

namespace App\Http\Controllers;

use App\QueryEmail;
use App\User;
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
            $email=new QueryEmail;
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

    public function sendQueryLaunchedEmail($query)
    {
         if($query != null && $query !="" >0 ) {
            $data = array(
                'query' => $query,
            );
            //Send email
            \Mail::queue('emails.newquery', $data, function ($message) use($query) {

                //Fetch emails of users to wchich query was sent
                $emails=$query->toDepartment->users->lists('email');
                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                $message->to($emails)->subject('Bank M Service portal: New Query Request notifications');
            });
            echo "Sent";
        }
    }

    //Query Assignment

    public function sendQueryAssignmentEmail($query)
    {
        if($query != null && $query !="" >0 ) {
            $data = array(
                'query' => $query,
            );
            //Send email
            \Mail::queue('emails.newquery', $data, function ($message) use($query) {

                //Fetch emails of users to wchich query was sent
                $emails=$query->toDepartment->users->lists('email');
                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                $message->to($emails)->subject('Bank M Service portal:Query Assignment notifications');
            });
            echo "Sent";
        }
    }

    //
    public function sendQueryProgressEmail($query)
    {
        if($query != null && $query !="" >0 ) {
            $data = array(
                'query' => $query,
            );
            //Send email
            \Mail::queue('emails.newquery', $data, function ($message) use($query) {

                //Fetch emails of users to wchich query was sent
                $emails=$query->toDepartment->users->lists('email');
                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');
                $message->to($emails)->subject('Bank M Service portal:Query progress notifications');
            });
            echo "Sent";
        }
    }
}
