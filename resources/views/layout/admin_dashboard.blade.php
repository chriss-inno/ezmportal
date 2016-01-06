@extends('layout.master')

@section('page-title')
    Home
@stop
@section('page_scripts')
    {!!HTML::script("assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js") !!}
    {!!HTML::script("js/sparkline-chart.js") !!}
    {!!HTML::script("js/easy-pie-chart.js") !!}
    {!!HTML::script("js/count.js") !!}
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
                                $dateCount.=count(\App\Query::where(\DB::raw('DAY(reporting_Date)'),'=',$i)->where(\DB::raw('MONTH(reporting_Date)'),'=',date('n'))->where('from_department','=',$dep->id)->get()).",";
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
            $(function () {
                $('#serviceDowntime').highcharts({
                    title: {
                        text: 'Today service downtime status',
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
            <!--state overview start-->
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol terques">
                    <i class="fa fa-user"></i>
                </div>
                <div class="value">
                    <h1 class="count">
                        {{count(\App\User::all())}}
                    </h1>
                    <p>Users</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="fa fa-bar-chart"></i>
                </div>
                <div class="value">
                    <h1 class=" count2">
                        {{count(\App\PortalReport::all())}}
                    </h1>
                    <p>Reports</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol yellow">
                    <i class="fa fa-laptop"></i>
                </div>
                <div class="value">
                    <h1 class=" count3">
                        {{count(\App\Inventory::all())}}
                    </h1>
                    <p>Inventory Items</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol red">
                    <i class="fa fa-database text-danger"></i>
                </div>
                <div class="value">
                    <h1 class=" count4">
                        {{count(\App\OracleSupport::where('status','=','Opened')->get())}}
                    </h1>
                    <p>Oracle Opened Issues</p>
                </div>
            </section>
        </div>
    </div>
    <!--state overview end-->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <section class="panel">
                <div class="panel-body">
                    <div id="serviceDowntime" style="height:400px;"></div>
                </div>
            </section>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div id="departmentRepo" style="height:400px;"></div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div id="highchart" style="height:400px;"></div>
        </div>
    </div>

@stop
