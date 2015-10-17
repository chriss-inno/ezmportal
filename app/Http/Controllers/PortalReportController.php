<?php

namespace App\Http\Controllers;

use App\PortalReport;
use App\ReportDepartment;
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
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::all();
            return view('portalreports.index',compact('reports'));
        }
        else
        {
            //$reports=PortalReport::where('department_id','=',Auth::user()->department_id)->get();
            $reports =\DB::table('portal_reports')
                ->join('report_departments', 'portal_reports.id', '=', 'report_departments.report_id')
                ->where('department_id', '=', Auth::user()->department_id)
                ->select('portal_reports.*')
                ->get();
            return view('portalreports.index',compact('reports'));
        }

    }
    public function searchReport()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::all();
            return view('portalreports.index',compact('reports'));
        }
        else
        {
            //$reports=PortalReport::where('department_id','=',Auth::user()->department_id)->get();
            $reports =\DB::table('portal_reports')
                ->join('report_departments', 'portal_reports.id', '=', 'report_departments.report_id')
                ->where('department_id', '=', Auth::user()->department_id)
                ->select('portal_reports.*')
                ->get();
            return view('portalreports.index',compact('reports'));
        }

    }

    //Generate reports
    public function generateReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::all();
            return view('portalreports.reports',compact('reports'));
        }
        else
        {
           // $reports=PortalReport::where('department_id','=',Auth::user()->department_id)->get();
            $reports =\DB::table('portal_reports')
                ->join('report_departments', 'portal_reports.id', '=', 'report_departments.report_id')
                ->where('department_id', '=', Auth::user()->department_id)
                ->select('portal_reports.*')
                ->get();
            return view('portalreports.reports',compact('reports'));
        }

    }


    //Daily
    public function dailyReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::where('report_type','=','Daily')->get();
            return view('portalreports.calendar',compact('reports'));
        }
        else
        {
            //$reports=PortalReport::where('report_type','=','Daily')->where('department_id','=',Auth::user()->department_id)->get();
            $reports =\DB::table('portal_reports')
                ->join('report_departments', 'portal_reports.id', '=', 'report_departments.report_id')
                ->where('report_type', '=', 'Daily')->where('department_id', '=', Auth::user()->department_id)
                ->select('portal_reports.*')
                ->get();
            return view('portalreports.calendar',compact('reports'));
        }

    }
    //Monthly
    public function monthlyReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::where('report_type','=','Monthly')->get();
            return view('portalreports.month',compact('reports'));
        }
        else {
           // $reports = PortalReport::where('report_type', '=', 'Monthly')->where('department_id', '=', Auth::user()->department_id)->get();
            $reports =\DB::table('portal_reports')
                ->join('report_departments', 'portal_reports.id', '=', 'report_departments.report_id')
                ->where('report_type', '=', 'Monthly')->where('department_id', '=', Auth::user()->department_id)
                ->select('portal_reports.*')
                ->get();
            return view('portalreports.month', compact('reports'));
        }
    }
    //Custom
    public function customReports()
    {
        //
        if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2) || Auth::user()->user_type=="Administrator")
        {
            $reports=PortalReport::where('report_type','=','Custom')->get();
            return view('portalreports.custom',compact('reports'));
        }
        else {
           // $reports = PortalReport::where('report_type', '=', 'Custom')->where('department_id', '=', Auth::user()->department_id)->get();
            $reports =\DB::table('portal_reports')
                ->join('report_departments', 'portal_reports.id', '=', 'report_departments.report_id')
                ->where('report_type', '=', 'Custom')->where('department_id', '=', Auth::user()->department_id)
                ->select('portal_reports.*')
                ->get();
            return view('portalreports.custom', compact('reports'));
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
       //Remove previous assignments
        if(count(ReportDepartment::where('report_id','=',$request->report_id)->get()) >0)
        {
            foreach(ReportDepartment::where('report_id','=',$request->report_id)->get() as $pre)
            {
                $pre->delete();
            }
        }
      if($request->department != null && $request->department != "")
      {
          foreach($request->department as $dp)
          {
              $arr=explode("##",$dp);
              $department_id=$arr[0]; //Get department ID
              $branch_id=$arr[1]; //Get branch ID

              $rd=new ReportDepartment();
              $rd->report_id=$request->report_id;
              $rd->branch_id=$branch_id;
              $rd->department_id=$department_id;
              $rd->save();
          }
          return "<h3 class='text-info'>Department successfully attached to report</h3>";
      }
        else
        {
            return "<h3 class='text-info'>No changes done report</h3>";
        }


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

    //Get day report
    public  function getDailyReports($y,$m,$d)
    {
        $dateas=$y."-".$m."-".$d;
        return view('portalreports.daily',compact('dateas'));
    }

    //
    public  function getArchivedReports($y,$m,$d)
    {
        $dateas=$y."-".$m."-".$d;
        return view('portalreports.archive',compact('dateas'));
    }
}
