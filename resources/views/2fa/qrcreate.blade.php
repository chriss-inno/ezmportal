{!! Form::open(array('url'=>'users/otp','role'=>'form','id'=>'adminPassChange')) !!}
<fieldset class="scheduler-border" style="margin-top: 10px;">
    <legend class="scheduler-border" style="color:#005DAD">Please scan this image using EzToken mobile app</legend>
    <div class="row">
        <div class="col-md-7 col-sm-7 col-xs-7 pull-left" >
            @if($errormsg=="No")
                {!! HTML::image("img/".$imagePath)!!}
                @else
                <span class='text-info'>Token quota reach – This indicated user has an active token</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
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
