{!! Form::open(array('url'=>'users/edit','role'=>'form','id'=>'adminLoginForm')) !!}
<fieldset class="scheduler-border" style="margin-top: 10px;">
    <legend class="scheduler-border" style="color:#005DAD">Login Details</legend>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username " name="username" placeholder="Enter Username" required @if(old('username') !="")value="{{old('username')}}" @else value="{{$user->username}}" @endif readonly>

    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="Password">Password</label>
                <input type="password" class="form-control"  id="Password" name="Password" placeholder="Enter Password" >
            </div>
            <div class="col-md-6">
                <label for="Password">Confirm Password</label>
                <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" >
            </div>
        </div>
        <p class="help-block"><input type="checkbox" value="changepass" name="changePass" id="changePass" >Please tick here if you want to change password.</p>
    </div>
    <div class="row">
        <div class="col-md-2 pull-right">
            <button type="submit" class="btn btn-primary btn-block">Change Department</button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}