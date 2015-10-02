<?php

namespace App\Http\Controllers;

use App\QueryStatus;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QueryStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $queriesStatus=QueryStatus::all();
        return view('queries.statusindex',compact('queriesStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('queries.statuscreate');
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
        $queriesStatus=new QueryStatus;
        $queriesStatus->status_name=strtoupper(strtolower($request->status_name));
        $queriesStatus->description=$request->description;
        $queriesStatus->input_by=Auth::user()->username;
        $queriesStatus->status=$request->status;
        $queriesStatus->save();

        return "Data is successful saved";
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
        $queriesStatus=QueryStatus::find($id);
        return view('queries.statusshow',compact('queriesStatus'));
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
        $queriesStatus=QueryStatus::find($id);
        return view('queries.statusedit',compact('queriesStatus'));
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
        $queriesStatus= QueryStatus::find($id);
        $queriesStatus->status_name=strtoupper(strtolower($request->status_name));
        $queriesStatus->description=$request->description;
        $queriesStatus->input_by=Auth::user()->username;
        $queriesStatus->status=$request->status;
        $queriesStatus->save();
        return "Data is successful saved";
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
        $queriesStatus=QueryStatus::find($id)->delete();
    }
}
