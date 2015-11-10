{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


{!! Form::open(array('url'=>'portal/reports/edit','role'=>'form','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic Reports details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="report_type">Report Type</label>
                <select class="form-control"  id="report_type" name="report_type">
                    @if($report->report_type !="" && $report->report_type != null )
                        <option value="{{$report->report_type}}" selected>{{$report->report_type}}</option>
                        @endif
                    <option >N/A</option>
                    <option value="Daily">Daily</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Custom">Custom</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="report_name">Report Current Name</label>
        <input type="text" class="form-control" id="report_name" name="report_name" value="{{$report->report_name}}" placeholder="Enter report name">
    </div>
    <div class="form-group">
        <label for="other_name">Old name</label>
        <input type="text" class="form-control" id="other_name" name="other_name" value="{{$report->other_name}}" placeholder="Enter other name">
    </div>

    <div class="form-group">
        <label for="description">Report Descriptions</label>
        <textarea class="form-control" id="description" name="description">{{$report->description}}</textarea>
    </div>
</fieldset>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
                @if($report->status !="" && $report->status != null )
                    <option value="{{$report->status}}" selected>{{$report->status}}</option>
                @endif
                <option  value="">----</option>
                <option value="In Use">In Use</option>
                <option value="Not In use">Not In use</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
            <input type="hidden" value="{{$report->id}}" name="report_id" id="report_id">
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

    $("#branch_id").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                $("#department_id").html(data);
            });

        }else{$("#department_id").html("<option value=''>----</option>");}
    });

    $("#InventoryForm").validate({
        rules: {
            type_id: "required",
            ip_address: "required",
            item_name: "required",
            machine_model: "required",
            branch_id: "required",
            status: "required",
            serial_number: "required",
            usb: "required",
            antivirus: "required"

        },
        messages: {
            type_id: "Please select item type",
            item_name: "Please enter module name",
            ip_address: "Please ip address",
            machine_model: "Please enter machine model",
            branch_id: "Please select branch",
            status: "Please select status",
            usb: "Please select usb status",
            antivirus: "Please select antivirus status",
            serial_number: "Please enter  serial number"
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
