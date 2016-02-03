@extends('layout.master')
@section('page-title')
    Queries
@stop
@section('page_style')

    {!!HTML::style("assets/bootstrap-datepicker/css/datepicker.css" )!!}
    {!!HTML::style("assets/bootstrap-colorpicker/css/colorpicker.css" )!!}
    {!!HTML::style("assets/bootstrap-daterangepicker/daterangepicker.css" )!!}
    <link href="{{asset("assets/jquery-file-upload/css/jquery.fileupload-ui.css")}}" rel="stylesheet" type="text/css" >

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
        $("#company_id").change(function () {


            var id1 = this.value;



            if(id1 != "")
            {
                $.get("<?php echo url('getsdcontact') ?>/"+id1,function(data){
                    document.getElementById('contact_person').value=data;
                });

            }else{$("#contact_person").html("");}
        });

        $("#InventoryForm").validate({
            rules: {
                company_id: "required",
                product_id: "required",
                mode_id: "required",
                description: "required",
                department_id: "required",
                received_by: "required",
                status_id: "required",
                root_cause:"required"

            },
            messages: {
                company_id: "Please enter company name",
                product_id: "Please select product type",
                mode_id: "Please select receipt mode",
                description: "Please enter description",
                department_id: "Please select department",
                received_by: "Please enter received by",
                status_id: "Please select status",
                root_cause: "Please enter root causes"
            }
        });



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
                <a href="javascript:;" class="active" >
                    <i class="fa fa-info"></i>
                    <span>Service Delivery</span>
                </a>
                <ul class="sub">
                    <li class="active"><a  href="{{url('servicedelivery')}}" title="Customer Issues Tracking" class="active">Customer Issues Tracking</a></li>
                    <li><a  href="{{url('servicedelivery/customers')}}" title="Customer Issues Tracking" >Customers</a></li>
                    <li ><a  href="{{url('servicedelivery/settings')}}"  > Settings</a></li>
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
                <a href="javascript:;">
                    <i class="fa fa-bell"></i>
                    <span>Reminder</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('reminders/create')}}" title="Create Reminder">Create Reminder</a></li>
                    <li><a  href="{{url('reminders')}}" title="Reminder List">Reminder List</a></li>

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
    <section class="site-min-height">
        <!-- page start-->

        <section class="panel">
            <header class="panel-heading">
                <h3 class="text-info"> <strong><i class="fa fa-users"></i>  CUSTOMER ISSUES TRACKING: Record new issue</strong></h3>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="btn-group btn-group-justified">
                            <a href="{{url('servicedelivery/create')}}" class=" btn btn-file btn-primary"><i class="fa fa-file-o text-danger"></i> RECORD NEW ISSUE</a>
                            <a href="{{url('servicedelivery')}}" class="btn btn-file btn-primary"> <i class="fa fa-pencil-square text-danger"></i> VIEW ISSUES PROGRESS</a>
                            <a href="{{url('servicedelivery/history')}}" class="btn btn-file btn-primary"> <i class="fa fa-archive text-danger"></i> VIEW ISSUES HISTORY</a>
                            <a href="{{url('servicedelivery/customers')}}" class="btn btn-file btn-primary"> <i class="fa fa-users"></i> CUSTOMERS</a>
                            <a href="{{url('servicedelivery/reports')}}" class="btn btn-file btn-primary"> <i class="fa fa-bar-chart text-danger"></i>  ISSUES REPORT</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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


                            {!! Form::open(array('url'=>'servicedelivery/edit','role'=>'form','id'=>'InventoryForm')) !!}
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border" style="color:#005DAD">Customer Details</legend>
                                <div class="form-group">
                                    <label for="company_id">Company Name</label>
                                    <select class="form-control"  id="company_id" name="company_id">
                                        @if($issue->company_id != null && $issue->company_id != "")
                                            <?php $customer=\App\SDCustomer::find($issue->company_id);?>
                                            <option value="{{$customer->id}}" selected>{{$customer->company_name}}</option>
                                        @else
                                            <option value="" selected>Select Company</option>
                                        @endif
                                        <?php $customers=\App\SDCustomer::all();?>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->company_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contact_person">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person"
                                           @if($issue->company_id != null && $issue->company_id != "")
                                           <?php $customer=\App\SDCustomer::find($issue->company_id);?>
                                           value="{{$customer->contact_person}}"
                                           @else
                                           value=""
                                           @endif
                                           placeholder="Enter contact person" readonly>
                                </div>
                            </fieldset>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border" style="color:#005DAD">Issues Details</legend>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="product_id">Product Type</label>
                                            <select class="form-control"  id="product_id" name="product_id">
                                                @if($issue->product_id != null && $issue->product_id !="")
                                                    <option value="{{$issue->producttype->id}}" selected>{{$issue->producttype->product_type}}</option>
                                                @else
                                                    <option value="">Select Product Type</option>
                                                @endif

                                                <?php $products=\App\SDProduct::all();?>
                                                @foreach($products as $pr)
                                                    <option value="{{$pr->id}}">{{$pr->product_type}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="product_details_id">Product Details</label>
                                            <select class="form-control"  id="product_details_id" name="product_details_id">
                                                @if($issue->product_details_id != null && $issue->product_details_id !="")
                                                    <option value="{{$issue->productdetails->id}}" selected>{{$issue->productdetails->details_name}}</option>
                                                @else
                                                    <option value="">Select Product details</option>
                                                @endif

                                                <?php $sdproductd=\App\SDProductDetails::all();?>
                                                @foreach($sdproductd as $rc)
                                                    <option value="{{$rc->id}}">{{$rc->details_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="received_by">Received By</label>
                                    <input type="text" class="form-control" id="received_by" name="received_by" value="{{$issue->received_by}}" placeholder="Enter received_by">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                            <label for="mode_id">Mode of receipt</label>
                                            <select class="form-control"  id="mode_id" name="mode_id">
                                                @if($issue->mode_id != null && $issue->mode_id !="")
                                                    <option value="{{$issue->receiptmode->id}}" selected>{{$issue->receiptmode->mode_name}}</option>
                                                @else
                                                    <option value="">Select Mode of Receipt </option>
                                                @endif
                                                <?php $sdmodes=\App\SDReceiptMode::all();?>
                                                @foreach($sdmodes as $rc)
                                                    <option value="{{$rc->id}}">{{$rc->mode_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                            <label for="status_id">Status</label>
                                            <select name="status_id" class="form-control" id="status_id">
                                                @if($issue->status_id != null && $issue->status_id !="")
                                                    <option value="{{$issue->status->id}}" selected>{{$issue->status->status_name}}</option>
                                                @else
                                                    <option selected value="">Select Status</option>
                                                @endif
                                                <?php $sdstatus=\App\SDStatus::all();?>
                                                @foreach($sdstatus as $rc)
                                                    <option value="{{$rc->id}}">{{$rc->status_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Root Cause</label>
                                    <textarea class="form-control" id="root_cause" name="root_cause" >{{$issue->root_cause}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Issue Descriptions</label>
                                    <textarea class="form-control" id="description" name="description" >{{$issue->description}}</textarea>
                                </div>
                                <div class="form-group">

                                    <label for="department_id">Department Responsible</label>
                                    <select name="department_id" class="form-control" id="department_id">
                                        @if($issue->department_id != null && $issue->department_id !="")
                                            <option value="{{$issue->department_id}}" selected>{{$issue->department_id}}</option>
                                        @else
                                            <option selected value="">Select Department</option>
                                        @endif
                                        <?php $depatments=\App\Department::all();?>
                                        @foreach($depatments as $rc)
                                            <option value="{{$rc->department_name}}">{{$rc->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
                                        <a href="{{url('servicedelivery')}}" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                                        <input type="hidden" value="{{$issue->id}}" id="issue_id" name="issue_id">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7 pull-left" id="output">

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
