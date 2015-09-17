{!! Form::open(array('url'=>'modules','role'=>'form','id'=>'moduleForm')) !!}

<div class="form-group">
    <label for="module_name">Module Name</label>
    <input type="text" class="form-control" id="module_name" name="module_name" value="{{old('module_name')}}" placeholder="Enter Module Name">
</div>
<div class="form-group">
    <label for="description">Module Descriptions</label>
    <textarea class="form-control" id="description" rows="8" name="description">{{old('description')}}</textarea>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="branch">Branch</label>
            <select class="form-control"  id="branch" name="branch">
                <option value="">----</option>
                <?php $branches=\App\Branch::all();?>
                @foreach($branches as $br)
                    <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                @endforeach

            </select>
        </div>
        <div class="col-md-6">
            <label for="department">Department</label>
            <select class="form-control"  id="department" name="department">
                <option value="">----</option>
            </select>
        </div>
    </div>
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
<button type="submit" class="btn btn-primary pull-right col-md-2">Submit</button>

{!! Form::close() !!}