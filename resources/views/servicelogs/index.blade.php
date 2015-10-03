@extends('layout.master')
@section('page-title')
    Branches
@stop
@section('page_scripts')
    {!!HTML::script("js/sparkline-chart.js") !!}
    {!!HTML::script("js/easy-pie-chart.js") !!}
    {!!HTML::script("js/count.js") !!}
    {!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
    {!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
    {!!HTML::script("js/jquery.scrollTo.min.js") !!}
    {!!HTML::script("js/jquery.nicescroll.js") !!}
    {!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
    {!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {


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
                <li><a  href="#" title="ICT Department">ICT Department</a></li>
                <li><a  href="#" title="Operation">Operation</a></li>
                <li><a  href="#" title="Administration">Administration</a></li>
                <li><a  href="#" title="Human Resource">Human Resource</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,4))
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
         @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,5))
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
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,6))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-info"></i><span>Treasury</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="Money Msafiri System">Forex Deal Slip</a></li>
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,7))
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
         @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,8))
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
         @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,9))
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-user"></i>
                <span>COP'S</span>
            </a>
            <ul class="sub">
                <li><a  href="#" title="HR Portal">Tracker</a></li>
              
            </ul>
        </li>
        @endif
        
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,10))
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
                 @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,6))
                    <li><a  href="{{url('queries/report')}}" title="View today system status">Queries Reports</a></li>
                @endif
                 @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,6))
                 <li><a  href="{{url('queries/assign')}}" title="View today system status">Queries Assign</a></li>
                 @endif
            </ul>
        </li>
        @endif
         @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,11))
          <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>Reminder</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('support/oracle/create')}}" title="Report System/Service problem or issue">Create Reminder</a></li>
                <li><a  href="{{url('support/oracle/opened')}}" title="Report System/Service problem or issue">Reminder List</a></li>
              
            </ul>
        </li>
        @endif
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,12))
          <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i><span>Oracle Support Issues</span>
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
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,13))
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
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
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
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
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
                                        <td>{{$ser->status}}</td>
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
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop