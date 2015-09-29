<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OracleSupport;
use App\Http\Requests\OracleSupportRequest;
use Illuminate\Support\Facades\Auth;
use App\IssuesDailyUpdates;
use Illuminate\Mail;

class OracleSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $issues=OracleSupport::all();
        return view('oraclesupport.index',compact('issues'));
    }
    public function opened()
    {
        //
        $issues=OracleSupport::where('status','=','Opened')->get();
        return view('oraclesupport.index',compact('issues'));
    }

    public function updateStatus($id)
    {
        //
        $issues=OracleSupport::find($id);
        return view('oraclesupport.status',compact('issues'));
    }
    public function saveStatus(Request $request)
    {
        //
        $status=new IssuesDailyUpdates;
        $status->current_update=$request->current_update;
        $status->issue_id=$request->issue_id;
        $status->input_by=Auth::user()->username;
        $status->current_date=date('Y-m-d');
        $status->display_name=Auth::user()->first_name." ".Auth::user()->last_name;
        $status->save();

        return "<h3 class='text-info'>Data saved successful</h3>";
    }



    public function closed()
    {
        //
        $issues=OracleSupport::where('status','=','Closed')->get();
        return view('oraclesupport.index',compact('issues'));
    }
    public function report()
    {
        //
        $issues=OracleSupport::all();
        return view('oraclesupport.index',compact('issues'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('oraclesupport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(OracleSupportRequest $request)
    {
        //
        $os=new OracleSupport;
        $os->issue_title=ucwords(strtolower($request->issue_title));
        $os->description=$request->description;
        $os->sr_number=$request->sr_number;
        $os->product=$request->product;
        $os->contact=$request->contact;
        $os->date_opened=$request->date_opened;
        if($request->date_closed !=""){
         $os->date_closed=$request->date_closed;
        }
        $os->current_status=$request->current_status;
        $os->status=$request->status;
        $os->input_by=Auth::user()->username;
        $os->save();

        return redirect('support/oracle/opened');
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
        $issue=OracleSupport::find($id);
        return view('oraclesupport.show',compact('issue'));
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
        $issues=OracleSupport::find($id);
        return view('oraclesupport.edit',compact('issues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(OracleSupportRequest $request)
    {
        //
        $os= OracleSupport::find($request->id);
        $os->issue_title=$request->issue_title;
        $os->description=$request->description;
        $os->sr_number=$request->sr_number;
        $os->product=$request->product;
        $os->contact=$request->contact;
        $os->date_opened=$request->date_opened;
        if($request->date_closed !=""){
            $os->date_closed=$request->date_closed;
        }
        $os->current_status=$request->current_status;
        $os->status=$request->status;
        $os->input_by=Auth::user()->username;
        $os->save();

        return redirect('support/oracle/opened');
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
        $os= OracleSupport::find($id);
        foreach($os->dailyUpdates as $du)
        {
            $du->delete();
        }
        $os->delete();

    }

}
