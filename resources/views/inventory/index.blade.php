@extends('layout.master')
@section('page-title')
   ICT Items Inventories
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
                "fnDrawCallback": function( oSettings ) {


            $(".deleteItem").click(function(){
                var id1 = $(this).parent().attr('id');
                $(".deleteItem").show("slow").parent().parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().find(".deleteItem").show("slow");
                    $(this).parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                    $.get("<?php echo url('inventory-remove') ?>/"+id1,function(data){
                        btn.hide("slow").next("hr").hide("slow");
                       // $(this).parent().parent().parent().parent().remove();
                    });
                });
            });
            //Edit Module
            $(".editItem").click(function(){
                var id1 = $(this).parent().attr('id');
                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center" style="color: #FFF">Update Inventory Item</span>';
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
                $(".modal-body").load("<?php echo url("inventory") ?>/"+id1+"/edit");
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                })

            })
            //Create module
            $(".createItem").click(function(){
                var id1 = $(this).parent().attr('id');
                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">New Inventory Item </span>';
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
                $(".modal-body").load("<?php echo url("inventory/create") ?>");
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                })

            });

            //Display Item details
            $(".showDetails").click(function(){
                var id1 = $(this).parent().attr('id');
                var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

                modaldis+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                modaldis+= '<div class="modal-content">';
                modaldis+= '<div class="modal-header">';
                modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info text-center" style="color: #FFF;">Item details </span>';
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
                $(".modal-body").load("<?php echo url("inventory") ?>/"+id1);
                $("#myModal").on('hidden.bs.modal',function(){
                    $("#myModal").remove();
                })

            });
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
                <li><a  href="#" title="Daily Reports">Daily Reports</a></li>
                <li><a  href="#" title="Monthly Reports">Monthly Reports</a></li>
                <li><a  href="#" title="Custom Reports">Custom Reports</a></li>
                <li><a  href="#" title="Search Report">Search Report</a></li>
                 @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,2)  || Auth::user()->user_type=="Administrator")
                 <li><a  href="#" title="Manage Reports">Manage Reports</a></li>
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
        @if(\App\Http\Controllers\RightsController::moduleAccess(Auth::user()->right_id,18)  || Auth::user()->user_type=="Administrator")
         <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-laptop"></i>
                <span>System service status</span>
            </a>
            <ul class="sub">
                <li><a  href="{{url('serviceslogs/create')}}" title="Log Status">Log Status</a></li>
                <li><a  href="{{url('services')}}" title="Services">Services</a></li>
                <li><a  href="{{url('serviceslogs/today')}}" title="Today Status">Today Status</a></li>
                <li><a  href="{{url('serviceslogs')}}" title="Status History">Status History</a></li>
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
                        <h3 class="text-info"> <strong><i class="fa fa-suitcase"></i> MANAGE INVENTORY ITEMS</strong></h3>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="branches">
                                <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Item Name</th>
                                    <th>IP Address</th>
                                    <th>Item Type</th>
                                    <th>Username</th>
                                    <th>Machine Model</th>
                                    <th>Serial number</th>
                                    <th>USB</th>
                                    <th>Antivirus</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;?>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->item_name}}</td>
                                        <td>{{$item->ip_address}}</td>
                                        @if($item->type_id != null && $item->type_id !="" )
                                        <td>{{$item->type->type_name}}</td>
                                        @else
                                            <td></td>
                                            @endif
                                        <td>{{$item->user_name}}</td>
                                        <td>{{$item->machine_model}}</td>
                                        <td>{{$item->serial_number}}</td>
                                        <td>{{$item->usb}}</td>
                                        <td>{{$item->antivirus}}</td>
                                        <td id="{{$item->id}}" align="center">
                                            <div class="pull-right hidden-phone" id="{{$item->id}}">
                                                <a  href="#" title="show item details" class="showDetails btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                            </div>

                                        </td>
                                        <td id="{{$item->id}}" align="center">
                                                <a  href="#" title="Edit Inventory Item" class="editItem btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                <a href="#b" title="Delete Inventory Item" class="deleteItem btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> </a>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>

                                    <th>SNO</th>
                                    <th>Item Name</th>
                                    <th>IP Address</th>
                                    <th>Item Type</th>
                                    <th>Username</th>
                                    <th>Machine Model</th>
                                    <th>Serial number</th>
                                    <th>USB</th>
                                    <th>Antivirus</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-2 col-md-2">
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="createItem btn btn-compose btn-block">New inventory item</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('inventory')}}" class="btn btn-compose btn-block">List inventory items</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('inventory-reports')}}" class="btn btn-compose btn-block">Inventory items reports</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('types')}}" class="btn btn-primary btn-block">List Items types</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <a href="{{url('inventory-import')}}" class="btn btn-primary btn-block">Import items From Excel</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- page end-->
@stop