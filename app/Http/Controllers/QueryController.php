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
        $query->save();

        //Generate error codes
        $query->query_code=$query->toDepartment->branch->branch_code.strtoupper(substr($query->toDepartment->department_name,0,3)).date("y").date("d").date("m").$query->id;;
        $query->save();


        //Auto resign
        //Check for users with no exemption and assigned to logged module
       // $users=DB::select(DB::raw("SELECT A.id user_id FROM prt_users A INNER JOIN prt_user_modules B ON(A.id=B.user_id)
                                // WHERE A.query_exemption ='No' AND module_id='".$query->module_id."'"));

        $users = \DB::table('users')->join('user_modules','users.id','=','user_modules.user_id')
                   ->select('users.id')
                   ->where('users.query_exemption','=','No')
                   ->where('user_modules.module_id','=',$query->module_id)
                   ->lists('users.id');

        //Check if the these user are assigned query for today

        $today=date("Y-m-d");

        $assignment =QueryAssignment::whereIn('user_id',$users)->where('assigned_date','=',$today)->get();

        if(count($assignment) >0) // if no user wa assigned then choose the first user
        {

        }
        else
        {

        }

        /*
        if(count($users) >0)
        {


            foreach($users as $usMod)
            {

                if($usMod->user->query_exemption =="No")
                {
                    //Get user with low number of assigned Queries

                    $user_assigned = DB::table('query_assignments')
                                 ->select('user_id', DB::raw('count(user_id) as total'))
                                 ->groupBy('user_id')
                                 ->orderBy('total', 'asc') ->get()->first();

                    $queryAssignment=new QueryAssignment;
                    $queryAssignment->query_id=$query->id;
                    $queryAssignment->user_id=$usMod->user->id;
                    $queryAssignment->module_id=$query->module_id;
                    $queryAssignment->save();

                    $query->assigned=1; //Change status to assigned
                    $query->save();
                }

            }


        }
        return redirect('queries/progress');
        */
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
}
