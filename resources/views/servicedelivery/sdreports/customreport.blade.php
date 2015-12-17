@extends('layout.master')
@section('page-title')
    Service delivery custom report
    @stop
    @section('page_style')

            <!-- Bootstrap core CSS -->
    {!!HTML::style("css/bootstrap.min.css" )!!}
    {!!HTML::style("css/bootstrap-reset.css")!!}
            <!--external css-->
    {!!HTML::style("assets/font-awesome/css/font-awesome.css" )!!}

    {!!HTML::style("assets/bootstrap-fileupload/bootstrap-fileupload.css" )!!}
    {!!HTML::style("assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" )!!}
    {!!HTML::style("assets/bootstrap-datepicker/css/datepicker.css" )!!}
    {!!HTML::style("assets/bootstrap-timepicker/compiled/timepicker.css" )!!}
    {!!HTML::style("assets/bootstrap-colorpicker/css/colorpicker.css" )!!}
    {!!HTML::style("assets/bootstrap-daterangepicker/daterangepicker-bs3.css" )!!}
    {!!HTML::style("assets/bootstrap-datetimepicker/css/datetimepicker.css" )!!}
    {!!HTML::style("assets/jquery-multi-select/css/multi-select.css")!!}


            <!-- Custom styles for this template -->
    {!!HTML::style("css/style.css" )!!}
    {!!HTML::style("css/style-responsive.css" )!!}

@stop
@section('page_scripts')
    <script class="include" type="text/javascript" src={{ asset("js/jquery.dcjqaccordion.2.7.js")}} ></script>

    {!!HTML::script("js/jquery.scrollTo.min.js") !!}
    {!!HTML::script("js/jquery.nicescroll.js") !!}
    {!!HTML::script("js/respond.min.js" ) !!}

            <!--this page plugins-->

    {!!HTML::script("assets/fuelux/js/spinner.min.js") !!}
    {!!HTML::script("assets/bootstrap-fileupload/bootstrap-fileupload.js") !!}
    {!!HTML::script("assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js") !!}
    {!!HTML::script("assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js") !!}
    {!!HTML::script("assets/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
    {!!HTML::script("assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/moment.min.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/daterangepicker.js") !!}
    {!!HTML::script("assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js") !!}
    {!!HTML::script("assets/bootstrap-timepicker/js/bootstrap-timepicker.js") !!}
    {!!HTML::script("assets/ckeditor/ckeditor.js") !!}
    {!!HTML::script("js/jquery.validate.min.js" ) !!}
    {!!HTML::script("js/form-validation-script.js") !!}
    {!!HTML::script("assets/jquery-multi-select/js/jquery.multi-select.js") !!}
    {!!HTML::script("assets/jquery-multi-select/js/jquery.quicksearch.js") !!}

            <!--common script for all pages-->
    {!!HTML::script("js/common-scripts.js") !!}
            <!--this page  script only-->
    {!!HTML::script("js/advanced-form-components.js") !!}


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
                <a href="javascript:;"class="active" >
                    <i class="fa fa-info"></i>
                    <span>Service Delivery</span>
                </a>
                <ul class="sub">
                    <li class="active"><a  href="{{url('servicedelivery')}}" >Customer Issues Tracking</a></li>
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
                    <li><a  href="#" title="Money Msafiri System">Forex Deal Slip</a></li>
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
                <a href="javascript:;"  >
                    <i class="fa fa-folder-open-o"></i>
                    <span>Support Queries</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('queries/create')}}" title="Log Query">Log Query</a></li>
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
                <a href="javascript:;" >
                    <i class="fa fa-laptop"></i>
                    <span>Reminder</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('support/oracle/create')}}" title="Create Reminder">Create Reminder</a></li>
                    <li><a  href="{{url('support/oracle/opened')}}" title="Reminder List">Reminder List</a></li>

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
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h3 class="text-info"> <strong> <i class="fa fa-pie-chart"></i> CUSTOMER ISSUES  CUSTOM REPORTS</strong></h3>
                            </header>
                            <div class="panel-body">
                                {!! Form::open(array('url'=>'servicedelivery/report/custom','role'=>'form','id'=>'querySearchForm')) !!}
                                    <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border" style="color:#005DAD">Search criteria</legend>
                                            <div class="form-group">

                                                @if(Session::has('error'))
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="alert fade in alert-danger">
                                                                <i class="icon-remove close" data-dismiss="alert"></i>
                                                                {{Session::get('error')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <label for="department_id">Department Responsible</label>
                                                        <select name="department_id" class="form-control" id="department_id">
                                                            <option selected value="">---</option>
                                                            <?php $depatments=\App\Department::all();?>
                                                            @foreach($depatments as $rc)
                                                                <option value="{{$rc->department_name}}">{{$rc->department_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <label for="status_id">Status</label>
                                                        <select name="status_id" class="form-control" id="status_id">
                                                            <option selected value="">---</option>
                                                            <?php $sdstatus=\App\SDStatus::all();?>
                                                            @foreach($sdstatus as $rc)
                                                                <option value="{{$rc->id}}">{{$rc->status_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border" style="color:#005DAD">Date range</legend>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                               <label for="start_time">Date From</label>
                                                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{date("d-m-Y")}}" class="input-append date dpYears">
                                                                    <input type="text" readonly="" value="" size="16" class="form-control" id="start_time" name="start_time">
                                                                      <span class="input-group-btn add-on">
                                                                        <button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
                                                                      </span>
                                                                </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                               <label for="end_time">Date To</label>
                                                                <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{date("d-m-Y")}}" class="input-append date dpYears">
                                                                    <input type="text" readonly="" value="" size="16" class="form-control" id="end_time" name="end_time">
                                                                      <span class="input-group-btn add-on">
                                                                        <button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
                                                                      </span>
                                                                </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row" style="margin-top: 20px">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                                        <button class="btn btn-primary btn-block" > <i class="fa fa-download"></i> Generate Report</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </section>
                    </div>
                 </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <div class="row">
                    <section class="panel">
                        <div class="panel-body">

                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('servicedelivery')}}" class=" btn btn-file btn-danger btn-block"><i class="fa fa-tasks"></i> Customer Issues Tracking</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('servicedelivery/customers')}}" class="btn btn-file btn-danger btn-block"><i class="fa fa-user"></i> Customers</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('servicedelivery/settings')}}" class="btn btn-file btn-danger btn-block"><i class="fa fa-cog"></i>  Settings</a>
                                </div>
                            </div>
                            @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,22) || Auth::user()->user_type=="Administrator")
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-12">
                                        <a href="{{url('servicedelivery/email')}}" class="btn btn-file btn-danger btn-block"> <i class="fa fa-envelope"></i> Email Settings</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </section>
                </div>
                <div class="row">
                    <section class="panel">
                        <header class="panel-heading">
                            <span class="text-info"> <strong> <i class="fa fa-download"></i> Download reports</strong></span>
                        </header>
                        <div class="panel-body">

                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('servicedelivery/report/daily')}}" class=" btn btn-file btn-primary btn-block"><i class="fa fa-clock-o"></i> Daily Report</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('servicedelivery/report/month')}}" class="btn btn-file btn-success btn-block"><i class="fa fa-calendar"></i> Month Report</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('servicedelivery/report/custom')}}" class=" btn btn-file btn-danger btn-block"> <i class="fa fa-bars"></i> Custom Report </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop