@extends('layout.master')

@section('page-title')
    Home
@stop
@section('page_scripts')
    {!!HTML::script("assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js") !!}
    {!!HTML::script("js/sparkline-chart.js") !!}
    {!!HTML::script("js/easy-pie-chart.js") !!}
    {!!HTML::script("js/count.js") !!}
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
                <li><a  href="#" title="Report System/Service problem or issue">Daily Reports</a></li>
                <li><a  href="#" title="View today system status">Monthly Reports</a></li>
                <li><a  href="#" title="System/services History">Custom Reports</a></li>
                <li><a  href="#" title="Generate System/Service status report">Search Report</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-picture-o"></i>
                <span>Photo Galley</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">Upload Photos</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">List Albums</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,3))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-download"></i>
                <span>Downloads</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">ICT Department</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">Operation</a></li>
                <li><a  href="#" title="View today system status">Administration</a></li>
                <li><a  href="#" title="View today system status">Human Resource</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,4))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-info"></i>
                <span>Special Portals</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">COPS Issues Tracking</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">CMF Reports</a></li>
                <li><a  href="#" title="View today system status">Money Msafiri</a></li>
                <li><a  href="#" title="View today system status">Human Resource</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,5))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-folder-open-o"></i>
                <span>Queries and Tasks</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('queries/create')}}" title="System/services History">Log Query</a></li>
                <li><a  href="{{url('queries/mytask')}}" title="Report System/Service problem or issue">My Tasks</a></li>
                <li><a  href="{{url('queries/progress')}}" title="Report System/Service problem or issue">Query Progress</a></li>
                <li><a  href="{{url('queries/history')}}" title="Report System/Service problem or issue">Query History</a></li>
                <li><a  href="{{url('queries/report')}}" title="View today system status">Queries Reports</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,6))
          <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>Oracle Support Isssues</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('support/oracle/create')}}" title="Report System/Service problem or issue">New Issue</a></li>
                <li><a  href="{{url('support/oracle/opened')}}" title="Report System/Service problem or issue">Opened Issues</a></li>
                <li><a  href="{{url('support/oracle/closed')}}" title="View today system status">Closed Issues</a></li>
                <li><a  href="{{url('support/oracle/history')}}" title="System/services History">Issues History</a></li>
                 <li><a  href="{{url('support/oracle/report')}}" title="System/services History">Issues Report</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,7))
         <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>System service status</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('serviceslogs/create')}}" title="Report System/Service problem or issue">Log Status</a></li>
                <li><a  href="{{url('services')}}" title="Report System/Service problem or issue">Services</a></li>
                <li><a  href="{{url('serviceslogs/today')}}" title="View today system status">Today Status</a></li>
                <li><a  href="{{url('serviceslogs')}}" title="System/services History">Status History</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,8))
         <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>ICT Inventory</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('types')}}" title="Report System/Service problem or issue">Item types</a></li>
                <li><a  href="{{url('inventory')}}" title="Report System/Service problem or issue">Inventory Items</a></li>
                <li><a  href="{{url('inventory-reports')}}" title="View today system status">Inventory Reports</a></li>
            
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,9))
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
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2">
                            0
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
                            {{count(\App\OracleSupport::all())}}
                        </h1>
                        <p>Oracle Opened Issues</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->

        <div class="row">
            <div class="col-lg-8">
                <!--custom chart start-->
                <div class="border-head">
                    <h3>Logged Queries per month for year <strong class="text-info">{{date('Y')}}</strong></h3>
                </div>

                <?php
                  //Get all queries per year
                    $allQ=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->get();
                    $QueryYear=count($allQ);
                $allJan=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',1)->get();
                $QueryJan=count($allJan);
                $allFeb=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',2)->get();
                $QueryFeb=count($allFeb);
                $allMar=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',3)->get();
                $QueryMar=count($allMar);
                $allApr=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',4)->get();
                $QueryApr=count($allApr);
                $allMay=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',5)->get();
                $QueryMay=count($allMay);
                $allJun=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',6)->get();
                $QueryJun=count($allJun);
                $allJul=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',7)->get();
                $QueryJul=count($allJul);
                $allAug=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',8)->get();
                $QueryAug=count($allAug);
                $allSep=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',9)->get();
                $QuerySep=count($allSep);
                $allOct=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',10)->get();
                $QueryOct=count($allOct);
                $allNov=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',11)->get();
                $QueryNov=count($allNov);
                $allDec=\App\Query::where(\DB::raw('YEAR(reporting_Date)'), '=', date('Y'))->where(\DB::raw('MONTH(reporting_Date)'), '=',12)->get();
                $QueryDec=count($allDec);
                ?>
                <div class="custom-bar-chart">
                    <ul class="y-axis">
                        <li><span>100</span></li>
                        <li><span>80</span></li>
                        <li><span>60</span></li>
                        <li><span>40</span></li>
                        <li><span>20</span></li>
                        <li><span>0</span></li>
                    </ul>
                    <div class="bar">
                        <div class="title">JAN</div>
                        <div class="value tooltips" data-original-title="{{$QueryJan}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryJan >0){{($QueryYear/$QueryJan) *100}}@else{{$QueryJan}}@endif%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">FEB</div>
                        <div class="value tooltips" data-original-title="{{$QueryFeb}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryFeb >0){{($QueryYear/$QueryFeb) *100}}@else{{$QueryFeb}}@endif%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">MAR</div>
                        <div class="value tooltips" data-original-title="{{$QueryMar}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryMar >0){{($QueryYear/$QueryMar) *100}}@else{{$QueryMar}}@endif%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">APR</div>
                        <div class="value tooltips" data-original-title="{{$QueryApr}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryApr >0){{($QueryYear/$QueryApr) *100}}@else{{$QueryApr}}@endif%</div>
                    </div>
                    <div class="bar">
                        <div class="title">MAY</div>
                        <div class="value tooltips" data-original-title="{{$QueryMay}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryMay >0){{($QueryYear/$QueryMay) *100}}@else{{$QueryMay}}@endif%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">JUN</div>
                        <div class="value tooltips" data-original-title="{{$QueryJun}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryJun >0){{($QueryYear/$QueryJun) *100}}@else{{$QueryJun}}@endif%</div>
                    </div>
                    <div class="bar">
                        <div class="title">JUL</div>
                        <div class="value tooltips" data-original-title="{{$QueryJul}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryJul >0){{($QueryYear/$QueryJul) *100}}@else{{$QueryJul}}@endif%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">AUG</div>
                        <div class="value tooltips" data-original-title="{{$QueryAug}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryAug >0){{($QueryYear/$QueryAug) *100}}@else{{$QueryAug}}@endif%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">SEP</div>
                        <div class="value tooltips" data-original-title="{{$QuerySep}} Queries" data-toggle="tooltip" data-placement="top">@if($QuerySep >0){{($QueryYear/$QuerySep) *100}}@else{{$QuerySep}}@endif%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">OCT</div>
                        <div class="value tooltips" data-original-title="{{$QueryOct}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryOct >0){{($QueryYear/$QueryOct) *100}}@else{{$QueryOct}}@endif%%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">NOV</div>
                        <div class="value tooltips" data-original-title="{{$QueryNov}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryNov >0){{($QueryYear/$QueryNov) *100}}@else{{$QueryNov}}@endif%%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">DEC</div>
                        <div class="value tooltips" data-original-title="{{$QueryDec}} Queries" data-toggle="tooltip" data-placement="top">@if($QueryDec >0){{($QueryYear/$QueryDec) *100}}@else{{$QueryDec}}@endif%%</div>
                    </div>
                </div>
                <!--custom chart end-->
            </div>
            <div class="col-lg-4">
                <!--new earning start-->
                <div class="panel terques-chart">
                    <div class="panel-body chart-texture">
                        <div class="chart">
                            <div class="heading">
                                <span>{{date('l')}}</span>
                            </div>
                            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[0,0,0,0,0,0,0,0,0,0,0]"></div>
                        </div>
                    </div>
                    <div class="chart-tittle">
                        <span class="title">Today Service status</span>
                    </div>
                </div>
                <!--new earning end-->

                <!--total earning start-->
                <div class="panel green-chart">
                    <div class="panel-body">
                        <div class="chart">
                            <div class="heading">
                                <span>{{date('F')}}</span>
                                <strong>{{date('d')}} Days</strong>
                            </div>
                            <div id="barchart"></div>
                        </div>
                    </div>
                    <div class="chart-tittle">
                        <span class="title">Closed Query</span>
                        <span class="value">{{count(\App\Query::all())}}</span>
                    </div>
                </div>
                <!--total earning end-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <!--user info table start-->
                <section class="panel">
                    <div class="panel-body">
                        <div class="task-thumb-details">
                            <h1><a href="#">My activity summary</a></h1>
                        </div>
                    </div>
                    <table class="table table-hover personal-task">
                        <tbody>
                        <tr>
                            <td>
                                <i class=" fa fa-tasks"></i>
                            </td>
                            <td>New Task Issued</td>
                            <td> 0</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-exclamation-triangle"></i>
                            </td>
                            <td>Task Pending</td>
                            <td> 0</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-envelope"></i>
                            </td>
                            <td>Inbox</td>
                            <td> 0</td>
                        </tr>
                        <tr>
                            <td>
                                <i class=" fa fa-bell-o"></i>
                            </td>
                            <td>New Notification</td>
                            <td> 0</td>
                        </tr>
                        </tbody>
                    </table>
                </section>
                <!--user info table end-->
            </div>
            <div class="col-lg-8">
                <!--work progress start-->
                <section class="panel">
                    <div class="panel-body progress-panel">
                        <div class="task-progress">
                            <h1>Work Progress</h1>
                        </div>
                    </div>
                    <table class="table table-hover personal-task">
                        <tbody>
                        <!-- <tr>
                            <td>1</td>
                            <td>
                                Target Sell
                            </td>
                            <td>
                                <span class="badge bg-important">75%</span>
                            </td>
                            <td>
                                <div id="work-progress1"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                Product Delivery
                            </td>
                            <td>
                                <span class="badge bg-success">43%</span>
                            </td>
                            <td>
                                <div id="work-progress2"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                Payment Collection
                            </td>
                            <td>
                                <span class="badge bg-info">67%</span>
                            </td>
                            <td>
                                <div id="work-progress3"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                Work Progress
                            </td>
                            <td>
                                <span class="badge bg-warning">30%</span>
                            </td>
                            <td>
                                <div id="work-progress4"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>
                                Delivery Pending
                            </td>
                            <td>
                                <span class="badge bg-primary">15%</span>
                            </td>
                            <td>
                                <div id="work-progress5"></div>
                            </td>
                        </tr> -->
                        </tbody>
                    </table>
                </section>
                <!--work progress end-->
            </div>
        </div>

@stop
