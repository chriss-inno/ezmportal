<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Http\Requests\InventoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportRequest;

class InventoryController extends Controller
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
        $items=Inventory::all();
        return view('inventory.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryRequest $request)
    {
        //
        $item=new Inventory;
        $item->ip_address=$request->ip_address;
        $item->type_id=$request->type_id;
        $item->item_name=strtoupper(strtolower($request->item_name));
        $item->user_name=ucwords(strtolower($request->user_name));
        $item->machine_model=$request->machine_model;
        $item->serial_number=strtoupper(strtolower($request->serial_number));
        $item->usb=$request->usb;
        $item->antivirus=$request->antivirus;
        $item->description=$request->description;
        $item->department_id=$request->department_id;
        $item->branch_id=$request->branch_id;
        $item->status=$request->status;
        $item->input_by=Auth::user()->username;
        $item->save();

        return "<h3 class='text-info'>Data saved successful</h3>";
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
        $item=Inventory::find($id);
        return view('inventory.show',compact('item'));
    }
    public function reports()
    {
        //
        $items=Inventory::all();
        return view('inventory.reports',compact('items'));
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
        $item=Inventory::find($id);
        return view('inventory.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryRequest $request, $id)
    {
        //
        $item=Inventory::find($id);
        $item->ip_address=$request->ip_address;
        $item->type_id=$request->type_id;
        $item->item_name=strtoupper(strtolower($request->item_name));
        $item->user_name=ucwords(strtolower($request->user_name));
        $item->machine_model=$request->machine_model;
        $item->serial_number=strtoupper(strtolower($request->serial_number));
        $item->usb=$request->usb;
        $item->antivirus=$request->antivirus;
        $item->description=$request->description;
        $item->department_id=$request->department_id;
        $item->branch_id=$request->branch_id;
        $item->status=$request->status;
        $item->input_by=Auth::user()->username;
        $item->save();

        return "<h3 class='text-info'>Data saved successful</h3>";
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
        $item=Inventory::find($id)->delete();
    }

    public function showImportExcel()
    {
        //
        return view('inventory.import');
    }

    //Reports download
    public function postDownloadReport(Request $request)
    {
        //
        return view('inventory.import');
    }
    public function showDownloadReport()
    {
        //
        return view('inventory.download');
    }
    //Upload ms excel file
    public function importExcel(Request $request)
    {
        try {

            $file= $request->file('inventory_file');
            $destinationPath = public_path() .'/uploads/temp/';
            $filename   = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move($destinationPath, $filename);

            Excel::load($destinationPath . $filename, function ($reader) {

                   $results = $reader->get();

                    $results->each(function($row) {


                        $item=new Inventory;
                        $item->ip_address=$row->ip_address;
                        $item->item_name=strtoupper(strtolower($row->item_name));
                        $item->user_name=ucwords(strtolower($row->username));
                        $item->machine_model=$row->machine_model;
                        $item->serial_number=strtoupper(strtolower($row->serial_number));
                        $item->usb=$row->usb;
                        $item->antivirus=$row->antivirus;
                        $item->status='working';
                        $item->input_by=Auth::user()->username;
                        $item->save();
                       });

                });

             File::delete($destinationPath . $filename); //Delete after upload

                return redirect('inventory')->with('success', 'Users uploaded successfully.');
            } catch (\Exception $e) {

                //echo $e->getMessage();
                return redirect('inventory')->with('error',$e->getMessage());
            }

    }
}
