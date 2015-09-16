<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Branch;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRegistrationRequest;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $users=User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserRequest $request)
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
        $user=User::find($id);
        return view('users.show',compact('user'));
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
        $user=User::find($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        $user=User::find($id);
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
        $user=User::find($id);
        $user->delete();
    }

    /**
     * Show the form for Login.
     *
     * @return Response
     */
    public function login()
    {
        //
        if (Auth::check())
        {
            // The user is logged in...
            //check for user type

            $user=User::find(Auth::user()->id);

            return view('layout.admin_dashboard');
        }
        else
        {

            return view('users.login');
        }
    }

    //Register user
    public function registration()
    {
        $branches =Branch::all();
        return view('users.registration',compact('branches'));
    }

    //Process registration
    public function postRegister(UserRegistrationRequest $request)
    {
        $us=new User;
        $us->first_name=ucwords($request->first_name);
        $us->last_name=ucwords($request->last_name);
        $us->designation=ucwords($request->designation);
        $us->phone=$request->phone;
        $us->branch_id=$request->branch;
        $us->department_id=$request->department;

        $us->password=bcrypt($request->Password);

        //Create username
        $string =strtolower($request->first_name.".".$request->last_name);
        $uname = preg_replace('/\s+/','',$string); //Remove all empty space

        $us->username= $uname; //Combine first and last names
        //Create email
        $us->email=$uname."@bankm.com"; //Combine first and last names
        $us->save();

        return redirect('login')->with('message','You have successful registered to Bank M service Portal,<br> Your login access was sent to your email');
    }

   //Process registration
    public function logout()
    {
        if (Auth::check())
        {
            $user= \App\User::find(Auth::user()->id);
            $user->last_logout=date("Y-m-d h:i:s");
            $user->save();
        }

        Auth::logout();
        return redirect('login');
    }
    //Post login for Authenticating users
    public function postLogin(Request $request)
    {
        $username=strtolower($request->username);
        $password=$request->password;

        if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
            if(Auth::user()->block ==1)
            {
                Auth::logout();
                return redirect()->back()->with('message', 'Login Failed you don\'t have Access to login please  Contact Administrator');
            }
            else
            {
                $user= User::find(Auth::user()->id);
                $user->last_success_login=date("Y-m-d h:i:s");
                $user->last_login=date("Y-m-d h:i:s");
                $user->save();

                return redirect()->intended('home');
            }

        }
        else
        {
            return redirect()->back()->with('message', 'Login Failed,Invalid username or password');
        }
    }


}
