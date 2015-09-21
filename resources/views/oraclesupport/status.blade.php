{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}


<fieldset class="scheduler-border">
    <legend class="scheduler-border text-info">Update status for <strong class="text-danger">{{ucwords(strtolower($issues->issue_title))}}</strong> issue logged  on {{$issues->date_opened}} </legend>
    {!! Form::open(array('url'=>'support/oracle/status','role'=>'form','id'=>'unitForm')) !!}

    <div class="form-group">
        <label for="current_update"></label>
        <textarea class="ckeditor form-control" name="current_update" rows="10"></textarea>
    </div>
   <div class="row">
       <div class="col-md-8 pull-left" id="output"></div>
       <div class="col-md-2 pull-right">
           <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
       </div>
       <div class="col-md-2 pull-right">
           <input type="hidden" name="issue_id" id="issue_id" value="{{$issues->id}}">
           <button type="submit" class="btn btn-primary btn-block">Submit</button>
       </div>
   </div>
    {!! Form::close() !!}
</fieldset>

{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#unitForm").validate({
        rules: {
            current_update: "required"

        },
        messages: {
            current_update: "Please enter update contents"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#unitForm').serializeArray();
            var formURL = $('#unitForm').attr("action");
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
