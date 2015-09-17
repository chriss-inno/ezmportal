{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Basic Service details</legend>
    {!! Form::open(array('url'=>'services/create','role'=>'form','id'=>'serviceForm')) !!}
    <div class="form-group">
        <label for="unit_name">Service Name</label>
        <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter service name" required>
    </div>
    <div class="form-group">
        <label for="unit_name">Service Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    <option selected value="">----</option>
                    <option value="enabled">enabled</option>
                    <option value="disabled">disabled</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-8 pull-left" id="output"></div>
    <div class="col-md-2 pull-right">
        <button type="submit" class="btn btn-primary  btn-block">Submit </button>
    </div>
    <div class="col-md-2 pull-right">
        <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
    </div>


    {!! Form::close() !!}
</fieldset>
<div class="form-group">
    <div class="col-md-2 pull-right" style="padding-bottom: 10px;">

    </div>
</div>
{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#serviceForm").validate({
        rules: {
            service_name: "required",
            status: "required"
        },
        messages: {
            service_name: "Please enter service name",
            status: "Please select status"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#serviceForm').serializeArray();
            var formURL = $('#serviceForm').attr("action");
            $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                            console.log(data);
                            //data: return data from server
                            document.getElementById('service_name').value="";
                            document.getElementById('description').value="";
                            $("#output").html(data);


                            setTimeout(function() {

                                $("#output").html("");
                                jQuery.noConflict();
                                $("#myModal").modal("hide");
                                $("#serviceList").load("<?php echo url('services/list')?>");
                            }, 2000);
                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");
                            $("#serviceList").load("<?php echo url('services/list')?>");
                            setTimeout(function() {
                                $("#output").html("");
                            }, 2000);
                        }
                    });
        }
    });

</script>
