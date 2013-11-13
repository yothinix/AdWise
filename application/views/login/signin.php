<!-- Sign In -->
<style type="text/css">
    body {
        padding-top: 60px;
        padding-bottom: 0px;
        background-image: url('assets/images/signin.jpg');
        background-size: 100% 100%;
        background-repeat: no-repeat;

    }

    .form-signin {
        max-width: 350px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }
</style>


<body>
<?php
echo br(6);
?>
<!-- ===== Sign In ===== -->
<div class="container-fluid">
    <?php
        $attr = array(
           'class' => 'form-signup'
        );
        echo form_open("user/signin",$attr);
    ?>

    <h2 class="form-signin-heading">Sign in to AdWise</h2>

    <input type="text" id="username" name="username" class="input-block-level" placeholder="Username" value="<?php echo set_value('username'); ?>">
    <br />
    <input type="password" id="password" name="password" class="input-block-level" placeholder="Password" value="<?php echo set_value('password'); ?>">
    <br />
    <button type="submit" value="signin" class="btn btn-primary btn-large btn-block">Sign in</button>

    <?php
        echo form_close();
    ?>
</div>
<?php
echo br(3);
?>