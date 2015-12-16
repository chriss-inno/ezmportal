{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

{!! Form::open(array('url'=>'servicedelivery/create','role'=>'form','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Customer Details</legend>
    <div class="form-group">
        <label for="company_id">Company Name</label>
        <select class="form-control"  id="company_id" name="company_id">
            <option value="">Select Company</option>
            <?php $customers=\App\SDCustomer::all();?>
            @foreach($customers as $customer)
                <option value="{{$customer->id}}">{{$customer->company_name}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">
        <label for="contact_person">Contact Person</label>
        <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{old('contact_person')}}" placeholder="Enter contact person" readonly>
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Issues Details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="product_id">Product Type</label>
                <select class="form-control"  id="product_id" name="product_id">
                    <option value="">Select Product Type</option>
                    <?php $products=\App\SDProduct::all();?>
                    @foreach($products as $pr)
                        <option value="{{$pr->id}}">{{$pr->product_type}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="product_details_id">Product Details</label>
                <select class="form-control"  id="product_details_id" name="product_details_id">
                    <option value="">Select Product details</option>
                    <?php $sdproductd=\App\SDProductDetails::all();?>
                    @foreach($sdproductd as $rc)
                        <option value="{{$rc->id}}">{{$rc->details_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="received_by">Received By</label>
        <input type="text" class="form-control" id="received_by" name="received_by" value="{{old('received_by')}}" placeholder="Enter received_by">
    </div>

<div class="form-group">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <label for="mode_id">Mode of receipt</label>
            <select class="form-control"  id="mode_id" name="mode_id">
                <option value="">Select Mode of Receipt </option>
                <?php $sdmodes=\App\SDReceiptMode::all();?>
                @foreach($sdmodes as $rc)
                    <option value="{{$rc->id}}">{{$rc->mode_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <label for="status_id">Status</label>
            <select name="status_id" class="form-control" id="status_id">
                <option selected value="">Select Status</option>
                <?php $sdstatus=\App\SDStatus::all();?>
                @foreach($sdstatus as $rc)
                    <option value="{{$rc->id}}">{{$rc->status_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="description">Issue Descriptions</label>
    <textarea class="form-control" id="description" name="description" >{{old('description')}}</textarea>
</div>
<div class="form-group">
        <label for="department_id">Department Responsible</label>
        <select name="department_id" class="form-control" id="department_id">
            <option selected value="">Select Department</option>
            <?php $depatments=\App\Department::all();?>
            @foreach($depatments as $rc)
                <option value="{{$rc->department_name}}">{{$rc->department_name}}</option>
            @endforeach
        </select>
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
    $("#company_id").change(function () {


        var id1 = this.value;



        if(id1 != "")
        {
            $.get("<?php echo url('getsdcontact') ?>/"+id1,function(data){
                document.getElementById('contact_person').value=data;
            });

        }else{$("#contact_person").html("");}
    });

    $("#InventoryForm").validate({
        rules: {
            company_id: "required",
            product_id: "required",
            product_details_id: "required",
            mode_id: "required",
            description: "required",
            department_id: "required",
            received_by: "required",
            status_id: "required"

        },
        messages: {
            company_id: "Please enter company name",
            product_id: "Please select product type",
            product_details_id: "Please select product details",
            mode_id: "Please select receipt mode",
            description: "Please enter description",
            department_id: "Please select department",
            received_by: "Please enter received by",
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
