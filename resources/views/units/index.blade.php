<?php
$dep=\App\Department::find($id);
$units=$dep->units;
?>
{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Basic Unit details</legend>
    {!! Form::open(array('url'=>'units/create','role'=>'form','id'=>'unitForm')) !!}
    <div class="form-group">
        <label for="department">Department</label>
        <select class="form-control"  id="department" name="department">
            <option value="{{$dep->id}}" selected>{{$dep->department_name}}</option>
        </select>
    </div>
    <div class="form-group">
        <label for="department">Parent Unit</label>
        <select class="form-control"  id="parent_id" name="parent_id">
            <option value="0" selected>----</option>
            @if(count($units) >0)
                @foreach($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="unit_name">Unit Name</label>
        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Enter unit name" required>
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
    <button type="submit" class="btn btn-primary pull-right col-md-2">Create New </button>
    {!! Form::close() !!}
</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">List of {{$dep->department_name}} units </legend>
    <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="branches">
            <thead>
            <tr>
                <th>SNO</th>
                <th>Unit name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="dataDisplay">
            @if(count($units) >0)

                <?php $i=1;?>
                @foreach($units as $unit)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$unit->unit_name}}</td>
                        <td>{{$unit->status}}</td>
                        <td id="{{$unit->id}}" class="text-center">
                            <a  href="#" title="Edit Unit" class="editUnit btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <a href="#b" title="Delete Unit" class="delUnit btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> </a>
                        </td>
                    </tr>

                @endforeach
                @endif
            </tbody>
            <tfoot>
            <tr>
                <th>SNO</th>
                <th>Unit name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
</fieldset>
<div class="form-group">
    <div class="col-md-2 pull-right" style="padding-bottom: 10px;">
        <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
    </div>
</div>
{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#unitForm").validate({
        rules: {
            unit_name: "required",
            status: "required"
        },
        messages: {
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
