{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


{!! Form::open(array('url'=>'queryemails','role'=>'form','id'=>'InventoryForm')) !!}

<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Email setting details</legend>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email address" >
    </div>
    <div class="form-group">

                <label for="department_id">Department</label>
                <select class="form-control"  id="department_id" name="department_id">
                    @if(old('department_id'))
                        <?php $depa=\App\Department::find(old('department_id'));?>
                        <option value="{{$depa->id}}">{{$depa->department_name}}</option>
                    @else
                        <option value="">----</option>
                    @endif
                    <?php $departments=\App\Department::where('receive_query','=','1')->get();?>
                    @foreach($departments as $de)
                        <option value="{{$de->id}}">{{$de->department_name}}</option>
                    @endforeach
                </select>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    <option selected value="">----</option>
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
            department_id: "required",
            status: "required"

        },
        messages: {
            email: {
                required: "Please enter email address",
                email: "Please enter valid email"
            },
            department_id: "Please select department",
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
