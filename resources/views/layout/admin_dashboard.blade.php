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
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-picture-o"></i>
                <span>Photo Galley</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">Upload Photos</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">List Albums</a></li>
                <li><a  href="#" title="View today system status">Manage Albums</a></li>
            </ul>
        </li>
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
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-folder-open-o"></i>
                <span>Queries and Tasks</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="System/services History">Log Query</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">My Tasks</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">Query Progress</a></li>
                <li><a  href="#" title="Report System/Service problem or issue">Query History</a></li>
                <li><a  href="#" title="View today system status">Manage Queries</a></li>
                <li><a  href="#" title="View today system status">Queries Reports</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>System service status</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('services/status/create')}}" title="Report System/Service problem or issue">Log Status</a></li>
                <li><a  href="{{url('services')}}" title="Report System/Service problem or issue">Services</a></li>
                <li><a  href="{{url('services/status/today')}}" title="View today system status">Today Status</a></li>
                <li><a  href="{{url('services/status/history')}}" title="System/services History">Status History</a></li>
                <li><a  href="{{url('services/status/reports')}}" title="Generate System/Service status report">Reports</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-cogs"></i>
                <span>Portal Administration</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('branches')}}">Branches</a></li>
                <li><a  href="{{url('departments')}}">Departments</a></li>
                <li><a  href="{{url('users')}}">Users</a></li>
                <li><a  href="{{url('modules')}}">Query Modules</a></li>
            </ul>
        </li>
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
                            0
                        </h1>
                        <p>New Users</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2">
                            0
                        </h1>
                        <p>Weekly queries</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3">
                            0
                        </h1>
                        <p>Week</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4">
                            0
                        </h1>
                        <p>Month</p>
                    </div>
                </section>
            </div>
        </div>
        <!--state overview end-->

        <div class="row">
            <div class="col-lg-8">
                <!--custom chart start-->
                <div class="border-head">
                    <h3>Logged Queries per month</h3>
                </div>
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
                        <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top">80%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">FEB</div>
                        <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">MAR</div>
                        <div class="value tooltips" data-original-title="40%" data-toggle="tooltip" data-placement="top">40%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">APR</div>
                        <div class="value tooltips" data-original-title="55%" data-toggle="tooltip" data-placement="top">55%</div>
                    </div>
                    <div class="bar">
                        <div class="title">MAY</div>
                        <div class="value tooltips" data-original-title="20%" data-toggle="tooltip" data-placement="top">20%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">JUN</div>
                        <div class="value tooltips" data-original-title="39%" data-toggle="tooltip" data-placement="top">39%</div>
                    </div>
                    <div class="bar">
                        <div class="title">JUL</div>
                        <div class="value tooltips" data-original-title="75%" data-toggle="tooltip" data-placement="top">75%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">AUG</div>
                        <div class="value tooltips" data-original-title="45%" data-toggle="tooltip" data-placement="top">45%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">SEP</div>
                        <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">OCT</div>
                        <div class="value tooltips" data-original-title="42%" data-toggle="tooltip" data-placement="top">42%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">NOV</div>
                        <div class="value tooltips" data-original-title="60%" data-toggle="tooltip" data-placement="top">60%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">DEC</div>
                        <div class="value tooltips" data-original-title="90%" data-toggle="tooltip" data-placement="top">90%</div>
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
                                <span>Friday</span>
                                <strong>$ 57,00 | 15%</strong>
                            </div>
                            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                        </div>
                    </div>
                    <div class="chart-tittle">
                        <span class="title">New Earning</span>
                              <span class="value">
                                  <a href="#" class="active">Market</a>
                                  |
                                  <a href="#">Referal</a>
                                  |
                                  <a href="#">Online</a>
                              </span>
                    </div>
                </div>
                <!--new earning end-->

                <!--total earning start-->
                <div class="panel green-chart">
                    <div class="panel-body">
                        <div class="chart">
                            <div class="heading">
                                <span>June</span>
                                <strong>23 Days | 65%</strong>
                            </div>
                            <div id="barchart"></div>
                        </div>
                    </div>
                    <div class="chart-tittle">
                        <span class="title">Total Earning</span>
                        <span class="value">$, 76,54,678</span>
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
                        <a href="#" class="task-thumb">
                            <img src="img/avatar1.jpg" alt="">
                        </a>
                        <div class="task-thumb-details">
                            <h1><a href="#">Anjelina Joli</a></h1>
                            <p>Senior Architect</p>
                        </div>
                    </div>
                    <table class="table table-hover personal-task">
                        <tbody>
                        <tr>
                            <td>
                                <i class=" fa fa-tasks"></i>
                            </td>
                            <td>New Task Issued</td>
                            <td> 02</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-exclamation-triangle"></i>
                            </td>
                            <td>Task Pending</td>
                            <td> 14</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-envelope"></i>
                            </td>
                            <td>Inbox</td>
                            <td> 45</td>
                        </tr>
                        <tr>
                            <td>
                                <i class=" fa fa-bell-o"></i>
                            </td>
                            <td>New Notification</td>
                            <td> 09</td>
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
                            <p>Anjelina Joli</p>
                        </div>
                        <div class="task-option">
                            <select class="styled">
                                <option>Anjelina Joli</option>
                                <option>Tom Crouse</option>
                                <option>Jhon Due</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover personal-task">
                        <tbody>
                        <tr>
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
                        </tr>
                        </tbody>
                    </table>
                </section>
                <!--work progress end-->
            </div>
        </div>

@stop
