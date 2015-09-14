<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="chriss-inno">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

    <title>Bank M Tanzania PLC | Self Registration</title>

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
                    <strong>Bank M Service Portal| User Registration form </strong>
                </header>
                <div class="panel-body">
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
                                    <label for="branch">Password</label>
                                    <input type="password" class="form-control"  id="uspass" name="uspass" placeholder="Enter Password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="branch">Confirm Password</label>
                                    <input type="password" class="form-control"  id="confirmuspass" name="confirmuspass" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                        <button type="submit" class="btn btn-danger pull-right">Register Now</button>
                        <a href="{{url('login')}}" class="btn btn-primary pull-right" style="margin-right:5px ">Already Registered?</a>
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
</body>
</html>
