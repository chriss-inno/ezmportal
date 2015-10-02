<div class="row">
    <div class="col-md-12 col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <h3 class="text-info"> <strong><i class="fa fa- fa-tasks"></i>  QUERY DETAILS </strong></h3>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="branches">
                                <thead>
                                <tr>
                                    <th>Query code</th>
                                    <th>Reported</th>
                                    <th>Sent to</th>
                                    <th>Person Assigned </th>
                                    <th>Critical</th>
                                    <th>Module</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>{{$query->query_code}}</td>
                                    <td>{{date("d M, Y H:i",strtotime($query->reporting_Date))}}</td>
                                    <td>{{$query->toDepartment->department_name}}</td>
                                    @if($query->assignment != null && $query->assignment !="")
                                        <td style="background-color:#78CD51; color: #FFF;">{{$query->assignment->user->first_name.' '.$query->user->last_name}}</td>
                                    @else
                                        <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                    @endif
                                    <td>{{$query->critical_level}}</td>
                                    <td>{{$query->module->module_name}}</td>
                                    <td>{{$query->status}}</td>
                                </tr>
                                <tr>
                                    <th colspan="7">Query Description</th>
                                </tr>
                                <tr>
                                    <td colspan="7"><?php echo $query->description;?></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <p><h4 class="text-info"><strong>Query Review Messages</strong></h4></p>
                        <div class="timeline-messages">
                            @foreach($query->messages as $message)
                                    <!-- Comment -->
                            <div class="msg-time-chat">
                                @if($message->message_type =='IN')
                                    <div class="message-body msg-in">
                                        @else
                                            <div class="message-body msg-out">
                                                @endif
                                                <span class="arrow"></span>
                                                <div class="text">
                                                    <p class="attribution"><a href="#">{{$message->mSender->first_name.' '.$message->mSender->last_name}}</a> at {{date('h:i A',strtotime($message->created_at))}}, {{date("l, jS F Y",strtotime($message->created_at))}}</p>
                                                    <p>{{$message->message}}</p>
                                                </div>
                                            </div>
                                    </div>
                                    @endforeach
                                            <!-- /comment -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
<div class="row">
    <div class="col-md-8 pull-left" id="output"></div>
    <div class="col-md-2 pull-right">
        <a href="#" data-dismiss="modal"  class="btn btn-primary btn-block"> <i class="icon-remove"></i>  Close</a>
    </div>
</div>
