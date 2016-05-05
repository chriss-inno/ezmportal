<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bank M Tanzania PLC, Activity portal">
    <meta name="author" content="Inno Chriss">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <title>Bank M Tanzania PLC | Portal Login </title>

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
	{!!HTML::script("ezm/ezuba.min.js"  ) !!}
	
	<script type="text/javascript">
			// @param elEva Mandatory. It is the DOM element of textbox
			// for which you would like to extract it UBA JSON
			// data.
			// @param elDes Optional. It is the DOM element of textbox or
			// textarea for which you would like to output the
			// UBA JSON data. If not provided or provide null.
			// The result will be returned from this function only.
			// EzUBAnalytics.ubaJson(elEva, elDes);
			function getUBADATA()
			{
				EzUBAnalytics.ubaJson(document.getElementById("password"),document.getElementById("uba_password"));
				EzUBAnalytics.ubaJson(document.getElementById("username"),document.getElementById("uba_username"));
			}
			
	</script>
</head>

<body class="login-body">
  
<div class="container">
    <div style="max-width: 330px; margin-left: auto; margin-right: auto">
      {!! Form::open(array('url'=>'login','class'=>'form-signin','role'=>'form','id'=>'UserLogin','onsubmit' => 'getUBADATA();')) !!}
        <h2 class="form-signin-heading">{!! HTML::image("img/logo.png")!!}<strong> Bank M Tanzania plc <br/><h4>EZMCOM UBA and 2FA POC </h4></strong></h2>
        <div class="login-wrap">

            @if(Session::has('message'))
                <div class="alert fade in alert-danger">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                    {{Session::get('message')}}
                </div>
            @endif
            <input type="text" name="username"  id="username" class="form-control" placeholder="User ID" autofocus autocomplete=off required>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required autocomplete=off>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me

            </label>
			 <!-- UBA DATA CAPTURE START-->
			     <input type="hidden" name="uba_password"  id="uba_password" >
			     <input type="hidden" name="uba_username"  id="uba_username">
				
			 <!-- UBA DATA CAPTURE START-->
			 	
            <button class="btn btn-lg btn-login btn-block" type="submit" >Sign in</button>
			<div class="registration">
                Don't have an account yet?
                <a class="" href="{{url('register')}}">
                    Create an account
                </a>
            </div>

        </div>
        {!! Form::close() !!}
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(array('url'=>'forgotPassword','role'=>'form','id'=>'forgotPassword')) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p><span class="text-center "><h4 class="text-center text-info">Enter your email and user name to reset your account</h4> </span> </p>
                        <div class="form-group">
                            <label for="status">Enter your Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" class="form-control placeholder-no-fix" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Enter your e-mail address</label>
                            <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">Cancel</button>
					
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    {!! Form::close() !!}

                    {!!HTML::script("js/jquery.validate.min.js" ) !!}
                    {!!HTML::script("js/respond.min.js"  ) !!}
                    {!!HTML::script("js/form-validation-script.js") !!}
                    <script>
                        //Validate user login
                        $("#forgotPassword").validate({
                            rules: {
                                email: {
                                    required: true,
                                    email: true
                                }
                            },
                            messages: {
                                email: {
                                    required: "Please provide a password",
                                    email: "Enter valid email address"
                                }
                            }
                        });
                    </script>
                  </div>
            </div>
        </div>
        <!-- modal -->


    </div>

</div>
<script type="text/javascript">
    // EzUBAnalytics.init(offsetFlag,sessionId)
    // @param offsetFlag Optional. Only if provide true, it will offset the char code.
    // @param sessionId Optional. If not provided, it create internal session Id.
    // It is a must to call this to initialised the UBA analytics script engine.
    EzUBAnalytics.init(); 
    
    // EzUBAnalytics.bind(element)
    // @param element Mandatory. It is the DOM element of textbox for which to run UBA evaluation.
    // Call this to bind and register UBA analytics on textbox. 
    EzUBAnalytics.bind(document.getElementById("username"));
    EzUBAnalytics.bind(document.getElementById("password"));
    
    // EzUBAnalytics.ubaJson(elEva, elDes)
    // @param elEva Mandatory. It is the DOM element of textbox for which you would like to extract it 
    //              UBA analytic JSON result.
    // @param elDes Optional. It is the DOM element of textbox or textarea for which you would like to 
    //              output the UBA analytic JSON result. If not provided. The result will be returned
    //              from this function only.
    // Call this when you ready to capture the UBA analytic JSON result. For an example: upon form submit or 
    // on click event of form Submit button.
  </script>

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
