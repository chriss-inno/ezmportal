<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Module;
use App\Http\Requests\ModuleRequest;
use Illuminate\Support\Facades\Auth;
use App\UserModules;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $modules=Module::all();
        return view('modules.index',compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ModuleRequest $request)
    {
        //
        $mod=new Module;
        $mod->department_id=$request->department;
        $mod->module_name=$request->module_name;
        $mod->description=$request->description;
        $mod->input_by=Auth::user()->username;
        $mod->status=$request->status;
        $mod->save();
        $modules=Module::all();
        return view('modules.index',compact('modules'));
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
        $mod=Module::find($id);
        return view('module.show',compact('mod'));
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
        $mod=Module::find($id);
        return view('module.edit',compact('mod'));
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
        $mod= Module::find($id);
        $mod->save();
        return redirect('modules');
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
        $mod= Module::find($id)->delete();
    }

    //Check for assigne modules
    public static function checkAccess($user_id,$module)
    {
        $usr=UserModules::where('user_id','=',$user_id)->where('module_id','=',$module)->get();
        if(count($usr)>0) {
            return true;} else {return false;}
    }
}
