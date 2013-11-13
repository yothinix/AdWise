<!-- ===== Sign Up ===== -->

<style type="text/css">
    body {
        padding-top: 60px;
        padding-bottom: 0px;
        background-image: url("<?php echo base_url("/resources/signup.jpg"); ?>");
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }
    .form-signup {
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
    .form-signup .form-signup-heading,
    .form-signup .checkbox {
        margin-bottom: 10px;
    }
    .form-signup input[type="text"],
    .form-signup input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }
</style>

<body>
<?php
echo br(5);
?>
<!-- ===== Sign Up ===== -->
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span7">
            <!--Sidebar content-->
        </div>

    <div class="span4">
    <?php
    $attr = array(
        'class' => 'form-signup'
    );
    echo form_open("user/signup",$attr);
    ?>

    <h2 class="form-signup-heading">Please sign up</h2>

    <input type="text" id="username" name="username" class="input-block-level" placeholder="Username" value="<?php echo set_value('username'); ?>">
    <br />
    <input type="text" id="email" name="email" class="input-block-level" placeholder="Your Email" value="<?php echo set_value('email'); ?>">
    <br />
    <input type="password" id="password" name="password" class="input-block-level" placeholder="Password" value="<?php echo set_value('password'); ?>">
    <br />
    <input type="password" id="re-type_password" name="re-type_password" class="input-block-level" placeholder="Re-type Password" value="<?php echo set_value('re-type_password'); ?>">
    <br />
    <button type="submit" value="submit" class="btn btn-success btn-large btn-block">Sign up</button>
        <a id="forget" href="#" class="pull-right">Forget your password ?</a>


    <?php
    echo form_close();
    ?>

</div>
</div>
</div>
