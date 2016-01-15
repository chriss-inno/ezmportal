<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="adv-table">
            <table  class="display table table-bordered table-striped" id="branches">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Recurrence patten</th>
                    <th>Input By</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$reminder->rm_title}}</td>
                        <td>{{$reminder->start_date}}</td>
                        <td>{{$reminder->end_date}}</td>
                        <td>{{$reminder->recurrence_pattern}}</td>
                        @if($reminder->user_id !="")
                            <td>{{$reminder->user->first_name." ".$reminder->user->last_name}}</td>
                        @else
                            <td></td>
                        @endif
                        @if($reminder->status =="Enabled")
                            <td  align="center">
                                <a  href="#" title="Details" class=" btn btn-success btn-xs"><i class="fa fa-eye"> {{$reminder->status}}</i></a>
                            </td>
                        @else
                            <td  align="center">
                                <a  href="#" title="Details" class=" btn btn-danger btn-xs"><i class="fa fa-eye"> {{$reminder->status}}</i></a>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th colspan="6">Description</th>
                    </tr>
                    <tr>
                        <td colspan="6">{{$reminder->description}}</td>
                    </tr>
                    <tr>
                        <th colspan="6">Reminder emails</th>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <ol>
                             @foreach($reminder->emails as $eml)
                                  <li>{{$eml->email}}</li>
                                 @endforeach
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 30px">
    <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
        <a href="#" data-dismiss="modal" class="btn btn-primary btn-block"> <i class="fa fa-remove"></i>  Close</a>
    </div>
</div>