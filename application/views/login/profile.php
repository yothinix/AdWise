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
    font {
        font-weight: bold;
        color: #FF0000;
    }
</style>

<script>
    $(document).ready(function(){
        $('#contact-form').validate(
            {
                rules: {
                    name: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    phone: {
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email: {
                        email: true,
                        required: true
                    }
                },
                highlight: function(element) {
                    $(element).closest('.control-group').removeClass('success').addClass('error');
                },
                success: function(element) {
                    element
                        .text('OK!').addClass('valid')
                        .closest('.control-group').removeClass('error').addClass('success');
                }
            });
    }); // end document.ready
</script>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span13">
        <div class="row-fluid">
            <h2 style="margin-top: -30px">Profile</h2>
            <hr/>
            <br>
            <div class="span4" style="text-align: center">
                <?php
                $get_image = $this->User_model->img($this->session->userdata('user_name'));
                foreach($get_image as $row) //ดึงข้อมูลมาจาก db
                {
                    $filename = $row->Image;

                    if($filename=="")
                    { ?>
                        <img class="img-circle" style="width: 200px; height: 200px" src="<?php echo base_url("/uploads/default.jpg") ?>" >
                    <?php }
                    else
                    { ?>
                        <img class="img-circle" style="width: 200px; height: 200px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
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

            <div class="span7">
                <?php
                    foreach($profile as $row)
                    {
                        $form = array('class' => 'form-horizontal' , 'id' => 'contact-form');
                        echo form_open('user/update',$form);
                ?>

                <!-- <form action="user/update" id="contact-form" class="form-horizontal"> -->

                <div class="control-group">
                    <label class="control-label" for="inputName"> Name <font>*</font> </label>
                    <div class="controls">
                        <input type="text" name="name" value="<?php echo $row->Name ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputLastname"> Lastname <font>*</font> </label>
                    <div class="controls">
                        <input type="text" name="lastname" value="<?php echo $row->Lastname ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputGender"> Gender </label>
                    <div class="controls" style="font-size: 14px">
                        <input type="radio" name="gender" value="0" <?php if($row->Gender==0) echo "checked"; ?> style="margin-top: -3px"> Male &nbsp;&nbsp;
                        <input type="radio" name="gender" value="1" <?php if($row->Gender==1) echo "checked"; ?> style="margin-top: -3px"> Female
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
                    <label class="control-label" for="inputEmail"> Email <font>*</font> </label>
                    <div class="controls">
                        <input type="text" name="email" value="<?php echo $row->Email ?>">
                     </div>
                </div>

                <div class="control-group">
                    <div class="controls" style="margin-top: 10px">
                        <button type="submit" class="btn btn-success" style="margin-left: 5px">Save</button>
                        <button type="reset" class="btn btn-danger" style="margin-left: 10px">Cancel</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- </form> -->
                <?php echo form_close(); } ?>
            </div><!--/span-->
        </div>
    </div>
</div>
</div>

<style type="text/css">
    label.valid {
        width: 24px;
        height: 24px;
        background: url(<?php echo base_url("/assets/img/valid.png"); ?>) center center no-repeat;
        display: inline-block;
        text-indent: -9999px;
    }
    label.error {
        font-weight: bold;
        color: red;
        padding: 2px 8px;
        margin-top: 2px;
    }
</style>

<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-datetimepicker.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/jquery.validate.min.js"); ?>"></script>


