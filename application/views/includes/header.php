<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AdWise | Assessment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
    <style type="text/css">
        body {
            padding-top: 60px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    </style>
    <link href="<?php echo base_url("/assets/css/bootstrap-responsive.css"); ?>" rel="stylesheet">


    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("/assets/css/bootstrap-datetimepicker.min.css"); ?>">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

</head>

<body>

<?php
$asmlist = base_url("index.php/assessment/asmlist");
$profile = base_url("index.php/user/profile");
$change = base_url("index.php/user/changepassword");
?>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">AdWise</a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="#about">About</a></li>
                </ul>
                <div class="navbar-text pull-right" style="margin-bottom: -30px">
                    <?php echo form_open("user/signout"); ?>
                    Logged in as <a href="<?php echo $profile ?>" class="navbar-link"><?php echo $this->session->userdata('user_name'); ?></a>
                    <button type="submit" value="signout" class="btn" style="margin-bottom: 10px; margin-left: 10px">Sign out</button>
                    <?php echo form_close(); ?>
                </div>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <ul class="nav nav-list">
                    <li class="nav-header">Main Menu</li>
                    <li><a href="#"><i class="icon-home icon-black"></i>Home</a></li>
                    <li <?php if($main_content == 'assessment_list' || $main_content == 'home')
                            { echo "class=\"active\""; } ?>>
                        <a href="<?php echo $asmlist ?>"><i class="icon-edit icon-black"></i>Assessment</a></li>
                    <li><a href="#"><i class="icon-print icon-black"></i>Report</a></li>
                    <li class="nav-header">User Menu</li>
                    <li <?php if($main_content == 'login/profile'){ echo "class=\"active\""; } ?>>
                        <a href="<?php echo $profile ?>"><i class="icon-user icon-black"></i>Profile</a></li>
                    <li <?php if($main_content == 'login/changepassword'){ echo "class=\"active\""; } ?>>
                        <a href="<?php echo $change?>"><i class="icon-lock icon-black"></i>Change Password</a></li>
                    <li><a href="#"><i class="icon-wrench icon-black"></i>Settings</a></li>
                    <div id="push"></div>
                    <div id="push"></div>
                    <div id="push"></div>
                    <div id="push"></div>
                    <div id="push"></div>
                </ul>
            </div><!--/.well -->
        </div><!--/span-->

<!--<li><a href="/about/"{% if page.url contains "/about/" %}class="active"{% endif %}>About me</a></li> -->
<!-- Prototype Active Nav Bar Highlight -->


