{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


{!! Form::open(array('url'=>'queriesstatus','role'=>'form','id'=>'queriesstatusForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic query status details</legend>

    <div class="form-group">
        <label for="item_name">Status Name</label>
        <input type="text" class="form-control" id="status_name" name="status_name" value="{{old('status_name')}}" placeholder="Enter Enabler Name">
    </div>
    <div class="form-group">
        <label for="description">Descriptions</label>
        <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    @if(old('status') !="")
                        <option selected value="{{old('status')}}">{{old('status')}}</option>
                    @else
                        <option selected value="">----</option>
                    @endif
                    <option value="Enabled">Enabled</option>
                    <option value="Disable">Disable</option>
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



    $("#queriesstatusForm").validate({
        rules: {
            status_name: "required",
            status: "required"
        },
        messages: {
            status_name: "Please enter status name",
            status: "Please select status"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#queriesstatusForm').serializeArray();
            var formURL = $('#queriesstatusForm').attr("action");
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
