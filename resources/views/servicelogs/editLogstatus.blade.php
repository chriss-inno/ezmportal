{!!HTML::style("assets/bootstrap-datepicker/css/datepicker.css" )!!}
{!!HTML::style("assets/bootstrap-colorpicker/css/colorpicker.css" )!!}
{!!HTML::style("assets/bootstrap-daterangepicker/daterangepicker.css" )!!}


{!! Form::open(array('url'=>'serviceslogs/create','role'=>'form','id'=>'serviceForm')) !!}
<div class="form-group">
    <label for="service_id">Service Name</label>
    <select class="form-control"  id="service_id" name="service_id">
        <option  selected value="{{$service->service->service_name}}">{{$service->service->service_name}}</option>
        <option value="">----</option>
        <?php $services=\App\Service::all();?>
        @foreach($services as $se)
            <option value="{{$se->id}}">{{$se->service_name}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <label for="unit_name">Log Title</label>
    <input type="text" class="form-control" id="log_title" name="log_title" value="{{$service->log_title}}" placeholder="Enter title">
</div>
<div class="form-group">
    <label for="unit_name">Description</label>
    <textarea class="ckeditor form-control" id="description" name="description"><?php echo $service->description?></textarea>
</div>
<div class="form-group">
    <label for="unit_name">Specify Reason</label>
    <input type="text" class="form-control" id="reason" name="reason" value="{{$service->log_title)}}" placeholder="Enter reason">
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="status">Start Time</label>
            <input type="text" class="form-control form-control form-control-inline input-medium default-date-picker" id="start_time" name="start_time" value="{{old('start_time')}}" placeholder="(YYYY-MM-DD HH:MM)">
        </div>
        <div class="col-md-6">
            <label for="status">Restoration Time</label>
            <input type="text" class="form-control" id="end_time" name="end_time" value="{{$service->end_time}}" placeholder="(YYYY-MM-DD HH:MM)">
        </div>
    </div>
</div>
<div class="form-group">
    <h3 class="text-info"> Area Affected by the downtime</h3> <hr/>
    <div class="row">
        <div class="col-md-12">
            <label for="status">Branches</label>
            <select multiple class="form-control" name="branches[]" id="branches">
                @foreach(\App\Branch::all() as $br)
                    <option >{{$br->branch_Name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
        <div class="col-md-12">
            <label for="status">Departments and units</label>
            <select multiple class="form-control" name="departments[]" id="departments">
                @foreach(\App\Branch::all() as $br)
                    @foreach($br->department as $dp)
                        @foreach($dp->units as $un)
                            <option >{{$un->unit_name}}-{{$dp->department_name}} ({{$br->branch_Name}})</option>
                        @endforeach
                        <option >{{$dp->department_name}}-({{$br->branch_Name}})</option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="unit_name">Remarks</label>
        <input type="text" class="form-control" id="remarks" name="remarks" value="{{old('remarks')}}" placeholder="Enter Remarks">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    <option selected value="">----</option>
                    <option value="Sorted">Sorted</option>
                    <option value="Not Sorted">Not Sorted</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-8 pull-left" id="output"></div>
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-2 pull-right">
            <button type="submit" class="btn btn-primary  btn-block">Submit </button>
            <input type="hidden" name="id" value="{{$service->id}}">
        </div>

    </div>
</div>

{!! Form::close() !!}

{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}