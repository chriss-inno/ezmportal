
{!! Form::open(array('url'=>'modules','role'=>'form','id'=>'moduleFRM')) !!}
<fieldset class="scheduler-border" style="margin-top: 10px;">
    <legend class="scheduler-border" style="color:#005DAD">Basic Module details</legend>
    <div class="form-group">
        <label for="module_name">Module Name</label>
        <input type="text" class="form-control" id="module_name" name="module_name" value="{{old('module_name')}}" placeholder="Enter Module Name">
    </div>
    <div class="form-group">
        <label for="description">Module Descriptions</label>
        <textarea class="form-control" id="description" rows="8" name="description">{{old('description')}}</textarea>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="branch">Branch</label>
                <select class="form-control"  id="branch" name="branch">
                    <option value="">----</option>
                    <?php $branches=\App\Branch::all();?>
                    @foreach($branches as $br)
                        <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="department">Department</label>
                <select class="form-control"  id="department" name="department">
                    <option value="">----</option>
                </select>
            </div>
        </div>
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
</fieldset>
{!! Form::close() !!}
{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $(document).ready(function() {
        jQuery.noConflict();
        $("#branch").change(function () {
            var id1 = this.value;
            if(id1 != "")
            {
                $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                    $("#department").html(data);
                });

            }else{$("#department").html("<option value=''>----</option>");}
        });
        jQuery.noConflict();
        $("#moduleFRM").validate({
            rules: {
                module_name: "required",
                branch: "required",
                department: "required",
                status: "required"

            },
            messages: {
                module_name: "Please enter module name",
                branch: "Please select branch",
                department: "Please select department",
                status: "Please enter  first name"
            },
            submitHandler: function(form) {
                $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
                var postData = $('#moduleForm').serializeArray();
                var formURL = $('#moduleForm').attr("action");
                $.ajax(
                        {
                            url : formURL,
                            type: "POST",
                            data : postData,
                            success:function(data)
                            {
                                console.log(data);
                                setTimeout(function() {
                                    $("#output").html(data);
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
    });


</script>
