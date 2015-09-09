@extends('layout.master')
@section('page_style')
Branches
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
        } );
    </script>

@stop

@section('contents')

        <section class="wrapper site-min-height">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Branches
                            <div class="col-sm-3 pull-right">
                                <div class="col-sm-4">  <a href="#myModal" data-toggle="modal" class="btn btn-xs btn-primary"> Create New</a> </div>
                                <div class="col-sm-4">  <a href="#myModal" data-toggle="modal" class="btn btn-xs btn-"> Create New</a> </div>
                                <div class="col-sm-4">  <a href="#myModal" data-toggle="modal" class="btn btn-xs btn-primary"> Create New</a> </div>
                            </div>
                        </header>
                        <div class="panel-body">
                            <div class="adv-table">
                                <table  class="display table table-bordered table-striped" id="branches">
                                    <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Branch Code</th>
                                        <th>Branch Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                     <tbody>
                                     </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Branch Code</th>
                                        <th>Branch Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>

@stop