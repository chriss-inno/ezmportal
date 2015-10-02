<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Enabler;
use Illuminate\Support\Facades\Auth;

class EnablerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enablers=Enabler::all();
        return view('enabler.index',compact('enablers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('enabler.create');
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
        $enabler=new Enabler;
        $enabler->enabler_name=$request->enabler_name;
        $enabler->description=$request->description;
        $enabler->status=$request->status;
        $enabler->input_by=Auth::user()->username;
        $enabler->save();

        return "Data saved successfully";
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
        $enabler= Enabler::find($id);
        return view('enabler.show',compact('enabler'));
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
        $enabler= Enabler::find($id);
        return view('enabler.edit',compact('enabler'));
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
        $enabler= Enabler::find($id);
        $enabler->enabler_name=$request->enabler_name;
        $enabler->description=$request->description;
        $enabler->status=$request->status;
        $enabler->input_by=Auth::user()->username;
        $enabler->save();
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
        $enabler= Enabler::find($id)->delete();
    }
}
