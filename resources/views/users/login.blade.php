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
     {!!HTML::style("css/bootstrap.min.css" )!!}
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

    <form class="form-signin" action="index.html">
        <h2 class="form-signin-heading"> <img src="img/logo.png" alt="logo" /><strong> Bank (M) Service Portal</strong></h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="User ID" autofocus>
            <input type="password" class="form-control" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
            <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">Cancel</button>
                        <button class="btn btn-primary" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

    </form>

</div>



<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
