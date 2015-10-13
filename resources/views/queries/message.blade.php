{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}
<link href="{{asset("assets/jquery-file-upload/css/jquery.fileupload-ui.css")}}" rel="stylesheet" type="text/css" >


<section class="panel">
    <header class="panel-heading">
        <h3 class="text-info"> <strong><i class="fa fa- fa-tasks"></i>  QUERY DETAILS </strong></h3>
    </header>
    <div class="panel-body">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="branches">
                    <thead>
                    <tr>
                        <th>Query code</th>
                        <th>Reported date</th>
                        <th>Reported by</th>
                        <th>From department</th>
                        <th>To Department</th>
                        <th>Person assigned </th>
                        <th>Date assigned</th>
                        <th>Critical</th>
                        <th>Module</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{$query->query_code}}</td>
                        <td>{{date("d M, Y H:i",strtotime($query->reporting_Date))}}</td>
                        <td>{{$query->user->first_name.' '.$query->user->last_name}}</td>
                        <td>{{$query->toDepartment->department_name}}</td>
                        <td>{{$query->fromDepartment->department_name}}</td>
                        @if($query->assignment != null && $query->assignment !="")
                            <td style="background-color:#78CD51; color: #FFF;">{{$query->assignment->user->first_name.' '.$query->assignment->user->last_name}}</td>
                            <td>{{$query->assignment->assigned_date_time}}</td>
                        @else
                            <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                            <td></td>
                        @endif
                        <td>{{$query->critical_level}}</td>
                        <td>{{$query->module->module_name}}</td>
                        <td>{{$query->status}}</td>
                    </tr>
                    <tr>
                        <th colspan="10">Query Description</th>
                    </tr>
                    <tr>
                        <td colspan="10"><?php echo $query->description;?></td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        <span class="text-info"> <strong><i class="fa fa- fa-envelope-square"></i>  QUERY DETAILS UPDATES </strong></span>
    </header>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12 col-sm-12">
    {!! Form::open(array('url'=>'queries/message','role'=>'form','id'=>'queryMessageForm','files'=>true)) !!}

    <div class="form-group">
        <label for="current_update">Updates description</label>
        <textarea class="ckeditor form-control" name="message" rows="10" id="message"></textarea>
    </div>
    <div class="form-group">
      <span class="btn green fileinput-button">
        <i class="fa fa-plus fa fa-white"></i>
        <span>Attachment</span>
         <input type="file" id="reference_file" name="reference_file">
          </span>
        <p class="help-block"><input type="checkbox" value="1" id="referencecheck" name="referencecheck"  @if(old('referencecheck')) checked @endif> <label for="file_upload">Tick here to attach file for reference</label></p>
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
    </div>
    {!! Form::close() !!}
    </div>
    </div>
    </section>
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
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#queryMessageForm').serialize();
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
                            $("#output").html(data);
                            setTimeout(function() {
                                //jQuery.noConflict();
                                //$("#myModal").modal("hide");
                            }, 5000);
                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                               // jQuery.noConflict();
                               // $("#myModal").modal("hide");
                            }, 5000);
                        }
                    });
        }
    });
    $(function()
    {
        // Variable to store your files
        var files;

        // Add events
        $('input[type=file]').on('change', prepareUpload);
        $('form').on('submit', uploadFiles);

        // Grab the files and set them to our variable
        function prepareUpload(event)
        {
            files = event.target.files;
        }

        // Catch the form submit and upload the files
        function uploadFiles(event)
        {
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening

            // START A LOADING SPINNER HERE

            // Create a formdata object and add the files
            var data = new FormData();
            $.each(files, function(key, value)
            {
                data.append(key, value);
            });

            $.ajax({
                url: 'submit.php?files',
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function(data, textStatus, jqXHR)
                {
                    if(typeof data.error === 'undefined')
                    {
                        // Success so call function to process the form
                        submitForm(event, data);
                    }
                    else
                    {
                        // Handle errors here
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    // STOP LOADING SPINNER
                }
            });
        }

        function submitForm(event, data)
        {
            // Create a jQuery object from the form
            $form = $(event.target);

            // Serialize the form data
            var formData = $form.serialize();

            // You should sterilise the file names
            $.each(data.files, function(key, value)
            {
                formData = formData + '&filenames[]=' + value;
            });

            $.ajax({
                url: 'submit.php',
                type: 'POST',
                data: formData,
                cache: false,
                dataType: 'json',
                success: function(data, textStatus, jqXHR)
                {
                    if(typeof data.error === 'undefined')
                    {
                        // Success so call function to process the form
                        console.log('SUCCESS: ' + data.success);
                    }
                    else
                    {
                        // Handle errors here
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                },
                complete: function()
                {
                    // STOP LOADING SPINNER
                }
            });
        }
    });

</script>
