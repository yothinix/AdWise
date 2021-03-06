<div class="container-fluid">
    <div class="row-fluid">
        <div class="span11">
            <div class="row-fluid">
                <h2 style="margin-top: -30px">Change Password</h2>
                <hr/>

                <div id="message1" class="alert alert-success" style="display:none;font-size: 14px;width: 700px">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> You have successfully done it.
                </div>

                <div id="message2" class="alert alert-danger" style="display:none;font-size: 14px;width: 700px">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> This is a fatal error.
                </div>

                <div class="span4" style="margin-top: 25px; text-align: center">
                    <?php
                    $get_image = $this->User_model->img($this->session->userdata('user_name'));
                    foreach($get_image as $row) //ดึงข้อมูลมาจาก db
                    {
                    $filename = $row->Image;

                    if($filename=="")
                    { ?>
                        <img class="img-circle" style="width: 200px; height: 200px; margin-left: 15px" src="<?php echo base_url("/uploads/default.jpg") ?>" >
                    <?php }
                    else
                    { ?>
                        <img class="img-circle" style="width: 200px; height: 200px; margin-left: 15px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
                    <?php } }?>
                </div><!--/span-->

                <div class="span6" style="margin-top: 50px">
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
                            <button type="submit" class="btn btn-success" ">Save</button>
                            <button type="reset" class="btn btn-danger" style="margin-left: 10px">Cancel</button>
                            <?php echo form_close(); ?>

                        </div>
                    </div>
                </div><!--/span-->

            </div>
        </div>
    </div>
</div>
<br><br>
<script>
    if(<?php echo json_encode(isset($_GET['success']))?>){
        document.getElementById("message1").style.display="block";
    }
</script>

<script>
    if(<?php echo json_encode(isset($_GET['error']))?>){
        document.getElementById("message2").style.display="block";
    }
</script>