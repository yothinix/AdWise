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



<!-- เหลือ Assessment Status กับ Assessment Report -->