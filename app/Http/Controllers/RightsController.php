<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Right;
use App\UserRight;
use Illuminate\Support\Facades\Auth;

class RightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $rights=Right::all();
        return view('userright.index',compact('rights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('userright.create');
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


               $right=new Right;
               $right->status=$request->status;
               $right->description=$request->description;
               $right->right_name=$request->right_name;
               $right->input_by=Auth::user()->username;
               $right->save();

               $i=1;
               foreach($request->module as $module)
               {
                   $create="create".$module;
                   $view="view".$module;
                   $edit="edit".$module;
                   $delete="delete".$module;
                   $authorize="authorize".$module;
                   $aut=$inp=$del=$edi=$viw=0;

                   if( $request->$create=== '1'){$inp=1;}
                   if($request->$view === '1'){$viw=1;}
                   if($request->$edit === '1'){$edi=1;}
                   if($request->$delete === '1'){$del=1;}
                   if($request->$authorize === '1'){$aut=1;}



                   $userRight =new UserRight;
                   $userRight->right_id=$right->id;
                   $userRight->module=$module;
                   $userRight->viw=$viw;
                   $userRight->edi=$edi;
                   $userRight->del=$del;
                   $userRight->inp=$inp;
                   $userRight->aut=$aut;
                   $userRight->save();

            $i++;
        }

       return redirect('users/rights');

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
        $right= Right::find($id);
        return view('userright.create',compact('right'));
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
