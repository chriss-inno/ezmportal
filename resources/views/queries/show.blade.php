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
                                    <th>Reported date</th>
                                    <th>Reported by</th>
                                    <th>To department</th>
                                    <th>From Department</th>
                                    <th>Person assigned </th>
                                    <th>Date assigned</th>
                                    <th>Critical</th>
                                    <th>Module</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>{{$query->query_code}}</td>
                                    <td>{{date("d M, Y H:i",strtotime($query->reporting_Date))}}</td>
                                    <td>{{$query->user->first_name.' '.$query->user->last_name}}</td>
                                    <td>{{$query->toDepartment->department_name}}</td>
                                    <td>{{$query->fromDepartment->department_name}}</td>
                                    @if($query->assignment != null && $query->assignment !="")
                                        <td style="background-color:#78CD51; color: #FFF;">{{$query->assignment->user->first_name.' '.$query->assignment->user->last_name}}</td>
                                        <td>{{$query->assignment->assigned_date_time}}</td>
                                    @else
                                        <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                        <td></td>
                                    @endif
                                    <td>{{$query->critical_level}}</td>
                                    <td>{{$query->module->module_name}}</td>
                                    <td>{{$query->status}}</td>
                                </tr>
                                <tr>
                                    <th colspan="10">Query Description</th>
                                </tr>
                                <tr>
                                    <td colspan="10"><?php echo $query->description;?>
                                        @if($query->reference_file != null && $query->reference_file !="")
                                            [ <a href="{{url('uploads')}}/{{$query->reference_file}}"><i class="fa fa-download text-danger"></i> Get attachment</a> ]
                                        @endif</td>
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
                                                    <p class="attribution"> @if($message->mSender != null && $message->mSender != "")
                                                            <a href="#">{{$message->mSender->first_name.' '.$message->mSender->last_name}}</a> @endif at {{date('h:i A',strtotime($message->created_at))}}, {{date("l, jS F Y",strtotime($message->created_at))}}</p>

                                                        <p>{{$message->message}}
                                                        @if($message->reference_file != null && $message->reference_file !="")
                                                            [ <a href="{{url('uploads/messages')}}/{{$message->reference_file}}"><i class="fa fa-download text-danger"></i> Get attachment</a> ]
                                                        @endif
                                                    </p>
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
