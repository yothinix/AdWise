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
                <input type="text" id="asm_name" name="asm_name" class="input-block-level" placeholder="Assessment Name" value="<?php echo $this->session->userdata('asm_name'); ?>" />
                <textarea type="text" rows="10" id="asm_desc" name="asm_desc" class="input-block-level" placeholder="Assessment Description"><?php echo $this->session->userdata('asm_desc'); ?></textarea>
                <div class="row">
                    <div class="span4">
                        <select name="asm_type">
                    <?php
                        $get_asm_type = $this->Manage_assessment_type->get_asm_type();
                        foreach($get_asm_type as $dd)
                        {
                            echo "<option value='". $dd['AssessmentTypeID'] ."'";
                            if($dd['AssessmentTypeID'] == $this->session->userdata('asm_type'))
                            //โหลดข้อมูล AssessmentTypeID มาตรงนี้ ถ้าตรง
                                echo "selected=\"selected\"";
                            echo ">". $dd['Name'] ."</option>";
                        }
                    ?>
                        </select>
                    </div>
                    <input type="text" id="total_question" name="total_question" class="input-medium" placeholder="Total Question" value="<?php echo $this->session->userdata('total_question'); ?>" />
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary btn-large input-large">Submit</button>
            <?php
                echo form_close();
            ?>
            <?php
                echo form_open("assessment/clear_create_asm_session"); //Destroy session data
            ?>
                    <button type="submit" class="btn btn-large input-large">Reset</button> <!--เอาไว้ลบค่าในช่องทั้งหมดที่ใส่ไป-->
            <?php
                echo form_close();
            ?>
                </div>
<hr>





