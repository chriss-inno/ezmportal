<?php

namespace App\Http\Controllers;

use App\DispatchCustomer;
use App\SMSCustomer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class SMSCustomerController extends Controller
{
    public function __construct()
    {
        if(Auth::guest())
        {
            return view('users.login');
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
        $customers=SMSCustomer::all();
        return view('sms.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sms.create');
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
            $phone="";
            $phone=preg_replace('/\s+/', '',$request->phone);
            if($phone != "" && $phone != null ) {

                if (!count(SMSCustomer::where('phone', '=', $phone)->get()) > 0) {
                    $customer = new SMSCustomer;
                    $customer->customer_name = $request->customer_name;
                    $customer->phone = $request->phone;
                    $customer->status = $request->status;
                    $customer->input_by = Auth::user()->username;
                    $customer->save();

                    return "Saved successfully";
                } else {
                    return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i>  Phone number [ ' . $request->phone . ' ] is already in use
                </div>';
                }
            }
            else
            {
                return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i>  Phone number is missing
                </div>';
            }

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
        $customer=SMSCustomer::find($id);
        return view('sms.show',compact('customer'));
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
        $customer=SMSCustomer::find($id);
        return view('sms.edit',compact('customer'));
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
            $phone="";
            $phone=preg_replace('/\s+/', '',$request->phone);
            if($phone != "" && $phone != null ) {
                $customer = SMSCustomer::find($request->id);
                $customer->customer_name = $request->customer_name;
                $customer->phone = $phone;
                $customer->status = $request->status;
                $customer->input_by = Auth::user()->username;
                $customer->save();

                return "Saved successfully";
            }else
            {
                return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i>  Phone number is missing
                </div>';
            }
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
        $customer=SMSCustomer::find($id);

        foreach(DispatchCustomer::where('customer_id','=',$customer->id)->get() as $cust)
        {
            $cust->delete();
        }
        $customer->delete();

    }

    //Import customers
    public function importCustomers()
    {
        return view('sms.import');
    }

    //Import customers
    public function postImportCustomers(Request $request)
    {
        try {

            $file= $request->file('customer_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                $results = $reader->get();

                $results->each(function($row) {

                    //Get phone number
                    $phone="";
                    $phone=preg_replace('/\s+/', '',$row->phone_number);
                    if($phone != null && $phone != "")
                    {
                        $cust=SMSCustomer::where('phone','=',$phone)->get();
                        if( ! count($cust) > 0)
                        {
                            $customer=new SMSCustomer;
                            $customer->customer_name=$row->customer_name;
                            $customer->phone=$phone;
                            $customer->status='Enabled';
                            $customer->input_by=Auth::user()->username;
                            $customer->save();
                        }
                    }


                });
            });

            File::delete($destinationPath . $filename); //Delete after upload

            return redirect('sms/customers')->with('success', 'Customer uploaded successfully.');
        } catch (\Exception $e) {

            //echo $e->getMessage();
            return redirect()->back()->with('error',$e->getMessage());
        }

    }
}
