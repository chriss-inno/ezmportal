{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


    {!! Form::open(array('url'=>'inventory','role'=>'form','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic Item details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="type_id">Item Type</label>
                <select class="form-control"  id="type_id" name="type_id">
                    <option value="">----</option>
                    <?php $inventories=\App\InventoryType::all();?>
                    @foreach($inventories as $inv)
                        <option value="{{$inv->id}}">{{$inv->type_name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" id="item_name" name="item_name" value="{{old('item_name')}}" placeholder="Enter Item Name ie Computer name">
    </div>
    <div class="form-group">
        <label for="item_name">Username</label>
        <input type="text" class="form-control" id="user_name" name="user_name" value="{{old('user_name')}}" placeholder="Enter Username">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="machine_model">Machine Model</label>
                <input type="text" class="form-control" id="machine_model" name="machine_model" value="{{old('machine_model')}}" placeholder="Enter Item Model">
            </div>
            <div class="col-md-4">
                <label for="serial_number">Serial Number</label>
                <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{old('serial_number')}}" placeholder="Enter Serial Number">
            </div>
            <div class="col-md-4">
                <label for="ip_address">IP Address</label>
                <input type="text" class="form-control" id="item_name" name="ip_address" value="{{old('ip_address')}}" placeholder="Enter IP Address ie 192.168.1.1">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="usb">USB</label>
                <select class="form-control"  id="usb" name="usb">
                    <option value="">----</option>
                    <option value="N/A">N/A</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>

            </div>
            <div class="col-md-6">
                <label for="antivirus">Antivirus</label>
                <select class="form-control"  id="antivirus" name="antivirus">
                    <option value="">----</option>
                    <option value="N/A">N/A</option>
                    <option value="Yes">Done</option>
                </select>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label for="description">Item Descriptions</label>
        <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Item Location</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="branch_id">Branch</label>
                <select class="form-control"  id="branch_id" name="branch_id">
                    <option value="">----</option>
                    <?php $branches=\App\Branch::all();?>
                    @foreach($branches as $br)
                        <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="department_id">Department</label>
                <select class="form-control"  id="department_id" name="department_id">
                    <option value="">----</option>
                </select>
            </div>
        </div>
    </div>
</fieldset>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    <option selected value="">----</option>
                    <option value="Working">Working</option>
                    <option value="Not Working">Not Working</option>
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
