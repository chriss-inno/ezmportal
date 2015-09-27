{!! Form::open(array('url'=>'users/exemption','role'=>'form','id'=>'adminUserQueryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Query exemption details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <label for="query_exemption">Query Exemption</label>
               <select class="form-control" name="query_exemption" id="query_exemption">
                   @if($user->query_exemption !="")
                         <option value="{{$user->query_exemption}}" selected>{{$user->query_exemption}}</option>
                       @elseif(old('query_exemption'))
                          <option value="{{old('query_exemption')}}" selected>{{old('query_exemption')}}</option>
                   @endif
                       <option value="Yes">Yes</option>
                       <option value="No">No</option>
               </select>
                @if($errors->first('query_exemption'))
                    <label for="first_name" class="error">{{$errors->first('query_exemption')}}</label>
                @endif
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <label for="exemption_type">Exemption Type</label>
                <input type="text" class="form-control" id="exemption_type" name="exemption_type" placeholder="Enter exemption type" required autocomplete=off @if(old('exemption_type') !="")value="{{old('exemption_type')}}" @else value="{{$user->exemption_type}}" @endif @if($user->query_exemption=="No") disabled @endif>
                @if($errors->first('exemption_type'))
                    <label for="first_name" class="error">{{$errors->first('exemption_type')}}</label>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="designation">Description</label>
        <textarea class="form-control" id="query_description " name="query_description">@if(old('query_description') !=""){{old('query_description')}}@else{{$user->query_description}}@endif</textarea>
        @if($errors->first('query_description'))
            <label for="first_name" class="error">{{$errors->first('query_description')}}</label>
        @endif
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="exemption_start_date">Exemption start date</label>
                <input type="text" class="form-control"  id="exemption_start_date" name="exemption_start_date" placeholder="Enter exemption start date" autocomplete=off @if(old('exemption_start_date') !="") value="{{old('exemption_start_date')}}" @else value="{{$user->exemption_start_date}}" @endif @if($user->query_exemption=="No") disabled @endif>
                @if($errors->first('exemption_start_date'))
                    <label for="first_name" class="error">{{$errors->first('exemption_stat_date')}}</label>
                @endif
            </div>
            <div class="col-md-6">
                <label for="exemption_end_date">Exemption end date</label>
                <input type="text" class="form-control"  id="exemption_end_date" name="exemption_end_date" placeholder="Enter exemption end date" autocomplete=off @if(old('exemption_end_date') !="") value="{{old('exemption_end_date')}}" @else value="{{$user->exemption_end_date}}"@endif @if($user->query_exemption=="No") disabled @endif>
                @if($errors->first('exemption_end_date'))
                    <label for="first_name" class="error">{{$errors->first('phone')}}</label>
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
            <button type="submit" class="btn btn-primary btn-block">Update Query Exemption</button>
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
    $("#adminUserQueryForm").validate({
        rules: {
            query_exemption: "required",
            exemption_type: "required",
            exemption_start_date: "required",
            exemption_end_date: "required"
        },
        messages: {
            query_exemption: "Please select query exemption",
            exemption_type: "Please enter exemption type",
            exemption_start_date: "Please exemption start date",
            exemption_end_date: "Please enter  exemption end date"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#adminUserQueryForm').serializeArray();
            var formURL = $('#adminUserQueryForm').attr("action");
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
    $("#query_exemption").change(function () {
        var id1 = this.value;
        if(id1 == "Yes")
        {
            $('#exemption_type').prop('disabled',false);
            $('#exemption_start_date').prop('disabled',false);
            $('#exemption_end_date').prop('disabled',false);

        }else{
            $('#exemption_type').prop('disabled',true);
            $('#exemption_start_date').prop('disabled',true);
            $('#exemption_end_date').prop('disabled',true);
        }
    });
</script>
