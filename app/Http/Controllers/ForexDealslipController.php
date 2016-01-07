<?php

namespace App\Http\Controllers;

use App\ForexDealSlip;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForexDealslipController extends Controller
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
        $deals=ForexDealSlip::all();
        return view('forex.deal.index',compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('forex.deal.create');
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
        $deal=new  ForexDealSlip;
        $deal->deal_date=date("Y-m-d");
        $deal->value_date=$request->value_date;
        $deal->counter_party=$request->counter_party;
        $deal->value_date=date("Y-m-d",strtotime($request->value_date));
        $deal->counter_party=$request->counter_party;
        $deal->curr_amount_bought_ccy=$request->curr_amount_bought_ccy;
        $deal->curr_amount_bought=$request->curr_amount_bought;
        $deal->curr_amount_sold_ccy=$request->curr_amount_sold_ccy;
        $deal->curr_amount_sold=$request->curr_amount_sold;
        $deal->rate=$request->rate;
        $deal->confirmed_with=$request->confirmed_with;
        $deal->bankm_dealer=$request->bankm_dealer;
        $deal->mobile=$request->mobile;
       // $deal->confirmed_date=$request->confirmed_date;
        $deal->instruction=$request->instruction;
        $deal->email=$request->email;
        $deal->save();

        //Create deal number
        $deal_number= $deal->id.".".date("m").".".date("d");
        $deal->deal_number=$deal_number;
        $deal->save();
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
        $deal=ForexDealSlip::find($id);
        return view('forex.deal.show',compact('deal'));
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
        $deal=ForexDealSlip::find($id);
        return view('forex.deal.edit',compact('deal'));
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
        $deal=ForexDealSlip::find($id);
        $deal->delete();
    }

    //reports

    public function reports()
    {
        return view('forex.deal.report');
    }

    //
    public function reportsToday()
    {
        return view('forex.deal.report');
    }
    //
    public function monthToday()
    {
        return view('forex.deal.report');
    }

    public function reportsGenerate()
    {
        return view('forex.deal.report');
    }



}
