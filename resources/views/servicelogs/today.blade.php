@extends('layout.master')
@section('page-title')
    Today service status
@stop
@section('page_scripts')
    {!!HTML::script("assets/highcharts/js/highcharts.js") !!}
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $(function () {
            $('#container').highcharts({
                title: {
                    text: 'Daily service downtime status',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Portal reports services',
                    x: -20
                },
                xAxis: { title: {
                    text: 'Hour'
                },
                    categories: ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00',
                        '14:00', '15:00', '16:00', '17:00', '18:00', '19:00','20:00']
                },
                yAxis: {
                    title: {
                        text: 'Frequency'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ''
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },

                series: [
                        @foreach(\App\Service::all() as $ser){
                        name: '{{$ser->service_name}}',
                        data: [{{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','8')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','9')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','10')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','11')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','12')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','13')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','14')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','15')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','16')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','17')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','18')->get())}}, {{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','19')->get())}},{{count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->where(\DB::raw('HOUR(start_time)'), '=','20')->get())}}]
                    },
                    @endforeach
                   ]
            });
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="container" style="width:100%; height:400px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="adv-table">
                                <table  class="display table table-bordered table-striped" id="branches">
                                    <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Service</th>
                                        <th>Log Title</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Status</th>
                                        <th>Detailed</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="serviceList">
                                    <?php $i=1;?>
                                    @foreach($services as $ser)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$ser->service->service_name}}</td>
                                            <td>{{$ser->log_title}}</td>
                                            <td>{{$ser->start_time}}</td>
                                            <td>{{$ser->end_time}}</td>
                                            @if($ser->status =="Sorted")
                                                <td><div class=" btn btn-success btn-xs"> {{$ser->status}}</div></td>
                                            @else
                                                <td><div class=" btn btn-danger btn-xs"> {{$ser->status}}</div></td>
                                            @endif
                                            <td id="{{$ser->id}}" class="text-center">
                                                <a  href="#" title="Edit Service" class="viewService btn btn-success btn-xs"><i class="fa fa-folder-open-o"></i>View </a>

                                            </td>
                                            <td id="{{$ser->id}}" class="text-center">
                                                <a  href="#" title="Edit Service" class="editService btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Edit</a>
                                                <a href="#b" title="Delete Department" class="delService btn btn-danger btn-xs"><i class="fa fa-trash-o "></i>Delete </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Service</th>
                                        <th>Log Title</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Status</th>
                                        <th>Detailed</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
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
