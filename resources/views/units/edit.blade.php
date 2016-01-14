{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Basic Unit details</legend>
    {!! Form::open(array('url'=>'units/edit','role'=>'form','id'=>'unitForm')) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="branch">Branch</label>
                <select class="form-control"  id="branch" name="branch">
                    @if($unit->department_id != null && $unit->department_id != "")
                        <?php $depunit=\App\Department::find($unit->department_id);?>
                        <option value="{{$depunit->branch->id}}">{{$depunit->branch->branch_Name}}</option>
                    @else
                        <option value="" selected>----</option>
                    @endif
                    <?php $branches=\App\Branch::all();?>
                    @foreach($branches as $br)
                        <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="department">Department</label>
                <select class="form-control"  id="department" name="department">
                    @if($unit->department_id != null && $unit->department_id != "")
                        <?php $depunit=\App\Department::find($unit->department_id);?>
                        <option value="{{$depunit->id}}">{{$depunit->department_name}}</option>
                    @else
                        <option value="" selected>----</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="department">Parent Unit</label>
        <select class="form-control"  id="parent_id" name="parent_id">
            @if($unit->parent_id != null && $unit->parent_id != "")
                <?php $units=\App\Unit::ind($unit->parent_id);?>
                    <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
            @else
                <option value="0" selected>----</option>
                @endif
            <?php $units=\App\Unit::all();?>
            @if(count($units) >0)
                @foreach($units as $unitkk)
                    <option value="{{$unitkk->id}}">{{$unitkk->unit_name}}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="unit_name">Unit Name</label>
        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Enter unit name" required value="{{$unit->unit_name}}">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    @if($unit->status != null && $unit->status != "")
                    <option selected value="{{$unit->status}}">{{$unit->status}}</option>
                    @else
                        <option selected value="">----</option>
                        @endif
                    <option value="enabled">enabled</option>
                    <option value="disabled">disabled</option>
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
                <input type="hidden" value="{{$unit->id}}" name="unit_id">
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

    $("#unitForm").validate({
        rules: {
            branch: "required",
            department: "required",
            unit_name: "required",
            status: "required"
        },
        messages: {
            branch: "Please select branch",
            department: "Please eselect department",
            unit_name: "Please enter your unit name",
            status: "Please enter your status"
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
                            document.getElementById('unit_name').value="";
                            $("#dataDisplay").html(data);

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