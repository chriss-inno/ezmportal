<?php

namespace App\Http\Controllers;

use App\DispatchCustomer;
use App\SMSDistributionList;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SMSDistributionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $distribution= SMSDistributionList::all();
        return view('sms.distribution.index',compact('distribution'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sms.distribution.create');
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
            $distribution= new SMSDistributionList;
            $distribution->list_name=$request->list_name;
            $distribution->descriptions=$request->descriptions;
            $distribution->status=$request->status;
            $distribution->input_by=Auth::user()->username;
            $distribution->save();
            return "Saved successfully";
        }
        catch(\Exception $ex)
        {
            return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i> ' . $ex->getMessage() .'

                </div>';
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
        $distribution= SMSDistributionList::find($id);
        return view('sms.distribution.show',compact('distribution'));
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
        $distribution= SMSDistributionList::find($id);
        return view('sms.distribution.edit',compact('distribution'));
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
        try
        {
        $distribution= SMSDistributionList::find($request->id);
        $distribution->list_name=$request->list_name;
        $distribution->descriptions=$request->descriptions;
        $distribution->status=$request->status;
        $distribution->input_by=Auth::user()->username;
        $distribution->save();
            return "Saved successfully";
        }
        catch(\Exception $ex)
        {
            return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i> ' . $ex->getMessage() .'

                </div>';
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
        $distribution= SMSDistributionList::find($id);
        if($distribution->distribution != null && count($distribution->distribution) >0)
        {
            foreach($distribution->distribution as  $dist)
            {
                $dist->delete();
            }
        }
        $distribution->delete();

    }

    //

    public function assignCustomers($id)
    {
        $distribution= SMSDistributionList::find($id);
        return view('sms.distribution.assignment',compact('distribution'));
    }
    public function postAssignCustomers(Request $request)
    {

        if($request->departments != null && count($request->departments) >0)
        {
            //Remove previous assignment
            $remodisp=DispatchCustomer::where('dispatch_id','=',$request->dispatch_id)->get();
            if(count($remodisp) > 0)
            {
               foreach($remodisp as $dt)
               {
                   $dt->delete();
               }
            }
           foreach($request->departments as $cust)
           {
               if(! count(DispatchCustomer::where('dispatch_id','=',$request->dispatch_id)->where('customer_id','=',$cust)->get()) >0)
               {
                   $disp=new DispatchCustomer;
                   $disp->dispatch_id=$request->dispatch_id;
                   $disp->customer_id=$cust;
                   $disp->input_by=Auth::user()->username;
                   $disp->save();
               }

           }

        }

        return redirect('sms/dispatch');

    }
}
