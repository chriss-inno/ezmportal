{!! Form::open(array('url'=>'users/personal','role'=>'form','id'=>'adminUserDetailForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Personal details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required autocomplete=off @if(old('first_name') !="")value="{{old('first_name')}}" @else value="{{$user->first_name}}" @endif >
                @if($errors->first('first_name'))
                    <label for="first_name" class="error">{{$errors->first('first_name')}}</label>
                @endif
            </div>
            <div class="col-md-4">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required autocomplete=off @if(old('last_name') !="")value="{{old('last_name')}}" @else value="{{$user->last_name}}" @endif >
                @if($errors->first('last_name'))
                    <label for="first_name" class="error">{{$errors->first('last_name')}}</label>
                @endif
            </div>
            <div class="col-md-4">
                <label for="middle_name">Other Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name" @if(old('middle_name') !="")value="{{old('middle_name')}}" @else value="{{$user->middle_name}}" @endif >
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="designation">Designation</label>
        <input type="text" class="form-control" id="designation " name="designation" placeholder="Enter Designation" required @if(old('designation') !="")value="{{old('designation')}}" @else value="{{$user->designation}}" @endif >
        @if($errors->first('designation'))
            <label for="first_name" class="error">{{$errors->first('designation')}}</label>
        @endif
        <p class="help-block">Please enter full details of your designation, do not enter abbreviation.</p>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="phone">Mobile Number</label>
                <input type="text" class="form-control"  id="phone" name="phone" placeholder="Enter Mobile Number" autocomplete=off @if(old('phone') !="") value="{{old('phone')}}" @else value="{{$user->phone}} "@endif >
                @if($errors->first('phone'))
                    <label for="first_name" class="error">{{$errors->first('phone')}}</label>
                @endif
            </div>
            <div class="col-md-8">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control"  id="email" name="email" placeholder="Enter email address" autocomplete=off @if(old('email') !="") value="{{old('email')}}" @else value="{{$user->email}}" @endif >
                @if($errors->first('email'))
                    <label for="first_name" class="error">{{$errors->first('email')}}</label>
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
            <button type="submit" class="btn btn-primary btn-block">Update Personal Details</button>
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
    $("#adminUserDetailForm").validate({
        rules: {
            phone: "required",
            designation: "required",
            last_name: "required",
            first_name: "required",
            email: {
                required: true,
                email: true
            }

        },
        messages: {
            unit_name: "Please enter your unit name",
            status: "Please enter your status",
            email: {
                required: "Please provide a password",
                email: "Enter valid email address"
            },
            designation: "Please enter full details of your designation",
            first_name: "Please enter  first name",
            last_name: "Please enter  last name",
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#adminUserDetailForm').serializeArray();
            var formURL = $('#adminUserDetailForm').attr("action");
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
