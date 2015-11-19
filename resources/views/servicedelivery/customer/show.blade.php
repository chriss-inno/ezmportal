{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

{!! Form::open(array('url'=>'servicedelivery/create','role'=>'form','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Customer Details</legend>
    <div class="form-group">
        <label for="company_name">Company Name</label>
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}" placeholder="Enter company name ">
    </div>
    <div class="form-group">
        <label for="contact_person">Contact Person</label>
        <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{old('contact_person')}}" placeholder="Enter contact person">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" placeholder="Enter address">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-lg-8 col-xs-8">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter email">
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="Enter phone">
            </div>
        </div>

    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    <option selected value="">Select Status</option>
                    <option  value="Enabled">Enabled</option>
                    <option  value="Disabled">Disabled</option>
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
            company_name: "required",
            contact_person: "required",
            status: "required"

        },
        messages: {
            company_name: "Please enter company name",
            contact_person: "Please enter contact person",
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
