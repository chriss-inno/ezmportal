@extends('layout.master')
@section('page-title')
    Users Profile
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


            $('#branches').dataTable( {
                "aaSorting": [[ 4, "desc" ]]
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

            //Edit class streams
            $(".userProfile").click(function(){
                var id1 = $(this).parent().attr('id');

                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                modaldis+= '<div class="modal-dialog" style="width:60%;margin-right: 20% ;margin-left: 20%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="color: #FFF;">User Profile</span>';
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
                $(".modal-body").load("<?php echo url("users/show") ?>/"+id1);
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
                        <h3 class="text-info"> <strong><i class="fa  fa-user"></i> USER PROFILE FOR <span class="text-danger">{{strtoupper($user->first_name.' '.$user->last_name)}} </span></strong></h3>
                    </header>
                    <div class="panel-body">
                        {!! Form::open(array('url'=>'register','role'=>'form','id'=>'personalForm')) !!}
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Personal details</legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required @if(old('first_name') !="") value="{{old('first_name')}}" @else value="{{$user->first_name}}" @endif>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="first_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required @if(old('last_name') !="") value="{{old('last_name')}}" @else value="{{$user->last_name}}" @endif>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="first_name">Other Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Other Name">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation " name="designation" placeholder="Enter Designation" required @if(old('designation') !="") value="{{old('designation')}}" @else value="{{$user->designation}}" @endif>
                                <p class="help-block">Please enter full details of your designation, do not enter abbreviation.</p>
                            </div>
                            <div class="form-group">
                                <label for="phone">Mobile Number</label>
                                <input type="text" class="form-control"  id="phone" name="phone" placeholder="Enter Mobile Number" @if(old('phone') !="") value="{{old('phone')}}" @else value="{{$user->phone}}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="phone">Email</label>
                                <input type="text" class="form-control"  id="phone" name="email" placeholder="Enter email" @if(old('email') !="") value="{{old('email')}}" @else value="{{$user->email}}" @endif>
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
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
            <div class="col-lg-2 col-md-2">
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('users/create')}}" class="btn btn-compose btn-block">Create New users</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('users')}}" class="btn btn-compose  btn-block">List users</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('users/reports')}}" class="btn btn-compose btn-block">users Reports</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop