{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


{!! Form::open(array('url'=>'sms/dispatch/edit','role'=>'form','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic group details</legend>

    <div class="form-group">
        <label for="list_name">Group Name</label>
        <input type="text" class="form-control" id="list_name" name="list_name" value="{{$distribution->list_name}}" placeholder="Enter group name">
    </div>
    <div class="form-group">
        <label for="descriptions">Descriptions</label>
        <textarea class="form-control" id="descriptions" name="descriptions">{{$distribution->descriptions}}</textarea>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    @if($distribution->status != null && $distribution->status != "")
                    <option selected value="{{$distribution->status}}">{{$distribution->status}}</option>
                    @else
                        <option selected value="">----</option>
                        @endif
                    <option value="Enabled">Enabled</option>
                    <option value="Disabled">Disabled</option>
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
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
            <input type="hidden" name="id" id="id" value="{{$distribution->id}}">
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
            list_name: "required",
            status: "required"

        },
        messages: {
            list_name: "Please enter group name",
            status: "Please select status"
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
                            if(data =="Saved successfully")
                            {
                                setTimeout(function() {
                                    $("#output").html("");
                                    location.reload();
                                    jQuery.noConflict();
                                    $("#myModal").modal("hide");
                                }, 2000);
                            }

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