@extends('layout.master')
@section('page-title')
    Oracle support issues
    @stop
    @section('page_style')

    {!!HTML::style("assets/bootstrap-datepicker/css/datepicker.css" )!!}
    {!!HTML::style("assets/bootstrap-colorpicker/css/colorpicker.css" )!!}
    {!!HTML::style("assets/bootstrap-daterangepicker/daterangepicker.css" )!!}

    @stop
    @section('page_scripts')
            <!-- js placed at the end of the document so the pages load faster -->


    <!--custom tagsinput-->
    {!!HTML::script("js/jquery.tagsinput.js") !!}
            <!--custom checkbox & radio-->
    {!!HTML::script("js/ga.js") !!}
    {!!HTML::script("assets/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/date.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/daterangepicker.js") !!}
    {!!HTML::script("assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js") !!}
    {!!HTML::script("assets/ckeditor/ckeditor.js") !!}
    {!!HTML::script("js/jquery.validate.min.js" ) !!}
    {!!HTML::script("js/respond.min.js"  ) !!}
    {!!HTML::script("js/form-validation-script.js") !!}
    <script>
        $("#serviceForm").validate({
            rules: {
                issue_title: "required",
                description: "required",
                sr_number: "required",
                product: "required",
                contact: "required",
                date_opened: "required",
                status: "required"
            },
            messages: {
                issue_title: "Please enter problem summary",
                description: "Please enter description",
                sr_number: "Please enter SR Number",
                product: "Please enter product",
                contact: "Please enter Contact",
                date_opened: "Please enter date opened",
                status: "Please select status"
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
                <li><a  href="{{url('queries/create')}}" title="System/services History">Log Query</a></li>
                <li><a  href="{{url('queries/mytask')}}" title="Report System/Service problem or issue">My Tasks</a></li>
                <li><a  href="{{url('queries/progress')}}" title="Report System/Service problem or issue">Query Progress</a></li>
                <li><a  href="{{url('queries/history')}}" title="Report System/Service problem or issue">Query History</a></li>
                <li><a  href="{{url('queries/report')}}" title="View today system status">Queries Reports</a></li>
            </ul>
        </li>
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
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-cogs"></i>
                <span>Portal Administration</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('branches')}}">Branches</a></li>
                <li><a  href="{{url('departments')}}">Departments</a></li>
                <li><a  href="{{url('users')}}">Users</a></li>
                <li><a  href="{{url('users/rights')}}">Users Rights</a></li>
                <li><a  href="{{url('modules')}}">Query Modules</a></li>
            </ul>
        </li>
    </ul>
@stop
@section('contents')
    <section class="site-min-height">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa  fa-users"></i> ORACLE SUPPORT LOGGED ISSUES</strong></h3>
                    </header>
                    <div class="panel-body">
                        <p> <h3>New loged issue  </h3>
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
                        {!! Form::open(array('url'=>'support/oracle/edit','role'=>'form','id'=>'serviceForm')) !!}

                        <div class="form-group">
                            <label for="issue_title">Problem Summary</label>
                            <input type="text" class="form-control" id="issue_title" name="issue_title" @if(old('issue_title') != "") value="{{old('issue_title')}}"@else value="{{$issues->issue_title}}"@endif placeholder="Enter title">
                        </div>

                        <div class="form-group">
                            <label for="sr_number">SR Number</label>
                            <input type="text" class="form-control" id="sr_number" name="sr_number" @if(old('sr_number') != "") value="{{old('sr_number')}}" @else value="{{$issues->sr_number}}"@endif placeholder="Enter SR Number">
                        </div>
                        <div class="form-group">
                            <label for="issue_title">Product</label>
                            <input type="text" class="form-control" id="product" name="product" @if(old('product') != "") value="{{old('product')}}" @else value="{{$issues->product}}"@endif placeholder="Enter Product">
                        </div>
                        <div class="form-group">
                            <label for="sr_number">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" @if(old('contact') != "") value="{{old('contact')}}" @else value="{{$issues->contact}}"@endif placeholder="Enter contact person">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="status">Open status</label>
                                    <select name="status" class="form-control" id="status">
                                        @if(old('status') !="")
                                            <option selected value="{{old('status')}}">{{old('status')}}</option>
                                        @else
                                            <option selected value="{{$issues->status}}">{{$issues->status}}</option>
                                        @endif
                                        <option  value="">----</option>
                                        <option value="Closed">Closed</option>
                                        <option value="Opened">Opened</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="sr_number">Status</label>
                                    <input type="text" class="form-control" id="current_status" name="current_status"  @if(old('current_status') != "") value="{{old('current_status')}}" @else value="{{$issues->current_status}}"@endif placeholder="Enter Status">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="status">Opened Date</label>
                                    <input type="text" class="form-control form-control form-control-inline input-medium default-date-picker" id="date_opened" name="date_opened"  @if(old('date_opened') != "") value="{{old('date_opened')}}" @else value="{{$issues->date_opened}}"@endif placeholder="(YYYY-MM-DD HH:MM)">
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Closed Date</label>
                                    <input type="text" class="form-control" id="date_closed" name="date_closed" @if(old('date_closed') != "") value="{{old('date_closed')}}" @else value="{{$issues->date_closed}}"@endif placeholder="(YYYY-MM-DD HH:MM)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="ckeditor form-control" id="description" name="description">@if(old('description') != ""){{old('description')}}@else{{$issues->description}}@endif</textarea>
                        </div>

                        <input type="hidden" name="id" id="id" value="{{$issues->id}}">
                        <button type="submit" class="btn btn-primary pull-right col-md-2">Submit</button>

                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
            <div class="col-lg-2 col-md-2">
                <section class="panel">
                    <div class="panel-body">

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('support/oracle/create')}}" class=" btn btn-file btn-danger btn-block"><i class="fa fa-folder-open-o"></i> New Issue </a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('support/oracle/opened')}}" class="btn btn-file btn-danger btn-block"> <i class="fa fa-bars"></i> Opened Issues</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('support/oracle/closed')}}" class="btn btn-file btn-danger btn-block"><i class=" fa fa-bar-chart-o"></i> Closed Issues</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('support/oracle/history')}}" class="btn btn-file btn-danger btn-block"><i class=" fa fa-bar-chart-o"></i> Issues History</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('support/oracle/report')}}" class="btn btn-file btn-danger btn-block"><i class=" fa fa-bar-chart-o"></i> Issues Report</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop