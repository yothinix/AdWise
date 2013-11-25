<h2 style="margin-top: -30px">Dashboard</h2>
<hr/>
<div class="container-fluid">
    <div class="span4" style="margin-left: 30px">
        <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
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
<br><br>
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
            echo "<p>$row->Description</p>";
            ?>
            <p><a class="btn btn-primary btn-large btn-block" href="
                <?php
                echo base_url("index.php/assessment/test/{$row->AssessmentID}/1");
                ?>
            ">Start Test &raquo;</a></p>
            <?php    echo "</div><!-- /.span4 -->";
        }
        ?>
</div>

<?php echo form_close(); ?>

<!-- เหลือ assessment status กับ report -->