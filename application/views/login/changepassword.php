<script>
    function myFunction()
    {
        alert("Success! You have successfully done it.");
    }
</script>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span11">
            <div class="row-fluid">
                <h2 style="margin-top: -30px">Change Password</h2>
                <hr/>
                <div class="span4">
                    <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
                </div><!--/span-->

                <div class="span6">
                    <?php
                    $pro = array(
                        'class' => 'form-horizontal'
                    );

                    echo form_open('user/password',$pro);
                    ?>

                    <div class="control-group">
                        <label class="control-label" for="inputPassword"> Current Password </label>
                        <div class="controls">
                            <input type="password" name="password" value="<?php echo set_value('password'); ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="inputNewPass"> New Password </label>
                        <div class="controls">
                            <input type="password" name="newpass" value="<?php echo set_value('newpass'); ?>">
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="inputConfirm"> Confirm Password </label>
                        <div class="controls">
                            <input type="password" name="confirm" value="<?php echo set_value('confirm'); ?>">
                        </div>
                    </div>


                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" onclick="myFunction()" class="btn btn-success">Save</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                </div><!--/span-->
            </div>
        </div>
    </div>
</div>