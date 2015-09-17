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
    public function index($id)
    {
        //

        return view('units.index',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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

        $data="";
        $i=1;
        $dep=\App\Department::find($request->department);
        $units=$dep->units;
        foreach($units as $unit) {
            $data .= '<tr>
                        <td>'.$i++.'</td>
                        <td>'.$unit->unit_name.'</td>
                        <td>'.$unit->status.'</td>
                        <td id="'.$unit->id.'" class="text-center">
                            <a  href="#" title="Edit Unit" class="editUnit btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <a href="#b" title="Delete Unit" class="delUnit btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> </a>
                        </td>
                    </tr>';
        }
        return $data;
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
