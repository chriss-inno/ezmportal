@extends('layout.master')
@section('page-title')
   Support Logged Query
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
                "fnDrawCallback": function( oSettings ) {

                    //adding company user
                    $(".addMessage").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modal+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                        modal+= '<div class="modal-content">';
                        modal+= '<div class="modal-header">';
                        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modal+= '<h2 class="modal-title" id="myModalLabel">Query updates details</h2>';
                        modal+= '</div>';
                        modal+= '<div class="modal-body">';
                        modal+= ' </div>';
                        modal+= '</div>';
                        modal+= '</div>';

                        $("body").append(modal);
                        jQuery.noConflict();
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("queries/message/composer") ?>/"+id1);
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    })
                    $(".queryAttend").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modal+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                        modal+= '<div class="modal-content">';
                        modal+= '<div class="modal-header">';
                        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modal+= '<h2 class="modal-title" id="myModalLabel">Query details</h2>';
                        modal+= '</div>';
                        modal+= '<div class="modal-body">';
                        modal+= ' </div>';
                        modal+= '</div>';
                        modal+= '</div>';

                        $("body").append(modal);
                        jQuery.noConflict();
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("queries/attend") ?>/"+id1);
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    })
                    $(".queryDetails").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modal+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                        modal+= '<div class="modal-content">';
                        modal+= '<div class="modal-header">';
                        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modal+= '<h2 class="modal-title" id="myModalLabel">Support logged query details</h2>';
                        modal+= '</div>';
                        modal+= '<div class="modal-body">';
                        modal+= ' </div>';
                        modal+= '</div>';
                        modal+= '</div>';

                        $("body").append(modal);
                        jQuery.noConflict();
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("queries/show") ?>/"+id1);
                        $("#myModal").on('hidden.bs.modal',function(){
                            $("#myModal").remove();
                        })

                    })

                    $(".deleteuser").click(function(){
                        var id1 = $(this).parent().attr('id');
                        $(".deleteuser").show("slow").parent().parent().find("span").remove();
                        var btn = $(this).parent().parent();
                        $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                        $("#no").click(function(){
                            $(this).parent().parent().find(".deleteuser").show("slow");
                            $(this).parent().parent().find("span").remove();
                        });
                        $("#yes").click(function(){
                            $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                            $.post("<?php echo url('company/delete') ?>/"+id1,function(data){
                                btn.hide("slow").next("hr").hide("slow");
                            });
                        });
                    });//endof deleting category
                }
            } );
        } );


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
                <a href="javascript:;" >
                    <i class="fa fa-info"></i>
                    <span>Service Delivery</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('servicedelivery')}}" >Customer Issues Tracking</a></li>
                    <li><a  href="{{url('servicedelivery/customers')}}" >Customers</a></li>
                    <li ><a  href="{{url('servicedelivery/settings')}}" > Settings</a></li>
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
                <a href="javascript:;" class="active" >
                    <i class="fa fa-folder-open-o"></i>
                    <span>Support Queries</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{url('queries/create')}}" title="Log Query">Log Query</a></li>
                    <li class="active"><a  href="{{url('queries/mytask')}}" title="My Tasks">My Tasks</a></li>
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
                        <h3 class="text-info"> <strong><i class="fa  fa-tasks"></i> MY TASK </strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group btn-group-justified">
                                    <a href="{{url('queries/create')}}" class=" btn  btn-primary"><i class="fa fa-folder-open-o"></i> Log New Query</a>

                                    <a href="{{url('queries/mytask')}}" class="btn btn-file btn-primary"><i class="fa fa-tasks"></i> My Tasks</a> <a href="{{url('queries/progress')}}" class="btn btn-file btn-primary"><i class="fa fa-archive"></i> Queries Progress</a>

                                    <a href="{{url('queries/history')}}" class="btn btn-file btn-primary"> <i class="fa fa-bars"></i> History</a>

                                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,21) || Auth::user()->user_type=="Administrator")
                                        <a href="{{url('queryemails')}}" class="btn btn-file btn-primary"><i class=" fa fa-envelope"></i> Emails Setting</a>
                                    @endif
                                    @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
                                        <a href="{{url('queries/report')}}" class="btn btn-file btn-primary"><i class=" fa fa-bar-chart-o"></i> Reports</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="branches">
                                <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Query code</th>
                                    <th>Date reported</th>
                                    <th>From</th>
                                    <th>Reported By</th>
                                    <th>Date assigned</th>
                                    <th>Critical level</th>
                                    <th>Status</th>
                                    <th>Module</th>
                                    <th>Details</th>
                                    <th>Attend</th>
                                    <th>Query Updates</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $c=1;?>
                                @if(count($queries) >0 && $queries !=null)
                                @foreach($queries as $qr)
                                    <tr>
                                        <td>{{$c++}}</td>
                                        <td>{{$qr->query_code}}</td>
                                        <td>{{date("d M ,Y H:i",strtotime($qr->reporting_Date))}}</td>
                                        <td>@if($qr->from_unit != null && $qr->from_unit != "")
                                                {{$qr->fromUnit->unit_name}}
                                                @else
                                                {{$qr->fromDepartment->department_name}}
                                            @endif
                                        </td>
                                        <td>{{$qr->user->first_name.' '.$qr->user->last_name}}</td>
                                        @if($qr->assignment->assigned_date_time !=null && $qr->assignment->assigned_date_time !="" )
                                        <td>{{date("d-M-Y H:i",strtotime($qr->assignment->assigned_date_time))}}</td>
                                        @else
                                            <td>ff</td>
                                            @endif
                                        <td>{{$qr->critical_level}}</td>
                                        <td>{{$qr->status}}</td>
                                        <td>{{$qr->module->module_name}}</td>
                                        <td id="{{$qr->id}}">
                                            <a href="#" class="queryDetails btn btn-info btn-xs" title="Detailed Information"><i class="fa fa-eye"></i> View </a>
                                        </td>
                                        <td id="{{$qr->id}}" class="text-center"> <a  href="#" title="Attend Query" class="queryAttend btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                        </td>
                                        <td id="{{$qr->id}}">
                                            <a href="#" class="addMessage btn btn-primary btn-xs" title="Additional Query Message"><i class="fa fa-envelope-o"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SNO</th>
                                    <th>Query code</th>
                                    <th>Date reported</th>
                                    <th>From</th>
                                    <th>Reported By</th>
                                    <th>Date assigned</th>
                                    <th>Critical level</th>
                                    <th>Status</th>
                                    <th>Module</th>
                                    <th>Details</th>
                                    <th>Attend</th>
                                    <th>Query Updates</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop