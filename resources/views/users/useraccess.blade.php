{!! Form::open(array('url'=>'users/edit','role'=>'form','id'=>'adminLoginForm')) !!}
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
                        <?php $right=\App\Right::find($user->department_id);?>
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
        <div class="col-md-2 pull-right">
            <button type="submit" class="btn btn-primary btn-block">Change Login details</button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}