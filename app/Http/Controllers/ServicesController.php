<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $services=Service::all();
        return view('services.index',compact('services'));
    }

    public function listService()
    {
        //
        $services=Service::all();
        return view('services.list',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('services.create');
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
        $service = new Service;
        $service->service_name=$request->service_name;
        $service->description=$request->description;
        $service->status=$request->status;
        $service->input_by=Auth::user()->username;
        $service->save();

        return "<h3 class='text-info'>Data saved successfully</h3>";
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
        $services=Service::find($id);
        return view('services.show',compact('services'));
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
        $services=Service::find($id);
        return view('services.edit',compact('services'));
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
        $service =  Service::find($request->id);
        $service->service_name=$request->service_name;
        $service->description=$request->description;
        $service->status=$request->status;
        $service->input_by=Auth::user()->username;
        $service->save();

        return "<h3 class='text-info'>Data saved successfully</h3>";
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
        $service =  Service::find($id)->delete();
    }
}
