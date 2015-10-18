@extends('layout.master')
@section('page-title')
    Inventory Reports
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
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of reports per departments'
                    },
                    xAxis: {
                        categories: [
                            @foreach(\App\Department::all() as $department)
                             '{{$department->department_name}}',
                            @endforeach
                         ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Number of reports'
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    <?php
                    $m3=date("Y-m-d",strtotime(date("Y-m-d").'-3 months'));
                    $data3="";
                    //Get all departments queries count for each month
                    foreach(\App\Department::all() as $department)
                    {
                        $data3.=count( \App\ReportDepartment::where('department_id','=',$department->id)->get()).",";
                    }
                    $data3=substr($data3,0,strlen($data3)-1);
                     ?>
                    series: [{
                        name: 'Reports',
                        data: [<?php echo $data3?>]

                    }]
                });
                //Create module
                $(".createInventory").click(function(){
                    var id1 = $(this).parent().attr('id');
                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                    modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                    modaldis+= '<div class="modal-content">';
                    modaldis+= '<div class="modal-header">';
                    modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Inventory Items Reports</span>';
                    modaldis+= '</div>';
                    modaldis+= '<div class="modal-body">';
                    modaldis+= ' </div>';
                    modaldis+= '</div>';
                    modaldis+= '</div>';
                    $('body').css('overflow','hidden');

                    $("body").append(modaldis);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("inventory/create") ?>");
                    $("#myModal").on('hidden.bs.modal',function(){
                        $("#myModal").remove();
                    })

                });
                $(".downloadReport").click(function(){
                    var id1 = $(this).parent().attr('id');
                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                    modaldis+= '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
                    modaldis+= '<div class="modal-content">';
                    modaldis+= '<div class="modal-header">';
                    modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;"><i class="fa fa-download"></i> Download Inventory Items Reports</span>';
                    modaldis+= '</div>';
                    modaldis+= '<div class="modal-body">';
                    modaldis+= ' </div>';
                    modaldis+= '</div>';
                    modaldis+= '</div>';
                    $('body').css('overflow','hidden');

                    $("body").append(modaldis);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("inventory-download") ?>");
                    $("#myModal").on('hidden.bs.modal',function(){
                        $("#myModal").remove();
                    })

                });
                $(".setupReport").click(function(){
                    var id1 = $(this).parent().attr('id');
                    var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                    modal+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                    modal+= '<div class="modal-content">';
                    modal+= '<div class="modal-header">';
                    modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modal+= '<h2 class="modal-title" id="myModalLabel">Report settings</h2>';
                    modal+= '</div>';
                    modal+= '<div class="modal-body">';
                    modal+= ' </div>';
                    modal+= '</div>';
                    modal+= '</div>';

                    $("body").append(modal);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("portal/reports/setup") ?>");
                    $("#myModal").on('hidden.bs.modal',function(){
                        $("#myModal").remove();
                    })

                })
                //Display Item details
                $(".showDetails").click(function(){
                    var id1 = $(this).parent().attr('id');
                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                    modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                    modaldis+= '<div class="modal-content">';
                    modaldis+= '<div class="modal-header">';
                    modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Item details </span>';
                    modaldis+= '</div>';
                    modaldis+= '<div class="modal-body">';
                    modaldis+= ' </div>';
                    modaldis+= '</div>';
                    modaldis+= '</div>';
                    $('body').css('overflow','hidden');

                    $("body").append(modaldis);
                    jQuery.noConflict();
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("inventory") ?>/"+id1);
                    $("#myModal").on('hidden.bs.modal',function(){
                        $("#myModal").remove();
                    })

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
        </li> @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,1))
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Reports</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('portal/reports/daily')}}" title="Daily Reports">Daily Reports</a></li>
                    <li><a  href="{{url('portal/reports/monthly')}}" title="Monthly Reports">Monthly Reports</a></li>
                    <li><a  href="{{url('portal/reports/custom')}}" title="Custom Reports">Custom Reports</a></li>
                    <li><a  href="{{url('portal/reports/search')}}" title="Search Report">Search Report</a></li>
                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2)  || Auth::user()->user_type=="Administrator")
                        <li><a  href="{{url('portal/reports')}}" title="Manage Reports">Manage Reports</a></li>
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
        <header class="panel-heading">
            <h3 class="text-info"> <strong><i class="fa  fa-pie-chart"></i> Portal Reports </strong></h3>
        </header>
        <div class="panel-body">
           <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="btn-group btn-group-justified">
                            @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2)  || Auth::user()->user_type=="Administrator")
                                <a href="#" class="addNewReport btn  btn-primary"><i class="fa fa-folder-open-o"></i> Add Reports</a>
                                <a href="{{url('portal/reports/import')}}" class=" btn  btn-primary"><i class="fa fa-file-excel-o"></i> Import reports</a>
                                <a href="{{url('portal/reports')}}" class=" btn  btn-primary"><i class="fa fa-bar-chart"></i> Manage reports</a>
                                <a href="#" class="setupReport  btn btn-primary"><i class="fa fa-cog"></i> Reports Setup</a>
                            @endif
                            <a href="{{url('portal/reports/daily')}}" class="btn btn-file btn-primary"><i class="fa fa-clock-o"></i> Daily Reports</a>
                            <a href="{{url('portal/reports/monthly')}}" class="btn btn-file btn-primary"><i class="fa fa-calendar-plus-o"></i> Monthly Reports</a>
                            <a href="{{url('portal/reports/custom')}}" class="btn btn-file btn-primary"> <i class="fa fa-bars"></i> Custom Reports</a>
                            @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
                                <a href="{{url('portal/reports/generate')}}" class="btn btn-file btn-danger"><i class=" fa fa-bar-chart-o"></i> Reports</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                            </header>
                            <div class="panel-body">
                                <div id="highchart" style="height:600px;"></div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
         </div>
    </section>
    <!-- page end-->
@stop
