<?php

namespace App\Http\Controllers;

use App\PortalReport;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PortalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,20) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::all();
            return view('portalreports.index',compact('reports'));
        }
        else
        {
            $reports=PortalReport::where('department_id','=',Auth::user()->department_id)->get();
            return view('portalreports.index',compact('reports'));
        }

    }
    public function searchReport()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,20) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::all();
            return view('portalreports.index',compact('reports'));
        }
        else
        {
            $reports=PortalReport::where('department_id','=',Auth::user()->department_id)->get();
            return view('portalreports.index',compact('reports'));
        }

    }

    //Generate reports
    public function generateReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,20) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::all();
            return view('portalreports.reports',compact('reports'));
        }
        else
        {
            $reports=PortalReport::where('department_id','=',Auth::user()->department_id)->get();
            return view('portalreports.reports',compact('reports'));
        }

    }


    //Daily
    public function dailyReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,20) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::where('report_type','=','Daily')->get();
            return view('portalreports.calendar',compact('reports'));
        }
        else
        {
            $reports=PortalReport::where('report_type','=','Daily')->where('department_id','=',Auth::user()->department_id)->get();
            return view('portalreports.calendar',compact('reports'));
        }

    }
    //Monthly
    public function monthlyReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,20) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::where('report_type','=','Monthly')->get();
            return view('portalreports.calendar',compact('reports'));
        }
        else {
            $reports = PortalReport::where('report_type', '=', 'Monthly')->where('department_id', '=', Auth::user()->department_id)->get();
            return view('portalreports.calendar', compact('reports'));
        }
    }
    //Custom
    public function customReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,20) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::where('report_type','=','Custom')->get();
            return view('portalreports.calendar',compact('reports'));
        }
        else {
            $reports = PortalReport::where('report_type', '=', 'Custom')->where('department_id', '=', Auth::user()->department_id)->get();
            return view('portalreports.calendar', compact('reports'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('portalreports.create');
    }
   //Show import
    public function showImport()
    {
        //
        return view('portalreports.import');
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
        $report=new PortalReport;
        $report->report_name=$request->report_name;
        $report->other_name=$request->other_name;
        $report->report_type=$request->report_type;
        $report->description=$request->description;
        $report->status=$request->status;
        $report->input_by=Auth::user()->username;
        $report->save();

    }

    public function importExcel(Request $request)
    {
        try {

            $file= $request->file('inventory_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                $results = $reader->get();

                $results->each(function($row) {

                    $report=new PortalReport;
                    $report->report_name=$row->report_name;
                    $report->other_name=$row->other_name;
                    $report->report_type=$row->report_type;
                    $report->status=$row->status;
                    $report->description=$row->description;
                    $report->input_by=Auth::user()->id;
                    $report->save();
                });

            });

            File::delete($destinationPath . $filename); //Delete after upload

            return redirect('portal/reports')->with('success', 'Reports uploaded successfully.');
        } catch (\Exception $e) {

            //echo $e->getMessage();
            return redirect('portal/reports/import')->with('error',$e->getMessage());
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
        $report= PortalReport::find($id);
        return view('portalreports.show',compact('report'));
    }

    //Departments assigned
    public function showDepartments($id)
    {
        //
        $report= PortalReport::find($id);
        return view('portalreports.departments',compact('report'));
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
        $report= PortalReport::find($id);
        return view('portalreports.edit',compact('report'));
    }

   //Post departments
    public function postDepartments(Request $request)
    {

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
        $report= PortalReport::find($request->report_id);
        $report->report_name=$request->report_name;
        $report->other_name=$request->other_name;
        $report->report_type=$request->report_type;
        $report->description=$request->description;
        $report->status=$request->status;
        $report->input_by=Auth::user()->username;
        $report->save();
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
        $report= PortalReport::find($id);
        if(count($report->assignedDepartments) > 0 && $report->assignedDepartments != null && $report->assignedDepartments != "")
        {
            foreach($report->assignedDepartments as $deps)
            {
                $deps->delete();
            }
        }
        $report->delete();

        return "Delete success";
    }
}
