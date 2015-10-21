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
    <script type="text/javascript">
        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr ,id1)
        {
            var aData = oTable.fnGetData( nTr );
            var sOut ="";
            $.get("<?php echo url('queries/show') ?>/"+id1,function(data){
                 sOut =data;
            });
            return sOut;
        }

        $(document).ready(function() {
            /*
             * Insert a 'details' column to the table
             */
            var nCloneTh = document.createElement( 'th' );
            var nCloneTd = document.createElement( 'td' );
            nCloneTd.innerHTML = '{!!HTML::image("assets/advanced-datatable/examples/examples_support/details_open.png") !!}';
            nCloneTd.className = "center";

            $('#hidden-table-info thead tr').each( function () {
                this.insertBefore( nCloneTh, this.childNodes[0] );
            } );

            $('#hidden-table-info tbody tr').each( function () {
                this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
            } );

            /*
             * Initialse DataTables, with no sorting on the 'details' column
             */
            var oTable = $('#hidden-table-info').dataTable( {

                 "fnDrawCallback": function( oSettings ) {

                    //adding company user
                    $(".assignUser").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modal+= '<div class="modal-content">';
                        modal+= '<div class="modal-header">';
                        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modal+= '<h2 class="modal-title" id="myModalLabel">Assign query to user</h2>';
                        modal+= '</div>';
                        modal+= '<div class="modal-body">';
                        modal+= ' </div>';
                        modal+= '</div>';
                        modal+= '</div>';

                        $("body").append(modal);
                        jQuery.noConflict();
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("queries/assign/users") ?>/"+id1);
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
            });

            /* Add event listener for opening and closing details
             * Note that the indicator for showing which row is open is not controlled by DataTables,
             * rather it is done here
             */
            $('#hidden-table-info tbody td img').live('click', function () {
                var nTr = $(this).parents('tr')[0];
                var id1 = $(this).parent().parent().attr('id');
                if ( oTable.fnIsOpen(nTr) )
                {
                    /* This row is already open - close it */
                    this.src = "{{asset("assets/advanced-datatable/examples/examples_support/details_open.png")}}";
                    oTable.fnClose( nTr );
                }
                else
                {
                    /* Open this row */
                    this.src = "{{asset("assets/advanced-datatable/examples/examples_support/details_close.png")}}";
                    oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr,id1), 'details' );
                }
            } );
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
                 @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,15) || Auth::user()->user_type=="Administrator")
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
            <div class="col-lg-12 col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa  fa-tasks"></i>QUERY ASSIGN </strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="btn-group btn-group-justified">
                                <a href="{{url('queries/create')}}" class=" btn  btn-primary"><i class="fa fa-folder-open-o"></i> Log New Query</a>

                                <a href="{{url('queries/mytask')}}" class="btn btn-file btn-primary"><i class="fa fa-tasks"></i> My Tasks</a>

                                <a href="{{url('queries/progress')}}" class="btn btn-file btn-primary"><i class="fa fa-archive"></i> My logged queries Progress</a>

                                <a href="{{url('queries/history')}}" class="btn btn-file btn-primary"> <i class="fa fa-bars"></i> History</a>

                                @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
                                    <a href="{{url('queryemails')}}" class="btn btn-file btn-primary"><i class=" fa fa-envelope"></i> Emails Setting</a>
                                @endif
                                @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,14) || Auth::user()->user_type=="Administrator")
                                    <a href="{{url('queries/report')}}" class="btn btn-file btn-primary"><i class=" fa fa-bar-chart-o"></i> Reports</a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Query code</th>
                                    <th>Reported</th>
                                    <th>Reported By</th>
                                    <th>From Department</th>
                                    <th>Person Assigned </th>
                                    <th>Criticality</th>
                                    <th>Module</th>
                                    <th>Assign</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $c=1;?>
                                @foreach($queries as $qr)
                                    <tr id="{{$qr->id}}">
                                        <td>{{$c++}}</td>
                                        <td>{{$qr->query_code}}</td>
                                        <td>{{date("d M, Y H:i",strtotime($qr->reporting_Date))}}</td>
                                        <td>{{$qr->user->first_name.' '.$qr->user->last_name}}</td>
                                        <td>{{$qr->fromDepartment->department_name}} ({{$qr->fromDepartment->branch->branch_Name}})</td>
                                       @if($qr->assignment != null && $qr->assignment !="")
                                            <td style="background-color:#78CD51; color: #FFF;">{{$qr->assignment->user->first_name.' '.$qr->assignment->user->last_name}}</td>
                                           @else
                                            <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                           @endif
                                        <td>{{$qr->critical_level}}</td>
                                        <td>{{$qr->module->module_name}}</td>
                                        <td id="{{$qr->id}}">
                                            <a href="#"   @if($qr->assignment != null && $qr->assignment !="")class="assignUser btn btn-success btn-xs" title="Click here to reassign user" @else class="assignUser btn btn-danger btn-xs" title="Click here to assign user" @endif><i class="fa fa-user-md"></i> </a>
                                        </td>
                                        <td id="{{$qr->id}}">
                                            <a href="#" class="queryDetails btn btn-info btn-xs" title=" Query Details"><i class="fa fa-eye-slash"></i>View </a>
                                        </td>
                                        <td>{{$qr->status}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
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