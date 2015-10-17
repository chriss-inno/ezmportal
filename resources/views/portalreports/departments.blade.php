{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


{!! Form::open(array('url'=>'portal/reports/departments','role'=>'form','id'=>'InventoryForm')) !!}

<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Reports Departments</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                      <th>SNO</th>
                      <th>Attach report</th>
                      <th>Department</th>
                      <th>Branch</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $departments=\App\Department::all(); $csn=1?>
                    @foreach($departments as $dp)

                      <tr>
                          <td>{{$csn++}}</td>
                          <td><input type="checkbox" value="{{$dp->id."##".$dp->branch->id}}" class="form-control" name="department[]" id="checkb{{$csn}}"
                                     @if(count(\App\ReportDepartment::where('report_id','=',$report->id)->where('department_id','=',$dp->id)->get()) >0) checked @endif></td>
                          <td><label for="checkb{{$csn}}">{{$dp->department_name}}</label></td>
                          <td><label for="checkb{{$csn}}">{{$dp->branch->branch_Name}} </label></td>

                      </tr>
                    @endforeach
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
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <input type="hidden" name="report_id" value="{{$report->id}}">
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
                            $("#output").html(data);
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
