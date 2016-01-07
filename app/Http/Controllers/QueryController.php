<?php

namespace App\Http\Controllers;

use App\Jobs\QueryLaunchedEmail;
use App\Jobs\QueryProgressEmail;
use App\Jobs\QueryAssignmentEmail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\QueryRequest;
use App\Query;
use App\QueryAssignment;
use App\User;
use App\UserModules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Message;

class QueryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('queries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QueryRequest $request)
    {
        //
        //Check for reference file
        if($request->referencecheck != null && $request->referencecheck != "") {

            $this->validate($request, [
                'reference_file' => 'required',
            ]);

        }

        $query=new Query;
        $query->reporting_Date=date("Y-m-d H:i");
        $query->from_department=Auth::user()->department_id;
        $query->from_unit=Auth::user()->unit_id;
        $query->from_branch=Auth::user()->branch_id;
        $query->reported_by=Auth::user()->id;
        $query->to_department=$request->to_department;
        $query->module_id=$request->module;
        $query->critical_level=$request->critical_level;
        $query->description=$request->description;
        $query->completed=0;
        $query->status="Launched";
        $query->today_date=date("Y-m-d");
        $query->save();


        //Generate query codes based on branch and department
        $query->query_code="BANKM".$query->toDepartment->branch->branch_code.strtoupper(substr($query->toDepartment->department_name,0,3)).$query->id;
        $query->save();

        //check if attachment
        if($request->referencecheck != null && $request->referencecheck != "") {

            $file= $request->file('reference_file');
            $destinationPath = public_path() .'/uploads/';
            $filename   = $query->query_code. '.'.$file->getClientOriginalExtension();

            $file->move($destinationPath, $filename);

            $query->reference_file= $filename;
            $query->save();
        }
        //Query auto reassign mechanism
        // 1. Check for users with no exemption and assigned to module the same module as logged by the query

        $users = \DB::table('users')->join('user_modules','users.id','=','user_modules.user_id')
                   ->select('users.id')
                   ->where('users.query_exemption','=','No')
                   ->where('user_modules.module_id','=',$query->module_id)
                   ->lists('users.id');

        //2. Check if the these user are assigned query for today

        $today=date("Y-m-d");

        $assignment =QueryAssignment::whereIn('user_id',$users)->where('assigned_date','=',$today)->get();

        if(count($assignment) >=count($users)) // if no user was assigned then choose the first user
        {
            $user = \DB::table('query_assignments')
                ->select('user_id', \DB::raw('count(user_id) as total'))
                ->whereIn('user_id',$users)->where('assigned_date','=',$today)
                ->groupBy('user_id')
                ->orderBy(\DB::raw('RAND()'))->first();
            if($user != null && $user !="")
            {
                $queryAssignment=new QueryAssignment;
                $queryAssignment->query_id=$query->id;
                $queryAssignment->user_id=$user->user_id;
                $queryAssignment->module_id=$query->module_id;
                $queryAssignment->assigned_date=$today;
                $queryAssignment->assigned_date_time=date("Y-m-d H:i");
                $queryAssignment->save();
                $query->assigned=1; //Change status to assigned
                $query->assigned_by ="System Auto Assign";
                $query->save();
            }


        }
        else
        {

           // $user=User::whereIn('id',$users)->orderByRaw("RAND()")->first();
            $userlist= "'".implode("','",$users)."'";
            $user=\DB::select("select prt_users.id as userid from prt_users where prt_users.id IN (".$userlist.") AND prt_users.id NOT IN (SELECT user_id FROM prt_query_assignments where assigned_date ='".$today."') ");

            if($user != null && $user !="") {
                $queryAssignment = new QueryAssignment;
                $queryAssignment->query_id = $query->id;
                $queryAssignment->user_id = $user[0]->userid;
                $queryAssignment->module_id = $query->module_id;
                $queryAssignment->assigned_date = $today;
                $queryAssignment->assigned_date_time=date("Y-m-d H:i");
                $queryAssignment->save();
                $query->assigned = 1; //Change status to assigned
                $query->assigned_by ="System Auto Assign";
                $query->save();
            }


        }

        //Send email
       // $job = (new QueryLaunchedEmail($query))->delay(10);
      //  $this->dispatch($job);
       // \App\Http\Controllers\QueryEmailController::sendQueryLaunchedEmail($query); //Launched emails

        return redirect('queries/progress');


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
        $query=Query::find($id);
        return view('queries.show',compact('query'));
    }
    //Query attend
    public function queryAttend($id)
    {
        //
        $query=Query::find($id);
        return view('queries.attend',compact('query'));
    }
    public function postQueryAttend(Request $request)
    {
        //
        $query=Query::find($request->query_id);
        //Update query status
        if(strtolower($request->status) =="closed")
        {
            $query->closed=1; //Close the query
        }
        $query->status=ucwords(strtolower($request->status));
        $query->save();

        //Store message
        $msg=new Message;
        $msg->query_id=$query->id;
        $msg->sender=Auth::user()->id;
        $msg->sent_time=date("Y-m-d H:i");
        $msg->message_type="OUT";
        $msg->message=$request->message;
        $msg->save();

        //Send attend email
        $job = (new QueryProgressEmail($msg))->delay(10);
        $this->dispatch($job);
       // \App\Http\Controllers\QueryEmailController::sendQueryProgressEmail($msg); //Passing messages
        return "Data saved successful";
    }
    //Query messages

    public function message($id)
    {
        //
        $query=Query::find($id);
        return view('queries.inbox',compact('query'));
    }
    public function messageComposer($id)
    {
        //
        $query=Query::find($id);
        return view('queries.message',compact('query'));
    }
    public function postMessageComposer(Request $request)
    {
        //
        $query=Query::find($request->query_id);

        $msg=new Message;
        $msg->query_id=$request->query_id;
        $msg->sender=Auth::user()->id;
        $msg->sent_time=date("Y-m-d H:i");
        $msg->message_type="OUT";
        $msg->message=$request->message;
        $msg->save();

        //Send emails for update
        //Send attend email
        $job = (new QueryProgressEmail($msg))->delay(10);
        $this->dispatch($job);
        //\App\Http\Controllers\QueryEmailController::sendQueryProgressEmail($msg); //Passing messages
        return "Data saved successful";
    }
    public function postMessage(Request $request)
    {
        //
        $query=Query::find($request->query_id);
        //Check for reference file
        if($request->referencecheck != null && $request->referencecheck != "") {

           // Build the input for our validation
             $input = array('reference_file' => $request->file('reference_file'));

            // Within the ruleset, make sure we let the validator know that this
            // file should be an image
            $rules = array(
                'reference_file' => 'required'
            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($input, $rules);
            if ($validator->fails())
            {
                return '<div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    Please attach recommended file! Submit failed
                </div>';
            }
            else
            {
                $msg=new Message;
                $msg->query_id=$request->query_id;
                $msg->sender=Auth::user()->id;
                $msg->sent_time=date("Y-m-d H:i");
                $msg->message_type="OUT";
                $msg->message=$request->message;
                $msg->save();

                //Generate Keys for message files
                $fileid= $msg->id.$msg->id.strtotime(date("Y-m-d H:i:s"));

                $file= $request->file('reference_file');
                $destinationPath = public_path() .'/uploads/messages/';
                $filename   = $fileid. '.'.$file->getClientOriginalExtension();

                $file->move($destinationPath, $filename);

                $msg->reference_file= $filename;
                $msg->save();

                //Send emails for update
                //Send email
                $job = (new QueryProgressEmail($msg))->delay(10);
                $this->dispatch($job);
               // \App\Http\Controllers\QueryEmailController::sendQueryProgressEmail($msg); //Passing messages

                return "Data submitted successfully";
            }
        }
        else
        {
            $msg=new Message;
            $msg->query_id=$request->query_id;
            $msg->sender=Auth::user()->id;
            $msg->sent_time=date("Y-m-d H:i");
            $msg->message_type="OUT";
            $msg->message=$request->message;
            $msg->save();

            //Send emails for update
            $job = (new QueryProgressEmail($msg))->delay(10);
            $this->dispatch($job);
            //\App\Http\Controllers\QueryEmailController::sendQueryProgressEmail($msg); //Passing messages

            return "Data submitted successfully";
        }


    }

    public function showCustomReport()
    {
        return view('queries.customreport');
    }

    public function postCustomReport(Request $request)
    {


        if( Auth::user()->user_type=="Administrator") {

            $start_time=date("Y-m-d",strtotime($request->start_time));
            $end_time=date("Y-m-d",strtotime($request->end_time));

            $range = [$start_time, $end_time];
            $queries=Query::whereBetween('reporting_Date',$range)->get();

            Excel::create("query_custom_report", function ($excel) use ($queries) {

                $excel->sheet('sheet', function ($sheet) use ($queries) {
                    $sheet->loadView('excels.qcreport')->with('queries', $queries);

                });

            })->download('xlsx');
        }
        else
        {
            $start_time=date("Y-m-d",strtotime($request->start_time));
            $end_time=date("Y-m-d",strtotime($request->end_time));

            $range = [$start_time, $end_time];
            $queries=Query::whereBetween('reporting_Date',$range)->where('to_department','=',Auth::user()->department_id)->get();

            Excel::create("query_custom_report", function ($excel) use ($queries) {

                $excel->sheet('sheet', function ($sheet) use ($queries) {
                    $sheet->loadView('excels.qcreport')->with('queries', $queries);

                });

            })->download('xlsx');
        }
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
        $query=Query::find($id);

        return view('queries.edit',compact('query'));
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
    }

    //Get all queries logged to or logged from a department
    public function progress()
    {
        if( Auth::user()->user_type=="Administrator")
        {
            $queries = Query::where('closed', '=', '0')->get();
        }
        else {
            if(Auth::user()->unit_id != "" && Auth::user()->unit_id != null )
            {
                $queries = Query::where('closed', '=', '0')
                    ->where('from_unit', '=', Auth::user()->unit_id)->orwhere('to_department', '=', Auth::user()->department_id)->get();
            }
            else
            {
                $queries = Query::where('closed', '=', '0')
                    ->where('from_department', '=', Auth::user()->department_id)->orwhere('to_department', '=', Auth::user()->department_id)->get();
            }

        }
        return view('queries.index',compact('queries'));

    }
    //Load query history
    public function history()
    {

        if( Auth::user()->user_type=="Administrator")
        {
            $queries=Query::all();
        }
        else
        {
            if(Auth::user()->unit_id != "" && Auth::user()->unit_id != null )
            {
                $queries=Query::where('from_unit', '=', Auth::user()->unit_id)->orwhere('to_department', '=', Auth::user()->department_id)->get();
            }
            else
            {
                $queries=Query::where('from_department', '=', Auth::user()->department_id)->orwhere('to_department', '=', Auth::user()->department_id)->get();
            }

        }

        return view('queries.history',compact('queries'));

    }
    //load query reports
    public function report()
    {
        if( Auth::user()->user_type=="Administrator")
        {
            $queries=Query::all();
        }
        else {
            if(Auth::user()->unit_id != "" && Auth::user()->unit_id != null )
            {
                $queries=Query::where('from_unit', '=', Auth::user()->unit_id)->orwhere('to_department', '=', Auth::user()->department_id)->get();
            }
            else {
                $queries = Query::where('from_department', '=', Auth::user()->department_id)->orwhere('to_department', '=', Auth::user()->department_id)->get();
            }
        }
        return view('queries.reports',compact('queries'));

    }
    //Load query history
    public function queryAssign()
    {
        //load query from user department only
        if( Auth::user()->user_type=="Administrator")
        {
            $queries=Query::where('closed', '<>', '1')->get();
            return view('queries.assign',compact('queries'));
        }
        else {
        $queries=Query::where('to_department','=',Auth::user()->department_id)->where('closed', '<>', '1')->get();
        return view('queries.assign',compact('queries'));
        }

    }
    public function queryAssignUsers($id)
    {
        //load query from user department only
        $query=Query::find($id);
        return view('queries.assignusers',compact('query'));

    }
    public function postQueryAssignUsers(Request $request)
    {
        $today=date("Y-m-d");
        $query=Query::find($request->query_id);
        if($query->assignment != null && $query->assignment !="")
        {
            $queryAssignment = QueryAssignment::where('query_id','=',$query->id)->get()->first();
            $queryAssignment->query_id = $query->id;
            $queryAssignment->user_id = $request->user_id;
            $queryAssignment->module_id = $query->module_id;
            $queryAssignment->assigned_date = date("Y-m-d");
            $queryAssignment->assigned_date_time=date("Y-m-d H:i");
            $queryAssignment->save();

            //Change status to assigned
            $query->assigned = 1;
            $query->status=$request->status;
            $query->assigned_by =Auth::user()->username;
            $query->save();

            $qry=Query::find($query->id);
            //Send emails
            //Send email
            $job = (new QueryAssignmentEmail($qry))->delay(10);
            $this->dispatch($job);
            //\App\Http\Controllers\QueryEmailController::sendQueryAssignmentEmail($qry); //Send assignment emails
            return "Data saved successful";
        }
        else
        {
            $queryAssignment =new QueryAssignment;
            $queryAssignment->query_id = $query->id;
            $queryAssignment->user_id = $request->user_id;
            $queryAssignment->module_id = $query->module_id;
            $queryAssignment->assigned_date = date("Y-m-d");
            $queryAssignment->assigned_date_time=date("Y-m-d H:i");
            $queryAssignment->save();

            //Change status to assigned
            $query->assigned = 1;
            $query->status=$request->status;
            $query->assigned_by =Auth::user()->username;
            $query->save();

            //Send emails
            $qry=Query::find($query->id);

            //Send email
            $job = (new QueryAssignmentEmail($qry))->delay(10);
            $this->dispatch($job);
            //\App\Http\Controllers\QueryEmailController::sendQueryAssignmentEmail($qry); //Send assignment emails

            return "Data saved successful";
        }

    }

    //View Queries assigned to specific users
    public function task()
    {
        if( Auth::user()->user_type=="Administrator")
        {
            $queries=Query::where('status','<>','Closed')->where('closed', '<>', '1')->get();
            return view('queries.mytask',compact('queries'));
        }
        else {
            $user = User::find(Auth::user()->id);
            $queries = $user->queries;
            return view('queries.usertask',compact('queries'));
        }


    }

    //Download attachment
    public function downloadAttachment($id)
    {
        $msg=Message::find($id);
        $destinationPath = str_replace("\\","/",public_path()) .'/uploads/messages/';
        $ref_file =$destinationPath.$msg->reference_file;
        if(File::exists($ref_file))
       {
            return Response::download($ref_file);
        }

    }

    //Query reports

    public function getMonthReports()
    {
        if( Auth::user()->user_type=="Administrator")
        {
            $queries=Query::where(\DB::raw('MONTH(reporting_Date)'),'=',date('n'))->get();
            Excel::create("query_month_report", function($excel) use($queries)  {

                $excel->sheet('sheet', function($sheet) use($queries){
                    $sheet->loadView('excels.qreport')->with('queries', $queries);

                });

            })->download('xlsx');
        }
        else
        {
            $queries=Query::where(\DB::raw('MONTH(reporting_Date)'),'=',date('n'))->where('to_department','=',Auth::user()->department_id)->get();
            Excel::create("query_month_report", function($excel) use($queries)  {

                $excel->sheet('sheet', function($sheet) use($queries){
                    $sheet->loadView('excels.mqreport')->with('queries', $queries);

                });

            })->download('xlsx');
        }

    }

    //Daily query logged

    public function getDailyReports()
    {
        if( Auth::user()->user_type=="Administrator")
        {
            $queries=Query::where(\DB::raw('DAY(reporting_Date)'),'=',date('j'))->get();
            Excel::create("query_daily_report_".date("d_M_Y"), function($excel) use($queries)  {

                $excel->sheet('sheet', function($sheet) use($queries){
                    $sheet->loadView('excels.adqreport')->with('queries', $queries);

                });

            })->download('xlsx');
        }
        else
        {
            $queries=Query::where(\DB::raw('DAY(reporting_Date)'),'=',date('j'))->where('to_department','=',Auth::user()->department_id)->get();
            Excel::create("query_daily_report_".date("d_M_Y"), function($excel) use($queries)  {

                $excel->sheet('sheet', function($sheet) use($queries){
                    $sheet->loadView('excels.dqreport')->with('queries', $queries);

                });

            })->download('xlsx');
        }
    }




}
