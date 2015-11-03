{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}
<?php
$current_path= "";
$archive_path= "";
$monthly_path=  "";
$custom_path= "";
$archive_start_date= "";
$archive_end_date= "";
  if(count($repser) > 0 && $repser !=null && $repser !="")
        {
            $current_path= $repser->current_path;
            $archive_path=$repser->archive_path;
            $monthly_path= $repser->monthly_path;
            $custom_path=$repser->custom_path;
            $archive_start_date=$repser->archive_start_date;
            $archive_end_date=$repser->archive_end_date;

        }
?>
{!! Form::open(array('url'=>'portal/reports/setup','role'=>'form','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic Reports settings</legend>
    <div class="form-group">
        <label for="current_path">Path for current used reports</label>
        <input type="text" class="form-control" id="current_path" name="current_path" value="{{$current_path}}" placeholder="Please enter path for current used reports">
    </div>
    <div class="form-group">
        <label for="archive_path">Path for archive reports</label>
        <input type="text" class="form-control" id="archive_path" name="archive_path" value="{{$archive_path}}" placeholder="Please enter path for archive reports">
    </div>
    <div class="form-group">
        <label for="monthly_path">Path for monthly reports</label>
        <input type="text" class="form-control" id="monthly_path" name="monthly_path" value="{{$monthly_path}}" placeholder="Please enter path for monthly reports">
    </div>
    <div class="form-group">
        <label for="custom_path">Path for customized reports</label>
        <input type="text" class="form-control" id="custom_path" name="custom_path" value="{{$custom_path}}" placeholder="Please enter path for customized reports">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                <label for="archive_date">Report Archive start  date</label>
                <input type="text" class="form-control" id="archive_start_date" name="archive_start_date" value="{{$archive_start_date}}" placeholder="Please enter  archive date">

            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                <label for="archive_date">Report Archive end  date</label>
                <input type="text" class="form-control" id="archive_end_date" name="archive_end_date" value="{{$archive_end_date}}" placeholder="Please enter  archive date">
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
            archive_path: "required",
            current_path: "required",
            monthly_path: "required",
            custom_path: "required",
            archive_start_date: {
                required: true,
                date: true
            },
            archive_end_date: {
                required: true,
                date: true
            }

        },
        messages: {
            archive_path: "Please enter path for archive reports",
            current_path: "Please enter path for current used reports",
            monthly_path: "Please enter path for monthly reports",
            custom_path: "Please enter path for customized reports",
            archive_start_date: {
                required: "Please enter  archive start date",
                date: "Please enter a valid date"
            },
            archive_end_date: {
                required: "Please enter  archive end date",
                date: "Please enter a valid date"
            }
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
                            $("#output").html(data);
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
