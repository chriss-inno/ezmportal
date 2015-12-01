@extends('layout.master')
@section('page-title')
    Manage Portal Downloads
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
        $(document).ready(function() {
            $("#branch_id").change(function () {
                var id1 = this.value;
                if(id1 != "")
                {
                    $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                        $("#department_id").html(data);
                    });

                }else{$("#department_id").html("<option value=''>----</option>");}
            });

            $("#DownloadForm").validate({
                rules: {
                    title: "required",
                    department_id: "required",
                    status: "required",
                    restricted: "required"

                },
                messages: {
                    title: "Please enter file name",
                    department_id: "Please select department",
                    status: "Please select status",
                    restricted: "Please select status"
                }
            });
        } );
    </script>

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
                 <a href="javascript:;" class="active" >
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa fa-download text-danger"> </i><i class="fa fa-cogs"></i> Portal Downloads</strong></h3>
                    </header>
                    <div class="panel-body">
                        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2)  || Auth::user()->user_type=="Administrator")
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group btn-group-justified">

                                        <a href="{{url('downloads/create')}}" class=" btn btn-file btn-primary">Upload File</a>


                                    <a href="{{url('downloads/manage')}}" class="btn btn-file btn-primary">Manage Downloads</a>

                                    <a href="{{url('downloads/reports')}}" class="btn btn-file btn-primary">Downloads reports</a>

                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p> <h3>Basic File Information </h3>
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
                                {!! Form::open(array('url'=>'downloads/edit','role'=>'form','id'=>'DownloadForm','files' => true)) !!}

                                <div class="form-group">
                                    <label for="title">File Name</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$download->title}}" placeholder="Enter file title">
                                </div>
                                <div class="form-group">
                                    <label for="title">Select file</label>
                                    <input type="file" class="form-control" id="downloadFile" name="downloadFile" value="{{$download->downloadFile}}" placeholder="Select file title">
                                    <br/><p> <input type="checkbox" value="yes" name="replace_check" id="replace_check"> <label for="replace_check" class="text-danger">Please Tick here if you want to replace the existing file</label> </p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descriptions</label>
                                    <textarea class="form-control" id="description" name="description">{{$download->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="branch_id">Branch</label>
                                            <select class="form-control"  id="branch_id" name="branch_id">
                                                @if($download->department_id != null && $download->department_id !="")
                                                    <?php $dpmt=\App\Department::find($download->department_id); ?>
                                                    <option value="{{$dpmt->branch->id}}">{{$dpmt->branch->branch_Name}}</option>
                                                @endif
                                                <?php $branches=\App\Branch::all();?>
                                                @foreach($branches as $br)
                                                    <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="department_id">Department</label>
                                            <select class="form-control"  id="department_id" name="department_id">
                                                @if($download->department_id != null && $download->department_id !="")
                                                    <?php $dpmt=\App\Department::find($download->department_id); ?>
                                                        <option value="{{$dpmt->id}}">{{$dpmt->department_name}}</option>
                                                    @endif
                                                <option value="">----</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control" id="status">
                                                @if($download->status != null && $download->status !="")
                                                    <option selected value="{{$download->status}}">{{$download->status}}</option>
                                                @endif
                                                 <option  value="">----</option>
                                                <option value="enabled">enabled</option>
                                                <option value="disabled">disabled</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status">Is restricted?</label>
                                            <select name="restricted" class="form-control" id="restricted">
                                                @if($download->restricted != null && $download->restricted !="")
                                                    <option selected value="{{$download->restricted}}">{{$download->restricted}}</option>
                                                @endif
                                                <option  value="">----</option>
                                                <option value="No" >No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                            <p class="text-info">Restriction means the file will be available only to allowed department</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{$download->id}}" name="id" id="id">
                                <button type="submit" class="btn btn-primary pull-right col-md-2">Submit</button>


                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop