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
            <img class="img-polaroid" style="width: 200px; height: 200px; margin-left: 50px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
        <?php }
        echo br(2);
        } ?>
    </div>

    <div class="span4"style="margin-left: 60px; margin-top: 40px; ">

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

        <p style="width:250%;">
            <div class="modal-body" style="margin-top: -20px; text-align: center;">
                <div style="margin-top: -50px">
                    <?php
                    $ID=0;
                    $userID = $this->session->userdata('user_id');
                    ?>
                    <!--ส่วนที่เพิ่มเข้ามา--!>
                    <br> <b> <font size=5>Assessment Status</font></b>
                    <center><br>
                    <TABLE BORDER="5" CELLPADDING="10" CELLSPACING="200" >
                    <TD><center><strong>Assessment</strong></center></TD>
                    <TD><center><strong>Status</strong></center></TD>
                    <?php $result_stat = $this->User_model->status_dashboard($userID);  //ส่งค่า userID ไปให้ query
                    if($result_stat==null){
                        ?>
                            <TR>
                            <TD><center><span class="btn btn-inverse" type="button">None</span></center></TD>
                            <TD><center><span class="btn btn-inverse" type="button">None</span></center></TD>
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
                            echo "<TD>".$assessment."</TD>"; echo "<TD><span class='btn btn-success' type='botton'>Complete</span></TD>";   //แสดงลิสสถานะ assessment ทั้งหมดของ user ID ที่ส่งไป
                         }
                         else if($status == 'ic'){
                            echo "<TD>".$assessment."</TD>"; echo "<TD><span class='btn btn-danger' type='botton'>Incomplete</span></TD></TD>";
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
        </p>
        </div>


<?php echo form_close(); ?>

<!-- เหลือ assessment status กับ report -->