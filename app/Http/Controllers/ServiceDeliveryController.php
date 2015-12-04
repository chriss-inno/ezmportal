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
        $issues=CustomerIssues::all();
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
}
