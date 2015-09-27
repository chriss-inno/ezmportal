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
    {!!HTML::script("js/jquery.validate.min.js" ) !!}
    {!!HTML::script("js/respond.min.js"  ) !!}
    {!!HTML::script("js/form-validation-script.js") !!}

    <script type="text/javascript" charset="utf-8">
        //Edit class streams
        $(".addBranch").click(function(){
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="text-align: center">Update School Class Level</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("branches/create") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });

        $("#branch").change(function () {
            var id1 = this.value;
            if(id1 != "")
            {
                $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                    $("#department").html(data);
                });

            }else{$("#department").html("<option value=''>----</option>");}
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
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-picture-o"></i>
                <span>Photo Galley</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">Upload Photos</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">List Albums</a></li>
                <li><a  href="#" title="View today system status">Manage Albums</a></li>
            </ul>
        </li>
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
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-cogs"></i>
                <span>Portal Administration</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('branches')}}">Branches</a></li>
                <li><a  href="{{url('departments')}}">Departments</a></li>
                <li><a  href="{{url('users')}}">Users</a></li>
                <li><a  href="{{url('users/rights')}}">Users Rights</a></li>
                <li><a  href="{{url('modules')}}">Query Modules</a></li>
            </ul>
        </li>
    </ul>
@stop
@section('contents')

    <section class="site-min-height">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa  fa-user"></i> USER DETAILS FOR <span class="text-danger">{{strtoupper($user->first_name.' '.$user->last_name)}} </span></strong></h3>
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

                        {!! Form::open(array('url'=>'users/edit','role'=>'form','id'=>'adminUserform')) !!}
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border" style="color:#005DAD">Personal details</legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required autocomplete=off @if(old('first_name') !="")value="{{old('first_name')}}" @else value="{{$user->first_name}}" @endif>
                                        @if($errors->first('first_name'))
                                            <label for="first_name" class="error">{{$errors->first('first_name')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required autocomplete=off @if(old('last_name') !="")value="{{old('last_name')}}" @else value="{{$user->last_name}}" @endif>
                                        @if($errors->first('last_name'))
                                            <label for="first_name" class="error">{{$errors->first('last_name')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middle_name">Other Name</label>
                                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name" @if(old('middle_name') !="")value="{{old('middle_name')}}" @else value="{{$user->middle_name}}" @endif>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation " name="designation" placeholder="Enter Designation" required @if(old('designation') !="")value="{{old('designation')}}" @else value="{{$user->designation}}" @endif>
                                @if($errors->first('designation'))
                                    <label for="first_name" class="error">{{$errors->first('designation')}}</label>
                                @endif
                                <p class="help-block">Please enter full details of your designation, do not enter abbreviation.</p>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="phone">Mobile Number</label>
                                        <input type="text" class="form-control"  id="phone" name="phone" placeholder="Enter Mobile Number" autocomplete=off @if(old('phone') !="") value="{{old('phone')}}" @else value="{{$user->phone}} "@endif>
                                        @if($errors->first('phone'))
                                            <label for="first_name" class="error">{{$errors->first('phone')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <label for="email">E-Mail</label>
                                        <input type="email" class="form-control"  id="email" name="email" placeholder="Enter email address" autocomplete=off @if(old('email') !="") value="{{old('email')}}" @else value="{{$user->email}}" @endif>
                                        @if($errors->first('email'))
                                            <label for="first_name" class="error">{{$errors->first('email')}}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="branch">Branch</label>
                                        <select class="form-control"  id="branch" name="branch">
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
                                        @if($errors->first('branch'))
                                            <label for="branch" class="error">{{$errors->first('branch')}}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="department">Department</label>
                                        <select class="form-control"  id="department" name="department">
                                            @if(old('branch') !="")
                                                <?php $depart=\App\Department::find(old('department'));?>
                                                <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
                                            @else
                                                <?php $depart=\App\Department::find($user->department_id);?>
                                                <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
                                            @endif
                                        </select>
                                        @if($errors->first('department'))
                                            <label for="department" class="error">{{$errors->first('department')}}</label>
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
                                        <input type="password" class="form-control"  id="Password" name="Password" placeholder="Enter Password" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="Password">Confirm Password</label>
                                        <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" >
                                    </div>
                                </div>
                                <p class="help-block"><input type="checkbox" value="changepass" name="changePass" id="changePass" >Please tick here if you want to change password.</p>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border" style="margin-top: 10px;">
                            <legend class="scheduler-border" style="color:#005DAD">User Access Rights</legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="right">User Access Level</label>
                                        <select name="right" class="form-control" id="right">

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
                                        <select name="status" class="form-control" id="status">
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
                        <div class="row">
                            <div class="col-md-2 pull-right">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
            <div class="col-lg-2 col-md-2">
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
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop