<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Customer Issue Summary</legend>
    <div class="form-group">
        <table  class="display table table-bordered table-striped" id="branches">
            <thead>
            <tr>
                <th>ISSUE #</th>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>Product Type</th>
                <th>Product Details</th>
                <th>Received By</th>
                <th>Date/Time Reported</th>
                <th>Department Responsible</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$issue->issues_number}}</td>
                <td>{{$issue->customer->company_name}}</td>
                <td>{{$issue->customer->contact_person}}</td>
                @if($issue->product_id != null && $issue->product_id !="" )
                    <td>{{$issue->producttype->product_type}}</td>
                @else
                    <td></td>
                @endif
                @if($issue->product_details_id != null && $issue->product_details_id !="" )
                    <td>{{$issue->producttype->product_type}}</td>
                @else
                    <td></td>
                @endif
                @if($issue->received_by != null && $issue->received_by !="" )
                    <td>{{$issue->received_by}}</td>
                @else
                    <td></td>
                @endif
                @if($issue->date_created_tmt != null && $issue->date_created_tmt !="" )
                    <td>{{date("d,M Y H:i",strtotime($issue->date_created_tmt))}}</td>
                @else
                    <td></td>
                @endif
                @if($issue->department_id != null && $issue->department_id !="" )
                    <td>{{$issue->department_id}}</td>
                @else
                    <td></td>
                @endif
                @if($issue->status_id != null && $issue->status_id !="" )
                    <td>{{$issue->status->status_name}}</td>
                @else
                    <td></td>
                @endif
            </tr>
            <tr>
                <th colspan="9">Root Cause</th>
            </tr>
            <tr>
                <td colspan="9">{{$issue->root_cause}}</td>
            </tr>
            <tr>
                <th colspan="9">Issue description</th>
            </tr>
            <tr>
                <td colspan="9">{{$issue->description}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <p><h4 class="text-info"><strong>Issue updates</strong></h4></p>
            <div class="timeline-messages">
                @foreach($issue->progress as $message)
                        <!-- Comment -->
                <div class="msg-time-chat">

                    <div class="message-body msg-in">
                        <span class="arrow"></span>
                        <div class="text">
                            <p class="attribution"><a href="#">{{$message->user_id}}</a> at {{date('h:i A',strtotime($message->progress_date_tm))}}, {{date("l, jS M Y",strtotime($message->progress_date_tm))}}</p>
                            <p>{{$message->issue_progress}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                        <!-- /comment -->
            </div>
        </div>
    </div>

</fieldset>
<div class="form-group">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i> Close</a>
        </div>
    </div>
</div>
