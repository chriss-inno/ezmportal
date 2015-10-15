<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic Reports details</legend>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="branches">
                    <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Other name</th>
                        <th>Report Type</th>
                        <th>Status</th>
                        <th>Input By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($report !="" && $report !=null)
                            <tr>
                                <td>{{$report->report_name}}</td>
                                <td>{{$report->other_name}}</td>
                                <td>{{$report->report_type}}</td>
                                <td>{{$report->status}}</td>
                                <td>{{$report->input_by}}</td>
                            </tr>
                            <tr>
                                <th colspan="6">Report descriptions</th>
                            </tr>
                            <tr>
                                <th colspan="6"><?php echo $report->description;?></th>
                            </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border text-info"> <i class="fa fa-info"></i> Report is current used by</legend>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="branches">
                    <thead>
                    <tr>
                        <th>SNO</th>
                        <th>Department name</th>
                        <th>Branch Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $c=1; ?>
                    @if($report !="" && $report !=null)
                        <tr>
                            <td>{{$c++}}</td>
                            <td>{{$report->other_name}}</td>
                            <td>{{$report->report_type}}</td>

                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</fieldset>

<div class="form-group">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>

    </div>
</div>

