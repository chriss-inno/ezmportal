<?php

namespace App\Http\Controllers;

use App\ForexCurrency;
use App\ForexCustomer;
use App\ForexDealSlip;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

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
        $deals=ForexDealSlip::all()->take(2000);
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
        try {
            $deal = new  ForexDealSlip;
            $deal->deal_date = date("Y-m-d H:i");
            $deal->value_date = $request->value_date;
            $deal->counter_party = $request->counter_party;
            $deal->curr_amount_bought_ccy = $request->curr_amount_bought_ccy;
            $deal->curr_amount_bought = $request->curr_amount_bought;
            $deal->curr_amount_sold_ccy = $request->curr_amount_sold_ccy;
            $deal->curr_amount_sold = $request->curr_amount_sold;
            $deal->rate = $request->rate;
            $deal->confirmed_with = $request->confirmed_with;
            $deal->bankm_dealer = $request->bankm_dealer;
            $deal->mobile = $request->mobile;
            // $deal->confirmed_date=$request->confirmed_date;
            $deal->instruction = $request->instruction;
            $deal->email = $request->email;
            $deal->save();

            //Create deal number
            $deal_number = $deal->id . "." . date("m") . "." . date("d");
            $deal->deal_number = $deal_number;
            $deal->save();

            return redirect('forex/dealslip/view');
        }
        catch(\Exception $ex)
        {
            return back()->with("eooro",$ex->getMessage());
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
    public function update(Request $request)
    {
        //
        try {
            $deal=ForexDealSlip::find( $request->deal_id);
            $deal->deal_date =$request->deal_date;
            $deal->value_date = $request->value_date;
            $deal->counter_party = $request->counter_party;
            $deal->curr_amount_bought_ccy = $request->curr_amount_bought_ccy;
            $deal->curr_amount_bought = $request->curr_amount_bought;
            $deal->curr_amount_sold_ccy = $request->curr_amount_sold_ccy;
            $deal->curr_amount_sold = $request->curr_amount_sold;
            $deal->rate = $request->rate;
            $deal->confirmed_with = $request->confirmed_with;
            $deal->bankm_dealer = $request->bankm_dealer;
            $deal->mobile = $request->mobile;
            // $deal->confirmed_date=$request->confirmed_date;
            $deal->instruction = $request->instruction;
            $deal->email = $request->email;
            $deal->save();

            //Create deal number
            $deal_number = $deal->id . "." . date("m") . "." . date("d");
            $deal->deal_number = $deal_number;
            $deal->save();

            return redirect('forex/dealslip/view');
        }
        catch(\Exception $ex)
        {
            return back()->with("eooro",$ex->getMessage());
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

    //Import
    public function importShow()
    {
        return view('forex.deal.import');
    }

    public function importPost(Request $request)
    {
      //  try {

            $file= $request->file('inventory_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                $results = $reader->get();

                $results->each(function($row) {

                    $cust_id="";
                    if($row->counter_party !="")
                    {
                        $checkdash=strpos($row->counter_party,"-");
                        if($checkdash)
                        {
                            $cust=explode("-",$row->counter_party);

                            $custchk=ForexCustomer::where('customer','=',$cust[0])->get()->first();
                            if($custchk != null && count($custchk) > 0)
                            {
                                $cust_id=$custchk->id;
                            }else
                            {
                                $customers=new ForexCustomer;
                                $customers->customer=$cust[0];
                                $customers->rm_code=$cust[1];
                                $customers->status="Enabled";
                                $customers->save();
                                $cust_id=$customers->id;
                            }
                        }
                        else
                        {
                            $customers=new ForexCustomer;
                            $customers->customer=$row->counter_party;
                            $customers->status="Enabled";
                            $customers->save();
                            $cust_id=$customers->id;
                        }


                    }
                    $amount1="";
                    $ccy1="";
                    if($row->amount_bought !="")
                    {
                        $ccy1=substr($row->amount_bought,0,3);
                        $amount1=substr($row->amount_bought,3);

                        if(!count(ForexCurrency::where('currency','=',$ccy1)->get()) > 0)
                        {
                            $ccy=new ForexCurrency;
                            $ccy->currency=$ccy1;
                            $ccy->save();
                        }
                    }

                    $amount2="";
                    $ccy2="";
                    if($row->amount_sold !="")
                    {
                        $ccy2=substr($row->amount_sold,0,3);
                        $amount2=substr($row->amount_sold,3);
                    }

                    if($row->deal_number !="") {
                        $deal = new  ForexDealSlip;
                        $deal->deal_number = $row->deal_number;
                        $deal->deal_date =  date("Y-m-d H:i",strtotime(date("Y-m-d",strtotime($row->deal_date))." ". date("H:i",strtotime($row->deal_time))));
                        $deal->value_date =  $row->value_date;
                        $deal->counter_party =  $cust_id;
                        $deal->curr_amount_bought_ccy =  $ccy1;
                        $deal->curr_amount_bought =  $amount1;
                        $deal->curr_amount_sold_ccy =  $ccy2;
                        $deal->curr_amount_sold =  $amount2;
                        $deal->rate =  $row->rate;
                        $deal->confirmed_with =  $row->confirmed_with;
                        $deal->bankm_dealer =  $row->bankm_dealer;

                        if(strlen($row->mobile) ==9 )
                        {
                            $deal->mobile =  "0".$row->mobile;
                        }
                        else
                        {
                            $deal->mobile =  $row->mobile;
                        }
                        $deal->confirmed_date= date("Y-m-d H:i",strtotime(date("Y-m-d",strtotime($row->deal_date))." ". date("H:i",strtotime($row->confirmed_time))));
                        $deal->instruction =  $row->instruction;
                        $deal->email =  $row->email;
                        $deal->save();
                    }

                });

            });

            File::delete($destinationPath . $filename); //Delete after upload

            return redirect('forex/dealslip/view');
            // } catch (\Exception $e) {

            //  return redirect()->back()->with('error',$e->getMessage());
           //  }

    }




}
