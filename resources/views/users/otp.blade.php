{!! Form::open(array('url'=>'users/otp','role'=>'form','id'=>'adminPassChange')) !!}
<fieldset class="scheduler-border" style="margin-top: 10px;">
    <legend class="scheduler-border" style="color:#005DAD">Login Details</legend>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username " name="username" placeholder="Enter Username" required @if(old('username') !="")value="{{old('username')}}" @else value="{{$user->username}}" @endif readonly>

    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="userpass">Email</label>
                <input type="text" class="form-control"  id="userpass" name="userpass" value="{{$user->email}}" required readonly>
                @if($errors->first('userpass'))
                    <label for="userpass" class="error">{{$errors->first('userpass')}}</label>
                @endif
            </div>
            <div class="col-md-6">
                <label for="passconfirmation">Provide your One time password</label>
                <input type="password" class="form-control"  id="otppass" name="otppass" placeholder="Provide one time password" required>
                @if($errors->first('passconfirmation'))
                    <label for="confirmation" class="error">{{$errors->first('passconfirmation')}}</label>
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
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
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
    $("#adminPassChange").validate({
        rules: {
            otppass: {
                required: true
            }
        },
        messages: {
            otppass: {
                required: "Please provide your one time password"
            }
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Authenticating please wait...</span><h3>");
            var postData = $('#adminPassChange').serializeArray();
            var formURL = $('#adminPassChange').attr("action");
            $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                            console.log(data);
                            if(data == 0)
                            {
                                setTimeout(function() {

                                    $("#output").html(data);
                                    $("#myModal").modal("hide");
                                }, 2000);
                            }
                            else if(data == -7)
                            {
                                $("#output").html("<h3><span class='text-danger'><i class='fa fa-info'></i> Invalid OTP Please try again...</span><h3>");
                            }

                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-danger'><i class='fa fa-info'></i> Error in processing data try again...</span><h3>");

                           // setTimeout(function() {
                            //    $("#output").html("");
                           // }, 2000);
                        }
                    });
        }
    });

</script>
