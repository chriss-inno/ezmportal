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
                                    <td>{{$query->fromDepartment->department_name}}</td>
                                    <td>{{$query->toDepartment->department_name}}</td>
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
                        <p><h4 class="text-info"><strong>Query Assign</strong></h4></p>
                        {!! Form::open(array('url'=>'queries/assign/users','role'=>'form','id'=>'queryAssignForm')) !!}
                        <div class="form-group">
                            <label for="enabler">Current Assigned To </label>
                            <input type="text" class="form-control" readonly
                                   @if($query->assignment != null && $query->assignment !="")value="{{$query->assignment->user->first_name.' '.$query->assignment->user->last_name}}"
                                   @else value="Not Assigned" @endif >
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="user_id">@if($query->assignment != null && $query->assignment !="") Reassign To @else Assign To @endif</label>
                                    <select class="form-control"  id="user_id" name="user_id">
                                        @if(old('user_id') !="")
                                            <?php $users=\App\User::find(old('user_id'))?>
                                            <option value="{{$users->id}}">{{$users->first_name.' '.$users->last_name}}</option>
                                        @else
                                            <option value="">----</option>
                                        @endif
                                            @if($query->assignment != null && $query->assignment !="")
                                                <?php
                                                $usersls = \DB::table('users')->join('user_modules','users.id','=','user_modules.user_id')
                                                        ->select('users.id')
                                                        ->where('users.query_exemption','=','No')
                                                        ->where('users.status','=','Active')
                                                        ->where('user_modules.module_id','=',$query->module_id)
                                                        ->lists('users.id');
                                               $usersar =\App\User::whereIn('id',$usersls)->get();
                                                ?>
                                                @foreach($usersar as $users)
                                                        @if($query->assignment->user_id != $users->id )
                                                            <option value="{{$users->id}}">{{$users->first_name.' '.$users->last_name}}</option>
                                                        @endif
                                                @endforeach
                                          @else
                                                @if(Auth::user()->user_type=="Administrator")

                                                    @foreach(\App\User::where('status','<>','Inactive')->get() as $users)

                                                        <option value="{{$users->id}}">{{$users->first_name.' '.$users->last_name}}</option>

                                                    @endforeach

                                                    @else
                                                        @foreach(\App\User::where('department_id','=',Auth::user()->department_id)->get() as $users)

                                                            <option value="{{$users->id}}">{{$users->first_name.' '.$users->last_name}}</option>

                                                        @endforeach
                                                    @endif
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <select class="form-control"  id="status" name="status">
                                        @if(old('status'))
                                            <?php $qStatus=\App\QueryStatus::find(old('status'))?>
                                            <option value="{{old('status')}}">{{old('status')}}</option>
                                        @else
                                            <option value="">----</option>
                                        @endif
                                            @if($query->assignment != null && $query->assignment !="")
                                            <option value="Reassigned">Reassigned</option>
                                                @else
                                                <option value="Assigned">Assigned</option>
                                            @endif

                                    </select>
                                </div>
                            </div>

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
    $("#queryAssignForm").validate({
        rules: {
            user_id: "required",
            status: "required"

        },
        messages: {
            user_id: "Please Select user to assign query",
            status: "Please select status"
        },
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#queryAssignForm').serializeArray();
            var formURL = $('#queryAssignForm').attr("action");
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
                                location.reload();
                                jQuery.noConflict();
                                $("#myModal").modal("hide");
                            }, 500);
                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='fa fa-spinner fa-spin'></i> Error in processing data try again...</span><h3>");

                            setTimeout(function() {
                                $("#output").html("");
                            }, 500);
                        }
                    });
        }
    });

</script>
