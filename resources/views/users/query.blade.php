{!! Form::open(array('url'=>'users/query','role'=>'form','id'=>'adminUserModulesForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Personal details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required autocomplete=off @if(old('first_name') !="")value="{{old('first_name')}}" @else value="{{$user->first_name}}" @endif readonly>
                @if($errors->first('first_name'))
                    <label for="first_name" class="error">{{$errors->first('first_name')}}</label>
                @endif
            </div>
            <div class="col-md-4">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required autocomplete=off @if(old('last_name') !="")value="{{old('last_name')}}" @else value="{{$user->last_name}}" @endif readonly>
                @if($errors->first('last_name'))
                    <label for="first_name" class="error">{{$errors->first('last_name')}}</label>
                @endif
            </div>
            <div class="col-md-4">
                <label for="middle_name">Other Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name" @if(old('middle_name') !="")value="{{old('middle_name')}}" @else value="{{$user->middle_name}}" @endif readonly>
            </div>
        </div>

    </div>

</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">User query assignment</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped">
                    <thead>
                       <th>SN</th>
                       <th>Module</th>
                       <th>Receive Query</th>
                    </thead>
                    <tbody>
                    <?php
                      //Get all query module under user department
                            $count=1;

                            //does user assigned to modules?
                     ?>
                    @if(count($user->department->module) >0 && $user->department->module !=null && $user->department->module !="" )
                        @foreach($user->department->module as $module)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$module->module_name}}</td>
                                <td><input type="checkbox" value="{{$module->id}}" name="module[]" @if(\App\Http\Controllers\ModuleController::checkAccess($user->id,$module->id)) checked @endif class="form-control"></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                        <th>SN</th>
                        <th>Module</th>
                        <th>Receive Query</th>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<div class="row">
    <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
        <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
        <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id">
        <button type="submit" class="btn btn-primary btn-block">Query Module Assignment</button>
    </div>
    <div class="col-md-7 col-sm-7 col-xs-7 pull-left" id="output">

    </div>
</div>
{!! Form::close() !!}
{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#adminUserModulesForm").validate({
        rules: {


        },
        messages: {

        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#adminUserModulesForm').serializeArray();
            var formURL = $('#adminUserModulesForm').attr("action");
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

</script>
