<style type="text/css">
    body {
        padding-top: 76px;
        padding-bottom: 0px;
        background-image: url("<?php echo base_url("/resources/signup.jpg"); ?>");
        background-size: 100% auto;
        background-repeat: no-repeat;
        background-position: center;
    }
    .form-signup {
        max-width: 350px;
        padding: 9px 19px 19px;
        margin: 0 auto 20px;
        background-color: rgba(0,0,0,0.5);
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

    #adtext {
        margin-top: 100px;
        margin-left: 30px;
    }

    #footer {
        position: fixed;
        bottom: 0px;
    }
</style>

<?php echo br(5); ?>

<div class="container-fluid">
    <div class="row-fluid">
        <div id="adtext" class="span5">
            <!--Sidebar content-->
            <h1><b style="color: #ffffff">Ad</b><b style="color: red">Wise</b></h1>
            <h3 style="color: #ffffff">Finding the right career path for high school<br>student is not hard anymore. With AdWise<br>you can find yourself in a few minutes.</h3>
        </div>

        <div class="span4 offset2">
            <?php
            $sign = array(
                'class' => 'form-signup'
                );

            echo form_open('user/signup',$sign); ?>

            <h2 class="form-signup-heading"><b style="color: lightgray">Sign Up to </b><b style="color: #ffffff">Ad</b><b style="color: red">Wise</b></h2>
            <input type="text" id="username" name="username" class="input-block-level" placeholder="Username" value="<?php echo set_value('username'); ?>">
            <br />
            <input type="text" id="email" name="email" class="input-block-level" placeholder="Your Email" value="<?php echo set_value('email'); ?>">
            <br />
            <input type="password" id="password" name="password" class="input-block-level" placeholder="Password" value="<?php echo set_value('password'); ?>">
            <br />
            <input type="password" id="re_password" name="re_password" class="input-block-level" placeholder="Re-type Password" value="<?php echo set_value('re-type_password'); ?>">
            <br />
            <button type="submit" value="submit" class="btn btn-success btn-large btn-block">Sign up</button>

            <a href="#forget" class="pull-right" data-toggle="modal">Forget your password ?</a>
            <?php form_close() ?>
        </div>
    </div>
</div>

<div id="forget" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header" style="margin-top: 20px;margin-right: 10px;margin-left: 10px">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Forget your password ?</h3>
    </div>
    <div class="modal-body" style="text-align: center;margin-right: 10px;margin-left: 10px">
        <?php echo form_open('user/reset_password'); ?>
        <input type="text" name="email" class="input-block-level" placeholder="Email" style="margin-top: 5px">
        <br>
        <button type="submit" class="btn btn-success" style="margin-top: 5px;margin-left: -40px">Send Email</button>
        <?php echo form_close(); ?>
    </div>
</div>
