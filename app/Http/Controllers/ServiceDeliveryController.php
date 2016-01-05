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
         return view('servicedelivery.advsearch',compact('issues'));
       // return view('servicedelivery.history',compact('issues'));
    }

    //Post postShowHistory

    public function postShowHistory(Request $request)
    {
        try {
            $start_time = date("Y-m-d", strtotime($request->start_time));
            $end_time = date("Y-m-d", strtotime($request->end_time));
            $department_id = $request->department_id;
            $status_id = $request->status_id;

            $issues="";

            $range = [$start_time, $end_time];

            if($request->start_time =="" && $request->end_time =="" && $request->department_id =="" && $request->status_id =="" && $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number ==""  )
            {
                return redirect()->back()->with('error',"Please select search criteria");
            }
            elseif(($request->department_id =="" && $request->status_id =="") && ($request->start_time !="" && $request->end_time !="" && $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number =="" ))
            {
                $issues = CustomerIssues::whereBetween('date_created', $range)->get();
            }
            elseif($request->department_id =="" && $request->status_id !="" && $request->start_time !="" && $request->end_time !="" && $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number =="" )
            {
                $issues = CustomerIssues::whereBetween('date_created', $range)
                    ->where('status_id', '=', $status_id)->get();
            }
            elseif($request->department_id !="" && $request->status_id =="" && $request->start_time !="" && $request->end_time !="" && $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number =="" )
            {
                $issues = CustomerIssues::whereBetween('date_created', $range)
                    ->where('department_id', '=', $department_id)->get();
            }
            elseif($request->department_id !="" && $request->status_id =="" && $request->start_time =="" && $request->end_time =="" && $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number =="" )
            {
                $issues = CustomerIssues::where('department_id', '=', $department_id)->get();

            }
            elseif($request->department_id =="" && $request->status_id !="" && $request->start_time =="" && $request->end_time =="" && $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number =="" )
            {
                $issues = CustomerIssues::where('status_id', '=', $status_id)->get();

            }
            elseif($request->department_id !="" && $request->status_id !="" && $request->start_time !="" && $request->end_time !="" && $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number =="" )
            {
                $issues = CustomerIssues::whereBetween('date_created', $range)
                    ->where('department_id', '=', $department_id)
                    ->where('status_id', '=', $status_id)->get();

            }
            elseif( ($request->start_time =="" && $request->end_time =="") &&  $request->department_id =="" && $request->status_id =="" &&  $request->product_type =="" && $request->receipt_mode =="" && $request->reference_number !="" )
            {
                $issues = CustomerIssues::where('issues_number', $request->reference_number)->get();
            }
            elseif( $request->start_time =="" && $request->end_time =="" &&  $request->department_id =="" && $request->status_id =="" &&  $request->product_type !="" && $request->receipt_mode =="" && $request->reference_number =="" )
            {
                $issues = CustomerIssues::where('product_id', $request->product_type)->get();
            }
            elseif( $request->start_time =="" && $request->end_time =="" &&  $request->department_id =="" && $request->status_id =="" &&  $request->product_type =="" && $request->receipt_mode !="" && $request->reference_number =="" )
            {
                $issues = CustomerIssues::where('mode_id', $request->receipt_mode)->get();
            }
            elseif( ($request->start_time !="" && $request->end_time !="") &&  $request->department_id !="" && $request->status_id !="" &&  $request->product_type !="" && $request->receipt_mode !="" && $request->reference_number !="" )
            {
                $issues = CustomerIssues::where('mode_id', $request->receipt_mode)
                    ->where('department_id', '=', $department_id)
                    ->where('product_id', $request->product_type)
                    ->where('date_created', $range)
                    ->where('issues_number', $request->reference_number)
                    ->where('status_id', '=', $status_id)->get();
            }
            elseif( ($request->start_time !="" && $request->end_time !="") ||  $request->department_id !="" || $request->status_id !="" ||  $request->product_type !="" || $request->receipt_mode !="" || $request->reference_number !="" )
            {
                $issues = CustomerIssues::where('mode_id', $request->receipt_mode)
                                        ->orwhere('department_id', '=', $department_id)
                                        ->orwhere('product_id', $request->product_type)
                                        ->orwhereBetween('date_created', $range)
                                        ->orwhere('issues_number', $request->reference_number)
                                        ->orwhere('status_id', '=', $status_id)->get();
            }


            if($issues !="")
            {

                return view('servicedelivery.history',compact('issues'));
            }
            else
            {
                return redirect()->back()->with('error',"Please select search criteria");
            }

        }
        catch (\Exception $ex)
        {
            return redirect()->back()->with('error',$ex->getMessage());
        }
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
        $issues=CustomerIssues::where(\DB::raw('Month(date_created)'),'=',date('n'))->where(\DB::raw('Year(date_created)'),'=',date('Y'))->get();

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
        $issues=CustomerIssues::where(\DB::raw('DAY(date_created)'),'=',date('j'))->where(\DB::raw('Year(date_created)'),'=',date('Y'))->where(\DB::raw('Month(date_created)'),'=',date('n'))->get();

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
        try {
            $start_time = date("Y-m-d", strtotime($request->start_time));
            $end_time = date("Y-m-d", strtotime($request->end_time));
            $department_id = $request->department_id;
            $status_id = $request->status_id;

            $issues="";

            $range = [$start_time, $end_time];
           if($request->start_time =="" && $request->end_time =="" && $request->department_id =="" && $request->status_id =="" )
           {
               return redirect()->back()->with('error',"Please select search criteria");
           }
            elseif(($request->department_id =="" && $request->status_id =="") && ($request->start_time !="" && $request->end_time !=""))
            {
                $issues = CustomerIssues::whereBetween('date_created', $range)->get();
            }
           elseif($request->department_id =="" && $request->status_id !="" && $request->start_time !="" && $request->end_time !="")
            {
                $issues = CustomerIssues::whereBetween('date_created', $range)
                    ->where('status_id', '=', $status_id)->get();
            }
           elseif($request->department_id !="" && $request->status_id =="" && $request->start_time !="" && $request->end_time !="")
           {
               $issues = CustomerIssues::whereBetween('date_created', $range)
                   ->where('department_id', '=', $department_id)->get();
           }
           elseif($request->department_id !="" && $request->status_id =="" && $request->start_time =="" && $request->end_time =="")
           {
               $issues = CustomerIssues::where('department_id', '=', $department_id)->get();

           }
           elseif($request->department_id =="" && $request->status_id !="" && $request->start_time =="" && $request->end_time =="")
           {
               $issues = CustomerIssues::where('status_id', '=', $status_id)->get();

           }
           elseif($request->department_id !="" && $request->status_id !="" && $request->start_time !="" && $request->end_time !="")
           {
               $issues = CustomerIssues::whereBetween('date_created', $range)
                   ->where('department_id', '=', $department_id)
                   ->where('status_id', '=', $status_id)->get();

           }

           if($issues !="")
           {

               Excel::create("Issues_custom_report", function ($excel) use ($issues) {

                   $excel->sheet('sheet', function ($sheet) use ($issues) {
                       $sheet->loadView('excels.csdreport')->with('issues', $issues);

                   });

               })->download('xlsx');
           }
            else
            {
                return redirect()->back()->with('error',"Please select search criteria");
            }

        }
        catch (\Exception $ex)
        {
            return redirect()->back()->with('error',$ex->getMessage());
        }

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
        $sdprogress->user_id=Auth::user()->first_name. " ".Auth::user()->last_name;
        $sdprogress->save();


        //Audit

        //Send email

        //Audit log
        \App\Http\Controllers\AuditController::auditLog("Attend Customer issue with reference number [".$issue->issues_number." ]","Service Delivery");

        return redirect('servicedelivery');

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
            $issues->date_created_tmt=date("Y-m-d H:i");
            $issues->root_cause=$request->root_cause;
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

            //Audit log
            \App\Http\Controllers\AuditController::auditLog("Created Customer issue with reference number [".$issue->issues_number." ]","Service Delivery");

            return redirect('servicedelivery');

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
            $issues->root_cause=$request->root_cause;
            $issues->input_by=Auth::user()->username;
            $issues->save();

            $issue= CustomerIssues::find($issues->id);
            if(strtolower($issue->status->status_name) =="resolved")
            {
                $issue->closed="Yes";
                $issue->date_resolved=date("Y-m-d H:i");
                $issue->save();
            }

            //Audit log
            \App\Http\Controllers\AuditController::auditLog("Update Customer issue with reference number [".$issue->issues_number." ]","Service Delivery");

            return redirect('servicedelivery');

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

        //Audit log
        \App\Http\Controllers\AuditController::auditLog("Deleted Customer issue with reference number [".$issue->issues_number." ]","Service Delivery");

        $issue->delete();

    }

    //View setting page

    public function settings()
    {
        $issues=CustomerIssues::all();
        return view('servicedelivery.setting.index',compact('issues'));
    }


    public function showImportMigrateProgress()
    {
        //
        return view('servicedelivery.importprogress');
    }

    //Import progress
    public function importMigrateProgress(Request $request)
    {
        //  try {

        $file= $request->file('inventory_file');
        $destinationPath = public_path() .'/uploads/temp/';
        $filename   = str_replace(' ', '_', $file->getClientOriginalName());

        $file->move($destinationPath, $filename);

        Excel::load($destinationPath . $filename, function ($reader) {

            $results = $reader->get();

            $results->each(function($row) {

                echo "Import start at ".date("Y-m-d H:i") ." <br/>";

               if($row->reference_number != "" && $row->description != "" && $row->status != "" && $row->prg_date != "" && $row->prg_time != "" && $row->inputed_by != "")
               {
                   if(count(CustomerIssues::where('issues_number','=', $row->reference_number)->get()) > 0)
                   {
                       echo "Import found start now <br/>";
                       //process status
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

                       echo "CustomerIssues looking <br/>";
                       $issue=CustomerIssues::where('issues_number','=', $row->reference_number)->get()->first();
                       $issue->remarks=$row->description;
                       $issue->status_id=$status->id;
                       $issue->save();

                       $issuep=CustomerIssues::find($issue->id);
                       if(strtolower($issuep->status->status_name) =="resolved")
                       {
                           $issuep->closed="Yes";
                           $issuep->date_resolved=date("Y-m-d H:i",strtotime(date("Y-m-d",strtotime($row->prg_date))." ". date("H:i",strtotime($row->prg_time))));

                           echo "CustomerIssues resolved <br/>";
                       }
                       $issuep->save();

                       echo "SDProgress start <br/>";

                       $sdprogress=new SDProgress;
                       $sdprogress->issue_id=$issuep->id;
                       $sdprogress->issue_progress=$row->description;
                       $sdprogress->remarks=$row->description;
                       $sdprogress->progress_date=date("Y-m-d",strtotime($row->prg_date));
                       $sdprogress->progress_date_tm=date("Y-m-d H:i",strtotime(date("Y-m-d",strtotime($row->prg_date))." ". date("H:i",strtotime($row->prg_time))));
                       $sdprogress->user_id=$row->inputed_by;
                       $sdprogress->save();
                   }
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
                    $product_details_id="";
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

                    //Process product details and product type are separeted by /
                    if(strpos($row->product_type,"/"))
                    {
                       $pos= strpos($row->product_type,"/");
                        //Get product type from left
                        $pr_type=substr($row->product_type,0,$pos);
                        $pr_details=substr($row->product_type,($pos+1));

                        //Product details
                        if(!count(SDProduct::where('product_type','=',$pr_type)->get()) > 0)
                        {
                            $product= new SDProduct;
                            $product->product_type=$pr_type;
                            $product->input_by=Auth::user()->username;
                            $product->save();

                            echo "SDProduct found1 <br/>";
                        }
                        else
                        {
                            $product=SDProduct::where('product_type','=',$pr_type)->get()->first();
                            echo "SDProduct found2 <br/>";
                        }

                        //Product details
                        if(!count(SDProductDetails::where('details_name','=',$pr_details)->get()) > 0)
                        {
                            $pdetails=new SDProductDetails;
                            $pdetails->details_name=$pr_details;
                            $pdetails->input_by=Auth::user()->username;
                            $pdetails->save();

                            $product_details_id=$pdetails->id;

                            echo "SDProductDetails found1 <br/>";
                        }
                        else
                        {
                            $pdetails=SDProductDetails::where('details_name','=',$pr_details)->get()->first();

                            echo "SDProductDetails found2 <br/>";
                            $product_details_id=$pdetails->id;
                        }
                    }
                    else
                    {
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


                    }

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
                    $issues->product_details_id=$product_details_id;
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
                    $issues->root_cause=$row->root_cause;
                    $issues-> department_id=$row->department;
                    $issues->save();

                    $issue= CustomerIssues::find($issues->id);
                    if(strtolower($issue->status->status_name) =="resolved")
                    {
                        $issue->closed="Yes";
                        if(date("Y-m-d H:i", strtotime(date("Y-m-d", strtotime($row->resolved_date)) . " " . date("H:i", strtotime($row->resolved_time)))) ==date("Y-m-d")." 03:00")
                        {

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
