<?php

namespace App\Http\Controllers;

use App\PortalReport;
use App\ReportDepartment;
use App\ReportSetup;
use App\ReportUnit;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
            return view('portalreports.manage',compact('reports'));
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
    public function postReportSetup(Request $request)
    {
        $repser=ReportSetup::all()->first();
        if($request->archive_start_date !="" && $request->archive_start_date !=null &&
            $request->archive_end_date !="" && $request->archive_end_date !=null     &&
            strtotime($request->archive_start_date) > strtotime($request->archive_end_date)
        )
        {
            return "<h2 class='text-danger'><strong>Invalid dates, start date can not be lorger than end date </strong></h2>";
        }
        if($repser !="" && $repser !=null)
        {
            $repser->archive_path=str_replace("\\","/",$request->archive_path);
            $repser->current_path=str_replace("\\","/",$request->current_path);
            $repser->monthly_path=str_replace("\\","/",$request->monthly_path);
            $repser->custom_path=str_replace("\\","/",$request->custom_path);
            if($request->archive_start_date !="" && $request->archive_start_date !=null)
               $repser->archive_start_date=date("Y-m-d",strtotime($request->archive_start_date));
            if($request->archive_end_date !="" && $request->archive_end_date !=null)
                $repser->archive_end_date=date("Y-m-d",strtotime($request->archive_end_date));
            $repser->input_by=Auth::user()->username;
            $repser->save();

            return "<h3 class='text-info'>Data saved successfully</h3>";
        }else
        {
            $repser=new ReportSetup;
            $repser->archive_path=str_replace("\\","/",$request->archive_path);
            $repser->current_path=str_replace("\\","/",$request->current_path);
            $repser->monthly_path=str_replace("\\","/",$request->monthly_path);
            $repser->custom_path=str_replace("\\","/",$request->custom_path);
            if($request->archive_start_date !="" && $request->archive_start_date !=null)
                $repser->archive_start_date=date("Y-m-d",strtotime($request->archive_start_date));
            if($request->archive_end_date !="" && $request->archive_end_date !=null)
                $repser->archive_end_date=date("Y-m-d",strtotime($request->archive_end_date));
            $repser->input_by=Auth::user()->username;
            $repser->save();

            return "<h3 class='text-info'>Data saved successfully</h3>";

        }
    }

    public function reportSetup()
    {
        $repser=\App\ReportSetup::all()->first();
        return view('portalreports.setup',compact('repser'));
    }

    //Report assignment
     public function  reportAssignment()
     {
         return view('portalreports.assignment');
     }

    //Assign report
    public  function postReportAssignment(Request $request)
    {
        if($request->reports != null && $request->reports != "")
        {
            foreach($request->reports as $report)
            {
                //Do for departments
                if($request->departments != null && $request->departments != "")
                {
                    //Remove previous assignments
                    if(count(ReportDepartment::where('report_id','=',$request->report_id)->get()) >0)
                    {
                        foreach(ReportDepartment::where('report_id','=',$request->report_id)->get() as $pre)
                        {
                            $pre->delete();
                        }
                    }

                    foreach($request->departments as $dp)
                    {
                        $rd=new ReportDepartment();
                        $rd->report_id=$report;
                        $rd->department_id=$dp;
                        $rd->save();
                    }
                }

                //Do for Units
                if($request->units != null && $request->units != "")
                {
                    //Remove previous assignments
                    if(count(ReportUnit::where('report_id','=',$request->report_id)->get()) >0)
                    {
                        foreach(ReportUnit::where('report_id','=',$request->report_id)->get() as $pre)
                        {
                            $pre->delete();
                        }
                    }

                    foreach($request->units as $unit)
                    {
                        $ru=new ReportUnit();
                        $ru->report_id=$report;
                        $ru->unit_id=$unit;
                        $ru->save();
                    }
                }
            }

        }
        return redirect('portal/reports');
    }

    public function store(Request $request)
    {
        //
        if(!count(PortalReport::where('report_name','=',$request->report_name)->get()) > 0) {
            $report = new PortalReport;
            $report->report_name = $request->report_name;
            $report->other_name = $request->other_name;
            $report->report_type = $request->report_type;
            $report->description = $request->description;
            $report->status = $request->status;
            $report->input_by = Auth::user()->username;
            $report->save();
        }

    }

    public function importReports(Request $request)
    {
        try {

            $report_type=$request->report_type;
            $importFrom=$request->importFrom;
            $reportFolder=str_replace("\\","/",$request->reportFolder);

           //Check how to import based on import From
            if($importFrom =="folder") //Importing files from folder
            {
                if(File::exists($reportFolder)) {
                    $filesInFolder =File::files($reportFolder);

                    foreach($filesInFolder as $path)
                    {
                        $fileDetails = pathinfo($path);
                        if($fileDetails['extension'] = ".rep") //Filter only BO files
                        {
                            if(!count(PortalReport::where('report_name','=',$fileDetails['filename'])->get()) > 0)
                            {
                                $report=new PortalReport;
                                $report->report_name=$fileDetails['filename'].$fileDetails['extension'];
                                $report->other_name=$fileDetails['filename'].$fileDetails['extension'];
                                $report->report_type=$report_type;
                                $report->status="In Use";
                                $report->input_by=Auth::user()->username;
                                $report->save();
                            }

                        }

                    }

                    return redirect('portal/reports')->with('messages',"Reports uploaded successfully.");
                }
                else
                {

                    return redirect()->back()->with('messages',"Folder is not exist or no permission");
                }
            }
            else
            {
                $file= $request->file('reference_file');
                $destinationPath = public_path() .'/uploads/temp/';
                $filename   = str_replace(' ', '_', $file->getClientOriginalName());

                $file->move($destinationPath, $filename);

                Excel::load($destinationPath . $filename, function ($reader) use($request) {

                    $results = $reader->get();

                    $results->each(function($row) use($request) {

                        if(!count(PortalReport::where('report_name','=',$row->report_name)->get()) > 0) {
                            $report = new PortalReport;
                            $report->report_name = $row->report_name;
                            $report->other_name = $row->old_name;
                            $report->status = $row->status;
                            $report->report_type = $request->report_type;
                            $report->description = $row->description;
                            $report->input_by = Auth::user()->username;
                            $report->save();
                        }
                    });

                });

                File::delete($destinationPath . $filename); //Delete after upload

                return redirect()->back()->with('messages', 'Reports uploaded successfully.');
            }


        } catch (\Exception $e) {


            return redirect()->back()->with('messages',$e->getMessage());
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

      if($request->department != null && $request->department != "")
      {
          //Remove previous assignments
          if(count(ReportDepartment::where('report_id','=',$request->report_id)->get()) >0)
          {
              foreach(ReportDepartment::where('report_id','=',$request->report_id)->get() as $pre)
              {
                  $pre->delete();
              }
          }

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

    public function downloadDailyReport($dt,$t,$id)
    {
        $report=PortalReport::find($id);
        $set=ReportSetup::all()->first(); //Get setup
        //Get root report folder
        $path=$set->current_path; //Get where currently files are stored

        $report_name="";
        switch($t)
        {
            case "pdf":
                $report_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->report_name.".PDF";
                $report_other_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->other_name.".PDF";

                if (File::exists($report_name))
                {
                    $headers = array(
                        'Content-Type: application/pdf',
                    );
                    return Response::make(file_get_contents($report_name), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; '.$report->report_name.".PDF",
                    ]);
                    //return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->report_name.".PDF", $headers);
                }
                elseif(File::exists($report_other_name))
                {
                    $headers = array(
                        'Content-Type: application/pdf',
                    );
                    return Response::make(file_get_contents($report_other_name), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; '.$report->report_name.".PDF",
                    ]);
                    //return Response::download($report_other_name, date("Y_M_d",strtotime($dt))."_".$report->other_name.".PDF", $headers);
                }
                else
                {
                    return redirect()->back()->with("message","Report ".$report->report_name.".PDF was not found for this date" );
                }

                break;
            case "xls":
                $report_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->report_name.".XLS";
                $report_other_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->other_name.".XLS";
                if (File::exists($report_name))
                {
                    $headers = array(
                        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ',
                    );
                    return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->report_name.".XLS", $headers);
                }
                elseif(File::exists($report_other_name))
                {
                    $headers = array(
                        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ',
                    );
                    return Response::download($report_other_name, date("Y_M_d",strtotime($dt))."_".$report->other_name.".XLS", $headers);
                }
                else
                {
                    return redirect()->back()->with("message","Report ".$report->report_name.".XLS was not found for this date" );
                }
                break;
            case "txt":
                $report_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->report_name.".TXT";
                $report_other_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->other_name.".TXT";
                if (File::exists($report_name))
                {
                    $headers = array(
                        'Content-Type: text/plain',
                    );

                    return Response::make(file_get_contents($report_name), 200, [
                        'Content-Type' =>  'text/plain',
                        'Content-Disposition' => 'inline; '.$report->report_name.".TXT",
                    ]);

                    //return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->report_name.".TXT", $headers);
                }
                elseif(File::exists($report_other_name))
                {
                    $headers = array(
                        'Content-Type: text/plain',
                    );
                    return Response::make(file_get_contents($report_other_name), 200, [
                        'Content-Type' =>  'text/plain',
                        'Content-Disposition' => 'inline; '.$report->report_name.".TXT",
                    ]);
                    //return Response::download($report_other_name, date("Y_M_d",strtotime($dt))."_".$report->other_name.".TXT", $headers);
                }
                else
                    {
                        return redirect()->back()->with("message","Report ".$report->report_name.".TXT was not found for this date" );
                    }

                break;
        }




    }

    public function downloadArchivedReport($dt,$t,$id)
    {
        $report=PortalReport::find($id);
        $set=ReportSetup::all()->first(); //Get setup

        //Get root report folder
        $path=$set->archive_path;  //Get where archive files are stored

        $report_name="";
        switch($t)
        {
            case "pdf":
                $report_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->report_name.".PDF";
                $report_other_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->other_name.".PDF";
                if (File::exists($report_name))
                {
                    $headers = array(
                        'Content-Type: application/pdf',
                    );

                    return Response::make(file_get_contents($report_name), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; '.$report->report_name.".PDF",
                    ]);
                    //return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->report_name.".PDF", $headers);
                }
                elseif(File::exists($report_other_name))
                {
                    $headers = array(
                        'Content-Type: application/pdf',
                    );

                    return Response::make(file_get_contents($report_other_name), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; '.$report->report_name.".PDF",
                    ]);
                   //return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->other_name.".PDF", $headers);
                }
                else
                {
                    return redirect()->back()->with("message","Report ".$report->report_name.".PDF was not found for this date" );
                }

                break;
            case "xls":
                $report_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->report_name.".XLS";
                $report_other_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->other_name.".XLS";
                if (File::exists($report_name))
                {
                    $headers = array(
                        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ',
                    );

                    return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->report_name.".XLS", $headers);
                }
                elseif(File::exists($report_other_name))
                {
                    $headers = array(
                        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ',
                    );
                    return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->other_name.".XLS", $headers);
                }
                else
                {
                    return redirect()->back()->with("message","Report ".$report->report_name.".XLS was not found for this date" );
                }
                break;
            case "txt":
                $report_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->report_name.".TXT";
                $report_other_name =$path."/".date("Y",strtotime($dt))."/".ucfirst(date("M",strtotime($dt)))."/".date("d",strtotime($dt))."/".$report->other_name.".TXT";
                if (File::exists($report_name))
                {
                    $headers = array(
                        'Content-Type: text/plain',
                    );
                    return Response::make(file_get_contents($report_name), 200, [
                        'Content-Type' =>  'text/plain',
                        'Content-Disposition' => 'inline; '.$report->report_name.".TXT",
                    ]);
                    //return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->report_name.".TXT", $headers);
                }
                elseif(File::exists($report_other_name))
                {
                    $headers = array(
                        'Content-Type: text/plain',
                    );
                    return Response::make(file_get_contents($report_other_name), 200, [
                        'Content-Type' =>  'text/plain',
                        'Content-Disposition' => 'inline; '.$report->report_name.".TXT",
                    ]);
                    //return Response::download($report_name, date("Y_M_d",strtotime($dt))."_".$report->other_name.".TXT", $headers);
                }
                else
                {
                    return redirect()->back()->with("message","Report ".$report->report_name.".TXT was not found for this date" );
                }

                break;
        }
    }


}
