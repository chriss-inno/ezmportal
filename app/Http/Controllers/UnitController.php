<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Unit;
use App\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function __construc()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $units= Unit::all();
        return view('units.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\UnitRequest $request)
    {

        $unit=new Unit;
        $unit->parent_id=$request->parent_id;
        $unit->department_id=$request->department;
        $unit->unit_name=$request->unit_name;
        $unit->status=$request->status;
        $unit->input_by=Auth::user()->username;
        $unit->save();
        return "Successful saved";
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
        $unit= Unit::find($id);
        return view('units.show',compact('unit'));
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
        $unit= Unit::find($id);
        return view('units.edit',compact('unit'));
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
        $unit= Unit::find($request->unit_id);
        $unit->parent_id=$request->parent_id;
        $unit->department_id=$request->department;
        $unit->unit_name=$request->unit_name;
        $unit->status=$request->status;
        $unit->input_by=Auth::user()->username;
        $unit->save();

        return "Successful saved";
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
        $unit= Unit::find($id);
        $unit->delete();
    }
}
