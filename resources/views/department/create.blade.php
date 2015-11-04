{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Basic Department details</legend>
    {!! Form::open(array('url'=>'departments/create','role'=>'form','id'=>'DepartmentFormUN')) !!}
    <div class="form-group">
                                    <label for="status">Branch</label>
                                    <select name="branch_id" class="form-control" id="branch_id">
                                        <option selected value="">----</option>
                                        @foreach(\App\Branch::all() as $br)
                                            <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                                            @endforeach
                                    </select>
                        </div>
    <div class="form-group">
                            <label for="branch_Name">Department Name</label>
                            <input type="text" class="form-control" id="department_name" name="department_name" value="{{old('branch_Name')}}" placeholder="Enter Department Name">
                        </div>
    <div class="form-group">
                            <label for="description">Descriptions</label>
                            <textarea class="form-control" id="description" rows="8" name="description">{{old('description')}}</textarea>
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
                                <div class="col-md-4">
                                    <label for="receive_query">Receive support queries?</label>
                                    <select name="receive_query" class="form-control" id="status">
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="download_check">Appear in download?</label>
                                    <select name="download_check" class="form-control" id="status">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
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
</fieldset>
{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#branch").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                $("#department").html(data);
            });

        }else{$("#department").html("<option value=''>----</option>");}
    });

    $("#DepartmentFormUN").validate({
        rules: {
            branch_id: "required",
            status: "required",
            department_name: "required"
        },
        messages: {
            branch_id: "Please select name",
            status: "Please enter status",
            department_name: "Please enter department name"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#DepartmentFormUN').serializeArray();
            var formURL = $('#DepartmentFormUN').attr("action");
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
                                location.reload();
                                $("#output").html("");
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