@extends('layout.master')
@section('page-title')
    Oracle Support Logged issues
@stop
@section('page_scripts')
    {!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
    {!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
    {!!HTML::script("js/jquery.scrollTo.min.js") !!}
    {!!HTML::script("js/jquery.nicescroll.js") !!}
    {!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
    {!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {


            $('#branches').dataTable( {
                "aaSorting": [[ 4, "desc" ]]
            } );

            $(".deleteUser").click(function(){
                var id1 = $(this).parent().parent().attr('id');
                $(".deleteUser").show("slow").parent().parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().parent().find(".deleteUser").show("slow");
                    $(this).parent().parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                    $.get("<?php echo url('users/remove') ?>/"+id1,function(data){
                        btn.hide("slow").next("hr").hide("slow");
                    });
                });
            });

            //Edit class streams
            $(".userCreate").click(function(){
                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                modaldis+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="color: #FFF;">Update School Class Level</span>';
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
                $(".modal-body").load("<?php echo url("users/create") ?>");
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                });

            });

            //Show isue details
            $(".issueDetails").click(function(){
                var id1 = $(this).parent().attr('id');

                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                modaldis+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="color: #FFF;">Issue detailed information</span>';
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
                $(".modal-body").load("<?php echo url("support/oracle/show") ?>/"+id1);
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                });

            });

            //Edit class streams
            $(".userProfile").click(function(){
                var id1 = $(this).parent().attr('id');

                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                modaldis+= '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="color: #FFF;">Update Issue current status</span>';
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
                $(".modal-body").load("<?php echo url("support/oracle/status") ?>/"+id1);
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
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

    <section class="site-min-height">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa  fa-tasks"></i> MY TASK </strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="branches">
                                <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Query code</th>
                                    <th>Date reported</th>
                                    <th>From</th>
                                    <th>Reported By</th>
                                    <th>Critical level</th>
                                    <th>Status</th>
                                    <th>Module</th>
                                    <th>Details</th>
                                    <th>Attend</th>
                                    <th>Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $c=1;?>
                                @foreach($queries as $qr)
                                    <tr>
                                        <td>{{$c++}}</td>
                                        <td>{{$qr->queries->query_code}}</td>
                                        <td>{{date("d-m-Y H:i",strtotime($qr->queries->reporting_Date))}}</td>
                                        <td>{{$qr->queries->fromDepartment->department_name}}</td>
                                        <td>{{$qr->queries->user->first_name.' '.$qr->user->last_name}}</td>
                                        <td>{{$qr->queries->critical_level}}</td>
                                        <td>{{$qr->queries->status}}</td>
                                        <td>{{$qr->queries->module->module_name}}</td>
                                        <td id="{{$qr->queries->id}}">
                                            <a href="#" class="issueDetails btn btn-info btn-xs" title="Detailed Information"><i class="fa fa-eye"></i> View </a>
                                        </td>
                                        <td id="{{$qr->queries->id}}" class="text-center"> <a  href="#" title="Attend Query" class="addUnit btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                        </td>
                                        <td>
                                            <div class="progress progress-striped progress-sm">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SNO</th>
                                    <th>Query code</th>
                                    <th>Date reported</th>
                                    <th>From</th>
                                    <th>Reported By</th>
                                    <th>Critical level</th>
                                    <th>Status</th>
                                    <th>Module</th>
                                    <th>Details</th>
                                    <th>Attend</th>
                                    <th>Progress</th>
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
                                <a href="{{url('queries/report')}}" class="btn btn-file btn-danger btn-block"><i class=" fa fa-bar-chart-o"></i> Reports</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop