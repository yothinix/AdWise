<!-- <h2 style="margin-top: -30px">Dashboard</h2>
<hr/> -->
<div class="container-fluid">
    <div class="span4" style="margin-left: 30px">
        <?php
        $get_image = $this->User_model->img($this->session->userdata('user_name'));
        foreach($get_image as $row) //ดึงข้อมูลมาจาก db
        {
        $filename = $row->Image;

        if($filename=="")
        { ?>
            <img class="img-circle" style="width: 150px; height: 150px; margin-left: 15px" src="<?php echo base_url("/uploads/default.jpg") ?>" >
        <?php }
        else
        { ?>
            <img class="img-polaroid" style="width: 150px; height: 150px; margin-left: 15px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
        <?php }
        echo br(2);
        } ?>
    </div>

    <div class="span4">

        <?php
        foreach($dashboard as $row)
        {

            echo form_open('user/dashboard');
            ?>

            <?php echo $row->Name ?> <?php echo $row->Lastname ?>
            <br>
            <?php echo $row->Username ?>
            <br>
            <?php echo $row->Email ?>

        <?php } //ตัวปิด ?>

    </div>
</div>
<br>
<hr>
<div class="container-fluid">
    <div style="border:1px solid black;width:500px;height:150px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;margin-left: 150px;margin-top: 20px;">


        <p style="width:250%;">
            <div class="modal-body" style="margin-top: -40px; text-align: center;">
                <div style="margin-top: -10px">
                    <?php
                    $ID=0;
                    $userID = $this->session->userdata('user_id');
                    ?>
                    <!--ส่วนที่เพิ่มเข้ามา--!>
                    <br> <b> <font size=5>Assessment Status</font></b>
                    <center>
                    <TABLE BORDER="3" CELLPADDING="3" CELLSPACING="3" >
                    <TD><center><strong>Assessment</strong></center></TD>
                    <TD><center><strong>Status</strong></center></TD>
                    <?php $result_stat = $this->User_model->status_dashboard($userID);  //ส่งค่า userID ไปให้ query
                    if($result_stat==null){
                        ?>
                            <TR>
                            <TD><span class='label label-Default'>None</span></TD>
                            <TD><span class='label label-Default'>None</span></TD>
                            </TR>
                        <?php
                    }else{
                        foreach($result_stat as $stat){
                        $assessment = $stat->Assessment;
                        $status = $stat->Status;
                        ?>
                        <TR>
                         <?php
                         if($status == 'cp'){
                            echo "<TD>".$assessment."</TD>"; echo "<TD><span class='label label-success'>Success</span></TD>";   //แสดงลิสสถานะ assessment ทั้งหมดของ user ID ที่ส่งไป

                         ?>
                         </TR>
                    <?php
                        }
                        }
                    }
                    ?>
                    </TABLE></center><br>
                    <!--ส่วนที่เพิ่มเข้ามา--!>
                    </div>
        </p>
        </div>
 </div>

<?php echo form_close(); ?>

<!-- เหลือ assessment status กับ report -->