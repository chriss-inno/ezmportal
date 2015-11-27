<?php

namespace App\Http\Controllers;

use App\DispatchCustomer;
use App\SMSCustomer;
use App\SMSDistributionList;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

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
    public function update(Request $request)
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
        $dspg=DispatchCustomer::where('dispatch_id','=',$distribution->id)->get();
        if($dspg != null && count($dspg) >0)
        {
            foreach($dspg as  $dist)
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
        try {

            if($request->importFrom != null && $request->importFrom == "Yes")
            {
                // Build the input for our validation
                $input = array('customer_file' => $request->file('customer_file'));

                // Within the ruleset, make sure we let the validator know that this
                // file should be an image
                $rules = array(
                    'customer_file' => 'required'
                );

                // Now pass the input and rules into the validator
                $validator = Validator::make($input, $rules);
                if ($validator->fails())
                {
                    return redirect()->back()->with('message',"Please enter valid file");
                }else
                {
                    $file= $request->file('customer_file');
                    $destinationPath = public_path() .'/uploads/temp/';
                    $filename   = str_replace(' ', '_', $file->getClientOriginalName());

                    $file->move($destinationPath, $filename);

                    Excel::load($destinationPath . $filename, function ($reader) use($request) {

                        $results = $reader->get();

                        $results->each(function($row) use($request){

                            //Get phone number
                            $phone="";
                            $phone=preg_replace('/\s+/', '',$row->phone_number);
                            if($phone != null && $phone != "") {

                                $cust = SMSCustomer::where('phone', '=', $phone)->get();

                                if (!count($cust) > 0) {
                                    $customer = new SMSCustomer;
                                    $customer->customer_name = $row->customer_name;
                                    $customer->phone = $phone;
                                    $customer->status = 'Enabled';
                                    $customer->input_by = Auth::user()->username;
                                    $customer->save();

                                    if (!count(DispatchCustomer::where('dispatch_id', '=', $request->dispatch_id)->where('customer_id', '=', $customer->id)->get()) > 0) {
                                        $disp = new DispatchCustomer;
                                        $disp->dispatch_id = $request->dispatch_id;
                                        $disp->customer_id = $customer->id;
                                        $disp->input_by = Auth::user()->username;
                                        $disp->save();
                                    }

                                } else {
                                    $customer = SMSCustomer::where('phone', '=', $phone)->first();
                                    if (!count(DispatchCustomer::where('dispatch_id', '=', $request->dispatch_id)->where('customer_id', '=', $customer->id)->get()) > 0) {
                                        $disp = new DispatchCustomer;
                                        $disp->dispatch_id = $request->dispatch_id;
                                        $disp->customer_id = $customer->id;
                                        $disp->input_by = Auth::user()->username;
                                        $disp->save();
                                    }
                                }
                            }


                        });
                    });

                    File::delete($destinationPath . $filename); //Delete after upload
                }
            }
            elseif($request->departments != null && count($request->departments) >0)
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

        } catch (\Exception $e) {

            //echo $e->getMessage();
            return redirect()->back()->with('error',$e->getMessage());
        }



    }
}
