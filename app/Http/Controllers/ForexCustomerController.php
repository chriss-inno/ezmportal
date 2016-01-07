<?php

namespace App\Http\Controllers;

use App\ForexCustomer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForexCustomerController extends Controller
{

    public function __construct()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
        elseif(!(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,9)  || Auth::user()->user_type=="Administrator"))
        {
            return redirect()->back();
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
        $customers=ForexCustomer::all();
        return view('forex.customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('forex.customers.create');
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
        $customers=new ForexCustomer;
        $customers->customer=$request->customer;
        $customers->rm_code=$request->rm_code;
        $customers->status=$request->status;
        $customers->save();

        return "Saved successfully";
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
        $customer= ForexCustomer::find($id);
        return view('forex.customers.edit',compact('customer'));
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
        $customer= ForexCustomer::find($request->id);
        $customer->customer=$request->customer;
        $customer->rm_code=$request->rm_code;
        $customer->status=$request->status;
        $customer->save();

        return "Saved successfully";
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
        $customer= ForexCustomer::find($id);
        $customer->delete();
    }
}
