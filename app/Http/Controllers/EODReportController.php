<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class EODReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('eod.create');
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
        $first_dir=str_replace("\\","/",$request->first_dir);
        $second_dir=str_replace("\\","/",$request->second_dir);
        $new_dir=str_replace("\\","/",$request->new_dir);

        if(File::exists($first_dir)) {
            $filesInFolder =File::files($first_dir);

            foreach($filesInFolder as $path)
            {
                $fileDetails = pathinfo($path);
                if($fileDetails['extension'] = ".rep") //Filter only BO files
                {
                    $getReport=$fileDetails['filename'].$fileDetails['extension'];

                    //Check report in second folder

                    $foundreport=$second_dir."/".$getReport;

                   // echo "Check in ". $foundreport . " - ";

                    if(File::exists($foundreport))
                    {

                       $new_file=$new_dir."/".$getReport;

                        if ( ! File::copy($foundreport, $new_file))
                        {
                            die("Couldn't copy file <br/>");
                        }

                    }
                    else
                    {
                       // echo  "Report not found ".$getReport. "<br/>";
                    }

                }

            }
            echo  "<br/>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx Done xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

        }
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
    }
}
