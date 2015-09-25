{!! Form::open(array('url'=>'users/edit','role'=>'form','id'=>'adminUserDetailForm')) !!}
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

    <div class="form-group">
        <label for="designation">Designation</label>
        <input type="text" class="form-control" id="designation " name="designation" placeholder="Enter Designation" required @if(old('designation') !="")value="{{old('designation')}}" @else value="{{$user->designation}}" @endif readonly>
        @if($errors->first('designation'))
            <label for="first_name" class="error">{{$errors->first('designation')}}</label>
        @endif
        <p class="help-block">Please enter full details of your designation, do not enter abbreviation.</p>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="phone">Mobile Number</label>
                <input type="text" class="form-control"  id="phone" name="phone" placeholder="Enter Mobile Number" autocomplete=off @if(old('phone') !="") value="{{old('phone')}}" @else value="{{$user->phone}} "@endif readonly>
                @if($errors->first('phone'))
                    <label for="first_name" class="error">{{$errors->first('phone')}}</label>
                @endif
            </div>
            <div class="col-md-8">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control"  id="email" name="email" placeholder="Enter email address" autocomplete=off @if(old('email') !="") value="{{old('email')}}" @else value="{{$user->email}}" @endif readonly>
                @if($errors->first('email'))
                    <label for="first_name" class="error">{{$errors->first('email')}}</label>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 pull-right">
            <button type="submit" class="btn btn-primary btn-block">Update Personal Details</button>
        </div>
    </div>
{!! Form::close() !!}