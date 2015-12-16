<?php

namespace App\Http\Controllers;

use App\CustomerIssues;
use App\SDProgress;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\SDCustomer;
use App\SDProduct;
use App\SDProductDetails;
use App\SDReceiptMode;
use App\SDStatus;

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
        $issues=CustomerIssues::where('closed','=','No')->get();
        return view('servicedelivery.index',compact('issues'));
    }

    //showHistory
    public function showHistory()
    {
        //
        $issues=CustomerIssues::all()->take(2000);
        return view('servicedelivery.history',compact('issues'));
    }
    //Reports
    public function reports()
    {
        //
        $issues=CustomerIssues::all();
        return view('servicedelivery.reports',compact('issues'));
    }

    //Month report
    public function getMonthReport()
    {
        //
        $issues=CustomerIssues::where(\DB::raw('DAY(created_at)'),'=',date('j'))->get();

        Excel::create("Issues_custom_report", function ($excel) use ($issues) {

            $excel->sheet('sheet', function ($sheet) use ($issues) {
                $sheet->loadView('excels.msdreport')->with('issues', $issues);

            });

        })->download('xlsx');
    }


    //Day report
    public function getDayReport()
    {
        //
        $issues=CustomerIssues::where(\DB::raw('DAY(created_at)'),'=',date('j'))->get();

        Excel::create("Issues_custom_report", function ($excel) use ($issues) {

            $excel->sheet('sheet', function ($sheet) use ($issues) {
                $sheet->loadView('excels.dsdreport')->with('issues', $issues);

            });

        })->download('xlsx');
    }

    //Custom report
    public function showCustomReports()
    {
        //
        return view('servicedelivery.sdreports.customreport');
    }

    //Post custom report
    public function postCustomReports(Request $request)
    {
        $start_time=date("Y-m-d",strtotime($request->start_time));
        $end_time=date("Y-m-d",strtotime($request->end_time));
        $department_id=$request->department_id;
        $status_id=$request->status_id;

        $range = [$start_time, $end_time];
        $issues=CustomerIssues::whereBetween('created_at',$range)
                                  ->orwhere('department_id','=',$department_id)
                                  ->orwhere('status_id','=',$status_id)->get();

        Excel::create("Issues_custom_report", function ($excel) use ($issues) {

            $excel->sheet('sheet', function ($sheet) use ($issues) {
                $sheet->loadView('excels.csdreport')->with('issues', $issues);

            });

        })->download('xlsx');
    }


    //





    //Show updates /attend
    public function showUpdates($id)
    {
        $issue=CustomerIssues::find($id);
        return view('servicedelivery.attend',compact('issue'));
    }

    //postUpdates
    public function postUpdates(Request $request)
    {
        $issue=CustomerIssues::find($request->issue_id);
        $issue->remarks=$request->remarks;
        $issue->status_id=$request->status_id;
        if(strtolower($issue->status->status_name) =="resolved")
        {
            $issue->closed="Yes";
            $issue->date_resolved=date("Y-m-d H:i");
        }
        $issue->save();

        $sdprogress=new SDProgress;
        $sdprogress->issue_id=$request->issue_id;
        $sdprogress->issue_progress=$request->description;
        $sdprogress->remarks=$request->remarks;
        $sdprogress->progress_date=date("Y-m-d");
        $sdprogress->progress_date_tm=date("Y-m-d H:i");
        $sdprogress->user_id=Auth::user()->id;
        $sdprogress->save();


        //Audit

        //Send email

        return "Updates saved successful";

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
            $issue= CustomerIssues::find($issues->id);
            if(strtolower($issue->status->status_name) =="resolved")
            {
                $issue->closed="Yes";
                $issue->date_resolved=date("Y-m-d H:i");
                $issue->save();
            }

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

            $issue= CustomerIssues::find($issues->id);
            if(strtolower($issue->status->status_name) =="resolved")
            {
                $issue->closed="Yes";
                $issue->date_resolved=date("Y-m-d H:i");
                $issue->save();
            }


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


    //Import migrate data

    public function showImportMigrate()
    {
        //
        $issues=CustomerIssues::all();
        return view('servicedelivery.importissues',compact('issues'));
    }

    public function importMigrate(Request $request)
    {
      //  try {

            $file= $request->file('inventory_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                $results = $reader->get();

                $results->each(function($row) {


                    // dump($row);
                    // exit;
                   //Process customer
                    if(!count(SDCustomer::where('company_name','=',$row->customer)->get()) > 0)
                    {
                        $customer= new SDCustomer;
                        $customer->company_name=$row->customer;
                        $customer->contact_person=$row->contact_person;
                        $customer->input_by= Auth::user()->username;
                        $customer->status="Enabled";
                        $customer->save();

                        echo "Customer found1 <br/>";
                    }
                    else
                    {
                        $customer= SDCustomer::where('company_name','=',$row->customer)->get()->first();
                        echo "Customer found2 <br/>";
                    }

                    //Product details
                    if(!count(SDProduct::where('product_type','=',$row->product_type)->get()) > 0)
                    {
                        $product= new SDProduct;
                        $product->product_type=$row->product_type;
                        $product->input_by=Auth::user()->username;
                        $product->save();

                        echo "SDProduct found1 <br/>";
                    }
                    else
                    {
                        $product=SDProduct::where('product_type','=',$row->product_type)->get()->first();
                        echo "SDProduct found2 <br/>";
                    }

                   /*
                    //Product details
                    if(count(SDProductDetails::where('details_name','=',$row->details_name)->get()) > 0)
                    {
                        $pdetails=new SDProductDetails;
                        $pdetails->details_name=$row->details_name;
                        $pdetails->input_by=Auth::user()->username;
                        $pdetails->save();

                        echo "SDProductDetails found1 <br/>";
                    }
                    else
                    {
                        $pdetails=SDProductDetails::where('details_name','=',$row->details_name)->get()->first();

                        echo "SDProductDetails found2 <br/>";
                    }
                   */
                    //Receipt mode

                    if(!count(SDReceiptMode::where('mode_name','=',$row->received_mode)->get()) >0)
                    {
                        $modes=new SDReceiptMode;
                        $modes->mode_name=$row->received_mode;
                        $modes->input_by=Auth::user()->username;
                        $modes->save();

                        echo "SDReceiptMode found1 <br/>";
                    }
                    else
                    {
                        $modes=SDReceiptMode::where('mode_name','=',$row->received_mode)->get()->first();
                        echo "SDReceiptMode found2 <br/>";
                    }

                    //Status

                    if(!count(SDStatus::where('status_name','=',$row->status)->get()) > 0)
                    {
                        $status=new SDStatus;
                        $status->status_name=$row->status;
                        $status->input_by=Auth::user()->username;
                        $status->save();

                        echo "SDStatus found1 <br/>";
                    }
                    else
                    {
                        $status=SDStatus::where('status_name','=',$row->status)->get()->first();
                        echo "SDStatus found2 <br/>";
                    }


                    $issues= new CustomerIssues;
                    $issues->company_id=$customer->id;
                    $issues->product_id=$product->id;
                   // $issues->product_details_id=$pdetails->id;
                    $issues->mode_id=$modes->id;
                    $issues->description=$row->description;
                    $issues->department_id=$row->department_id;
                    $issues->received_by=$row->received_by;
                    $issues->status_id=$status->id;
                    $issues->date_created=$row->reported_date;
                    $issues->date_created_tmt= date("Y-m-d H:i",strtotime(date("Y-m-d",strtotime($row->reported_date))." ". date("H:i",strtotime($row->reported_time))));
                    $issues->input_by=$row->inpute_by;
                    $issues->issues_number= $row->reference_number;
                    $issues->remarks= $row->issue_note;
                    $issues-> department_id=$row->department;
                    $issues->save();

                    $issue= CustomerIssues::find($issues->id);
                    if(strtolower($issue->status->status_name) =="resolved")
                    {
                        $issue->closed="Yes";
                        if($row->resolved_date=="0000-00-00")
                        {
                            $issue->date_resolved= date("Y-m-d H:i",strtotime(date("Y-m-d",strtotime($row->reported_date))." ". date("H:i",strtotime($row->resolved_time))));
                        }
                        else
                        {
                            $issue->date_resolved= date("Y-m-d H:i",strtotime(date("Y-m-d",strtotime($row->resolved_date))." ". date("H:i",strtotime($row->resolved_time))));
                        }
                        $issue->save();

                    }
                });

            });

            File::delete($destinationPath . $filename); //Delete after upload

            return redirect('servicedelivery')->with('success', 'Users uploaded successfully.');
       // } catch (\Exception $e) {

            //echo $e->getMessage();
          //  return redirect()->back()->with('error',$e->getMessage());
       // }
    }
}
