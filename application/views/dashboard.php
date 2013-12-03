<!-- <h2 style="margin-top: -30px">Dashboard</h2>
<hr/> -->
<div class="container-fluid">
    <div class="span4" style="margin-left: 30px">
        <?php
        $get_image = $this->user_model->img($this->session->userdata('user_name'));
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

        <?php
        $assessment = $this->user_model->get_assessment();
        foreach($assessment as $row)
        {
            echo "<div class=\"span4\">";
            ?>
            <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
            <?php
            echo heading("$row->Name", 3);
            ?>

            <?php    echo "</div><!-- /.span4 -->";
        }
        ?>
</div>

<?php echo form_close(); ?>

<!-- เหลือ assessment status กับ report -->