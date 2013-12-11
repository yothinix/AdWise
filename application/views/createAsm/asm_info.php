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

    .nav-tabs a {
        font-size: 14px;
    }
</style>

<h2 style="margin-top: -30px">Create Assessment</h2>
<hr/>
<?php
echo form_close();
$page = "question_and_answer";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/manage/manage_assessment"); ?>">&larr; Manage Assessment</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$page}"); ?>">Question & Answer &rarr;</a>
    </li>
</ul>
<hr>
            <?php
                echo form_open("assessment/init_create_asm"); //Save ASM_info_data to initialize
            ?>
                <input type="text" id="asm_name" name="asm_name" class="input-block-level" placeholder="Assessment Name" value="<?php echo set_value('asm_name'); ?>" />
                <textarea type="text" rows="10" id="asm_desc" name="asm_desc" class="input-block-level" placeholder="Assessment Description" value="<?php echo set_value('asm_desc'); ?>"></textarea>
                <div class="row">
                    <div class="span4">
                    <?php
                        $options = array(
                            'desc' => 'Type name',
                            '1'  => 'Single Choice',
                            '2'    => 'Multiple Choice',
                            '3'   => 'True/False',
                            'ASM_type_ID' => 'ASM_Type_Name',   //ดึงจาก DB แบบนี้
                        );

                        echo form_dropdown('asm_type', $options, 'desc');
                    ?>
                    </div>
                    <input type="text" id="total_question" name="total_question" class="input-medium" placeholder="Total Question" value="<?php echo set_value('total_question'); ?>" />
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-success btn-large input-large">Submit</button>
                    <button class="btn btn-danger btn-large input-large">Reset</button> <!--เอาไว้ลบค่าในช่องทั้งหมดที่ใส่ไป-->
                </div>
<hr>





