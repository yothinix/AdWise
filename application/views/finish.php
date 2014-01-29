<style>
    /* ROW CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .row .span4 {
        text-align: center;
    }
    .row h3 {
        font-weight: normal;
    }
    .row .span4 p {
        margin-left: 10px;
        margin-right: 10px;
    }
</style>
    <h2 style="margin-top: -30px">Report</h2>
<hr/>
<div class="row">
<?php
    $asm_info = $this->Assessment_model->get_asm_info(1); //เอาค่ามาจาก session วิธีเดียวกับ Take an Assessment
    foreach($asm_info as $asm_info_row)
    {
    echo "<div class=\"span4\">";
        ?>
        <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
        <?php
        echo heading("$asm_info_row->Name", 3);
        echo "<p>$asm_info_row->Description</p>";
        ?>
        <p><a class="btn btn-primary btn-large btn-block" href="
    <?php
            echo base_url("index.php/assessment/test/{$asm_info_row->AssessmentID}/1");
            ?>
        "><i class="icon-repeat icon-white"></i> Test Again</a></p>
        <?php    echo "</div><!-- /.span4 -->";
        }
        ?>
    <div id="result_content" class="span8" style="margin-left: 10px">
        <div id="result_content1" class="row" style="margin-left: 10px">
            <h2>View your result</h2>
            <a href="<?php echo base_url("index.php/Resultexp/Summation/{$UserID}/{$AsmID}"); ?>" class="btn btn-large btn-block btn-primary">Click</a>
        </div>
    </div>
</div><!--/span-->

<hr>



