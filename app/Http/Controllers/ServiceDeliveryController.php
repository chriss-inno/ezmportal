<?php

namespace App\Http\Controllers;

use App\CustomerIssues;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServiceDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $issues=CustomerIssues::all();
        return view('servicedelivery.index',compact('issues'));
    }

    //Reports
    public function reports()
    {
        //
        $issues=CustomerIssues::all();
        return view('servicedelivery.reports',compact('issues'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicedelivery.create');
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
        try
        {
            $issues= new CustomerIssues;
            $issues->company_id=$request->company_id;
            $issues->product_id=$request->product_id;
            $issues->product_details_id=$request->product_details_id;
            $issues->mode_id=$request->mode_id;
            $issues->description=$request->description;
            $issues->department_id=$request->department_id;
            $issues->received_by=$request->received_by;
            $issues->status_id=$request->status_id;
            $issues->date_created=date("Y-m-d");
            $issues->input_by=Auth::user()->username;
            $issues->save();

            //Create Issue number
            $issues->issues_number= "CIN".$issues->id;
            $issues->save();
            return "Data saved successfully";

        }catch (\Exception $ex)
        {
            return $ex->getMessage();
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
        $issue=CustomerIssues::find($id);
        return view('servicedelivery.show',compact('issue'));
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
        $issue=CustomerIssues::find($id);
        return view('servicedelivery.edit',compact('issue'));
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
        try
        {
            $issues= CustomerIssues::find($request->issue_id);
            $issues->company_id=$request->company_id;
            $issues->contact_person=$request->contact_person;
            $issues->product_id=$request->product_id;
            $issues->product_details_id=$request->product_details_id;
            $issues->mode_id=$request->mode_id;
            $issues->description=$request->description;
            $issues->department_id=$request->department_id;
            $issues->received_by=$request->received_by;
            $issues->status_id=$request->status_id;
            $issues->input_by=Auth::user()->username;
            $issues->save();

            return "Data saved successfully";

        }catch (\Exception $ex)
        {
            return $ex->getMessage();
        }



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
        $issue=CustomerIssues::find($id);
        $issue->delete();
    }

    //View setting page

    public function settings()
    {
        $issues=CustomerIssues::all();
        return view('servicedelivery.setting.index',compact('issues'));
    }
}
