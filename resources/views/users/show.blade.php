
                {!! Form::open(array('url'=>'register','role'=>'form','id'=>'signupForm')) !!}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Personal details</legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="first_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation " name="designation" placeholder="Enter Designation" required>
                            <p class="help-block">Please enter full details of your designation, do not enter abbreviation.</p>
                        </div>
                        <div class="form-group">
                            <label for="phone">Mobile Number</label>
                            <input type="text" class="form-control"  id="phone" name="phone" placeholder="Enter Mobile Number">
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
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Login Details</legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control"  id="Password" name="Password" placeholder="Enter Password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Password">Confirm Password</label>
                                    <input type="password" class="form-control"  id="Confirm_Password" name="Confirm_Password" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                     <fieldset class="scheduler-border">
                         <legend class="scheduler-border">User Access Rights</legend>
                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-6">
                                     <label for="Password">Password</label>
                                     <input type="password" class="form-control"  id="Password" name="Password" placeholder="Enter Password" required>
                                 </div>
                                 <div class="col-md-6">
                                     <label for="Password">Confirm Password</label>
                                     <input type="password" class="form-control"  id="Confirm_Password" name="Confirm_Password" placeholder="Confirm Password" required>
                                 </div>
                             </div>
                         </div>
                     </fieldset>
                     <fieldset class="scheduler-border">
                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-2 pull-right">
                                     <a href="#" data-dismiss="modal" class="btn btn-danger pull-right">Close</a>
                                 </div>
                             </div>
                         </div>
                     </fieldset>

{!! Form::close() !!}
 <script>
     $("#branch").change(function () {
         var id1 = this.value;
         if(id1 != "")
         {
             $.get("<?php echo url('getDepartment') ?>/"+id1,function(data){
                 $("#department").html(data);
             });

         }else{$("#department").html("<option value=''>----</option>");}
     });
 </script>