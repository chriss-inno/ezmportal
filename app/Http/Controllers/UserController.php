<?php

namespace App\Http\Controllers;

use App\Department;
use App\Unit;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
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

    //
    public function diabledUsers()
    {
        //
        $users=User::where('status','=','Inactive')->orderBy('first_name','ASC')->get();
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



    //User Migration


    public function showUserImport()
    {
        //
        return view('users.importusers');
    }
   public function postUserImport(Request $request)
   {
       $file= $request->file('inventory_file');
       $destinationPath = public_path() .'/uploads/temp/';
       $filename   = str_replace(' ', '_', $file->getClientOriginalName());

       $file->move($destinationPath, $filename);

       Excel::load($destinationPath . $filename, function ($reader) {

           $results = $reader->get();
           $results->each(function($row) {

               $string = strtolower($row->first_name . "." . $row->last_name); //Combine first and last names
               $uname = preg_replace('/\s+/', '', $string); //Remove all empty space
               $users = User::where('username', '=', $uname)->get();

               if (!count($users) > 0) {


                   $us = new User;
                   $us->first_name = ucwords($row->first_name);
                   $us->last_name = ucwords($row->last_name);
                   $us->designation = ucwords($row->designation);


                   if($row->phone != "")
                   {
                       $usersph = User::where('phone', '=', $row->phone)->get();
                       if(!count($usersph) >0)
                       {
                           $us->phone = $row->phone;
                       }
                   }

                   $branch = Branch::where('branch_Name', '=', $row->branch)->get()->first();
                   if (count($branch) > 0) {
                       $us->branch_id = $branch->id;
                   }
                   $dep = Department::where('department_name', '=', $row->department)->get()->first();

                   $unit = Unit::where('unit_name', '=', $row->department)->get()->first();
                   if (count($unit) > 0) {
                       $us->unit_id = $unit->id;
                       $us->department_id = $unit->department->id;
                   } elseif (count($dep) > 0) {
                       $us->department_id = $dep->id;
                   }

                   $us->old_password= $row->old_password;
                   if($row->active_password != null && $row->active_password != "")
                   {
                       $us->password = bcrypt($row->active_password);
                       $us->old_password_startus="Migrated";
                   }
                   else
                   {
                       $us->old_password_startus="Not Migrated";
                   }


                   $us->username = $uname;
                   //Create email

                   if($row->email != "")
                   {
                       $usersem = User::where('email', '=', $row->email)->get();
                       if(count($usersem) > 0)
                       {
                           $us->email = $uname."@bankm.com"; //Combine first and last names
                       }
                       else
                       {
                           $us->email = $row->email;
                       }
                   }
                   else
                   {
                       $us->email = $uname."@bankm.com"; //Combine first and last names
                   }

                   //Assign user right
                   $right = Right::where('is_default', '=', 'Yes')->get();
                   $rght = 0;
                   if (count($right) > 0) {
                       foreach ($right as $r) {
                           $rght = $r->id;
                       }
                   }
                   $us->right_id = $rght;
                   $us->status = "Active";
                   $us->save();
               }

       });

        });

       File::delete($destinationPath . $filename); //Delete after upload
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
        $branches =Branch::where('status','=','enabled')->get();
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

            if($request->unit != "")
            {
                $us->unit_id = $request->unit;
            }
            $us->password = bcrypt($request->Password);

            $us->username = $uname;
            //Create email
            $us->email = $uname . "@bankm.com"; //Combine first and last names

            //Assign user right
            $right=Right::where('is_default','=','Yes')->get();
            $rght=0;
            if(count($right) >0)
            {
               foreach($right as $r)
               {
                   $rght =$r->id;
               }
            }
            $us->right_id=$rght;
            $us->status="Inactive";
            $us->save();

            //Sent notifications to support team



            $data1 = array(
                'user' => serialize($us),
            );

            \Mail::queue('emails.newuser', $data1, function ($message) {

                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

                $message->to('support@bankm.com')->subject('Bank M Services Portal: New User Registration Notification');

            });

            //Send email to registered user
            $data = array(
                'user' => serialize($us),
                'password' => $request->Password
            );

            \Mail::queue('emails.registration', $data, function ($message) use($us){

                $message->from('bankmportal@bankm.com', 'Bank M PLC Support portal');

                $message->to($us->email)->subject('Bank M Services Portal: User registration notification');

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

            //Audit log
            \App\Http\Controllers\AuditController::auditLog("Successful logged out","User");
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

                //Audit log
                \App\Http\Controllers\AuditController::auditLog("Successifuly logged in","User");
                return redirect()->intended('home');
            }

        }
        else
        {
            $md5_pass=md5($password);

            //Check for migrations old users
            $oldusr=User::where('username','=',$username)->where('old_password','=',$md5_pass)->get()->first();
            if(count($oldusr) >0)
            {
                //Migrate password
                $oldusr->password = bcrypt($password);
                $oldusr->old_password_startus="Migrated";
                $oldusr->old_password="";
                $oldusr->save();

                //Authenticate user
                if (Auth::attempt(['username' => $username, 'password' => $password])) {
                    if (Auth::user()->block == 1 || Auth::user()->status == "Inactive") {
                        Auth::logout();
                        return redirect()->back()->with('message', 'Login Failed you don\'t have Access to login please  Contact ICT Support at support@bankm.com');
                    } else {
                        $user = User::find(Auth::user()->id);
                        $user->last_success_login = date("Y-m-d h:i:s");
                        $user->last_login = date("Y-m-d h:i:s");
                        $user->save();

                        //Audit log
                        \App\Http\Controllers\AuditController::auditLog("Successifuly logged in", "User");
                        return redirect()->intended('home');
                    }
                }
                else {
                    return redirect()->back()->with('message', 'Login Failed,Invalid username or password');
                }
            }
            else {
                return redirect()->back()->with('message', 'Login Failed,Invalid username or password');
            }
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

    //Show user personal details
    public function userPersonalDetails($id)
    {
        $user=User::find($id);
        return view('users.userdetails',compact('user'));
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
    public function userUnit($id)
    {
        $user=User::find($id);
        return view('users.unit',compact('user'));
    }

    public function postUserUnit(Request $request)
    {
        $user=User::find($request->user_id);
        $user->branch_id=$request->branch;
        $user->department_id=$request->department;
        $user->unit_id=$request->unit;
        $user->save();
        //Audit log
        $auditMsg="Changed user department for ".$user->username. " current department ".$user->department->department_name;
        \App\Http\Controllers\AuditController::auditLog($auditMsg,"User");

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

        //Audit log
        $auditMsg="Changed user department for ".$user->username. " current department ".$user->department->department_name;
        \App\Http\Controllers\AuditController::auditLog($auditMsg,"User");

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
        $user->password=bcrypt($request->userpass);
        $user->save();

        //Audit log
        $auditMsg="Changed password for ".$user->username. " with status ".$user->status;
        \App\Http\Controllers\AuditController::auditLog($auditMsg,"User");

        return "Password changed successfully";
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

        //Audit log
        $auditMsg="Changed user right for ".$user->username. " with status ".$request->status;
        \App\Http\Controllers\AuditController::auditLog($auditMsg,"User");

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

        //Audit log
        $auditMsg="Changed user query exemption for ".$user->username. " with exception status ".$user->exemption_type;
        \App\Http\Controllers\AuditController::auditLog($auditMsg,"User");

        return "Data saved successfully";
    }


}
