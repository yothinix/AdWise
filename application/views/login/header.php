<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo (isset($title)) ? $title : "" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("/assets/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>

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

    <!-- POPUP -->
    <SCRIPT TYPE="text/javascript">
        function popup(mylink, windowname)
        {
            if (! window.focus)return true;
            var href;
            if (typeof(mylink) == 'string')
                href=mylink;
            else
                href=mylink.href;
            window.open(href, windowname, 'width=400,height=200,scrollbars=yes');
            return false;
        }
    </SCRIPT>
</head>
<body>>