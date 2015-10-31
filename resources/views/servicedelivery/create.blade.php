{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

{!! Form::open(array('url'=>'servicedelivery/create','role'=>'form','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Customer Details</legend>
    <div class="form-group">
        <label for="item_name">Customer Name</label>
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}" placeholder="Enter customer name">
    </div>
    <div class="form-group">
        <label for="item_name">Contact Person</label>
        <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{old('contact_person')}}" placeholder="Enter contact person">
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Issues Details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="branch_id">Product Type</label>
                <select class="form-control"  id="product_id" name="product_id">
                    <option value="">Select Product Type</option>
                    <?php $products=\App\SDProduct::all();?>
                    @foreach($products as $pr)
                        <option value="{{$pr->id}}">{{$pr->type}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="mode_id">Mode of receipt</label>
                <select class="form-control"  id="mode_id" name="mode_id">
                    <option value="">Select Mode of Receipt </option>
                    <?php $sdmodes=\App\SDReceiptMode::all();?>
                    @foreach($sdmodes as $rc)
                        <option value="{{$rc->id}}">{{$rc->mode_name}}</option>
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
        <div class="col-md-12">
            <label for="status">Status</label>
            <select name="status_id" class="form-control" id="status_id">
                <option selected value="">Select Status</option>
                <option value="Working">Working</option>
                <option value="Not Working">Not Working</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="description">Issue Descriptions</label>
    <textarea class="form-control" id="description" name="description" >{{old('description')}}</textarea>
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
