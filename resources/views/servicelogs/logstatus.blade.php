@extends('layout.master')
@section('page-title')
    Branches
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    {!!HTML::script("js/html5shiv.js") !!}
    {!!HTML::script("js/respond.min.js") !!}
    <![endif]-->

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

    {!!HTML::script("assets/datetimepicker/js/bootstrap-datetimepicker.min.js") !!}

            <!-- js placed at the end of the document so the pages load faster -->

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
  {!!HTML::script("assets/jquery-multi-select/js/jquery.multi-select.js") !!}
   {!!HTML::script("assets/jquery-multi-select/js/jquery.quicksearch.js") !!}

    <!--common script for all pages-->
    {!!HTML::script("js/common-scripts.js") !!}
    <!--this page  script only-->
   {!!HTML::script("js/advanced-form-components.js") !!}
    {!!HTML::script("js/form-validation-script.js") !!}




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
                <li><a  href="#" title="Daily Reports">Daily Reports</a></li>
                <li><a  href="#" title="Monthly Reports">Monthly Reports</a></li>
                <li><a  href="#" title="Custom Reports">Custom Reports</a></li>
                <li><a  href="#" title="Search Report">Search Report</a></li>
                 @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2)  || Auth::user()->user_type=="Administrator")
                 <li><a  href="#" title="Manage Reports">Manage Reports</a></li>
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
                <li><a  href="#" title="ICT Department">ICT Department</a></li>
                <li><a  href="#" title="Operation">Operation</a></li>
                <li><a  href="#" title="Administration">Administration</a></li>
                <li><a  href="#" title="Human Resource">Human Resource</a></li>
                @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,6)  || Auth::user()->user_type=="Administrator")
                  <li><a  href="#" title="Manage Downloads">Manage Downloads</a></li>
                 @endif
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
                <li><a  href="#" title="Customer Issues Tracking">Customer Issues Tracking</a></li>
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
                <li><a  href="#" title="Money Msafiri System">Money Msafiri System</a></li>
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
                <li><a  href="#" title="Credit Request">Credit Request</a></li>
                <li><a  href="#" title="CA Portal">CA Portal</a></li>
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
                <li><a  href="#" title="HR Portal">HR Portal</a></li>
              
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
            <a href="javascript:;" >
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
                 @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,15))
                 <li><a  href="{{url('queries/assign')}}" title="Queries Assign">Queries Assign</a></li>
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
                <li><a  href="{{url('branches')}}">Branches</a></li>
                <li><a  href="{{url('departments')}}">Departments</a></li>
                <li><a  href="{{url('users')}}">Users</a></li>
                <li><a  href="{{url('user/rights')}}">Users Rights</a></li>
                <li><a  href="{{url('modules')}}">Query Modules</a></li>
                <li><a  href="{{url('enablers')}}">Query Enablers</a></li>
                <li><a  href="{{url('queriesstatus')}}">Query Status</a></li>
            </ul>
        </li>
        @endif
    </ul>
    @stop
@section('contents')
 <section class="site-min-height">
    <!-- page start-->
    <div class="row">
        <div class="col-lg-10 col-md-10">
            <section class="panel">
                <header class="panel-heading">
                    <h3 class="text-info"> Service Monitoring</h3>
                </header>
                <div class="panel-body">
                    <p> <h3>Log new service status </h3>
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
                    {!! Form::open(array('url'=>'serviceslogs/create','role'=>'form','id'=>'serviceStatusForm')) !!}
                       <div class="form-group">
							<label for="service_id">Service Name</label>
							<select class="form-control"  id="service_id" name="service_id">
								<option value="">----</option>
								<?php $services=\App\Service::all();?>
								@foreach($services as $se)
									<option value="{{$se->id}}">{{$se->service_name}}</option>
								@endforeach

							</select>
						</div>
						<div class="form-group">
							<label for="unit_name">Log Title</label>
							<input type="text" class="form-control" id="log_title" name="log_title" value="{{old('log_title')}}" placeholder="Enter title">
						</div>
						<div class="form-group">
							<label for="unit_name">Description</label>
							<textarea class="ckeditor form-control" id="description" name="description"></textarea>
						</div>
                        <div class="form-group">
                            <label for="unit_name">Specify Reason</label>
                            <input type="text" class="form-control" id="reason" name="reason" value="{{old('log_title')}}" placeholder="Enter reason">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="status">Start Time</label>
                                    <input size="16" type="text" id="start_time" name="start_time" value="{{old('start_time')}}" readonly class="form_datetime form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Restoration Time</label>
                                    <input size="16" type="text" id="end_time" name="end_time" value="{{old('end_time')}}" readonly class="form_datetime form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3 class="text-info"> Area Affected by the downtime</h3> <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="status">Branches</label>
                                    <select multiple class="form-control" name="branches[]" id="branches">
                                        @foreach(\App\Branch::all() as $br)
                                            <option >{{$br->branch_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                <div class="col-md-12">
                                    <label for="status">Departments and units</label>
                                    <select multiple class="form-control" name="departments[]" id="departments">
                                       @foreach(\App\Branch::all() as $br)
                                            @foreach($br->department as $dp)
                                                @foreach($dp->units as $un)
                                                    <option >{{$un->unit_name}}-{{$dp->department_name}} ({{$br->branch_Name}})</option>
                                                @endforeach
                                                    <option >{{$dp->department_name}}-({{$br->branch_Name}})</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit_name">Remarks</label>
                            <input type="text" class="form-control" id="remarks" name="remarks" value="{{old('remarks')}}" placeholder="Enter Remarks">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option selected value="">----</option>
                                        <option value="Sorted">Sorted</option>
                                        <option value="Not Sorted">Not Sorted</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right col-md-2">Submit</button>

                        {!! Form::close() !!}
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-2 col-md-2">
                <section class="panel">
                    <div class="panel-body">

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('serviceslogs/create')}}" class=" btn btn-file btn-danger btn-block">Log Status</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('serviceslogs/today')}}" class="btn btn-file btn-danger btn-block">Today Status</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('serviceslogs')}}" class="btn btn-file btn-danger btn-block">Status History</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('services')}}" class="btn btn-file btn-primary btn-block">View  Service</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop