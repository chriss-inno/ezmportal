<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ServiceLog;
class ServiceLogController extends Controller
{
    public function __construc()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $services =ServiceLog::all();
        return view('servicelogs.index',compact('services'));
    }
    public function serviceToday()
    {
        //
        $today=date("Y-m-d");
        $services =ServiceLog::where('logdate','=',$today)->get();
        return view('servicelogs.index',compact('services'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('servicelogs.logstatus');
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
        $sl=new ServiceLog;
        $sl->service_id=$request->service_id;
        $sl->log_title=$request->log_title;
        $sl->description=$request->description;
        $sl->reason=$request->reason;
        $sl->start_time=$request->start_time;
        $sl->end_time=$request->end_time;
        $sl->Remarks=$request->Remarks;
        $sl->input_by=$request->input_by;
        $sl->save();
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
        $service =ServiceLog::find($id);
        return view('servicelogs.show',compact('service'));
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
        $service =ServiceLog::find($id);
        return view('servicelog.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        //
        $sl= ServiceLog::find($request->id);
        $sl->service_id=$request->service_id;
        $sl->log_title=$request->log_title;
        $sl->description=$request->description;
        $sl->reason=$request->reason;
        $sl->start_time=$request->start_time;
        $sl->end_time=$request->end_time;
        $sl->Remarks=$request->Remarks;
        $sl->input_by=$request->input_by;
        $sl->save();
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
}
