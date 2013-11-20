<div class="container-fluid">
    <div class="row-fluid">
        <div class="span11">
        <div class="row-fluid">
            <h2 style="margin-top: -30px">Profile</h2>
            <hr/>
            <div class="span4">
                <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
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
                        <input type="radio" id="gender" value=""> Male
                        <input type="radio" id="gender" value=""> Female
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputBirthday"> Birthday </label>
                    <div class="controls">
                        <div class='input-append date' id='datetimepicker1'>
                            <input placeholder="Birthday" data-format='dd/MM/yyyy' type='text' />
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
                    <div class="controls">
                        <button type="submit" class="btn btn-success">Save</button>
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
<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-datetimepicker.pt-BR.js"); ?>"></script>
