@extends('layout.master')
@section('page-title')
    Branches
@stop
@section('page_scripts')
    {!!HTML::script("js/sparkline-chart.js") !!}
    {!!HTML::script("js/easy-pie-chart.js") !!}
    {!!HTML::script("js/count.js") !!}
    {!!HTML::script("js/jquery.tagsinput.js")!!}
    {!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
    {!!HTML::script("js/jquery.scrollTo.min.js") !!}
    {!!HTML::script("js/jquery.nicescroll.js") !!}
    {!!HTML::script("js/jquery.validate.min.js" ) !!}
    {!!HTML::script("js/respond.min.js"  ) !!}
    {!!HTML::script("js/form-validation-script.js") !!}

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

        } );
        //Edit class streams
        $(".addBranch").click(function(){
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="text-align: center">Update School Class Level</span>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';
            $('body').css('overflow','hidden');

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("branches/create") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        });
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
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,9)) <li class="sub-menu">
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa fa-bars"></i> </strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group btn-group-justified">
                                    <a href="{{url('portal/reports/create')}}" class=" btn  btn-primary"><i class="fa fa-folder-open-o"></i>Add Reports</a>

                                    <a href="{{url('portal/reports/daily')}}" class="btn btn-file btn-primary"><i class="fa fc-agenda-days"></i> Daily Reports</a>

                                    <a href="{{url('portal/reports/monthly')}}" class="btn btn-file btn-primary"><i class="fa fa-calendar-plus-o"></i>Monthly Reports</a>

                                    <a href="{{url('portal/reports/custom')}}" class="btn btn-file btn-primary"> <i class="fa fa-bars"></i> Custom Reports</a>

                                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
                                        <a href="{{url('portal/reports/generate')}}" class="btn btn-file btn-danger"><i class=" fa fa-bar-chart-o"></i> Reports</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p> <h3 class="text-center">Import From MS Excel </h3>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert fade in alert-danger">
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <hr/>
                        {!! Form::open(array('url'=>'portal/reports/import','role'=>'form','id'=>'importInventory','files' => true)) !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-4 col-sm-offset-4 col-md-offset-4 col-xs-offset-4">
                                    <input type="file" id="inventory_file" name="inventory_file" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-4 col-sm-offset-4 col-md-offset-4 col-xs-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block">Import File</button>
                                </div>
                            </div>
                        </div>


                        {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </section>
    <!-- page end-->
@stop