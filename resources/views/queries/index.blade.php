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
                    $(".addMessage").click(function(){
                        var id1 = $(this).parent().attr('id');
                        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                        modal+= '<div class="modal-content">';
                        modal+= '<div class="modal-header">';
                        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        modal+= '<h2 class="modal-title" id="myModalLabel">Additional Query Message</h2>';
                        modal+= '</div>';
                        modal+= '<div class="modal-body">';
                        modal+= ' </div>';
                        modal+= '</div>';
                        modal+= '</div>';

                        $("body").append(modal);
                        jQuery.noConflict();
                        $("#myModal").modal("show");
                        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                        $(".modal-body").load("<?php echo url("queries/message") ?>/"+id1);
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
            <div class="col-lg-12 col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="text-info"> <strong><i class="fa  fa-tasks"></i> MY LOGGED QUERIES PROGRESS</strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group btn-group-justified">
                                    <a href="{{url('queries/create')}}" class=" btn  btn-primary"><i class="fa fa-folder-open-o"></i> Log New Query</a>

                                    <a href="{{url('queries/mytask')}}" class="btn btn-file btn-primary"><i class="fa fa-tasks"></i> My Tasks</a>

                                    <a href="{{url('queries/progress')}}" class="btn btn-file btn-primary"><i class="fa fa-archive"></i> My logged queries Progress</a>

                                    <a href="{{url('queries/history')}}" class="btn btn-file btn-primary"> <i class="fa fa-bars"></i> History</a>

                                    <a href="{{url('queries/report')}}" class="btn btn-file btn-danger"><i class=" fa fa-bar-chart-o"></i> Reports</a>
                                </div>
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
                                    <th>Sent to</th>
                                    <th>Person Assigned </th>
                                    <th>Critical</th>
                                    <th>Status</th>
                                    <th>Module</th>
                                    <th>Message</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $c=1;?>
                                @foreach($queries as $qr)
                                    <tr id="{{$qr->id}}">
                                        <td>{{$c++}}</td>
                                        <td>{{$qr->query_code}}</td>
                                        <td>{{date("d M, Y H:i",strtotime($qr->reporting_Date))}}</td>
                                        <td>{{$qr->toDepartment->department_name}}</td>
                                       @if($qr->assignment != null && $qr->assignment !="")
                                            <td style="background-color:#78CD51; color: #FFF;">{{$qr->assignment->user->first_name.' '.$qr->assignment->user->last_name}}</td>
                                           @else
                                            <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                           @endif
                                        <td>{{$qr->critical_level}}</td>
                                        <td>{{$qr->status}}</td>
                                        <td>{{$qr->module->module_name}}</td>
                                        <td id="{{$qr->id}}">
                                            <a href="#" class="addMessage btn btn-primary btn-xs" title="Additional Query Message"><i class="fa fa-envelope-o"></i> </a>
                                        </td>
                                        <td id="{{$qr->id}}">
                                            <a href="#" class="queryDetails btn btn-info btn-xs" title=" Query Details"><i class="fa fa-eye-slash"></i>View </a>
                                        </td>
                                        <td id="{{$qr->id}}" style="min-width: 80px">
                                            <a  href="#" title="Edit User right" class="addBranch btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <a href="#b" title="Remove" class="deleteIssue btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                        </td>
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