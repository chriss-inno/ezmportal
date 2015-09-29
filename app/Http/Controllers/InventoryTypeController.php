<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\InventoryType;
use App\Http\Requests\InventoryTypeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class InventoryTypeController extends Controller
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
        $types=InventoryType::all();
        return view('inventory.typeindex',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inventory.typecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryTypeRequest $request)
    {
        //
        $inventoryType=new InventoryType;
        $inventoryType->type_name=$request->type_name;
        $inventoryType->description=$request->description;
        $inventoryType->input_by=Auth::user()->username;
        $inventoryType->status=$request->status;
        $inventoryType->save();

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
        $type=InventoryType::find($id);
        return view('inventory.typeshow',compact('type'));
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
        $type=InventoryType::find($id);
        return view('inventory.typeedit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryTypeRequest $request, $id)
    {
        //
        $inventoryType= InventoryType::find($id);
        $inventoryType->type_name=$request->type_name;
        $inventoryType->description=$request->description;
        $inventoryType->input_by=Auth::user()->username;
        $inventoryType->status=$request->status;
        $inventoryType->save();

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
        $type=InventoryType::find($id);
        foreach($type->item as $item)
        {
            $item->delete();
        }
    }

}
