{!! Form::open(array('url'=>'users/rights','role'=>'form','id'=>'adminUserRightsDetailForm')) !!}
<fieldset class="scheduler-border" style="margin-top: 10px;">
    <legend class="scheduler-border" style="color:#005DAD">User Access Rights</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="right">User Access Level</label>
                <select name="right" class="form-control" id="right">

                    @if(old('right') !="")
                        <?php $right=\App\Right::find(old('department'));?>
                        <option value="{{$right->id}}" selected>{{$right->right_name}}</option>
                    @else
                        <?php $right=\App\Right::find($user->right_id);?>
                        <option value="{{$right->id}}" selected>{{$right->right_name}}</option>
                    @endif
                    <?php
                    $rights=\App\Right::where('status','=','enabled')->get(); //Get all user rights
                    ?>
                    @foreach($rights as $right)
                        <option value="{{$right->id}}">{{$right->right_name}}</option>
                    @endforeach
                    <option value="Active">Active</option>
                </select>
                @if($errors->first('right'))
                    <label for="right" class="error">{{$errors->first('right')}}</label>
                @endif
            </div>
            <div class="col-md-6">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    @if(old('status') !="")

                        <option value="{{old('status')}}" selected>{{old('status')}}</option>
                    @else
                        <option value="{{$user->status}}" selected>{{$user->status}}</option>
                    @endif
                    <option value="Inactive">Inactive</option>
                    <option value="Active">Active</option>
                </select>
                @if($errors->first('status'))
                    <label for="status" class="error">{{$errors->first('status')}}</label>
                @endif
            </div>

        </div>
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
    $("#adminUserRightsDetailForm").validate({
        rules: {
            right: "required",
            status: "required"

        },
        messages: {
            right: "Please select user access level",
            status: "Please select status"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#adminUserRightsDetailForm').serializeArray();
            var formURL = $('#adminUserRightsDetailForm').attr("action");
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
                            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                            }, 2000);
                        }
                    });
        }
    });

</script>