<?php

namespace App\Http\Controllers;

use App\SDEmail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SDEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emails= SDEmail::all();
        return view('servicedelivery.email.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicedelivery.email.create');
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
        $email= new SDEmail;
        $email->email=$request->email;
        $email->display_name=$request->display_name;
        $email->status=$request->status;
        $email->input_by=Auth::user()->username;
        $email->save();
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
        $email= SDEmail::find($id);
        return view('servicedelivery.email.show',compact('email'));
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
        $email= SDEmail::find($id);
        return view('servicedelivery.email.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $email= SDEmail::find($request->id);
        $email->email=$request->email;
        $email->display_name=$request->display_name;
        $email->status=$request->status;
        $email->input_by=Auth::user()->username;
        $email->save();
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
        $email= SDEmail::find($id);
        $email->delete();
    }
}
