<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="chriss-inno">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

    <title>Bank M Tanzania PLC| Support Portal Registration</title>

    <!-- Bootstrap core CSS -->
     {!!HTML::style("css/bootstrap.min.css")!!}
     {!!HTML::style("css/bootstrap-reset.css")!!}
    <!--external css-->
     {!!HTML::style("assets/font-awesome/css/font-awesome.css")!!}
    <!-- Custom styles for this template -->
     {!!HTML::style("css/style.css" )!!}
     {!!HTML::style("css/style-responsive.css" )!!}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
     {!!HTML::script("js/html5shiv.js")!!}
     {!!HTML::script("js/respond.min.js")!!}
    <![endif]-->
</head>

<body class="login-body">

<div class="container">
       <div class="row" style="margin-top: 10px;">
        <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-sm-offset-2 col-md-offset-2">
            <section class="panel">
                <header class=" panel-heading text-center" style="background-color: #015EAC; color: #FFF;">
                    <strong>Bank M Service Portal - User Registration form </strong>
                </header>
                <div class="panel-body">

                    @if(Session::has('message'))
                        <div class="alert fade in alert-danger">
                            <i class="icon-remove close" data-dismiss="alert"></i>
                            {{Session::get('message')}}
                        </div>
                    @endif

                     {!! Form::open(array('url'=>'register','role'=>'form','id'=>'signupForm')) !!}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border text-info">Personal details</legend>
                        <div class="form-group">
                             <div class="row">
                                 <div class="col-md-6">
                                     <label for="first_name">First Name</label>
                                     <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required value="{{old('first_name')}}">
                                   @if($errors->first('first_name'))
                                     <label for="first_name" class="error">{{$errors->first('first_name')}}</label>
                                       @endif
                                 </div>
                                 <div class="col-md-6">
                                     <label for="last_name">Last Name</label>
                                     <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required value="{{old('last_name')}}">
                                     @if($errors->first('last_name'))
                                         <label for="first_name" class="error">{{$errors->first('last_name')}}</label>
                                     @endif
                                 </div>
                             </div>

                        </div>

                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation " name="designation" placeholder="Enter Designation" required value="{{old('designation')}}">
                            <p class="help-block">Please enter full details of your designation, do not enter abbreviation.</p>
                            @if($errors->first('last_name'))
                                <label for="designation" class="error">{{$errors->first('designation')}}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Mobile Number</label>
                            <input type="text" class="form-control"  id="phone" name="phone" placeholder="Enter Mobile Number" required value="{{old('phone')}}">
                            @if($errors->first('phone'))
                                <label for="phone" class="error">{{$errors->first('phone')}}</label>
                            @endif
                        </div>
                    </fieldset>
              <fieldset class="scheduler-border">
                <legend class="scheduler-border text-info">Branch,Department and Unit details </legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="branch">Branch</label>
                                     <select class="form-control"  id="branch" name="branch">
                                         @if(old('branch') !="")
                                             <?php $branchd=\App\Branch::find(old('branch'));?>
                                               <option value="{{$branchd->id}}" selected>{{$branchd->branch_Name}}</option>
                                             @else
                                             <option value="">----</option>
                                             @endif

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
                                            <option value="">----</option>
                                        @endif
                                    </select>
                                    @if($errors->first('department'))
                                        <label for="department" class="error">{{$errors->first('department')}}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select class="form-control"  id="unit" name="unit">
                                @if(old('unit') !="")
                                    <?php $unit=\App\Unit::find(old('unit'));?>
                                    <option value="{{$unit->id}}" selected>{{$unit->unit_name}}</option>
                                @else
                                    <option value="" selected>----</option>
                                @endif
                            </select>
                            @if($errors->first('unit'))
                                <label for="unit" class="error">{{$errors->first('unit')}}</label>
                            @endif
                        </div>
              </fieldset>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border text-info">Login Details</legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control"  id="Password" name="Password" placeholder="Enter Password" required>
                                    @if($errors->first('Password'))
                                        <label for="Password" class="error">{{$errors->first('Password')}}</label>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                    @if($errors->first('password_confirmation'))
                                        <label for="confirmation" class="error">{{$errors->first('password_confirmation')}}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                        <button type="submit" class="btn btn-danger pull-right">Register Now</button>
                        <a href="{{url('login')}}" class="btn btn-primary pull-left" style="margin-right:5px ">Already Registered?</a>
                    {!! Form::close() !!}

                </div>
            </section>
        </div>
    </div>


</div>

<!-- js placed at the end of the document so the pages load faster -->
{!!HTML::script("js/jquery.js" ) !!}
{!!HTML::script("js/bootstrap.min.js" ) !!}
{!!HTML::script("js/jquery.dcjqaccordion.2.7.js" ) !!}
{!!HTML::script("js/jquery.scrollTo.min.js" ) !!}
{!!HTML::script("js/jquery.nicescroll.js") !!}
{!!HTML::script("js/jquery.validate.min.js" ) !!}
{!!HTML::script("js/respond.min.js"  ) !!}

<!--common script for all pages-->
{!!HTML::script("js/common-scripts.js" ) !!}

<!--script for this page-->
{!!HTML::script("js/form-validation-script.js" ) !!}

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
    $("#department").change(function () {
        var id1 = this.value;
        if(id1 != "")
        {
            $.get("<?php echo url('getDepartmentUnits') ?>/"+id1,function(data){
                $("#unit").html(data);
            });

        }else{$("#unit").html("<option value=''>----</option>");}
    });
</script>
</body>
</html>
