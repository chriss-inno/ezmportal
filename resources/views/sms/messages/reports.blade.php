@extends('layout.master')
@section('page-title')
    SMS Messages Reports
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
                $('#departmentRepo').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Daily messages sent  for the Month of <?php echo date("F,Y");?>',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Portal reports services',
                        x: -20
                    },
                    credits: {
                        enabled: false
                    },
                    xAxis: { title: {
                        text: '<?php echo date("F")?>'
                    },
                        <?php
                             $d=cal_days_in_month(CAL_GREGORIAN,date('n'),date("Y"));
                             $categories="";

                             for($i=1; $i<= $d; $i++)
                             {
                               $categories.="'".$i."',";

                             }
                             $days=substr($categories,0,strlen($categories)-1);
                             ?>

                         categories: [<?php echo $days;?>]
                    },
                    yAxis: {
                        title: {
                            text: 'Number of messages per day'
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
                    <?php
                     $dayData="";

                        $dayData.="{name: 'Messages sent',";
                            $da=cal_days_in_month(CAL_GREGORIAN,date('n'),date("Y"));
                             $dateCount="";
                             for($i=1; $i<= $da; $i++)
                             {
                                $dateCount.=count(\App\SMSLog::where(\DB::raw('DAY(dispatch_date)'),'=',$i)->where(\DB::raw('MONTH(dispatch_date)'),'=',date('n'))->get()).",";
                             }
                             $dayData.="data: [".substr($dateCount,0,strlen($dateCount)-1)."]},";

                     $dataContent=substr($dayData,0,strlen($dayData)-1);
                    ?>


                   series: [<?php echo $dataContent;?>]
                });
            });
            $(function () {
                $('#highchart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of customers per dispatch group'
                    },
                    subtitle: {
                        text: 'Source: Bank M Service Portal'
                    },
                    xAxis: {
                        categories: [
                            @foreach(\App\SMSDistributionList::all() as $department)
                             '{{$department->list_name}}',
                            @endforeach
                         ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Number of Customer'
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.0f} Customers</b></td></tr>',
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

                    $data1="";

                    //Get all departments queries count for each month
                    foreach(\App\SMSDistributionList::all() as $disp)
                    {
                       $data1.="{
                           name: '".$disp->list_name."',
                            data: [".count( \App\DispatchCustomer::where('dispatch_id','=',$disp->id)->get())."]
                            },
                           ";
                    }
                    $data1=substr($data1,0,strlen($data1)-1);


                     ?>
                    series: [<?php echo $data1?>]
                });
            });

            //Edit class streams
            $(".customReports").click(function () {
                var id1 = $(this).parent().attr('id');
                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                modaldis += '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                modaldis += '<div class="modal-content">';
                modaldis += '<div class="modal-header">';
                modaldis += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis += '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Queries custom reports</span>';
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
                $(".modal-body").load("<?php echo url("queries/download") ?>");
                $("#myModal").on('hidden.bs.modal', function () {
                    $("#myModal").remove();
                })

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
            <a href="javascript:;" class="active">
                <i class="fa fa-laptop"></i>
                <span>SMS To Customers</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('sms/messages')}}" title="Messages">Messages</a></li>
                <li   ><a  href="{{url('sms/customers')}}" title="Customers">Customers</a></li>
                <li><a  href="{{url('sms/dispatch')}}" title="Dispatch Group">Dispatch Group</a></li>
                <li class="active"><a  href="{{url('sms/reports')}}" title="SMS Reports">Report</a></li>

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

        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h3 class="text-info"> <strong> <i class="fa fa-envelope-square"></i>  <i class="fa fa-line-chart text-danger"></i> SMS REPORTS</strong></h3>
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div id="departmentRepo" style="height:400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                            </header>
                            <div class="panel-body">
                                <div id="highchart" style="height:400px;"></div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
            <div class="col-lg-2 col-md-2">
                <div class="row">
                    <section class="panel">
                        <header class="panel-heading">
                            <span class="text-info"> <strong> <i class="fa fa-tasks"></i> Quick links</strong></span>
                        </header>
                        <div class="panel-body">

                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('sms/messages/create')}}" class=" btn btn-file btn-danger btn-block"><i class="fa fa-envelope-o"></i> Compose Messages</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('sms/messages')}}" class=" btn btn-file btn-danger btn-block"><i class="fa fa-envelope"></i> Messages</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('sms/messages/history')}}" class=" btn btn-file btn-danger btn-block"><i class="fa fa-envelope"></i> Dispatch History</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('sms/customers')}}" class="btn btn-file btn-danger btn-block"><i class="fa fa-archive"></i>  Customers</a>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-12">
                                    <a href="{{url('sms/dispatch')}}" class="btn btn-file btn-danger btn-block"><i class="fa fa-users"></i> Dispatch Groups</a>
                                </div>
                            </div>
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
                                    <a href="#" class=" btn btn-file btn-primary btn-block"><i class="fa fa-clock-o"></i> Custom Report</a>
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
