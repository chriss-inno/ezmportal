<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bank M Tanzania PLC, Activity portal">
    <meta name="author" content="Inno Chriss">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

    <title>Bank M Tanzania PLC | @yield('page-title')</title>

    <!-- Bootstrap core CSS -->
    {!!HTML::style("css/bootstrap.min.css")!!}
    {!!HTML::style("css/bootstrap-reset.css")!!}
            <!--external css-->
    {!!HTML::style("assets/font-awesome/css/font-awesome.css")!!}
            <!-- Custom styles for this template -->
    {!!HTML::style("css/style.css")!!}
    {!!HTML::style("css/style-responsive.css")!!}
    @yield('page_style')
            <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    {!!HTML::script("js/html5shiv.js") !!}
    {!!HTML::script("js/respond.min.js") !!}
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
        </div>
        <!--logo start-->
        <a href="#" class="logo" > {!!Html::image('img/logo.png') !!} <strong> Bank M Tanzania plc| </strong> EZMCOM UBA and 2FA POC</a>
        <!--logo end-->

    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            @yield('menus')
                    <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <section class="site-min-height">
                <!-- page start-->
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                        <section class="panel">
                            <header class="panel-heading">
                                <h3 class="text-info"> <strong><i class="fa  fa-user"></i> LOG IN AS  <span class="text-danger">{{strtoupper($user->first_name.' '.$user->last_name)}} </span></strong></h3>
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border" style="color:#005DAD">Request status panel</legend>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="displayResultsData">
                                                </div>
                                            </div>
                                        </fieldset>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <div class="row">
                            <section class="panel">
                                <header class="panel-heading" >
                                    <h3 class="text-info"> <i class="fa  fa-info-circle"></i>  UBA RESULTS </h3>
                                </header>
                                <div class="panel-body">
                                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                            <div class="col-md-12">
                                                <a  href="#" class=" btn btn-primary btn-block"> SCORE RESULTS : {{$user->UBAStatus->score}}</a>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                            <div class="col-md-12">
                                                <a  href="{{url('queries/mytask')}}" class=" btn btn-primary btn-block"> TRAINING STATUS : @if($user->UBAStatus->training ==1) Completed @else On Training @endif </a>
                                            </div>
                                        </div>
                                    @if($user->UBAStatus->training ==0)
                                        <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                            <div class="col-md-12">
                                                <a  href="{{url('queries/mytask')}}" class=" btn btn-primary btn-block"> ATTEMPT :{{$user->UBAStatus->attempt}} </a>
                                            </div>
                                        </div>
                                        @endif
                                    <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                        <div class="col-md-12">
                                            <a  href="{{url('queries/mytask')}}" class=" btn btn-primary btn-block"> THRESHOLD :{{$user->UBAStatus->threshold}} </a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                        <div class="col-md-12">
                                            <a  href="{{url('queries/mytask')}}" class=" btn btn-primary btn-block"> DATE :{{$user->UBAStatus->date}} </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="row">
                            <section class="panel">
                                <header class="panel-heading" >
                                    <h3 class="text-info">  <i class="fa  fa-info-circle"></i> 2FA METHODS  </h3>
                                </header>
                                <div class="panel-body">

                                    <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                        <div class="col-md-12">
                                            <a href="#" class="qrcodeimage btn btn-primary btn-block"> Create QR-code image</a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                        <div class="col-md-12">
                                            <a href="#" class="sendPushRequest btn btn-primary btn-block"> Notify Me ! <i class="fa fa-phone-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                        <div class="col-md-12">
                                            <a href="#" class="changePassword btn btn-primary btn-block"> Input your OTP</a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px" id ="{{$user->id}}">
                                        <div class="col-md-12">
                                            <a href="{{url('logout')}}" class=" btn btn-danger btn-block"><i class="fa fa-key"></i> Cancel Login</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </section>
                    <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            {{date('Y')}} &copy; Bank (M) Tanzania PLC.
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
{!!HTML::script("js/jquery-1.8.3.min.js") !!}
{!!HTML::script("js/jquery.js") !!}
{!!HTML::script("js/bootstrap.min.js") !!}
{!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
{!!HTML::script("js/jquery.scrollTo.min.js") !!}
{!!HTML::script("js/jquery.nicescroll.js") !!}
{!!HTML::script("js/respond.min.js" ) !!}
{!!HTML::script("js/jquery.sparkline.js") !!}
{!!HTML::script("assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js") !!}
{!!HTML::script("js/owl.carousel.js" ) !!}
{!!HTML::script("js/jquery.customSelect.min.js" ) !!}

        <!-- js placed at the end of the document so the pages load faster -->
<!--common script for all pages-->
{!!HTML::script("js/common-scripts.js") !!}
{!!HTML::script("js/sparkline-chart.js") !!}
{!!HTML::script("js/easy-pie-chart.js") !!}
{!!HTML::script("js/count.js") !!}
{!!HTML::script("js/jquery.tagsinput.js")!!}
{!!HTML::script("js/jquery.dcjqaccordion.2.7.js") !!}
{!!HTML::script("js/jquery.scrollTo.min.js") !!}
{!!HTML::script("js/jquery.nicescroll.js") !!}
{!!HTML::script("js/respond.min.js"  ) !!}
<script type="text/javascript" charset="utf-8">

    $(".sendPushRequest").click(function(){
        $("#displayResultsData").html("<h3><span class='alert alert-info'><i class='fa fa-spinner fa-spin'></i> Sending push notification to your mobile application, please wait...</span><h3>");
        $.get("<?php echo url('users/push/request') ?>",function(data){
            $("#displayResultsData").html("<p class='alert alert-info' style='font-size: medium'>A push notification has been sent to your mobile application. Please check on your mobile application and respond accordingly</p>");
        });
    });
    //Edit class streams
    $(".qrcodeimage").click(function(){
        var id1 = $(this).parent().parent().attr('id');
        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
        modal+= '<div class="modal-content">';
        modal+= '<div class="modal-header">';
        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;">Scan QR-Image for activation</span>';
        modal+= '</div>';
        modal+= '<div class="modal-body">';
        modal+= ' </div>';
        modal+= '</div>';
        modal+= '</div>';
        $('body').css('overflow','hidden');

        $("body").append(modal);
        $("#myModal").modal("show");
        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
        $(".modal-body").load("<?php echo url("qrcode/scan") ?>");
        $("#myModal").on('hidden.bs.modal',function(){
            $("#myModal").remove();
        })

    });

    //Edit class streams
    $(".queryExemption").click(function(){
        var id1 = $(this).parent().parent().attr('id');
        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
        modal+= '<div class="modal-content">';
        modal+= '<div class="modal-header">';
        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;">User Query Exemption</span>';
        modal+= '</div>';
        modal+= '<div class="modal-body">';
        modal+= ' </div>';
        modal+= '</div>';
        modal+= '</div>';
        $('body').css('overflow','hidden');

        $("body").append(modal);
        $("#myModal").modal("show");
        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
        $(".modal-body").load("<?php echo url("users/exemption") ?>/"+id1);
        $("#myModal").on('hidden.bs.modal',function(){
            $("#myModal").remove();
        })

    })

    //Personal detail
    $(".personalDetail").click(function(){
        var id1 = $(this).parent().parent().attr('id');
        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
        modal+= '<div class="modal-content">';
        modal+= '<div class="modal-header">';
        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> User Personal Details</span>';
        modal+= '</div>';
        modal+= '<div class="modal-body">';
        modal+= ' </div>';
        modal+= '</div>';
        modal+= '</div>';
        $('body').css('overflow','hidden');

        $("body").append(modal);
        $("#myModal").modal("show");
        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
        $(".modal-body").load("<?php echo url("users/personal") ?>/"+id1);
        $("#myModal").on('hidden.bs.modal',function(){
            $("#myModal").remove();
        })

    });
    //Department detail
    $(".changeDepartment").click(function(){
        var id1 = $(this).parent().parent().attr('id');
        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
        modal+= '<div class="modal-content">';
        modal+= '<div class="modal-header">';
        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> User Department Details</span>';
        modal+= '</div>';
        modal+= '<div class="modal-body">';
        modal+= ' </div>';
        modal+= '</div>';
        modal+= '</div>';
        $('body').css('overflow','hidden');

        $("body").append(modal);
        $("#myModal").modal("show");
        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
        $(".modal-body").load("<?php echo url("users/department") ?>/"+id1);
        $("#myModal").on('hidden.bs.modal',function(){
            $("#myModal").remove();
        })

    });
    //changePassword detail
    $(".changePassword").click(function(){
        var id1 = $(this).parent().parent().attr('id');
        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
        modal+= '<div class="modal-content">';
        modal+= '<div class="modal-header">';
        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> USE ONE TIME PASSWORD</span>';
        modal+= '</div>';
        modal+= '<div class="modal-body">';
        modal+= ' </div>';
        modal+= '</div>';
        modal+= '</div>';
        $('body').css('overflow','hidden');

        $("body").append(modal);
        $("#myModal").modal("show");
        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
        $(".modal-body").load("<?php echo url("users/otp") ?>/"+id1);
        $("#myModal").on('hidden.bs.modal',function(){
            $("#myModal").remove();
        })

    });

    //changePassword detail
    $(".changeRights").click(function(){
        var id1 = $(this).parent().parent().attr('id');
        var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
        modal+= '<div class="modal-content">';
        modal+= '<div class="modal-header">';
        modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        modal+= '<span id="myModalLabel" class="h2 modal-title text-center" style="text-align: center; color: #FFF;"><i class="fa  fa-user"></i> User Rights Details</span>';
        modal+= '</div>';
        modal+= '<div class="modal-body">';
        modal+= ' </div>';
        modal+= '</div>';
        modal+= '</div>';
        $('body').css('overflow','hidden');

        $("body").append(modal);
        $("#myModal").modal("show");
        $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
        $(".modal-body").load("<?php echo url("users/rights") ?>/"+id1);
        $("#myModal").on('hidden.bs.modal',function(){
            $("#myModal").remove();
        })

    });

</script>
</body>
</html>
