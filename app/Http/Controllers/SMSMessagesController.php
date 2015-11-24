<?php

namespace App\Http\Controllers;

use App\Jobs\SendSMS;
use App\SMSLog;
use App\SMSMessages;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SMSMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $smsmessages=SMSMessages::all();
        return view('sms.messages.index',compact('smsmessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sms.messages.create');
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
        $sms=new SMSMessages;
        $sms->message_title=$request->message_title;
        $sms->message=$request->message;
        $sms->dispatch_id=$request->dispatch_id;
        $sms->status='Pending';
        $sms->input_by=Auth::user()->username;
        $sms->save();

        //Dispatch job
        $msg= SMSMessages::find($sms->id);
       // dump($msg);
        //Send email
        $job = (new SendSMS($msg))->delay(10);
        $this->dispatch($job);

        return redirect('sms/messages');
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
    }

    //Dispatch log
    public function dispatchLog($id)
    {
        $smsmessages=SMSLog::where('message_id','=',$id)->get();
        return view('sms.messages.history',compact('smsmessages'));
    }
}
