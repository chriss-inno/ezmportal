<?php

namespace App\Http\Controllers;

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
        if($request->file_upload_chec != null && $request->file_upload_chec != "") {

            $validator = Validator::make(
                [
                    'reference_file' => 'required|mimes:application/msword,application/vnd.ms-office,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ]
            );
            if ($validator->fails())
            {
                // The given data did not pass validation
                return redirect()->back()->withErrors($validator);
            }
        }
        $query=new Query;
        $query->reporting_Date=date("Y-m-d H:i");
        $query->from_department=Auth::user()->department_id;
        $query->from_branch=Auth::user()->branch_id;
        $query->reported_by=Auth::user()->id;
        $query->to_department=$request->to_department;
        $query->module_id=$request->module;
        $query->critical_level=$request->critical_level;
        $query->description=$request->description;
        $query->completed=0;
        $query->status="Launched";
        $query->save();


        //Generate query codes based on branch and department
        $query->query_code=$query->toDepartment->branch->branch_code.strtoupper(substr($query->toDepartment->department_name,0,3)).date("y").date("d").date("m").$query->id;;
        $query->save();

        //Check for reference file
        if($request->file_upload_chec != null && $request->file_upload_chec != "")
        {
            $imageName = $query->query_code . '.' .
                $request->file('reference_file')->getClientOriginalExtension();

            $request->file('reference_file')->move(
                base_path() . '/public/uploads/', $imageName
            );
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
                ->orderBy('total', 'asc')->first();;
            if($user != null && $user !="")
            {
                $queryAssignment=new QueryAssignment;
                $queryAssignment->query_id=$query->id;
                $queryAssignment->user_id=$user->user_id;
                $queryAssignment->module_id=$query->module_id;
                $queryAssignment->assigned_date=$today;
                $queryAssignment->save();
                $query->assigned=1; //Change status to assigned
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
                $queryAssignment->save();
                $query->assigned = 1; //Change status to assigned
                $query->save();
            }


        }

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

    //Query progress
    public function progress()
    {
        $queries=Query::where('reported_by','=',Auth::user()->id)->where('closed','=','0')->get();
        return view('queries.index',compact('queries'));

    }
    //Load query history
    public function history()
    {
        $queries=Query::where('reported_by','=',Auth::user()->id)->get();
        return view('queries.index',compact('queries'));

    }

    //Task
    public function task()
    {
        $user=User::find(Auth::user()->id);
        $queries=$user->queries;
        return view('queries.mytask',compact('queries'));

    }

}
