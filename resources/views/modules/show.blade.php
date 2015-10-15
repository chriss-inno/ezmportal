@extends('layout.master')
@section('page-title')
    Modules
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
            $('#branches').dataTable( {
                "aaSorting": [[ 4, "desc" ]]
            } );
        } );

        $("#branch").change(function () {
            var id1 = this.value;
            if(id1 != "")
            {
                $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                    $("#department").html(data);
                });

            }else{$("#department").html("<option value=''>----</option>");}
        });

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
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-primary">Create new Module</h3>
                    </header>
                    <div class="panel-body">
                        <p> <h3>Basic Module Information </h3>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <hr/>
                        {!! Form::open(array('url'=>'modules','role'=>'form','id'=>'moduleForm')) !!}

                        <div class="form-group">
                            <label for="module_name">Module Name</label>
                            <input type="text" class="form-control" id="module_name" name="module_name" value="{{old('module_name')}}" placeholder="Enter Module Name">
                        </div>
                        <div class="form-group">
                            <label for="description">Module Descriptions</label>
                            <textarea class="form-control" id="description" rows="8" name="description">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="branch">Branch</label>
                                    <select class="form-control"  id="branch" name="branch">
                                        <option value="">----</option>
                                        <?php $branches=\App\Branch::all();?>
                                        @foreach($branches as $br)
                                            <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="department">Department</label>
                                    <select class="form-control"  id="department" name="department">
                                        <option value="">----</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option selected value="">----</option>
                                        <option value="enabled">enabled</option>
                                        <option value="disabled">disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right col-md-2">Submit</button>

                        {!! Form::close() !!}

                    </div>
                </section>
            </div>
            <div class="col-lg-2 col-md-2">
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('branches/create')}}" class="btn btn-compose btn-block">Create New Branch</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('branches')}}" class="btn btn-compose btn-block">List Branches</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-compose btn-block">Branch Reports</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop