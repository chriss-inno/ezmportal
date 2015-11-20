<?php

namespace App\Http\Controllers;

use App\SDCustomer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SDCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $customers= SDCustomer::all();
       return view('servicedelivery.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicedelivery.customer.create');
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
            $customer= new SDCustomer;
            $customer->company_name=$request->company_name;
            $customer->contact_person=$request->contact_person;
            $customer->address=$request->address;
            $customer->phone=$request->phone;
            $customer->email=$request->email;
            $customer->status=$request->status;
            $customer->input_by= Auth::user()->username;
            $customer->save();

            return "Saved successfully";
        }
        catch(\Exception $ex)
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
        $customer=  SDCustomer::find($id);
        return view('servicedelivery.customer.show',compact('customer'));
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
        $customer=  SDCustomer::find($id);
        return view('servicedelivery.customer.edit',compact('customer'));
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
            $customer=  SDCustomer::find($request->id);
            $customer->company_name=$request->company_name;
            $customer->contact_person=$request->contact_person;
            $customer->address=$request->address;
            $customer->phone=$request->phone;
            $customer->email=$request->email;
            $customer->status=$request->status;
            $customer->input_by= Auth::user()->username;
            $customer->save();

            return "Saved successfully";
        }
        catch(\Exception $ex)
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
        $customer=  SDCustomer::find($id);
        $customer->delete();

    }

    //getContactPersonal
    public function getContactPersonal($id)
    {
        $customer=  SDCustomer::find($id);
        if($customer != null && $customer->contact_person != null &&  $customer->contact_person != ""  )
        {
           return  $customer->contact_person;
        }
    }
}
