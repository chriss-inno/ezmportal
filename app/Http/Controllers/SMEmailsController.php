<?php

namespace App\Http\Controllers;

use App\SMEmails;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SMEmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emails=SMEmails::all();
        return view('servicelogs.emails.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicelogs.emails.create');
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
                'email' => 'required|email|unique:s_m_emails'
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {

                return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    Save failed, email already exist
                </div>';
            }
            else
            {
                $email= new SMEmails;
                $email->email=$request->email;
                $email->display_name=$request->display_name;
                $email->status=$request->status;
                $email->input_by=Auth::user()->username;
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
        $email=SMEmails::find($id);
        return view('servicelogs.emails.show',compact('email'));
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
        $email=SMEmails::find($id);
        return view('servicelogs.emails.edit',compact('email'));
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
            $email=SMEmails::find($id);
            $email->email=$request->email;
            $email->display_name=$request->display_name;
            $email->status=$request->status;
            $email->input_by=Auth::user()->username;
            $email->save();
            return "Email saved successfully";

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
        $email=SMEmails::find($id);
        $email->delete();
    }
}
