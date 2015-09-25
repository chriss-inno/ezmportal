{!! Form::open(array('url'=>'users/edit','role'=>'form','id'=>'adminDepartmentForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Department details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="branch">Branch</label>
                <select class="form-control"  id="branch" name="branch">
                    <?php $branches=\App\Branch::all();?>

                    @if(old('branch') !="")
                        <?php $branchd=\App\Branch::find(old('branch'));?>
                        <option value="{{$branchd->id}}" selected>{{$branchd->branch_Name}}</option>
                    @else
                        <?php $branchd=\App\Branch::find($user->branch_id);?>
                        <option value="{{$branchd->id}}" selected>{{$branchd->branch_Name}}</option>
                    @endif
                    <?php $branches=\App\Branch::all();?>
                    @foreach($branches as $br)
                        <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                    @endforeach

                </select>
                @if($errors->first('branch'))
                    <label for="branch" class="error">{{$errors->first('branch')}}</label>
                @endif
            </div>
            <div class="col-md-6">
                <label for="department">Department</label>
                <select class="form-control"  id="department" name="department">
                    @if(old('branch') !="")
                        <?php $depart=\App\Department::find(old('department'));?>
                        <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
                    @else
                        <?php $depart=\App\Department::find($user->department_id);?>
                        <option value="{{$depart->id}}" selected>{{$depart->department_name}}</option>
                    @endif
                </select>
                @if($errors->first('department'))
                    <label for="department" class="error">{{$errors->first('department')}}</label>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 pull-right">
            <button type="submit" class="btn btn-primary btn-block">Change Department</button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}