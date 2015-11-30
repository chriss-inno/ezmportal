{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

{!! Form::open(array('url'=>'servicedelivery/updates','role'=>'form','id'=>'InventoryForm')) !!}
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
                <th>Received By</th>
                <th>Date Issued</th>
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
                @if($issue->received_by != null && $issue->received_by !="" )
                    <td>{{$issue->received_by}}</td>
                @else
                    <td></td>
                @endif
                @if($issue->date_created != null && $issue->date_created !="" )
                    <td>{{date("d,M Y",strtotime($issue->date_created))}}</td>
                @else
                    <td></td>
                @endif
                @if($issue->department_id != null && $issue->department_id !="" )
                    <td>{{$issue->department->department_name}}</td>
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
                <th colspan="8">Issue description</th>
            </tr>
            <tr>
                <td colspan="8">{{$issue->description}}</td>
            </tr>
            </tbody>
      </table>
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Attend/Update Details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <label for="description"><strong>Descriptions</strong></label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>

            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
                <label for="remarks"><strong>Remarks</strong></label>
               <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks">
            </div>
            <div class="col-md-5 col-sm-5 col-xs-5 col-lg-5">
                <label for="status_id"><strong>Status</strong></label>
                <select name="status_id" class="form-control" id="status_id">
                    @if($issue->status_id != null && $issue->status_id !="")
                        <option value="{{$issue->status->id}}" selected>{{$issue->status->status_name}}</option>
                    @else
                        <option selected value="">Select Status</option>
                    @endif
                    <?php $sdstatus=\App\SDStatus::all();?>
                    @foreach($sdstatus as $rc)
                        <option value="{{$rc->id}}">{{$rc->status_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</fieldset>
<div class="form-group">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <input type="hidden" value="{{$issue->id}}" id="issue_id" name="issue_id">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        <div class="col-md-7 col-sm-7 col-xs-7 pull-left" id="output">

        </div>
    </div>
</div>
{!! Form::close() !!}



{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#InventoryForm").validate({
        rules: {
            description: "required",
            status_id: "required"

        },
        messages: {
            description: "Please enter description",
            status_id: "Please select status"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#InventoryForm').serializeArray();
            var formURL = $('#InventoryForm').attr("action");
            $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                            console.log(data);
                            setTimeout(function() {
                                $("#output").html("");
                                location.reload();
                                jQuery.noConflict();
                                $("#myModal").modal("hide");
                            }, 2000);
                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                            }, 2000);
                        }
                    });
        }
    });

</script>
