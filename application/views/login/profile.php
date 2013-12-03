<script>
    function myFunction()
    {
        alert("Success! You have successfully done it.");
    }
</script>

<style type="text/css">
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 999px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        cursor: inherit;
        display: block;
    }
    .btn-submit {
        position: relative;
        overflow: hidden;
    }
    .btn-submit input[type=submit] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 999px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        cursor: inherit;
        display: block;
    }
</style>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span11">
        <div class="row-fluid">
            <h2 style="margin-top: -30px">Profile</h2>
            <hr/>
            <br>
            <div class="span4">
                <?php
                $get_image = $this->user_model->img($this->session->userdata('user_name'));
                foreach($get_image as $row) //ดึงข้อมูลมาจาก db
                {
                    $filename = $row->Image;

                    if($filename=="")
                    { ?>
                        <img class="img-circle" style="width: 200px; height: 200px; margin-left: 15px" src="<?php echo base_url("/uploads/default.jpg") ?>" >
                    <?php }
                    else
                    { ?>
                        <img class="img-polaroid" style="width: 200px; height: 200px; margin-left: 15px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
                    <?php }

                    echo br(2);

                    echo form_open_multipart('user/upload'); ?>

                    <div class="input-group" style="text-align: center">
                        <div class="input-group-btn">
                            <span class="btn btn-info btn-file">
                                Browse <input type="file"  name="photo">
                            </span>

                            <span class="btn btn-success btn-submit">
                                Upload <input type="submit"  name="upload">
                            </span>
                        </div>
                    </div>

                    <?php echo form_close();
                } //ตัวปิด ?>
            </div><!--/span-->

            <div class="span6">
                <?php
                $pro = array(
                    'class' => 'form-horizontal'
                );

                foreach($profile as $row)
                {

                echo form_open('user/update',$pro);
                ?>


                <div class="control-group">
                    <label class="control-label" for="inputName"> Name </label>
                    <div class="controls">
                        <input type="text" name="name" value="<?php echo $row->Name ?>">
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="inputLastname"> Lastname </label>
                    <div class="controls">
                        <input type="text" name="lastname" value="<?php echo $row->Lastname ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputGender"> Gender </label>
                    <div class="controls">
                        <input type="radio" name="gender" value="0" <?php echo $row->Gender ?> > Male
                        <input type="radio" name="gender" value="1" <?php echo $row->Gender ?>> Female
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputBirthday"> Birthday </label>
                    <div class="controls">
                        <div class='input-append' id='datetimepicker1'>
                            <input type='text' name="birthday" data-format='yyyy-MM-dd' value="<?php echo $row->Birthday ?>" >
                         <span class='add-on'>
                         <i data-date-icon='icon-calendar'>
                         </i>
                         </span>
                        </div>
                    </div>
                </div>
                    <script type='text/javascript'>
                        $(function() {
                            $('#datetimepicker1').datetimepicker({
                                language: 'pt-BR'
                                });
                            });
                    </script>

                <div class="control-group">
                    <label class="control-label" for="inputPhone"> Phone </label>
                    <div class="controls">
                        <input type="text" name="phone" value="<?php echo $row->Phone ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputEmail"> Email </label>
                    <div class="controls">
                        <input type="text" name="email" value="<?php echo $row->Email ?>">
                     </div>
                </div>

                <div class="control-group">
                    <div class="controls" style="text-align: center">
                        <button type="submit" onclick="myFunction()" class="btn btn-success">Save</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>

                <?php } //ตัวปิด ?>

            </div><!--/span-->
        </div>
    </div>
</div>
</div>


<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-datetimepicker.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-alert.js"); ?>"></script>

