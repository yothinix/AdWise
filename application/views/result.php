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
<div class="page-header">
    <h2 style="margin-top: -30px">Report </h2><small><?php echo "ชื่อแบบทดสอบที่ทำ" ?></small>
</div>
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
            <h3>Test Result</h3>
            <div id="name_asset" class="span7">
                <h2>Your Meyer-Briggs Type Indicator is:</h2>
            </div>
            <div id="asset_result" class="span4">
                <pre><h1 style="text-align: left">ISTJ</h1></pre>
            </div>
        </div>
        <div id="result_content2" class="row" style="margin-left: 10px">
            <div id="name_asset" class="span6">
                <h3 style="text-align: center">Career Path</h3>
                <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div id="asset_result" class="span5">
                <h3 style="text-align: center">Academic Path</h3>
                <p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>
</div><!--/span-->

<hr>



