@extends('layout.master')
@section('page-title')
    Branches
@stop
        @section('page_style')

{!!HTML::style("assets/bootstrap-datepicker/css/datepicker.css" )!!}
{!!HTML::style("assets/bootstrap-colorpicker/css/colorpicker.css" )!!}
{!!HTML::style("assets/bootstrap-daterangepicker/daterangepicker.css" )!!}

@stop
@section('page_scripts')
<!-- js placed at the end of the document so the pages load faster -->
{!!HTML::script("js/jquery.js") !!}
    {!!HTML::script("js/bootstrap.min.js") !!}
    {!!HTML::script("js/jquery.scrollTo.min.js") !!}
    {!!HTML::script("js/jquery.nicescroll.js" ) !!}

    {!!HTML::script("js/jquery-ui-1.9.2.custom.min.js") !!}
    {!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}

    <!--custom switch-->
    {!!HTML::script("js/bootstrap-switch.js") !!}
    <!--custom tagsinput-->
    {!!HTML::script("js/jquery.tagsinput.js") !!}
    <!--custom checkbox & radio-->
    {!!HTML::script("js/ga.js") !!}

    {!!HTML::script("assets/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/date.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/daterangepicker.js") !!}
    {!!HTML::script("assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js") !!}
    {!!HTML::script("assets/ckeditor/ckeditor.js") !!}

    {!!HTML::script("assets/bootstrap-inputmask/bootstrap-inputmask.min.js") !!}
    {!!HTML::script("js/respond.min.js" ) !!}


    <!--common script for all pages-->
    {!!HTML::script("js/common-scripts.js") !!}

    <!--script for this page-->
    {!!HTML::script("js/form-component.js") !!}


    {!!HTML::script("js/jquery.validate.min.js" ) !!}
    {!!HTML::script("js/respond.min.js"  ) !!}
    {!!HTML::script("js/form-validation-script.js") !!}
    <script>
        $("#serviceForm").validate({
            rules: {
                start_time: "required",
                service_id: "required",
                log_title: "required",

                status: "required"
            },
            messages: {
                service_id: "Please select service name",
                log_title: "Please enter title",
                start_time: "Please enter start time",
                status: "Please select status"
            },
            submitHandler: function(form) {
                $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
                var postData = $('#serviceForm').serializeArray();
                var formURL = $('#serviceForm').attr("action");
                $.ajax(
                        {
                            url : formURL,
                            type: "POST",
                            data : postData,
                            success:function(data)
                            {
                                console.log(data);
                                //data: return data from server
                                document.getElementById('service_name').value="";
                                document.getElementById('description').value="";
                                $("#output").html(data);


                                setTimeout(function() {

                                    $("#output").html("");
                                    jQuery.noConflict();
                                    $("#myModal").modal("hide");
                                    $("#serviceList").load("<?php echo url('services/list')?>");
                                }, 2000);
                            },
                            error: function(data)
                            {
                                console.log(data.responseJSON);
                                //in the responseJSON you get the form validation back.
                                $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");
                                $("#serviceList").load("<?php echo url('services/list')?>");
                                setTimeout(function() {
                                    $("#output").html("");
                                }, 2000);
                            }
                        });
            }
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
            <li><a  href="#" title="Report System/Service problem or issue">Log Status</a></li>
            <li><a  href="#" title="View today system status">Today Status</a></li>
            <li><a  href="#" title="System/services History">Status History</a></li>
            <li><a  href="#" title="Generate System/Service status report">Reports</a></li>
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
        </ul>
    </li>
</ul>
@stop
@section('contents')
 <section class="site-min-height">
    <!-- page start-->
    <div class="row">
        <div class="col-lg-9 col-md-9">
            <section class="panel">
                <header class="panel-heading">
                    <h3 class="text-info"> Service Monitoring</h3>
                </header>
                <div class="panel-body">
                    <p> <h3>Log new service status </h3>
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
                    {!! Form::open(array('url'=>'serviceslogs/create','role'=>'form','id'=>'serviceForm')) !!}
                       <div class="form-group">
							<label for="service_id">Service Name</label>
							<select class="form-control"  id="service_id" name="service_id">
								<option value="">----</option>
								<?php $services=\App\Service::all();?>
								@foreach($services as $se)
									<option value="{{$se->id}}">{{$se->service_name}}</option>
								@endforeach

							</select>
						</div>
						<div class="form-group">
							<label for="unit_name">Log Title</label>
							<input type="text" class="form-control" id="log_title" name="log_title" value="{{old('log_title')}}" placeholder="Enter title">
						</div>
						<div class="form-group">
							<label for="unit_name">Description</label>
							<textarea class="ckeditor form-control" id="description" name="description"></textarea>
						</div>
                        <div class="form-group">
                            <label for="unit_name">Specify Reason</label>
                            <input type="text" class="form-control" id="reason" name="reason" value="{{old('log_title')}}" placeholder="Enter reason">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="status">Start Time</label>
                                    <input type="text" class="form-control form-control form-control-inline input-medium default-date-picker" id="start_time" name="start_time" value="{{old('start_time')}}" placeholder="(YYYY-MM-DD HH:MM)">
                                   </div>
                                <div class="col-md-6">
                                    <label for="status">End Time</label>
                                    <input type="text" class="form-control" id="end_time" name="end_time" value="{{old('end_time')}}" placeholder="(YYYY-MM-DD HH:MM)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3> Area Affected by the downtime</h3> <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="status">Branches</label>
                                    <select multiple class="form-control" name="branches[]" id="branches">
                                        @foreach(\App\Branch::all() as $br)
                                            <option >{{$br->branch_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Departments and units</label>
                                    <select multiple class="form-control" name="departments[]" id="departments">
                                       @foreach(\App\Branch::all() as $br)
                                            @foreach($br->department as $dp)
                                                @foreach($dp->units as $un)
                                                    <option >{{$un->unit_name}}-{{$dp->department_name}} ({{$br->branch_Name}})</option>
                                                @endforeach
                                                    <option >{{$dp->department_name}}-({{$br->branch_Name}})</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit_name">Remarks</label>
                            <input type="text" class="form-control" id="remarks" name="remarks" value="{{old('remarks')}}" placeholder="Enter Remarks">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option selected value="">----</option>
                                        <option value="Sorted">Sorted</option>
                                        <option value="Not Sorted">Not Sorted</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right col-md-2">Submit</button>

                        {!! Form::close() !!}

                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-md-3">
                <section class="panel">
                    <div class="panel-body">

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('serviceslogs/create')}}" class=" btn btn-lg btn-danger btn-block">Log Status</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('serviceslogs/today')}}" class="btn btn-lg btn-danger btn-block">Today Status</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('serviceslogs')}}" class="btn btn-lg btn-danger btn-block">Status History</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop