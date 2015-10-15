{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

<div class="row">
    <div class="col-md-12 col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <h3 class="text-info"> <strong><i class="fa fa- fa-tasks"></i>  QUERY DETAILS </strong></h3>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="branches">
                                <thead>
                                <tr>
                                    <th>Query code</th>
                                    <th>Reported date</th>
                                    <th>Reported by</th>
                                    <th>From department</th>
                                    <th>To Department</th>
                                    <th>Person assigned </th>
                                    <th>Date assigned</th>
                                    <th>Critical</th>
                                    <th>Module</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>{{$query->query_code}}</td>
                                    <td>{{date("d M, Y H:i",strtotime($query->reporting_Date))}}</td>
                                    <td>{{$query->user->first_name.' '.$query->user->last_name}}</td>
                                    <td>{{$query->toDepartment->department_name}}</td>
                                    <td>{{$query->fromDepartment->department_name}}</td>
                                    @if($query->assignment != null && $query->assignment !="")
                                        <td style="background-color:#78CD51; color: #FFF;">{{$query->assignment->user->first_name.' '.$query->assignment->user->last_name}}</td>
                                        <td>{{$query->assignment->assigned_date_time}}</td>
                                    @else
                                        <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                        <td></td>
                                    @endif
                                    <td>{{$query->critical_level}}</td>
                                    <td>{{$query->module->module_name}}</td>
                                    <td>{{$query->status}}</td>
                                </tr>
                                <tr>
                                    <th colspan="10">Query Description</th>
                                </tr>
                                <tr>
                                    <td colspan="10"><?php echo $query->description;?></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <p><h4 class="text-info"><strong>Attend Query</strong></h4></p>
                        {!! Form::open(array('url'=>'queries/attend','role'=>'form','id'=>'queryMessageForm')) !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="enabler">Enabler</label>
                                    <select class="form-control"  id="enabler" name="enabler">
                                        @if(old('enabler'))
                                            <?php $enabler=\App\Enabler::find(old('enabler'))?>
                                            <option value="{{$enabler->id}}">{{$enabler->enabler_name}}</option>
                                            @else
                                            <option value="">----</option>
                                        @endif
                                           @foreach(\App\Enabler::all() as $enabler)
                                            <option value="{{$enabler->id}}">{{$enabler->enabler_name}}</option>
                                               @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Progress Status</label>
                                    <select class="form-control"  id="status" name="status">
                                        @if(old('status'))
                                            <?php $qStatus=\App\QueryStatus::find(old('status'))?>
                                            <option value="{{$qStatus->id}}">{{$qStatus->status_name}}</option>
                                        @else
                                            <option value="">----</option>
                                        @endif
                                        @foreach(\App\QueryStatus::all() as $qs)
                                            <option value="{{$qs->id}}">{{$qs->status_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="current_update">Query updates</label>
                            <textarea class="ckeditor form-control" name="message" rows="10" id="message"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-8 pull-left" id="output"></div>
                            <div class="col-md-2 pull-right">
                                <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
                            </div>
                            <div class="col-md-2 pull-right">
                                <input type="hidden" name="query_id" id="query_id" value="{{$query->id}}">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#queryMessageForm").validate({
        rules: {
            message: "required",
            status: "required",
            enabler: "required"

        },
        messages: {
            message: "Please enter Message",
            status: "Please select status",
            enabler: "Please select enabler"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#queryMessageForm').serializeArray();
            var formURL = $('#queryMessageForm').attr("action");
            $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                            console.log(data);
                            //data: return data from server
                            setTimeout(function() {
                                $("#output").html("");
                                jQuery.noConflict();
                                $("#myModal").modal("hide");
                            }, 2000);
                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                            }, 2000);
                        }
                    });
        }
    });

</script>
