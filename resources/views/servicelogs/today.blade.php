@extends('layout.master')
@section('page-title')
    Today service status
@stop
@section('page_scripts')
    {!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
    {!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
    {!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
    {!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}
    {!!HTML::script("assets/highcharts/js/highcharts.js") !!}

    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $(function () {
            $('#highchart').highcharts({
                title: {
                    text: 'Daily service downtime status',
                    x: -20 //center
                },
                credits: {
                    enabled: false
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
        $('#branches').dataTable({

            "fnDrawCallback": function (oSettings) {
                $(".delService").click(function () {
                    var id1 = $(this).parent().attr('id');
                    $(".delService").show("slow").parent().parent().find("span").remove();
                    var btn = $(this).parent().parent();
                    $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                    $("#no").click(function () {
                        $(this).parent().parent().find(".delService").show("slow");
                        $(this).parent().parent().find("span").remove();
                    });
                    $("#yes").click(function () {
                        $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                        $.get("<?php echo url('serviceslogs/remove') ?>/" + id1, function (data) {
                            btn.hide("slow").next("hr").hide("slow");
                        });
                    });
                });

                //Edit class streams
                $(".addService").click(function () {
                    var id1 = $(this).parent().attr('id');
                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                    modaldis += '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                    modaldis += '<div class="modal-content">';
                    modaldis += '<div class="modal-header">';
                    modaldis += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis += '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Log service status</span>';
                    modaldis += '</div>';
                    modaldis += '<div class="modal-body">';
                    modaldis += ' </div>';
                    modaldis += '</div>';
                    modaldis += '</div>';
                    $('body').css('overflow', 'hidden');

                    $("body").append(modaldis);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("serviceslogs/create") ?>");
                    $("#myModal").on('hidden.bs.modal', function () {
                        $("#myModal").remove();
                    })

                });

                //Edit class streams
                $(".viewService").click(function () {
                    var id1 = $(this).parent().attr('id');
                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                    modaldis += '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                    modaldis += '<div class="modal-content">';
                    modaldis += '<div class="modal-header">';
                    modaldis += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis += '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Service Status Details</span>';
                    modaldis += '</div>';
                    modaldis += '<div class="modal-body">';
                    modaldis += ' </div>';
                    modaldis += '</div>';
                    modaldis += '</div>';
                    $('body').css('overflow', 'hidden');

                    $("body").append(modaldis);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("serviceslogs/show") ?>/" + id1);
                    $("#myModal").on('hidden.bs.modal', function () {
                        $("#myModal").remove();
                    })

                });

                //viewService
                $(".editService").click(function () {
                    var id1 = $(this).parent().attr('id');
                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                    modaldis += '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
                    modaldis += '<div class="modal-content">';
                    modaldis += '<div class="modal-header">';
                    modaldis += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis += '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Update Service</span>';
                    modaldis += '</div>';
                    modaldis += '<div class="modal-body">';
                    modaldis += ' </div>';
                    modaldis += '</div>';
                    modaldis += '</div>';
                    $('body').css('overflow', 'hidden');

                    $("body").append(modaldis);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("serviceslogs/edit") ?>/" + id1);
                    $("#myModal").on('hidden.bs.modal', function () {
                        $("#myModal").remove();
                    })

                });
                //logService class streams
                $(".logService").click(function () {
                    var id1 = $(this).parent().attr('id');
                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                    modaldis += '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
                    modaldis += '<div class="modal-content">';
                    modaldis += '<div class="modal-header">';
                    modaldis += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis += '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Update Service</span>';
                    modaldis += '</div>';
                    modaldis += '<div class="modal-body">';
                    modaldis += ' </div>';
                    modaldis += '</div>';
                    modaldis += '</div>';
                    $('body').css('overflow', 'hidden');

                    $("body").append(modaldis);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("services/log") ?>/" + id1);
                    $("#myModal").on('hidden.bs.modal', function () {
                        $("#myModal").remove();
                    })

                });
            }
        });
    } );
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
            <a href="javascript:;" class="active">
                <i class="fa fa-laptop"></i>
                <span>Services monitoring</span>
            </a>
            <ul class="sub">
                <li class="active"><a  href="{{url('serviceslogs/create')}}" title="Log Status">Log downtime</a></li>
                <li><a  href="{{url('services')}}" title="Services">List services </a></li>
                <li ><a  href="{{url('serviceslogs/today')}}" title="View today status">Today Status</a></li>
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
                        <div class="row" style="margin-top: 10px">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="highchart" style="height:400px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="adv-table">
                                <table  class="display table table-bordered table-striped" id="branches">
                                    <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Service</th>
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
                                            <td>{{$ser->start_time}}</td>
                                            <td>{{$ser->end_time}}</td>
                                            @if($ser->status =="Sorted")
                                                <td><div class=" btn btn-success btn-xs"> {{$ser->status}}</div></td>
                                            @else
                                                <td><div class=" btn btn-danger btn-xs"> {{$ser->status}}</div></td>
                                            @endif
                                            <td id="{{$ser->id}}" class="text-center">
                                                <a  href="{{url('serviceslogs/show')}}/{{$ser->id}}" title="Edit Service" class=" btn btn-success btn-xs"><i class="fa fa-folder-open-o"></i>View </a>

                                            </td>
                                            <td id="{{$ser->id}}" class="text-center">
                                                <a  href="{{url('serviceslogs/edit')}}/{{$ser->id}}" title="Edit" class=" btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                                <a href="#b" title="Delete" class=" delService btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> Delete </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Service</th>
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
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop
