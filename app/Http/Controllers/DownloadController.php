<?php

namespace App\Http\Controllers;

use App\Department;
use App\Download;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function __construct()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $downloads=Download::all();
        return view('downloads.index',compact('downloads'));
    }


    public function reports()
    {
        return view('downloads.reports');
    }
    //Show downloads as per departments
    public function showDepartmentDownload($id)
    {
        //
        $department=Department::find($id);
        return view('downloads.downloads',compact('department'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('downloads.create');
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
        $this->validate($request, [
            'downloadFile' => 'required',
            'title' => 'required',
            'department_id' => 'required',
            'status' => 'required',
            'restricted' => 'required'
        ]);
            $download = new Download;
            $download->title = $request->title;
            $download->department_id = $request->department_id;
            $download->descriptions = $request->descriptions;
            $download->status = $request->status;
            $download->restricted = $request->restricted;
            $download->input_by = Auth::user()->username;
            $download->save();

        $file= $request->file('downloadFile');
        $destinationPath = public_path() .'/downloads/';
        $filename   = $download->id.substr($download->title,0,3). '.'.$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        $download->download_path=$filename;
        $download->download_ext=$file->getClientOriginalExtension();
        $download->save();

        return redirect('downloads/manage');
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
        $download=Download::all();
        return view('downloads.show',compact('download'));
    }

    //Download file

    public function downloadFile($id)
    {
        //
        $download=Download::find($id);
        $fileDownload= public_path() .'/downloads/'.$download->download_path;
        if (File::exists($fileDownload))
        {
            return Response::download($fileDownload,$download->title.".".$download->download_ext);
        }
      else
      {
          return redirect()->back()->with("message"," File [".$download->title." ] was not found" );
      }

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
        $download=Download::find($id);
        return view('downloads.edit',compact('download'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

         if($request->replace_check != null && $request->replace_check != "") {

             $this->validate($request, [
                 'downloadFile' => 'required',
             ]);

         }else
         {
             $this->validate($request, [
                 'title' => 'required',
                 'department_id' => 'required',
                 'status' => 'required',
                 'restricted' => 'required'
             ]);
         }

        $download=Download::find($request->id);
        $download->title=$request->title;
        $download->department_id=$request->department_id;
        $download->descriptions=$request->descriptions;
        $download->status=$request->status;
        $download->restricted=$request->restricted;
        $download->input_by=Auth::user()->username;
        $download->save();

        if($request->replace_check != null && $request->replace_check != "") {

            $file= $request->file('downloadFile');
            $destinationPath = public_path() .'/downloads/';
            $filename   = $download->id.substr($download->title,0,3). '.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $download->download_path=$filename;
            $download->download_ext=$file->getClientOriginalExtension();
            $download->save();
        }
        return redirect('downloads/manage');
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
        $download=Download::find($id);
        $download->delete();
    }
}
