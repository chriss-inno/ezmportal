{!! Form::open(array('url'=>'users/unit','role'=>'form','id'=>'adminDepartmentForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Department details</legend>
    <div class="form-group">
        <label for="branch">Branch</label>
        <select class="form-control"  id="branch" name="branch">
            <?php $branches=\App\Branch::all();?>

            @if(old('branch') !="")
                <?php $branchd=\App\Branch::find(old('branch'));?>
                <option value="{{$branchd->id}}" selected>{{$branchd->branch_Name}}</option>
            @else
                <?php $branchd=\App\Branch::find($user->branch_id);?>
                <option value="{{$branchd->id}}" selected>{{$branchd->branch_Name}}</option>
            @endif
            <?php $branches=\App\Branch::all();?>
            @foreach($branches as $br)
                <option value="{{$br->id}}">{{$br->branch_Name}}</option>
            @endforeach

        </select>
        @if($errors->first('branch'))
            <label for="branch" class="error">{{$errors->first('branch')}}</label>
        @endif
    </div>
    <div class="form-group">
        <label for="department">Department</label>
        <select class="form-control"  id="department" name="department">
            @if(old('department') !="")
                <?php $depart=\App\Department::find(old('department'));?>
                <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
            @else
                <?php $depart=\App\Department::find($user->department_id);?>
                <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
            @endif
        </select>
        @if($errors->first('department'))
            <label for="department" class="error">{{$errors->first('department')}}</label>
        @endif
    </div>
    <div class="form-group">
        <label for="unit">Unit</label>
        <select class="form-control"  id="unit" name="unit">
            @if(old('unit') !="")
                <?php $unit=\App\Unit::find(old('unit'));?>
                <option value="{{$unit->id}}" selected>{{$unit->unit_name}}</option>
            @elseif($user->unit_id != null && $user->unit_id !="")
                <?php $unit=\App\Unit::find($user->unit_id);?>
                <option value="{{$unit->id}}" selected>{{$unit->unit_name}}</option>
            @else
                <option value="" selected>----</option>
            @endif
        </select>
        @if($errors->first('unit'))
            <label for="unit" class="error">{{$errors->first('unit')}}</label>
        @endif
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id">
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
    $("#adminDepartmentForm").validate({
        rules: {
            branch: "required",
            department: "required"
        },
        messages: {
            branch: "Please select branch",
            department: "Please select department"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#adminDepartmentForm').serializeArray();
            var formURL = $('#adminDepartmentForm').attr("action");
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
                                location.reload();
                                $("#myModal").modal("hide");
                            }, 2000);
                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin' ></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                            }, 2000);
                        }
                    });
        }
    });
    $("#branch").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                $("#department").html(data);
            });

        }else{$("#department").html("<option value=''>----</option>");}
    });
    $("#department").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('getDepartmentUnits') ?>/"+id1,function(data){
                $("#unit").html(data);
            });

        }else{$("#unit").html("<option value=''>----</option>");}
    });
</script>
