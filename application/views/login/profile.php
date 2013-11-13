<div class="container-fluid">
    <div class="row-fluid">
        <div class="span9">
        <div class="row-fluid">
            <div class="span3">
                <h2 style="margin-top: -30px">Profile</h2>
                <hr/>
                <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
            </div><!--/span-->

            <div class="span4">
                <?php echo br(2); ?>
                <?php
                $pro = array(
                    'class' => 'form-horizontal'
                );
                echo form_open("user/profile",$pro);
                ?>

                <div class="control-group">
                    <label class="control-label" for="inputName"> Name </label>
                    <div class="controls">
                        <input type="text" id="name" placeholder="Name" value="<?php echo set_value('name'); ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputLastname"> Lastname </label>
                    <div class="controls">
                        <input type="text" id="lastname" placeholder="Lastname" value="<?php echo set_value('lastname'); ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputGender"> Gender </label>
                    <div class="controls">
                        <input type="radio" name="gender" value="male" <?php echo set_radio('gender', 'male', TRUE); ?> /> Male
                        <input type="radio" name="gender" value="female" <?php echo set_radio('gender', 'female'); ?> /> Female
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputBirthday"> Birthday </label>
                    <div class="controls">
                    <input type="text" id="birthday" placeholder="Birthday" value="<?php echo set_value('birthday'); ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputPhone"> Phone </label>
                    <div class="controls">
                        <input type="text" id="phone" placeholder="Phone" value="<?php echo set_value('phone'); ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputEmail"> Email </label>
                    <div class="controls">
                        <input type="text" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                     </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" value="save" class="btn btn-success">Save</button>
                        <button type="clear" value="clear" class="btn btn-danger">Clear</button>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="inputNewpassword"> New Password </label>
                    <div class="controls">
                        <input type="text" id="newpassword" placeholder="New Password" value="<?php echo set_value('newpassword'); ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputConfirmpassword"> Confirm Password </label>
                    <div class="controls">
                        <input type="text" id="confirmpassword" placeholder="Confirm Password" value="<?php echo set_value('confirmpassword'); ?>">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" value="save" class="btn btn-success btn-block">Save</button>
                        <button type="clear" value="clear" class="btn btn-danger btn-block">Clear</button>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div><!--/span-->
        </div>
    </div>
</div>
</div>
