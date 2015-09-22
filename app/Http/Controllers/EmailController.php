<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OracleSupport;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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

    //Oracle issues
    public function olacle()
    {
        //
        $issues=OracleSupport::where('status','=','Opened')->where('email_sent','=','N')->get();
        //Send every
        if(date("H:i") =="20:30") {
                $data = array(
                    'issues' => $issues,
                );

                \Mail::send('emails.oracle', $data, function ($message) {

                    $message->from('innocent.christopher@bankm.com', 'Innocent Christopher');

                    $message->to('innocent.christopher@bankm.com')->subject('DAILY ISSUES LOGGED');

                });
            echo "Email sent";
        }
        else
        {
            foreach($issues as $issue)
            {
                $issue->email_sent='N';
                $issue->save();
            }
            echo "Email bado";
        }

    }

}
