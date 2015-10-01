<section class="panel">
    <header class="panel-heading">
        <h3 class="text-info"> <strong><i class="fa  fa-tasks"></i> QUERIES</strong></h3>
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <table  class="display table table-bordered table-striped" id="branches">
                <thead>
                <tr>
                    <th>SNO</th>
                    <th>Query code</th>
                    <th>Reported</th>
                    <th>Sent to</th>
                    <th>Assigned </th>
                    <th>Critical</th>
                    <th>Status</th>
                    <th>Module</th>
                    <th>Details</th>
                    <th>Progress</th>
                </tr>
                </thead>
                <tbody>
                <?php $c=1;?>
                @foreach($queries as $qr)
                    <tr>
                        <td>{{$c++}}</td>
                        <td>{{$qr->query_code}}</td>
                        <td>{{date("d M, Y H:i",strtotime($qr->reporting_Date))}}</td>
                        <td>{{$qr->fromDepartment->department_name}}</td>
                        @if($qr->assignment != null && $qr->assignment !="")
                            <td>{{$qr->assignment->user->first_name.' '.$qr->user->last_name}}</td>
                        @else
                            <td>Not Assigned</td>
                        @endif
                        <td>{{$qr->critical_level}}</td>
                        <td>{{$qr->status}}</td>
                        <td>{{$qr->module->module_name}}</td>
                        <td id="{{$qr->id}}">
                            <a href="{{url('queries/show')}}/{{$qr->id}}" class=" btn btn-info btn-xs" title="Detailed Information"><i class="fa fa-eye"></i> View </a>
                        </td>
                        <td>
                            <div class="progress progress-striped progress-sm">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>SNO</th>
                    <th>Query code</th>
                    <th>Reported</th>
                    <th>Sent to</th>
                    <th>Assigned </th>
                    <th>Critical</th>
                    <th>Status</th>
                    <th>Module</th>
                    <th>Details</th>
                    <th>Progress</th>
                </tr>
                </tfoot>
            </table>
            <script type="text/javascript" charset="utf-8">


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

                //Show isue details
                $(".issueDetails").click(function(){
                    var id1 = $(this).parent().attr('id');

                    var modaldis = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                    modaldis+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                    modaldis+= '<div class="modal-content">';
                    modaldis+= '<div class="modal-header">';
                    modaldis+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="color: #FFF;">Issue detailed information</span>';
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
                    $(".modal-body").load("<?php echo url("support/oracle/show") ?>/"+id1);
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
                    modaldis+= '<span id="myModalLabel" class="h2 modal-title text-center text-info" style="color: #FFF;">Update Issue current status</span>';
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
                    $(".modal-body").load("<?php echo url("support/oracle/status") ?>/"+id1);
                    $("#myModal").on('hidden.bs.modal',function(){
                        $("#myModal").remove();
                    });

                });


            </script>
        </div>
    </div>
</section>