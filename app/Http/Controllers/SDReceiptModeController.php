<?php

namespace App\Http\Controllers;

use App\SDReceiptMode;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SDReceiptModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $modes=SDReceiptMode::all();
        return view('servicedelivery.receiptmode.index',compact('modes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicedelivery.receiptmode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $modes=new SDReceiptMode;
        $modes->mode_name=$request->mode_name;
        $modes->description=$request->description;
        $modes->input_by=Auth::user()->username;
        $modes->save();
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
        $modes=SDReceiptMode::find();
        return view('servicedelivery.receiptmode.show',compact('modes'));
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
        $modes=SDReceiptMode::find($id);
        return view('servicedelivery.receiptmode.edit',compact('modes'));
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
        $modes=SDReceiptMode::find($id);
        $modes->mode_name=$request->mode_name;
        $modes->description=$request->description;
        $modes->input_by=Auth::user()->username;
        $modes->save();
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
        $modes=SDReceiptMode::find($id);
        $modes->delete();
    }
}
