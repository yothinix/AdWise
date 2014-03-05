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
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("/assets/css/bootstrap-datetimepicker.min.css"); ?>">
    <style type="text/css">
        body {
            padding-top: 60px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>

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
//$result = base_url("index.php/assessment/result");  //OLD ONE FOR DIRECT USE OF ASSESSMENT DEBUGGING
$result = base_url("index.php/result/view/{$this->session->userdata('user_id')}");
$manage_user = base_url("index.php/manage/manage_user");
$manage_assessment = base_url("index.php/manage/manage_assessment");
$manage_assessment_type = base_url("index.php/manage/manage_assessment_type");
$manage_answer_group = base_url("index.php/manage/manage_answer_group");
$manage_result = base_url("index.php/manage/manage_result");
$manage_occupation = base_url("index.php/manage/manage_occupation");
$dashboard = base_url("index.php/user/dashboard");
$academic = base_url("index.php/manage/manage_academic");
$tags = base_url("index.php/manage/manage_tags");
$analytics = base_url("index.php/manage/analytics");
?>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php
            if($this->session->userdata('user_id') != null)
                echo base_url("index.php/user/dashboard");
            else
                echo base_url();
            ?>"><b style="color: #ffffff">Ad</b><b style="color: red">Wise</b></a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="<?php echo base_url("index.php/feature/index"); ?>">Features</a></li>
                    <li><a href="<?php echo base_url("index.php/meetus/index"); ?>">Meet Us</a></li>
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


