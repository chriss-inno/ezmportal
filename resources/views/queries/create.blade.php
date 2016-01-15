@extends('layout.master')
@section('page-title')
    Queries
    @stop
    @section('page_style')

    {!!HTML::style("assets/bootstrap-datepicker/css/datepicker.css" )!!}
    {!!HTML::style("assets/bootstrap-colorpicker/css/colorpicker.css" )!!}
    {!!HTML::style("assets/bootstrap-daterangepicker/daterangepicker.css" )!!}
    <link href="{{asset("assets/jquery-file-upload/css/jquery.fileupload-ui.css")}}" rel="stylesheet" type="text/css" >

    @stop
    @section('page_scripts')
            <!-- js placed at the end of the document so the pages load faster -->


    <!--custom tagsinput-->
    {!!HTML::script("js/jquery.tagsinput.js") !!}
            <!--custom checkbox & radio-->
    {!!HTML::script("js/ga.js") !!}
    {!!HTML::script("assets/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/date.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/daterangepicker.js") !!}
    {!!HTML::script("assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js") !!}
    {!!HTML::script("assets/ckeditor/ckeditor.js") !!}
    {!!HTML::script("js/jquery.validate.min.js" ) !!}
    {!!HTML::script("js/respond.min.js"  ) !!}
    {!!HTML::script("js/form-validation-script.js") !!}
    <script type="text/javascript" charset="utf-8">

        $("#to_department").change(function () {
            var id1 = this.value;
            if(id1 != "")
            {
                $.get("<?php echo url('getModules') ?>/"+id1,function(data){
                    $("#module").html(data);
                });

            }else{$("#module").html("<option value=''>----</option>");}
        });

        $("#serviceForm").validate({
            rules: {
                to_department: "required",
                description: "required",
                module: "required",
                critical_level: "required"
            },
            messages: {
                to_department: "Please select department",
                description: "Please enter description",
                module: "Please select module",
                critical_level: "Please select critical level"
            }
        });

    </script>


@stop
@section('menus')
    <?php  $system=\App\SystemSetup::all()->first();?>
    <ul class="sidebar-menu" id="nav-accordion">
        <li>
            <a class="active" href="{{url('home')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,1) || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Reports</span>
                </a> <ul class="sub">
                    <li><a  href="{{url('portal/reports/daily')}}" title="Daily Reports">Daily Reports</a></li>
                    <li><a  href="{{url('portal/reports/monthly')}}" title="Monthly Reports">Monthly Reports</a></li>
                    <li><a  href="{{url('portal/reports/custom')}}" title="Custom Reports">Custom Reports</a></li>
                    <li><a  href="{{url('portal/reports/search')}}" title="Search Report">Search Report</a></li>
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2)  || Auth::user()->user_type=="Administrator")
                        <li><a  href="{{url('portal/reports')}}" title="Manage Reports">Manage Reports</a></li>
                        <li><a  href="{{url('portal/reports/assignment')}}" title="Manage Reports" > Reports Assignment </a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,3)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-picture-o"></i>
                    <span>Photo Gallery</span>
                </a>
                <ul class="sub">
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,4)  || Auth::user()->user_type=="Administrator")
                        <li><a  href="#" title="Manage Gallery">Manage Gallery </a></li>
                    @endif
                    <li><a  href="#" title="List Albums">List Albums</a></li>
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,5)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-download"></i>
                    <span>Downloads</span>
                </a>
                <ul class="sub">
                    @foreach(\App\Department::where('download_check','=','Yes')->get() as $depart )
                        <li><a  href="{{url('downloads/department')}}/{{$depart->id}}" title="Download for {{$depart->department_name}}">{{$depart->department_name}}</a></li>
                    @endforeach
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,6)  || Auth::user()->user_type=="Administrator")
                        <li><a  href="{{url('downloads/manage')}}" title="Manage Downloads">Manage Downloads</a></li>
                    @endif
                </ul>
            </li>@endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,23)  || Auth::user()->user_type=="Administrator")<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-laptop"></i>
                    <span>SMS To Customers</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('sms/messages')}}" title="Messages">Messages</a></li>
                    <li   ><a  href="{{url('sms/customers')}}" title="Customers">Customers</a></li>
                    <li><a  href="{{url('sms/dispatch')}}" title="Dispatch Group">Dispatch Group</a></li>
                    <li><a  href="{{url('sms/reports')}}" title="SMS Reports">Report</a></li>

                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,7)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-info"></i>
                    <span>Service Delivery</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('servicedelivery')}}" >Customer Issues Tracking</a></li>
                    <li><a  href="{{url('servicedelivery/customers')}}" >Customers</a></li>
                    <li ><a  href="{{url('servicedelivery/settings')}}" > Settings</a></li>
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,22) || Auth::user()->user_type=="Administrator") <li ><a  href="{{url('servicedelivery/email')}}" >Email Settings</a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,8)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-info"></i>
                    <span>Money Msafiri</span>
                </a>
                <ul class="sub">

                    <li><a  @if($system != null && count($system) > 0 && $system->mm_link_1 != null && $system->mm_link_1 !="") href="{{$system->mm_link_1}}" @else href="#" @endif  title="Money Msafiri System" target="_blank">Money Msafiri System</a></li>
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,9)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-info"></i><span>Treasury</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('forex/dealslip')}}" title="Money Msafiri System">Forex Deal Slip</a></li>
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,10)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-info"></i>
                    <span>Credit</span>
                </a>
                <ul class="sub">

                    <li><a  @if($system != null && count($system) > 0 && $system->credit_link_1 != null && $system->credit_link_1 !="") href="{{$system->credit_link_1}}" @else href="#" @endif title="Credit Request" TARGET="_blank">Credit Request</a></li>
                    <li><a  @if($system != null && count($system) > 0 && $system->credit_link_2 != null && $system->credit_link_2 !="") href="{{$system->credit_link_2}}" @else href="#" @endif title="CA Portal" target="_blank">CA Portal</a></li>
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,11)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-user"></i>
                    <span>Human Resource</span>
                </a>
                <ul class="sub">
                    <li><a   @if($system != null && count($system) > 0 && $system->hr_link_1 != null && $system->hr_link_1 !="") href="{{$system->hr_link_1}}" @else href="#" @endif title="HR Portal" TARGET="_blank">HR Portal</a></li>

                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,12)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-user"></i>
                    <span>COP'S</span>
                </a>
                <ul class="sub">
                    <li><a  href="#" title="Tracker">Tracker</a></li>

                </ul>
            </li>
        @endif

        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,13) || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" class="active" >
                    <i class="fa fa-folder-open-o"></i>
                    <span>Support Queries</span>
                </a>
                <ul class="sub">
                    <li class="active"><a  href="{{url('queries/create')}}" title="Log Query">Log Query</a></li>
                    <li><a  href="{{url('queries/mytask')}}" title="My Tasks">My Tasks</a></li>
                    <li><a  href="{{url('queries/progress')}}" title="Query Progress">Query Progress</a></li>
                    <li><a  href="{{url('queries/history')}}" title="Query History">Query History</a></li>
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
                        <li><a  href="{{url('queries/report')}}" title="Queries Reports">Queries Reports</a></li>
                    @endif
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,15) || Auth::user()->user_type=="Administrator")
                        <li><a  href="{{url('queries/assign')}}" title="Queries Assign">Queries Assign</a></li>
                    @endif
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,21))
                        <li><a  href="{{url('queryemails')}}" title="Queries Emails">Queries Emails Setup</a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,16)  || Auth::user()->user_type=="Administrator")
             <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-bell"></i>
                    <span>Reminder</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('reminders/create')}}" title="Create Reminder">Create Reminder</a></li>
                    <li><a  href="{{url('reminders')}}" title="Reminder List">Reminder List</a></li>

                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,17)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-laptop"></i><span>Oracle Support Issues</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('support/oracle/create')}}" title="New Issue">New Issue</a></li>
                    <li><a  href="{{url('support/oracle/opened')}}" title="Opened Issues">Opened Issues</a></li>
                    <li><a  href="{{url('support/oracle/closed')}}" title="Closed Issues">Closed Issues</a></li>
                    <li><a  href="{{url('support/oracle/history')}}" title="Issues History">Issues History</a></li>
                    <li><a  href="{{url('support/oracle/report')}}" title="Issues Report">Issues Report</a></li>
                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,18)  || Auth::user()->user_type=="Administrator") <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>Services monitoring</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('serviceslogs/create')}}" title="Log Status">Log downtime</a></li>
                <li><a  href="{{url('services')}}" title="Services">List services </a></li>
                <li><a  href="{{url('serviceslogs/today')}}" title="View today status">Today Status</a></li>
                <li><a  href="{{url('serviceslogs')}}" title="Status History">Downtime History</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,19) || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-laptop"></i>
                    <span>ICT Inventory</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('types')}}" title="Item types">Item types</a></li>
                    <li><a  href="{{url('inventory')}}" title="Inventory Items">Inventory Items</a></li>
                    <li><a  href="{{url('inventory-reports')}}" title="Inventory Reports">Inventory Reports</a></li>

                </ul>
            </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,20) || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-cogs"></i>
                    <span>Portal Administration</span>
                </a>
                <ul class="sub">
                    <li class="sub-menu">
                        <a  href="#">Branches</a>
                        <ul class="sub">
                            <li><a  href="{{url('branches')}}">Branches</a></li>
                            <li><a  href="{{url('departments')}}">Departments</a></li>
                            <li><a  href="{{url('units')}}">Units</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a  href="#">Users Management</a>
                        <ul class="sub">
                            <li><a  href="{{url('users')}}">Users</a></li>
                            <li><a  href="{{url('user/rights')}}">Users Rights</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a  href="#">Queries Module</a>
                        <ul class="sub">
                            <li><a  href="{{url('modules')}}">Query Modules</a></li>
                            <li><a  href="{{url('enablers')}}">Query Enablers</a></li>
                            <li><a  href="{{url('queriesstatus')}}">Query Status</a></li>
                        </ul>
                    </li>
                    <li><a  href="{{url('systemsetups')}}">System Settings</a></li>
                </ul>
            </li>
        @endif
    </ul>
@stop
@section('contents')
    <section class="site-min-height">
        <!-- page start-->

                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong> <i class="fa fa-smile"></i> SERVICE PORTAL QUERIES</strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group btn-group-justified">
                                    <a href="{{url('queries/create')}}" class=" btn  btn-primary"><i class="fa fa-folder-open-o"></i> Log New Query</a>

                                    <a href="{{url('queries/mytask')}}" class="btn btn-file btn-primary"><i class="fa fa-tasks"></i> My Tasks</a>
                                    <a href="{{url('queries/progress')}}" class="btn btn-file btn-primary"><i class="fa fa-archive"></i> Logged Queries Progress</a>
                                    <a href="{{url('queries/assigned/progress')}}" class="btn btn-file btn-primary"><i class="fa fa-archive"></i> Received Queries Progress</a>
                                    <a href="{{url('queries/history')}}" class="btn btn-file btn-primary"> <i class="fa fa-bars"></i> History</a>
                                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
                                        <a href="{{url('queries/report')}}" class="btn btn-file btn-primary"><i class=" fa fa-bar-chart-o"></i> Reports</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p> <h3>Query details </h3>
                        @if(Session::has('message'))
                            <div class="alert fade in alert-danger">
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                {{Session::get('message')}}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <hr/>
                        {!! Form::open(array('url'=>'queries/create','role'=>'form','id'=>'serviceForm','files' => true)) !!}
                        <div class="form-group">
                            <label for="to_department">To Department</label>
                            <select class="form-control"  id="to_department" name="to_department">
                                @if(old('to_department'))
                                    <?php $depa=\App\Department::find(old('to_department'));?>
                                    <option value="{{$depa->id}}">{{$depa->department_name}}</option>
                                @else
                                    <option value="">----</option>
                                @endif
                                <?php $departments=\App\Department::where('receive_query','=','1')->get();?>
                                @foreach($departments as $de)
                                    <option value="{{$de->id}}">{{$de->department_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="module">Module</label>
                                    <select class="form-control"  id="module" name="module">
                                        @if(old('module'))
                                            <?php $module=\App\Module::find(old('module'))?>
                                            <option value="{{$module->id}}">{{$module->module_name}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="critical_level">Critical Level</label>
                                    <select class="form-control"  id="critical_level" name="critical_level">
                                        @if(old('critical_level'))
                                            <option value="{{old('critical_level')}}">{{old('critical_level')}}</option>
                                            @else
                                            <option value="">----</option>
                                            @endif

                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                        <option value="Emergency">Emergency</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="unit_name">Description</label>
                            <textarea class="ckeditor form-control" id="description" name="description">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <span class="btn green fileinput-button">
                               <i class="fa fa-plus fa fa-white"></i>
                                 <span >Click here to select attachment (if any)</span>
                                  <input type="file" id="reference_file" name="reference_file">
                            </span>
                            <p class="help-block"><input type="checkbox" value="1" id="referencecheck" name="referencecheck"  @if(old('referencecheck')) checked @endif> <label for="file_upload" class="text-danger">Tick here for your attachment to be uploaded</label></p>
                        </div>

                            <button type="submit" class="btn btn-primary pull-right col-md-2">Submit Query</button>
                            {!! Form::close() !!}

                    </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop