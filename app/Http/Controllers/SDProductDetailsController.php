<?php

namespace App\Http\Controllers;

use App\SDProductDetails;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SDProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pdetails=SDProductDetails::all();
        return view('servicedelivery.productdetails.index',compact('pdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicedelivery.productdetails.create');
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
        $pdetails=new SDProductDetails;
        $pdetails->details_name=$request->details_name;
        $pdetails->description=$request->description;
        $pdetails->input_by=Auth::user()->username;
        $pdetails->save();
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
        $pdetails=SDProductDetails::find($id);
        return view('servicedelivery.productdetails.show',compact('pdetails'));
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
        $pdetails=SDProductDetails::find($id);
        return view('servicedelivery.productdetails.edit',compact('pdetails'));
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
        $pdetails=SDProductDetails::find($id);
        $pdetails->details_name=$request->details_name;
        $pdetails->description=$request->description;
        $pdetails->input_by=Auth::user()->username;
        $pdetails->save();
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
        $pdetails=SDProductDetails::find($id);
        $pdetails->delete();
    }
}
