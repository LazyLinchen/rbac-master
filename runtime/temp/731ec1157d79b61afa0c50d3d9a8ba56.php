<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"E:\WWW\blogNote\public/../application/admin\view\pub\login.html";i:1493442411;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login page</title>
    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="__CSS__/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="__CSS__/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="__CSS__/demo/nifty-demo-icons.min.css" rel="stylesheet">


        
    <!--Demo [ DEMONSTRATION ]-->
    <link href="__CSS__/demo/nifty-demo.min.css" rel="stylesheet">

    <link href="__CSS__/app.css?version=<?PHP echo time(); ?>" rel="stylesheet">







    
    <!--JAVASCRIPT-->
    <!--=================================================-->


    <!--jQuery [ REQUIRED ]-->
    <script src="__JS__/jquery-2.2.4.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="__JS__/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="__JS__/nifty.min.js"></script>






    <!--=================================================-->
    
    <!--Background Image [ DEMONSTRATION ]-->
    <script src="__JS__/demo/bg-images.js"></script>

    <script type="text/javascript" src="__STATIC__/layer/layer.js"></script>

    <script type="text/javascript" src="__JS__/admin.min.js"></script>

    <script type="text/javascript" src="__JS__/common.js"></script>


    
    <!--=================================================

    REQUIRED
    You must include this in your project.


    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.


    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.


    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.


    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    =================================================-->
        
</head>
<body>

    <div id="container" class="cls-container">

        <!-- BACKGROUND IMAGE -->
        <!--===================================================-->
        <div id="bg-overlay" class="bg-img" style="background-image: url('__IMG__/bg-img/bg-img-5.jpg');"></div>
        
        
        <!-- LOGIN FORM -->
        <!--===================================================-->
        <div class="cls-content">

            <div class="cls-content-sm panel" style="margin-top: 10%;">
                <div class="spinner" style="margin: 9% 9%;">
                    <div class="cube1"></div>
                    <div class="cube2"></div>
                </div>
                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <h3 class="h4 mar-no">Account Login</h3>
                        <p class="text-muted">Sign In to your account</p>
                    </div>

                    <form action="<?php echo url('Pub/login'); ?>" method="post" class="form builder-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" value="" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" value="">
                        </div>
                       <!--  <div class="checkbox pad-btm text-left">
                            <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
                            <label for="demo-form-checkbox">Remember me</label>
                        </div> -->
                        <button class="btn btn-primary btn-lg btn-block ajax-post1" type="submit" target-form="builder-form">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
        <!--===================================================-->
        
        <!-- DEMO PURPOSE ONLY -->
        <!--=================================================== -->
        <div class="demo-bg">
            <div id="demo-bg-list">
                <div class="demo-loading"><i class="psi-repeat-2"></i></div>
                <!-- <img class="demo-chg-bg bg-trans active" src="__IMG__/bg-img/thumbs/bg-trns.jpg" alt="Background Image">  -->
                <img class="demo-chg-bg" src="__IMG__/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
                <img class="demo-chg-bg" src="__IMG__/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
                <img class="demo-chg-bg" src="__IMG__/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
                <img class="demo-chg-bg" src="__IMG__/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
                <img class="demo-chg-bg" src="__IMG__/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
                <img class="demo-chg-bg" src="__IMG__/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
                <img class="demo-chg-bg" src="__IMG__/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
            </div>
        </div>
    </div>

</body>
</html>
<script>
    $(function () {
       $(".ajax-post").click(function () {
           $(".spinner").css('display', 'block');
       });
    });
</script>