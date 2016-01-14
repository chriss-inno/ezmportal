<?php

namespace App\Http\Controllers;

use App\Reminder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
    public function store(Request $request)
    {
        //
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
        $reminders=Reminder::find($id);
        return view('reminders.show',compact('reminders'));
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
        $reminders=Reminder::find($id);
        return view('reminders.edit',compact('reminders'));
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
        $reminders=Reminder::find($id);
        $reminders->delete();
    }
}
