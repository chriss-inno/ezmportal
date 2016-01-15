<?php

namespace App\Http\Controllers;

use App\SystemSetup;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SystemSetupController extends Controller
{
    public function __construct()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $system=SystemSetup::all()->first();
        return view('systemsetups.index',compact('system'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if($request->save_request =="Add_new")
        {
            $system=new SystemSetup;
            $system->credit_link_1=$request->credit_link_1;
            $system->credit_link_2=$request->credit_link_2;
            $system->hr_link_1=$request->hr_link_1;
            $system->mm_link_1=$request->mm_link_1;
            $system->automation_start_tm=$request->automation_start_tm;
            $system->automation_end_tm=$request->automation_end_tm;
            $system->automation_status=$request->automation_status;
            $system->portal_eod_report_date=$request->portal_eod_report_date;
            $system->input_by=Auth::user()->username;
            $system->reminder_status=$request->reminder_status;
            $system->reminder_start_tm=$request->reminder_start_tm;
            $system->reminder_end_tm=$request->reminder_end_tm;

            $system->save();

            return redirect('systemsetups');
        }
        else
        {
            $system=SystemSetup::all()->first();
            $system->credit_link_1=$request->credit_link_1;
            $system->credit_link_2=$request->credit_link_2;
            $system->hr_link_1=$request->hr_link_1;
            $system->mm_link_1=$request->mm_link_1;
            $system->automation_start_tm=$request->automation_start_tm;
            $system->automation_end_tm=$request->automation_end_tm;
            $system->automation_status=$request->automation_status;
            $system->portal_eod_report_date=$request->portal_eod_report_date;
            $system->input_by=Auth::user()->username;
            $system->reminder_status=$request->reminder_status;
            $system->reminder_start_tm=$request->reminder_start_tm;
            $system->reminder_end_tm=$request->reminder_end_tm;
            $system->save();
            return redirect('systemsetups');
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
}
