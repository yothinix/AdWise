<style type = "text/css">
    th {
        background : #6C7B8B;
        color : white;
        test-align : left;
    }
    td {
        font-size: 14px;
    }
    .modal-body {
        font-size: 14px;
    }
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

<h2 style="margin-top: -30px">Manage User</h2>
<hr />
<table class="table table-bordered">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Lastname</th>
        <th style="text-align: center">Controller</th>
    </tr>

    <?php
    $ID=0;
    $user = $this->User_model->manage_user();
    foreach($user as $row)
    {
        $userID = $row->ID;
        ?>

        <tr>
            <td style="text-align: center"><?php echo $row->ID ?>  </td>
            <td style="text-align: center"><?php echo $row->Name ?>  </td>
            <td style="text-align: center"><?php echo $row->Lastname ?>  </td>
            <td style="text-align: center">
                <a href="#view<?php echo $userID; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-user"></i></a>
                <a href="#status<?php echo $userID; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-edit"></i></a>
                <a href="#edit<?php echo $userID; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-pencil"></i></a>
                <a href="#del<?php echo $userID; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-trash"></i></a>
            </td>
        </tr>

    <?php } // ปิด foreach ?>
</table>


<?php
$ID=0;
$user = $this->User_model->manage_user();
foreach($user as $row)
{
$userID = $row->ID;
?>
<!-- Model View -->
<div id="view<?php echo $userID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
        <h3 id="myModalLabel"><?php echo $row->Username ?></h3>
    </div>
    <div class="modal-body" style="margin-top: -10px; margin-left: 20px">
        <div class="span5" style="margin-top: 20px">
            <?php
            $get_name = $this->User_model->get_creatorName($userID);
            $get_image = $this->User_model->img($get_name);
            foreach($get_image as $img) //ดึงข้อมูลมาจาก db
            {
                $filename = $img->Image;
                if($filename=="")
                { ?>
                    <img class="img-circle" style="width: 150px; height: 150px; margin-left: 15px" src="<?php echo base_url("/uploads/default.jpg") ?>" >
                <?php }
                else
                { ?>
                    <img class="img-polaroid" style="width: 150px; height: 150px; margin-left: 15px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
                <?php }
            }?>
        </div>
        <div class="row">
            <div class="span5" style="margin-left: 10px; margin-top: 5px">
                <b>Name </b> <?php echo $row->Name ?>
                <br>
                <b>Lastname </b> <?php echo $row->Lastname ?>
                <br>
                <b>Gender </b> <?php if($row->Gender==0) echo "Male"; ?> <?php if($row->Gender==1) echo "Female"; ?>
                <br>
                <b>Birthday</b> <?php echo $row->Birthday ?>
                <br>
                <b>Phone</b> <?php echo $row->Phone ?>
                <br>
                <b>Email </b> <?php echo $row->Email ?>
                <br>
                <b>Role </b> <?php if($row->Role==0) echo "User"; ?> <?php if($row->Role==1) echo "Admin"; ?>



                </div>
            </div>
            <div class="row">
                <div style="text-align: center; margin-top: 20px">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>
        </div> <!-- ปิด modal-body -->
    </div>

    <!-- Modal Status -->

    <!-- ปิด Modal status -->
            <div id="status<?php echo $userID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel"><?php echo $row->Username ?></h3>
                </div>
                <div class="modal-body" style="margin-top: -10px; text-align: center;">
                    <div style="margin-top: -20px">
                        <!--ส่วนที่เพิ่มเข้ามา--!>
                    <br> <b> <font size=4>Status</font></b>
                    <center>
                    <TABLE BORDER="3" CELLPADDING="3" CELLSPACING="3" >
                    <TD><strong>Assessment</strong></TD>
                    <TD><strong>Status</strong></TD>
                    <?php $result_stat = $this->User_model->status_user($userID);  //ส่งค่า userID ไปให้ query
                    if($result_stat==null){
                        ?>
                            <TR>
                            <TD><span class='label label-Default'>None</span></TD>
                            <TD><span class='label label-Default'>None</span></TD>
                            </TR>
                        <?php
                    }else{
                    foreach($result_stat as $stat) //รับค่ามาแสดงผล
                    {   //แทนตัวแปร
                        $assessment = $stat->Name;
                        $status = $stat->Status
                        ?>
                        <TR>
                         <?php
                         if($status == 'cp'){
                            echo "<TD>".$assessment."</TD>"; echo "<TD><span class='label label-success'>Complete</span></TD>";   //แสดงลิสสถานะ assessment ทั้งหมดของ user ID ที่ส่งไป
                         }
                         else if($status == 'ic'){
                            echo "<TD>".$assessment."</TD>"; echo "<TD><span class='label label-danger'>Incomplete</span></TD>";
                         }
                         ?>
                         </TR>
                    <?php
                    }
                    }
                    ?>
                    </TABLE></center><br>
                    <!--ส่วนที่เพิ่มเข้ามา--!>
                    </div>

                </div> <!-- ปิด modal-body -->
            </div>

    <!-- Model Edit -->
            <script type='text/javascript'>
                $(function() {
                    $('#datetimepicker<?php echo $userID; ?>').datetimepicker({
                        language: 'pt-BR'
                    });
                });
            </script>
            <div id="edit<?php echo $userID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel"><?php echo $row->Username ?></h3>
                </div>
                <div class="modal-body" style="margin-top: -10px; margin-left: 50px">
                    <div class="span5" style="margin-top: 20px">
                        <?php
                        $get_name = $this->User_model->get_creatorName($userID);
                        $get_image = $this->User_model->img($get_name);
                        foreach($get_image as $img) //ดึงข้อมูลมาจาก db
                        {
                            $filename = $img->Image;

                            if($filename=="")
                            { ?>
                                <img class="img-circle" style="width: 150px; height: 150px" src="<?php echo base_url("/uploads/default.jpg") ?>" >
                            <?php }
                            else
                            { ?>
                                <img class="img-polaroid" style="width: 150px; height: 150px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
                            <?php }
                            echo form_open_multipart('manage/upload_photo'); ?>

                            <span class="btn btn-info btn-file">
                            Browse <input type="file"  name="photo">
                        </span>
                            <span class="btn btn-success btn-submit">
                            Upload <input type="submit"  name="upload">
                        </span>
                            <br><br><br>
                            <?php echo form_close(); }?>
                    </div>
                    <div class="row">
                        <?php echo form_open("manage/update_user/{$userID}"); ?>
                        <b>Name </b>
                        <input type="text" name="name" class="input-medium" value="<?php echo $row->Name ?>">
                        <br>
                        <b>Lastname </b>
                        <input type="text" name="lastname" class="input-medium" value="<?php echo $row->Lastname ?>">
                        <br>
                        <b>Gender </b>
                        <input type="radio" name="gender" value="0" <?php if($row->Gender==0) echo "checked"; ?> > Male
                        <input type="radio" name="gender" value="1" <?php if($row->Gender==1) echo "checked"; ?> > Female
                        <br>
                        <b>Birthday</b>
                        <div class='input-append' id='datetimepicker<?php echo $userID; ?>'>
                            <input type='text' name="birthday" class="input-medium" data-format='yyyy-MM-dd' value="<?php echo $row->Birthday ?>" >
                        <span class='add-on'>
                            <i data-date-icon='icon-calendar'></i>
                        </span>
                        </div>
                        <br>
                        <b>Phone</b>
                        <input type="text" name="phone" class="input-medium" value="<?php echo $row->Phone ?>">
                        <br>
                        <b>Email </b>
                        <input type="text" name="email" class="input-medium" value="<?php echo $row->Email ?>">
                        <br>
                        <b>Role </b>
                        <input type="radio" name="role" value="0" <?php if($row->Role==0) echo "checked"; ?> > User
                        <input type="radio" name="role" value="1" <?php if($row->Role==1) echo "checked"; ?> > Admin
                        <div class="row">
                            <div style="text-align: center; margin-top: 20px">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div> <!-- ปิด modal-body -->
            </div> <!-- ปิด edit -



    <!-- Modal Delete -->
            <div id="del<?php echo $userID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                    <h3 id="myModalLabel">Delete User</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure? </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/delete_user/{$userID}"); ?>">    Yes    </a>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
            </div> <!-- ปิด delete -->

            <?php } // ปิด foreach ?>

            <script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-datetimepicker.min.js"); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-alert.js"); ?>"></script>