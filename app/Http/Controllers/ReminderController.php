<?php

namespace App\Http\Controllers;

use App\Reminder;
use App\ReminderEmail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReminderRequest;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{

    public function index()
    {
        //
        $reminders=Reminder::all();
        return view('reminders.index',compact('reminders'));
    }

    public function getHistoryList()
    {
        //
        $reminders=Reminder::all();
        return view('reminders.index',compact('reminders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActiveList()
    {
        //
        $reminders=Reminder::all();
        return view('reminders.index',compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('reminders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReminderRequest $request)
    {
        //
        $reminder=new Reminder;
        $reminder->rm_title=$request->rm_title;
        $reminder->start_date=date("Y-m-d",strtotime($request->start_date));
        $reminder->end_date=date("Y-m-d",strtotime($request->end_date));
        $reminder->description=$request->description;
        $reminder->status=$request->status;
        $reminder->recurrence_pattern=$request->recurrence_pattern;
        $reminder->days_before=$request->notification_days;
        $reminder->notify_before=$request->notify_before;
        $reminder->rm_access=$request->rm_access;
        $reminder->input_by=Auth::user()->username;
        $reminder->user_id=Auth::user()->id;
        $reminder->instruction_date=date("Y-m-d",strtotime($request->start_date));
        $reminder->save();

        //Process emails
        if($request->emails !="") {
            $emailscm = strstr($request->emails, ',');
            if ($emailscm ==true) {
                $emlar = explode(",", $request->emails);
                foreach ($emlar as $eml) {

                    if (filter_var($eml, FILTER_VALIDATE_EMAIL)) {
                        $em = new ReminderEmail;
                        $em->rmd_id = $reminder->id;
                        $em->email = $eml;
                        $em->status = "Enabled";
                        $em->input_by = Auth::user()->username;
                        $em->save();
                    }

                }
            } else {
                if (filter_var($request->emails, FILTER_VALIDATE_EMAIL)) {
                    $em = new ReminderEmail;
                    $em->rmd_id = $reminder->id;
                    $em->email = $request->emails;
                    $em->status = "Enabled";
                    $em->input_by = Auth::user()->username;
                    $em->save();
                }
            }
        }

        return redirect('reminders');
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
        $reminder=Reminder::find($id);
        return view('reminders.show',compact('reminder'));
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
        $reminder=Reminder::find($id);
        return view('reminders.edit',compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReminderRequest $request)
    {
        //
        $reminder= Reminder::find($request->rm_id);
        $reminder->rm_title=$request->rm_title;
        $reminder->start_date=date("Y-m-d",strtotime($request->start_date));
        $reminder->end_date=date("Y-m-d",strtotime($request->end_date));
        $reminder->description=$request->description;
        $reminder->status=$request->status;
        $reminder->recurrence_pattern=$request->recurrence_pattern;
        $reminder->days_before=$request->notification_days;
        $reminder->notify_before=$request->notify_before;
        $reminder->rm_access=$request->rm_access;
        $reminder->input_by=Auth::user()->username;
        $reminder->instruction_date=date("Y-m-d",strtotime($request->start_date));
        $reminder->save();

        //Process emails
        if($request->emails !="") {
            if(count(ReminderEmail::where('rmd_id','=', $reminder->id)->get()) >0)
            {
                foreach(ReminderEmail::where('rmd_id','=', $reminder->id)->get() as $eml)
                {
                    $eml->delete();
                }
            }

            $emailscm = strstr($request->emails, ',');
            if ($emailscm ==true) {
                $emlar = explode(",", $request->emails);
                foreach ($emlar as $eml) {

                    if (filter_var($eml, FILTER_VALIDATE_EMAIL)) {
                        $em = new ReminderEmail;
                        $em->rmd_id = $reminder->id;
                        $em->email = $eml;
                        $em->status = "Enabled";
                        $em->input_by = Auth::user()->username;
                        $em->save();
                    }

                }
            } else {
                if (filter_var($request->emails, FILTER_VALIDATE_EMAIL)) {
                    $em = new ReminderEmail;
                    $em->rmd_id = $reminder->id;
                    $em->email = $request->emails;
                    $em->status = "Enabled";
                    $em->input_by = Auth::user()->username;
                    $em->save();
                }
            }
        }

        return redirect('reminders');
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
        $reminder=Reminder::find($id);
        if(count(ReminderEmail::where('rmd_id','=', $reminder->id)->get()) >0)
        {
            foreach(ReminderEmail::where('rmd_id','=', $reminder->id)->get() as $eml)
            {
                $eml->delete();
            }
        }
        $reminder->delete();
    }
}
