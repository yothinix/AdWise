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
            <h2 style="margin-top: -30px">Profile</h2>
            <hr/>
            <br>
            <div class="span4">
                <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
                <br><br>

                <!-- Button to trigger modal -->
                <a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

                <!-- Modal -->
                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Modal header</h3>
                    </div>
                    <div class="modal-body">
                        <p>One fine body…</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </div>

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
                    <div class="controls">
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
<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-datetimepicker.pt-BR.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-alert.js"); ?>"></script>

