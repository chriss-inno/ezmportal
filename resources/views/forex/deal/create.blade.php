@extends('layout.master')
@section('page-title')
    FOREX DEAL SLIPS - New deal slip
@stop
@section('page_style')

        <!-- Bootstrap core CSS -->
    {!!HTML::style("css/bootstrap.min.css" )!!}
    {!!HTML::style("css/bootstrap-reset.css")!!}
            <!--external css-->
    {!!HTML::style("assets/font-awesome/css/font-awesome.css" )!!}

    {!!HTML::style("assets/bootstrap-fileupload/bootstrap-fileupload.css" )!!}
    {!!HTML::style("assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" )!!}
    {!!HTML::style("assets/bootstrap-datepicker/css/datepicker.css" )!!}
    {!!HTML::style("assets/bootstrap-timepicker/compiled/timepicker.css" )!!}
    {!!HTML::style("assets/bootstrap-colorpicker/css/colorpicker.css" )!!}
    {!!HTML::style("assets/bootstrap-daterangepicker/daterangepicker-bs3.css" )!!}
    {!!HTML::style("assets/bootstrap-datetimepicker/css/datetimepicker.css" )!!}
    {!!HTML::style("assets/jquery-multi-select/css/multi-select.css")!!}


            <!-- Custom styles for this template -->
    {!!HTML::style("css/style.css" )!!}
    {!!HTML::style("css/style-responsive.css" )!!}

@stop
@section('page_scripts')
    {!!HTML::script("js/sparkline-chart.js") !!}
    {!!HTML::script("js/easy-pie-chart.js") !!}
    {!!HTML::script("js/count.js") !!}
    {!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
    {!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
    {!!HTML::script("js/jquery.scrollTo.min.js") !!}
    {!!HTML::script("js/jquery.nicescroll.js") !!}

    {!!HTML::script("assets/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
    {!!HTML::script("assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/moment.min.js") !!}
    {!!HTML::script("assets/bootstrap-daterangepicker/daterangepicker.js") !!}
    {!!HTML::script("assets/bootstrap-timepicker/js/bootstrap-timepicker.js") !!}
    {!!HTML::script("js/jquery.validate.min.js" ) !!}
    {!!HTML::script("js/form-validation-script.js") !!}
    {!!HTML::script("js/advanced-form-components.js") !!}

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
                <a href="javascript:;" >
                    <i class="fa fa-info"></i>
                    <span>Service Delivery</span>
                </a>
                <ul class="sub">
                    <li ><a  href="{{url('servicedelivery')}}" title="Customer Issues Tracking" class="active">Customer Issues Tracking</a></li>
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
                <a href="javascript:;"  class="active">
                    <i class="fa fa-money"></i><span>Treasury</span>
                </a>
                <ul class="sub">
                    <li  class="active"><a  href="{{url('forex/dealslip')}}" title="Money Msafiri System">Forex Deal Slip</a></li>
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa fa-money text-danger"></i>  FOREX DEAL SLIPS -: New deal slip</strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group btn-group-justified">
                                    <a href="{{url('forex/dealslip/create')}}" class=" btn btn-file btn-primary"><i class="fa fa-file-o text-danger"></i> RECORD NEW DEAL</a>
                                    <a href="{{url('forex/dealslip/view')}}" class="btn btn-file btn-primary"> <i class="fa fa-archive text-danger"></i> VIEW FOREX DEAL HISTORY</a>
                                    <a href="{{url('forex/customers')}}" class="btn btn-file btn-primary"> <i class="fa fa-users"></i> COUNTER PARTY</a>
                                    <a href="{{url('forex/dealslip/reports')}}" class="btn btn-file btn-primary"> <i class="fa fa-bar-chart text-danger"></i>  FOREX DEAL REPORT</a>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11" style="margin-left: 20px">
                                <p>  <h3 class="text-info"> Basic details</h3>
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
                                {!! Form::open(array('url'=>'forex/dealslip/create','role'=>'form','id'=>'messageDispatch')) !!}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="deal_date">DEAL DATE: </label></div>
                                        <div class="col-md-3">
                                            <input type="text" name="deal_date" class="form-control" readonly value="{{date("d-M-Y")}}">
                                        </div>
                                        <div class="col-md-2"><label for="value_date">VALUE DATE: </label></div>
                                        <div class="col-md-4">
                                            <input type="text" name="value_date" class="default-date-picker form-control" value="{{date("d-m-Y")}}" required>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label for="counter_party"> COUNTER PARTY: </label></div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="counter_party" id="counter_party" required>
                                                     <option value="">--Select--</option>
                                                     @foreach(\App\ForexCustomer::orderBy('customer','ASC')->get() as $cust)
                                                             <option value="{{$cust->id}}">{{$cust->customer}}</option>
                                                         @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="curr_amount_sold_ccy"> CURR. & AMOUNT SOLD: </label></div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="curr_amount_sold_ccy" id="curr_amount_sold_ccy" required>
                                                <option value="">--Currency--</option>
                                                @foreach(\App\ForexCurrency::orderBy('currency','ASC')->get() as $cust)
                                                    <option value="{{$cust->currency}}">{{$cust->currency}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="curr_amount_sold" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="counter_party"> RATE: </label></div>
                                        <div class="col-md-3">
                                            <input type="text" name="rate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="curr_amount_bought_ccy"> CURR. & AMOUNT BOUGHT : </label></div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="curr_amount_bought_ccy" id="curr_amount_bought_ccy">
                                                <option value="">--Currency--</option>
                                                @foreach(\App\ForexCurrency::orderBy('currency','ASC')->get() as $cust)
                                                    <option value="{{$cust->currency}}">{{$cust->currency}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="curr_amount_bought" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="confirmed_with">DEAL CONFIRMED WITH: </label></div>
                                        <div class="col-md-3">
                                            <input type="text" name="confirmed_with" class="form-control">
                                        </div>
                                        <div class="col-md-2"><label for="bankm_dealer"> BANK M DEALER: </label></div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="bankm_dealer" id="bankm_dealer">
                                                <option value="">--Select Bank M Dealer--</option>
                                                @foreach(\App\User::where('right_id','=',9)->where('status','=','Active')->orderBy('first_name','ASC')->get() as $cust)
                                                    <option value="{{$cust->first_name." ".$cust->last_name}}">{{$cust->first_name." ".$cust->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="counter_party">PHONE/ MOBILE NO.: </label></div>
                                        <div class="col-md-3">
                                            <input type="text" name="mobile" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="counter_party">SPL. INSTRUCTION: </label></div>
                                        <div class="col-md-9">
                                            <input type="text" name="instruction" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3"><label for="counter_party">CUSTOMER E-MAIL ID: </label></div>
                                        <div class="col-md-9">
                                            <input type="text" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group" style="margin-top: 20px">
                                        <button type="submit" class="btn btn-primary pull-right col-md-2">Submit</button>
                                    </div>


                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                </section>
            </div>

        </div>
    </section>
    <!-- page end-->
@stop