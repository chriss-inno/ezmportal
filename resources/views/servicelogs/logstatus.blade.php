@extends('layout.master')
@section('page-title')
    Service Monitoring
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
    <ul class="sidebar-menu" id="nav-accordion">
        <li>
            <a class="active" href="{{url('home')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li> @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,1) || Auth::user()->user_type=="Administrator")
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
        @endif @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,5)  || Auth::user()->user_type=="Administrator")
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
            </li>@endif @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,7)  || Auth::user()->user_type=="Administrator")
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-info"></i>
                    <span>Service Delivery</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('servicedelivery')}}" title="Customer Issues Tracking" class="active">Customer Issues Tracking</a></li>
                    <li ><a  href="{{url('servicedelivery/settings')}}" title="Customer Issues Tracking" > Settings</a></li>
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
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,15) || Auth::user()->user_type=="Administrator")
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
                <a href="javascript:;" class="active" >
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <i class="fa fa-tachometer text-danger"></i> <i class="fa fa-cogs"></i> Service Monitoring</h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group btn-group-justified">
                                    <a href="{{url('serviceslogs/create')}}" class="createItem btn btn-file btn-primary">Log Downtime</a>

                                    <a href="{{url('serviceslogs/today')}}"  class="btn btn-file btn-primary">Today Status</a>

                                    <a href="{{url('smemails')}}" class="btn btn-file btn-primary"> <i class="fa fa-envelope"></i> <i class="fa fa-cog text-danger"></i> Email Settings</a>

                                    <a href="{{url('services')}}" class="btn btn-file btn-primary">View  Service</a>

                                    <a href="{{url('serviceslogs')}}" class="btn btn-file btn-primary">Status History</a>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                <!-- page
						<div class="form-group">
							<label for="unit_name">Log Title</label>
							<input type="text" class="form-control" id="log_title" name="log_title" value="{{old('log_title')}}" placeholder="Enter title">
						</div>
						 -->
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
                                            <input size="16" type="text" id="start_time" name="start_time" value="{{old('start_time')}}"  class="form_datetime form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status">Restoration Time</label>
                                            <input size="16" type="text" id="end_time" name="end_time" value="{{old('end_time')}}"  class="form_datetime form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h3 class="text-info"> Area Affected by the downtime</h3> <hr/>
                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-4">
                                            <label for="status">Branches</label>
                                            <select name="branches[]" class="multi-select form-control" multiple="" id="branches" >
                                                @foreach(\App\Branch::all() as $br)
                                                    <option >{{$br->branch_Name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="status">Departments</label>
                                            <select multiple class="multi-select form-control" name="departments[]" id="departments" multiple="">
                                                @foreach(\App\Branch::all() as $br)
                                                    @foreach($br->department as $dp)
                                                        <option >{{$dp->department_name}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="units">Units</label>
                                            <select multiple class="multi-select form-control" name="units[]" id="units" multiple="">
                                                @foreach(\App\Branch::all() as $br)
                                                    @foreach($br->department as $dp)
                                                        @foreach($dp->units as $un)
                                                            <option >{{$un->unit_name}})</option>
                                                        @endforeach
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
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop