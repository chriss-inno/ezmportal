<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ServiceLog;
use App\ServiceLogArea;
use Illuminate\Support\Facades\Auth;
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
        $sl->remarks=$request->remarks;
        $sl->status=$request->status;
        $sl->input_by=Auth::user()->username;;
        $sl->logdate=date('Y-m-d');
        $sl->save();

        //Save area affected
        //Branches
        foreach($request->branches as $br)
        {
            $sa=new ServiceLogArea;
            $sa->serviceLog_id=$sl->id;
            $sa->area_affected=$br;
            $sa->area_type='branch';
            $sa->save();
        }

        //Units
        foreach($request->departments as $dp)
        {
            $sa=new ServiceLogArea;
            $sa->serviceLog_id=$sl->id;
            $sa->area_affected=$dp;
            $sa->area_type='unit';
            $sa->save();
        }

        return redirect('serviceslogs/today');
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
        return view('servicelogs.editLogstatus',compact('service'));
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
        $sl->status=$request->status;
        $sl->input_by=Auth::user()->username;;
        $sl->logdate=date('Y-m-d');
        $sl->save();


        foreach($sl->areas as $a)
        {
            $a->delete();
        }
        //Save area affected
        //Branches
        foreach($request->branches as $br)
        {
            $sa=new ServiceLogArea;
            $sa->serviceLog_id=$sl->id;
            $sa->area_affected=$br;
            $sa->area_type='branch';
            $sa->save();
        }

        //Units
        foreach($request->departments as $dp)
        {
            $sa=new ServiceLogArea;
            $sa->serviceLog_id=$sl->id;
            $sa->area_affected=$dp;
            $sa->area_type='unit';
            $sa->save();
        }

        return redirect('serviceslogs/today');
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
        $sl= ServiceLog::find($id);
        foreach($sl->areas as $a)
        {
            $a->delete();
        }
        $sl->delete();

        return "Delete of service log successful";
    }
}
