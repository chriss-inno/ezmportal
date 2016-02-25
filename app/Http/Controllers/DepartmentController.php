<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $units=Department::all();
        return view('department.index',compact('units'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $dep=new Department;
        $dep->department_name=$request->department_name;
        $dep->description=$request->description;
        $dep->branch_id=$request->branch_id;
        $dep->input_by=Auth::user()->username;
        $dep->receive_query=$request->receive_query;
        $dep->status=$request->status;
        $dep->download_check=$request->download_check;
        $dep->save();

        return "Saved successful";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $dep=Department::find($id);
        return view('department.show',compact('dep'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $dep=Department::find($id);
        return view('department.edit',compact('dep'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        //
        $dep=Department::find($request->id);
        $dep->department_name=$request->department_name;
        $dep->description=$request->description;
        $dep->branch_id=$request->branch_id;
        $dep->input_by=Auth::user()->username;
        $dep->status=$request->status;
        $dep->receive_query=$request->receive_query;
        $dep->download_check=$request->download_check;
        $dep->save();

        return "Saved successful";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $dep=Department::find($id);
        $dep->delete();
    }

    public function getModules($id)
    {
        //
        $dp=Department::find($id);
        $dep="<option value=''>----</option>";
        foreach($dp->module as $m)
        {
            $dep .="<option value='$m->id'>$m->module_name</option>";
        }
        return $dep;
    }

    public function getUnits($id)
    {
        //
        $dp=Department::find($id);
        $dep="<option value=''>----</option>";
        foreach($dp->units as $unit)
        {
            $dep .="<option value='$unit->id'>$unit->unit_name</option>";
        }
        return $dep;
    }
    public static function getDepartmentIDByUserId($userid)
    {
        $user=User::find($userid);
        if(count($user) > 0) {
            $depacc = Department::find($user->department_id);
            if (count($depacc) > 0) {
                return $depacc->id;
            } else {
                return "";;
            }
        }else
        {
            return "";
        }
    }
    public static function getDepartmentIdById($depid)
    {
        $depacc=Department::find($depid);
        if(count($depacc)>0) {
            return $depacc->id;} else {return "";}
    }
}
