{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


{!! Form::open(array('url'=>'servicedelivery/email/edit','role'=>'form','id'=>'InventoryForm')) !!}

<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Email setting details</legend>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email address"
               @if($email->email !="" && $email->email != null) value="{{$email->email}}" @endif>
    </div>
    <div class="form-group">
        <label for="display_name">Display name</label>
        <input type="text" class="form-control" name="display_name" id="display_name" @if($email->display_name !="" && $email->display_name != null) value="{{$email->display_name}}" @endif >
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    @if($email->status != null && $email->status != "")
                        <?php $depa=\App\Department::find(old('department_id'));?>
                        <option value="{{$email->status}}" selected>{{$email->status}}</option>
                    @else
                        <option value="" selected >----</option>
                    @endif
                    <option value="Active">Active</option>
                    <option value="In Active">In Active</option>
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
            <input type="hidden" value="{{$email->id}}" name="id" id="id">
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
            email: {
                required: true,
                email: true
            },
            status: "required"

        },
        messages: {
            email: {
                required: "Please enter email address",
                email: "Please enter valid email"
            },
            status:"Please select email status"
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
                            $("#output").html("<h3 class='text-primary'>"+data+"</h3>");
                            if(data == "Email saved successfully")
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
