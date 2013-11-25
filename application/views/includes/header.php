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
$result = base_url("index.php/assessment/result");
$manage_user = base_url("index.php/manage/manage_user");
?>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo base_url(); ?>"><b style="color: #ffffff">Ad</b><b style="color: red">Wise</b></a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Meet Us</a></li>
                </ul>
                <div class="navbar-text pull-right" style="margin-bottom: -30px">
                    <?php echo form_open("user/signout"); ?>
                    Logged in as <a href="<?php echo $profile ?>" class="navbar-link"><b><?php echo $this->session->userdata('user_name'); ?></b></a>
                    <button type="submit" value="signout" class="btn btn-danger" style="margin-bottom: 10px; margin-left: 10px">Sign out</button>
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
                    <li <?php if($main_content == 'result'){ echo "class=\"active\""; } ?>>
                        <a href="<?php echo $result ?>"><i class="icon-print icon-black"></i>Report</a></li>
                    <li class="nav-header">User Menu</li>
                    <li <?php if($main_content == 'login/profile'){ echo "class=\"active\""; } ?>>
                        <a href="<?php echo $profile ?>"><i class="icon-user icon-black"></i>Profile</a></li>
                    <li><a href="#"><i class="icon-wrench icon-black"></i>Settings</a></li>
                    <?php
                        $session_username =  $this->session->userdata('user_name'); //แก้เป็น String
                        $user_role = $this->Assessment_model->check_admin($session_username);
                        foreach ($user_role as $row)
                        if( $row->Role == "1" )
                        {
                    ?>
                            <li class="nav-header">Admin Menu</li>
                            <li><a href="#"><i class="icon-cog"></i>Admin Home</a></li>
                            <li><a href="#"><i class="icon-th-list"></i>Manage Assessment Type</a></li>
                            <li><a href="#"><i class="icon-file"></i>Manage Assessment</a></li>
                            <li><a href="#"><i class="icon-tasks"></i>Manage Result</a></li>
                            <li><a href="#"><i class="icon-random"></i>Manage Answer Group</a></li>
                            <li><a href="#"><i class="icon-tags"></i>Manage Occupation</a></li>
                            <li><a href="#"><i class="icon-tags"></i>Manage Academic</a></li>
                            <li <?php if($main_content == 'manage_user'){ echo "class=\"active\""; } ?>>
                                <a href="<?php echo $manage_user; ?>"><i class="icon-user"></i>Manage User</a></li>
                            <li><a href="#"><i class="icon-home"></i>Analytics</a></li>
                    <?php
                        }
                    ?>

                </ul>
            </div><!--/.well -->
        </div><!--/span-->

<!--<li><a href="/about/"{% if page.url contains "/about/" %}class="active"{% endif %}>About me</a></li> -->
<!-- Prototype Active Nav Bar Highlight -->


