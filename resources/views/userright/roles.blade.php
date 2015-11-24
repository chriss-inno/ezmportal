{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

{!! Form::open(array('url'=>'roles/create','role'=>'form','id'=>'rolesCreateForm')) !!}
<div class="row">
    <div class="col-lg-12 col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <h3 class="text-info"> <strong> USER ROLES</strong></h3>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="branches">
                        <thead>
                        <tr>
                            <th>SNO</th>
                            <th>Module Name</th>
                            <th>Create</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Authorize</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $modules=array('Reports','Manage Reports','Photo Gallery','Manage Gallery','Downloads','Manage Downloads','Service Delivery','Money Msafiri','Treasury','Credit','Human Resource','COP\'S','Support Queries','Queries Reports','Queries Assign','Reminder','Oracle Support Issues','System service status','ICT Inventory','Portal Administration','Query Emails Settings','Service Delivery Email Settings','Customer SMS Section');

                        $count=1;
                        ?>
                        @foreach($modules as $module )
                            <?php  //Fetch user rights
                            $role=\App\UserRight::where('module','=',$count)->where('right_id','=',$right->id)->get();
                            ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td ><input type="checkbox" value="{{$count}}" name="module[]" id="chk" @if(count($role) >0 ) checked @endif> <label> {{$module}}</label></td>
                                <td class="text-center"><input type="checkbox" value="1"  name="create{{$count}}"></td>
                                <td class="text-center"><input type="checkbox" value="1"  name="view{{$count}}"></td>
                                <td class="text-center"><input type="checkbox" value="1"  name="edit{{$count}}"></td>
                                <td class="text-center"><input type="checkbox" value="1"  name="delete{{$count}}" ></td>
                                <td class="text-center"><input type="checkbox" value="1"  name="authorize{{$count}}"></td>
                            </tr>
                            <?php $count++;?>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>SNO</th>
                            <th>Module Name</th>
                            <th>Create</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Authorize</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-8 pull-left" id="output"></div>
    <div class="col-md-2 pull-right">
        <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
    </div>
    <div class="col-md-2 pull-right">
        <input type="hidden" id="id" name="id" value="{{$right->id}}">
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</div>
{!! Form::close() !!}

{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}
{!!HTML::script("js/form-validation-script.js") !!}
<script>
    $("#rolesCreateForm").validate({
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#rolesCreateForm').serializeArray();
            var formURL = $('#rolesCreateForm').attr("action");
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
