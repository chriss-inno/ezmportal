<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Branch;
use App\Http\Requests\BranchRequest;
use Illuminate\Support\Facades\Auth;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $branches=Branch::all();
        return view('branches.index',compact('branches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(BranchRequest $request)
    {
        //
        $br=new Branch;
        $br->branch_code=$request->branch_code;
        $br->branch_Name=$request->branch_Name;
        $br->description=$request->description;
        $br->status=$request->status;
        $br->input_by=Auth::user()->username;
        $br->save();

        return redirect('branches');
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
        $branch=Branch::find($id);
        return view('branches.edit',compact('branch'));
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
        //
        $br= Branch::find($request->id);
        $br->branch_code=$request->branch_code;
        $br->branch_Name=$request->branch_Name;
        $br->description=$request->description;
        $br->status=$request->status;
        $br->input_by=Auth::user()->username;
        $br->save();

        return redirect('branches');
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
        $branch=Branch::find($id)->delete();
    }

    //getDepartment

    public function getDepartment($id)
    {
        //
        $br=Branch::find($id);
        $dep="<option value=''>----</option>";
        foreach($br->department as $d)
        {
            $dep .="<option value='$d->id'>$d->department_name</option>";
        }
        return $dep;
    }
}
