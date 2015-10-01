{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


<fieldset class="scheduler-border">
    <legend class="scheduler-border text-info">Send Message for query <strong class="text-danger">{{ucwords(strtolower($query->query_code." (".$query->fromDepartment->department_name.")"))}}</strong> issue logged  on {{date("d M, Y H:i",strtotime($query->reporting_Date))}} </legend>
    {!! Form::open(array('url'=>'queries/message','role'=>'form','id'=>'queryMessageForm')) !!}

    <div class="form-group">
        <label for="current_update"></label>
        <textarea class="ckeditor form-control" name="message" rows="10" id="message"></textarea>
    </div>
    <div class="row">
        <div class="col-md-8 pull-left" id="output"></div>
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-2 pull-right">
            <input type="hidden" name="query_id" id="query_id" value="{{$query->id}}">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
</fieldset>

{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#queryMessageForm").validate({
        rules: {
            message: "required"

        },
        messages: {
            message: "Please enter Message"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#queryMessageForm').serializeArray();
            var formURL = $('#queryMessageForm').attr("action");
            $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                            console.log(data);
                            //data: return data from server
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
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                            }, 2000);
                        }
                    });
        }
    });

</script>
