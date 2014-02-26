<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo (isset($title)) ? $title : "" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Javascript preload -->
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

    <!-- Le styles -->
    <link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("/assets/css/bootstrap-responsive.css"); ?>" rel="stylesheet">

    <!-- Head -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#"><b style="color: #ffffff">Ad</b><b style="color: red">Wise</b></a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Meet Us</a></li>
                    </ul>

                    <div class="navbar-form pull-right" style="margin-bottom: -20px">
                        <?php echo form_open("user/signin"); ?>
                            <input type="text" id="username" name="username" class="span2" placeholder="Username" value="<?php echo set_value('username'); ?>">
                            <input type="password" id="password" name="password" class="span2" placeholder="Password" value="<?php echo set_value('password'); ?>">
                            <button type="submit" value="signin" class="btn">Sign in</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</head>
<body>
<!-- Alert Message Failed Sign in -->
<div id="signin" class="alert alert-danger" style="display:none;font-size: 16px;margin-top: -35px">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Wrong!</strong> Username or password is incorrect.
</div>

<script>
    if(<?php echo json_encode(isset($_GET['error']))?>){
        document.getElementById("signin").style.display="block";
    }
</script>

<!-- Alert Message Failed Forget Password -->
<div id="forget1" class="alert alert-danger" style="display:none; font-size: 16px; margin-top: -35px">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Wrong!</strong> Email is incorrect.
</div>

<script>
    if(<?php echo json_encode(isset($_GET['failed']))?>){
        document.getElementById("forget1").style.display="block";
    }
</script>

<!-- Alert Message Success Forget Password -->
<div id="forget2" class="alert alert-success" style="display:none; font-size: 16px; margin-top: -35px">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Please check your email address.
</div>

<script>
    if(<?php echo json_encode(isset($_GET['success']))?>){
        document.getElementById("forget2").style.display="block";
    }
</script>