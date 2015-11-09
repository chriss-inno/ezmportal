<!-- Bootstrap core CSS -->
{!!HTML::style("css/bootstrap.min.css")!!}

{!! Form::open(array('url'=>'eod/create','role'=>'form','id'=>'eodimport')) !!}

<div class="container">
    <div class="row">
        <div class="col-md-12">

<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic Reports Import</legend>

    <div class="form-group">
        <label for="report_name">first_dir</label>
        <input type="text" class="form-control" id="first_dir" name="first_dir" value="{{old('first_dir')}}" placeholder="Enter report name">
    </div>
    <div class="form-group">
        <label for="other_name">second_dir</label>
        <input type="text" class="form-control" id="second_dir" name="second_dir" value="{{old('second_dir')}}" placeholder="Enter other name">
    </div>
    <div class="form-group">
        <label for="other_name">new_dir</label>
        <input type="text" class="form-control" id="new_dir" name="new_dir" value="{{old('new_dir')}}" placeholder="Enter other name">
    </div>


</fieldset>


<div class="form-group">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        <div class="col-md-7 col-sm-7 col-xs-7 pull-left" id="output">

        </div>
    </div>
</div>

        </div>
    </div>
</div>
{!! Form::close() !!}
