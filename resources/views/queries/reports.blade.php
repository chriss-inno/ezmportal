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
                $('#departmentRepo').highcharts({
                    title: {
                        text: 'Daily Logged queries per department for the Month of <?php echo date("F,Y");?>',
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
                            text: 'Logged Queries'
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
                     foreach(\App\Department::all() as $dep)
                     {
                        $dayData.="{name: '".$dep->department_name."',";
                            $da=cal_days_in_month(CAL_GREGORIAN,date('n'),date("Y"));
                             $dateCount="";
                             for($i=1; $i<= $da; $i++)
                             {
                                $dateCount.=count(\App\Query::where(\DB::raw('DAY(reporting_Date)'),'=',$i)->where('from_department','=',$dep->id)->get()).",";
                             }
                             $dayData.="data: [".substr($dateCount,0,strlen($dateCount)-1)."]},";
                     }
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
                        text: 'Last three months average queries per departments'
                    },
                    subtitle: {
                        text: 'Source: Bank M Service Portal'
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
                            text: 'Number of Queries Logged'
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.0f} Queries</b></td></tr>',
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
                    $m1=date("Y-m-d",strtotime(date("Y-m-d").'-1 months'));
                    $m2=date("Y-m-d",strtotime(date("Y-m-d").'-2 months'));
                    $m3=date("Y-m-d",strtotime(date("Y-m-d").'-3 months'));
                    $data1="";
                    $data2="";
                    $data3="";
                    //Get all departments queries count for each month
                    foreach(\App\Department::all() as $department)
                    {
                       $data1.=count( \App\Query::where('from_department','=',$department->id)->where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y',strtotime($m1)))->where(\DB::raw('MONTH(reporting_Date)'), '=',date('n',strtotime($m1)))->get()).",";
                       $data2.=count( \App\Query::where('from_department','=',$department->id)->where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y',strtotime($m2)))->where(\DB::raw('MONTH(reporting_Date)'), '=',date('n',strtotime($m2)))->get()).",";
                       $data3.=count( \App\Query::where('from_department','=',$department->id)->where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y',strtotime($m3)))->where(\DB::raw('MONTH(reporting_Date)'), '=',date('n',strtotime($m3)))->get()).",";
                    }
                    $data1=substr($data1,0,strlen($data1)-1);
                    $data2=substr($data2,0,strlen($data2)-1);
                    $data3=substr($data3,0,strlen($data3)-1);


                     ?>
                    series: [{
                        name: '{{date("F",strtotime($m3))}}',
                        data: [<?php echo $data3?>]

                    }, {
                        name: '{{date("F",strtotime($m2))}}',
                        data: [<?php echo $data2?>]

                    }, {
                        name: '{{date("F",strtotime($m1))}}',
                        data: [<?php echo $data1?>]

                    }]
                });
            });
            $(function () {
                $('#pieChart').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Query logged by branches percentage wise'
                    },
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.0f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    <?php
                      //Get all branches
                      $dataPieDis=$dataPie="";
                      $checkselect=1;
                       foreach(\App\Branch::all() as $br)
                       {
                          if($checkselect ==1){
                           $dataPie.='{';
                            $dataPie.='name: "'.$br->branch_Name.'",';
                          //Get number of logs for all time
                            $dataPie.=' y: '. count(\App\Query::where('from_branch','=',$br->id)->get()).',
                                sliced: true,
                                selected: true';
                           $dataPie.='},';

                          }else
                          {
                           $dataPie.='{';
                            $dataPie.='name: "'.$br->branch_Name.'",';
                          //Get number of logs for all time
                            $dataPie.=' y: '. count(\App\Query::where('from_branch','=',$br->id)->get());
                           $dataPie.='},';
                          }
                         $checkselect++;
                       }
                        $dataPieDis= substr($dataPie,0,strlen($dataPie)-1);
                     ?>
                    series: [{
                        name: "Branches",
                        colorByPoint: true,
                        data: [<?php echo $dataPieDis;?>]
                    }]
                });
            });
            $(function () {
                $('#currentYear').highcharts({
                    chart: {
                        type: 'spline'
                    },
                    title: {
                        text: 'Monthly Average Support Queries'
                    },
                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    credits: {
                        enabled: false
                    },
                    yAxis: {
                        title: {
                            text: 'Average Queries'
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                radius: 4,
                                lineColor: '#666666',
                                lineWidth: 1
                            }
                        }
                    },
                    <?php
                          $MonthCount="";
                          $monthData="";
                             for($i=1; $i<= 12; $i++)
                             {
                                $MonthCount.=count(\App\Query::where(\DB::raw('Month(reporting_Date)'),'=',$i)->get()).",";
                             }
                             $monthData.=substr($MonthCount,0,strlen($MonthCount)-1);
                    ?>
                    series: [{
                        name: 'Monthly Average Queries',
                        data: [<?php echo $monthData;?>]

                    }]
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
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h3 class="text-info"> <strong> <i class="fa fa-bar-chart-o"></i> SERVICE PORTAL QUERIES REPORTS VISUALIZATION</strong></h3>
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
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <section class="panel">
                            <header class="panel-heading">
                            </header>
                            <div class="panel-body">
                                <div id="currentYear" style="height:400px;"></div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <section class="panel">
                            <header class="panel-heading">
                            </header>
                            <div class="panel-body">
                              <div id="pieChart" style="height:400px;"></div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
             <div class="col-lg-2 col-md-2">
                 <div class="row">
                   <section class="panel">
                    <div class="panel-body">

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('queries/create')}}" class=" btn btn-file btn-danger btn-block"><i class="fa fa-folder-open-o"></i> Log Query</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('queries/mytask')}}" class="btn btn-file btn-danger btn-block"><i class="fa fa-tasks"></i> My Tasks</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('queries/progress')}}" class="btn btn-file btn-danger btn-block"><i class="fa fa-archive"></i>  Progress</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('queries/history')}}" class="btn btn-file btn-danger btn-block"> <i class="fa fa-bars"></i> History</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('queryemails')}}" class="btn btn-file btn-danger btn-block"><i class=" fa fa-envelope"></i> Emails Setting</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('queries/report')}}" class="btn btn-file btn-danger btn-block"><i class=" fa fa-bar-chart-o"></i> Reports</a>
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
                                     <a href="#" class=" btn btn-file btn-primary btn-block"><i class="fa fa-clock-o"></i> Daily Report</a>
                                 </div>
                             </div>
                             <div class="row" style="margin-top: 10px">
                                 <div class="col-md-12">
                                     <a href="#" class="btn btn-file btn-success btn-block"><i class="fa fa-calendar"></i> Month Report</a>
                                 </div>
                             </div>
                             <div class="row" style="margin-top: 10px">
                                 <div class="col-md-12">
                                     <a href="#" class="btn btn-file btn-info btn-block"><i class="fa fa-calendar"></i> Year Report</a>
                                 </div>
                             </div>
                             <div class="row" style="margin-top: 10px">
                                 <div class="col-md-12">
                                     <a href="#" class="customReports btn btn-file btn-danger btn-block"> <i class="fa fa-bars"></i> Custom Report </a>
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
