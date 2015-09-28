@extends('layout.master')
@section('page-title')
    User Management
@stop
@section('page_scripts')
    {!!HTML::script("js/sparkline-chart.js") !!}
    {!!HTML::script("js/easy-pie-chart.js") !!}
    {!!HTML::script("js/count.js") !!}
    {!!HTML::script("js/jquery.tagsinput.js")!!}
    {!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
    {!!HTML::script("js/jquery.scrollTo.min.js") !!}
    {!!HTML::script("js/jquery.nicescroll.js") !!}
    {!!HTML::script("js/respond.min.js"  ) !!}
    <script type="text/javascript" charset="utf-8">


        //Edit class streams
        $(".queryModules").click(function(){
            var id1 = $(this).parent().parent().attr('id');
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;">User Query Module Assignment</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("users/query/") ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

        //Edit class streams
        $(".queryExemption").click(function(){
            var id1 = $(this).parent().parent().attr('id');
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;">User Query Exemption</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("users/exemption") ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        })

        //Personal detail
        $(".personalDetail").click(function(){
            var id1 = $(this).parent().parent().attr('id');
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> User Personal Details</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("users/personal") ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });
        //Department detail
        $(".changeDepartment").click(function(){
            var id1 = $(this).parent().parent().attr('id');
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> User Department Details</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("users/department") ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });
        //changePassword detail
        $(".changePassword").click(function(){
            var id1 = $(this).parent().parent().attr('id');
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> User Password Changes</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("users/password") ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

        //changePassword detail
        $(".changeRights").click(function(){
            var id1 = $(this).parent().parent().attr('id');
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> User Rights Details</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("users/rights") ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

    </script>

@stop
@section('menus')
    <ul class="sidebar-menu" id="nav-accordion">
        <li>
            <a class="active" href="{{url('home')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,1))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class=" fa fa-bar-chart-o"></i>
                <span>Reports</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="Report System/Service problem or issue">Daily Reports</a></li>
                <li><a  href="#" title="View today system status">Monthly Reports</a></li>
                <li><a  href="#" title="System/services History">Custom Reports</a></li>
                <li><a  href="#" title="Generate System/Service status report">Search Report</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-picture-o"></i>
                <span>Photo Galley</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">Upload Photos</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">List Albums</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,3))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-download"></i>
                <span>Downloads</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">ICT Department</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">Operation</a></li>
                <li><a  href="#" title="View today system status">Administration</a></li>
                <li><a  href="#" title="View today system status">Human Resource</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,4))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-info"></i>
                <span>Special Portals</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">COPS Issues Tracking</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">CMF Reports</a></li>
                <li><a  href="#" title="View today system status">Money Msafiri</a></li>
                <li><a  href="#" title="View today system status">Human Resource</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,5))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-folder-open-o"></i>
                <span>Queries and Tasks</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('queries/create')}}" title="System/services History">Log Query</a></li>
                <li><a  href="{{url('queries/mytask')}}" title="Report System/Service problem or issue">My Tasks</a></li>
                <li><a  href="{{url('queries/progress')}}" title="Report System/Service problem or issue">Query Progress</a></li>
                <li><a  href="{{url('queries/history')}}" title="Report System/Service problem or issue">Query History</a></li>
                <li><a  href="{{url('queries/report')}}" title="View today system status">Queries Reports</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,6))
          <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>Oracle Support Isssues</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('support/oracle/create')}}" title="Report System/Service problem or issue">New Issue</a></li>
                <li><a  href="{{url('support/oracle/opened')}}" title="Report System/Service problem or issue">Opened Issues</a></li>
                <li><a  href="{{url('support/oracle/closed')}}" title="View today system status">Closed Issues</a></li>
                <li><a  href="{{url('support/oracle/history')}}" title="System/services History">Issues History</a></li>
                 <li><a  href="{{url('support/oracle/report')}}" title="System/services History">Issues Report</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,7))
         <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>System service status</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('serviceslogs/create')}}" title="Report System/Service problem or issue">Log Status</a></li>
                <li><a  href="{{url('services')}}" title="Report System/Service problem or issue">Services</a></li>
                <li><a  href="{{url('serviceslogs/today')}}" title="View today system status">Today Status</a></li>
                <li><a  href="{{url('serviceslogs')}}" title="System/services History">Status History</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,8))
         <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>ICT Inventory</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('types')}}" title="Report System/Service problem or issue">Item types</a></li>
                <li><a  href="{{url('inventory')}}" title="Report System/Service problem or issue">Inventory Items</a></li>
                <li><a  href="{{url('inventory-reports')}}" title="View today system status">Inventory Reports</a></li>
            
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,9))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-cogs"></i>
                <span>Portal Administration</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('branches')}}">Branches</a></li>
                <li><a  href="{{url('departments')}}">Departments</a></li>
                <li><a  href="{{url('users')}}">Users</a></li>
                <li><a  href="{{url('user/rights')}}">Users Rights</a></li>
                <li><a  href="{{url('modules')}}">Query Modules</a></li>
            </ul>
        </li>
        @endif
    </ul>
    @stop
@section('contents')

    <section class="site-min-height">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa  fa-user"></i> USER PROFILE FOR <span class="text-danger">{{strtoupper($user->first_name.' '.$user->last_name)}} </span></strong></h3>
                    </header>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border" style="color:#005DAD">Personal details</legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required autocomplete=off @if(old('first_name') !="")value="{{old('first_name')}}" @else value="{{$user->first_name}}" @endif readonly>
                                        @if($errors->first('first_name'))
                                            <label for="first_name" class="error">{{$errors->first('first_name')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required autocomplete=off @if(old('last_name') !="")value="{{old('last_name')}}" @else value="{{$user->last_name}}" @endif readonly>
                                        @if($errors->first('last_name'))
                                            <label for="first_name" class="error">{{$errors->first('last_name')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middle_name">Other Name</label>
                                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name" @if(old('middle_name') !="")value="{{old('middle_name')}}" @else value="{{$user->middle_name}}" @endif readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation " name="designation" placeholder="Enter Designation" required @if(old('designation') !="")value="{{old('designation')}}" @else value="{{$user->designation}}" @endif readonly>
                                @if($errors->first('designation'))
                                    <label for="first_name" class="error">{{$errors->first('designation')}}</label>
                                @endif
                                <p class="help-block">Please enter full details of your designation, do not enter abbreviation.</p>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="phone">Mobile Number</label>
                                        <input type="text" class="form-control"  id="phone" name="phone" placeholder="Enter Mobile Number" autocomplete=off @if(old('phone') !="") value="{{old('phone')}}" @else value="{{$user->phone}} "@endif readonly>
                                        @if($errors->first('phone'))
                                            <label for="first_name" class="error">{{$errors->first('phone')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <label for="email">E-Mail</label>
                                        <input type="email" class="form-control"  id="email" name="email" placeholder="Enter email address" autocomplete=off @if(old('email') !="") value="{{old('email')}}" @else value="{{$user->email}}" @endif readonly>
                                        @if($errors->first('email'))
                                            <label for="first_name" class="error">{{$errors->first('email')}}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            </fieldset>

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border" style="color:#005DAD">Department details</legend>
                                <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="branchusr">Branch</label>
                                        <select class="form-control"  id="branchusr" name="branchusr" disabled>
                                            <?php $branches=\App\Branch::all();?>

                                            @if(old('branch') !="")
                                                <?php $branchd=\App\Branch::find(old('branch'));?>
                                                <option value="{{$branchd->id}}" selected>{{$branchd->branch_Name}}</option>
                                            @else
                                                <?php $branchd=\App\Branch::find($user->branch_id);?>
                                                <option value="{{$branchd->id}}" selected>{{$branchd->branch_Name}}</option>
                                            @endif
                                            <?php $branches=\App\Branch::all();?>
                                            @foreach($branches as $br)
                                                <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->first('branchusr'))
                                            <label for="branchusr" class="error">{{$errors->first('branchusr')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="departmentUsr">Department</label>
                                        <select class="form-control"  id="departmentUsr" name="departmentUsr" disabled>
                                            @if(old('branch') !="")
                                                <?php $depart=\App\Department::find(old('department'));?>
                                                <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
                                            @else
                                                <?php $depart=\App\Department::find($user->department_id);?>
                                                <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
                                            @endif
                                        </select>
                                        @if($errors->first('departmentUsr'))
                                            <label for="department" class="error">{{$errors->first('departmentUsr')}}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            </fieldset>

                        <fieldset class="scheduler-border" style="margin-top: 10px;">
                            <legend class="scheduler-border" style="color:#005DAD">Login Details</legend>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username " name="username" placeholder="Enter Username" required @if(old('username') !="")value="{{old('username')}}" @else value="{{$user->username}}" @endif readonly>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="Password">Password</label>
                                        <input type="password" class="form-control"  id="Password" name="Password" placeholder="Enter Password" readonly value="*********************">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="Password">Confirm Password</label>
                                        <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" readonly value="*********************">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="scheduler-border" style="margin-top: 10px;">
                            <legend class="scheduler-border" style="color:#005DAD">User Access Rights</legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="right">User Access Level</label>
                                        <select name="right" class="form-control" id="right" disabled>

                                            @if(old('right') !="")
                                                <?php $right=\App\Right::find(old('department'));?>
                                                <option value="{{$right->id}}" selected>{{$right->right_name}}</option>
                                            @else
                                                <?php $right=\App\Right::find($user->department_id);?>
                                                <option value="{{$right->id}}" selected>{{$right->right_name}}</option>
                                            @endif
                                            <?php
                                            $rights=\App\Right::where('status','=','enabled')->get(); //Get all user rights
                                            ?>
                                            @foreach($rights as $right)
                                                <option value="{{$right->id}}">{{$right->right_name}}</option>
                                            @endforeach
                                            <option value="Active">Active</option>
                                        </select>
                                        @if($errors->first('right'))
                                            <label for="right" class="error">{{$errors->first('right')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status" disabled>
                                            @if(old('status') !="")

                                                <option value="{{old('status')}}" selected>{{old('status')}}</option>
                                            @else
                                                <option value="{{$user->status}}" selected>{{$user->status}}</option>
                                            @endif
                                            <option value="Inactive">Inactive</option>
                                            <option value="Active">Active</option>
                                        </select>
                                        @if($errors->first('status'))
                                            <label for="status" class="error">{{$errors->first('status')}}</label>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </fieldset>


                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('users/create')}}" class="btn btn-compose btn-block">Create New users</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('users')}}" class="btn btn-compose  btn-block">List users</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('users/reports')}}" class="btn btn-compose btn-block">users Reports</a>
                            </div>
                        </div>
                        <hr/>
                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                            <div class="col-md-12">
                                <a href="#" class="personalDetail btn btn-primary btn-block"><i class="fa  fa-user"></i> Personal Details</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                            <div class="col-md-12">
                                <a href="#" class="changeDepartment btn btn-primary btn-block"><i class="fa fa-building-o"></i> Change Department</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                            <div class="col-md-12">
                                <a href="#" class="changePassword btn btn-primary btn-block"><i class="fa fa-asterisk"></i><i class="fa  fa-asterisk"></i> Change Password</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                            <div class="col-md-12">
                                <a href="#" class="changeRights btn btn-primary btn-block"><i class="fa fa-gavel"></i> Access Right</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                            <div class="col-md-12">
                                <a href="#" class="queryModules btn btn-primary btn-block"><i class="fa fa-pencil"></i> Query Module Assignment</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                            <div class="col-md-12">
                                <a href="#" class="queryExemption btn btn-primary btn-block"><i class="fa fa-cog"></i> Query Exemption</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop