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
use App\Http\Requests\UserEditRequest;
use App\Right;
use App\UserModules;

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
        $user=new User;
        $user->first_name=$request->first_name;
        $user->middle_name=$request->middle_name;
        $user->last_name=$request->last_name;
        $user->designation=$request->designation;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->username=$request->username;
        $user->password=bcrypt($request->Password);
        $user->right_id=$request->right;
        $user->branch_id=$request->branch;
        $user->department_id=$request->department;
        $user->status=$request->status;
        $user->input_by=Auth::user()->username;;
        $user->save();

        //Send email to registered user
        $data = array(
            'username' => $user->username,
            'password' => $request->Password,
            'name' =>   $string = ucwords(strtolower($user->first_name . " " . $user->last_name)) ,
        );

        \Mail::queue('emails.registration', $data, function ($message) use ($user){

            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

            $message->to($user->email)->subject('Portal registration notification');

        });

        return redirect('users');
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
    public function update(UserEditRequest $request, $id)
    {
        //
        $user=User::find($id);
        $user->first_name=$request->first_name;
        $user->middle_name=$request->middle_name;
        $user->last_name=$request->last_name;
        $user->designation=$request->designation;
        $user->email=$request->email;
        $user->phone=$request->phone;

        //Check request for changing password
        if($request->changepass ==="changepass" )
        {
            $user->password=bcrypt($request->Password);
        }
        $user->right_id=$request->right;
        $user->branch_id=$request->branch;
        $user->department_id=$request->department;
        $user->status=$request->status;
        $user->input_by=Auth::user()->username;;
        $user->save();

        //Send email to registered user
        $data = array(
            'username' => $user->username,
            'password' => $request->Password,
            'name' =>   $string = ucwords(strtolower($user->first_name . " " . $user->last_name)) ,
        );

        \Mail::queue('emails.registration', $data, function ($message) use ($user){

            $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

            $message->to($user->email)->subject('Portal user information update notification');

        });
        return redirect('users');
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


    public function forgotPassword(Request $requests)
    {
        $email=$requests->email;
        $username=$requests->username;
        $user =User::where('email', '=', $email)->where('username','=',$username)->get()->first();
        if(count($user) > 0)
        {
            $password='password'.rand(5, 15);
            $user->password=bcrypt($password);
            $user->save();
            //send email

            //Send email to registered user
            $data = array(
                'username' => $username,
                'password' =>$password,
                'name' =>   $string = ucwords(strtolower($user->first_name . " " . $user->last_name)) ,
            );

            \Mail::queue('emails.forgotpassword', $data, function ($message) use($user){

                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

                $message->to($user->email)->subject('Portal registration notification');

            });

            return redirect('login')->with('message', 'You have successful reset your password, new generated password was sent to your email');


        }else
        {
            return redirect('login')->with('message', 'Password reset failed, invalid email or username');
        }
    }

    //Register user
    public function registration()
    {
        $branches =Branch::all();
        return view('users.registration',compact('branches'));
    }

    //
    public function userRights()
    {
        $right =Right::all();
        return view('users.rights',compact('right'));
    }

    //User profile
    public function showProfile()
    {
        $user=User::find(Auth::user()->id);
        return view('users.profile',compact('user'));
    }

    //Process registration
    public function postRegister(UserRegistrationRequest $request)
    {
        //Create username
        $string = strtolower($request->first_name . "." . $request->last_name); //Combine first and last names
        $uname = preg_replace('/\s+/', '', $string); //Remove all empty space

        //Validate user
        $users = User::where('username', '=', $uname)->get();
        if (count($users) > 0) {

            return redirect()->back()->with('message', 'Registration failed, Another user is registered with the same details as yours, please contact ICT support to check your details and complete registration');

        } else {
            $us = new User;
            $us->first_name = ucwords($request->first_name);
            $us->last_name = ucwords($request->last_name);
            $us->designation = ucwords($request->designation);
            $us->phone = $request->phone;
            $us->branch_id = $request->branch;
            $us->department_id = $request->department;

            $us->password = bcrypt($request->Password);

            $us->username = $uname;
            //Create email
            $us->email = $uname . "@bankm.com"; //Combine first and last names

            //Assign user right
            $right=Right::where('is_default','=','No')->get();
            $rght=0;
            if(count($right) >0)
            {
               foreach($right as $r)
               {
                   $rght =$r->id;
               }
            }
            $us->right_id=$rght;
            $us->save();

            //Sent notifications to support team



            $data1 = array(
                'user' => $us,
            );

            \Mail::send('emails.newuser', $data1, function ($message) {

                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

                $message->to('support@bankm.com')->subject('User Registration Notification');

            });

            //Send email to registered user
            $data = array(
                'username' => $uname,
                'password' => $request->Password,
                'name' =>   $string = ucwords(strtolower($request->first_name . " " . $request->last_name)) ,
            );

            \Mail::send('emails.registration', $data, function ($message) use($us){

                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

                $message->to($us->email)->subject('Portal registration notification');

            });


            return redirect('login')->with('message', 'You have successful registered to Bank M service Portal,Your login access was sent to your email and request was sent to ICT for approval');

        }
    }

   //Process registration
    public function logout()
    {
        if (Auth::check())
        {
            $user= User::find(Auth::user()->id);
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
            if(Auth::user()->block ==1 || Auth::user()->status=="Inactive")
            {
                Auth::logout();
                return redirect()->back()->with('message', 'Login Failed you don\'t have Access to login please  Contact ICT Support at support@bankm.com');
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
    public function userQuery($id)
    {
        $user=User::find($id);
        return view('users.query',compact('user'));
    }

    public function postUserQuery(Request $request)
    {

        $usm=UserModules::where('user_id','=',$request->user_id)->delete(); //Remove all previous assigned

        if($request->module != null && $request->module !="")
        {
            foreach($request->module as $module)
            {
                $usmod=new UserModules;
                $usmod->user_id=$request->user_id;
                $usmod->module_id=$module;
                $usmod->input_by=Auth::user()->username;
                $usmod->save();
            }
        }

        return "Data saved successfully";
    }

    public function userPersonal($id)
    {
        $user=User::find($id);
        return view('users.personal',compact('user'));
    }

    public function postUserPersonal(Request $request)
    {
        $us=User::find($request->user_id);
        $us->first_name = ucwords($request->first_name);
        $us->last_name = ucwords($request->last_name);
        $us->designation = ucwords($request->designation);
        $us->phone = $request->phone;
        $us->input_by=Auth::user()->username;;
        $us->email = $request->email;
        $us->save();

        return "Data saved successfully";
    }
    public function userDepartment($id)
    {
        $user=User::find($id);
        return view('users.department',compact('user'));
    }

    public function postUserDepartment(Request $request)
    {
        $user=User::find($request->user_id);
        $user->branch_id=$request->branch;
        $user->department_id=$request->department;
        $user->save();

        return "Data saved successfully";
    }

    public function userPassword($id)
    {
        $user=User::find($id);
        return view('users.password',compact('user'));
    }

    public function postUserPassword(Request $request)
    {
        $user=User::find($request->user_id);
        $user->password=bcrypt($request->Password);
        $user->save();

        return "Data saved successfully";
    }

    public function changeUserRights($id)
    {
        $user=User::find($id);
        return view('users.rights',compact('user'));
    }

    public function postChangeUserRights(Request $request)
    {
        $user=User::find($request->user_id);
        $user->right_id=$request->right;
        $user->status=$request->status;
        $user->save();

        return "Data saved successfully";
    }

    public function changeUserExemption($id)
    {
        $user=User::find($id);
        return view('users.queryexemption',compact('user'));
    }

    public function postChangeUserExemption(Request $request)
    {
        $user=User::find($request->user_id);
        if($request->query_exemption != "No")
        {
            $user->query_exemption=$request->query_exemption;
            $user->exemption_type=ucwords(strtolower($request->exemption_type));
            $user->query_description=$request->query_description;
            $user->exemption_start_date=$request->exemption_start_date;
            $user->exemption_end_date=$request->exemption_end_date;
        }
        else
        {
            $user->query_exemption=$request->query_exemption;
            $user->exemption_type=null;
            $user->query_description=null;
            $user->exemption_start_date=null;
            $user->exemption_end_date=null;
        }
        $user->save();


        return "Data saved successfully";
    }


}
