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
    $controller = "";
    $asm_name = $this->session->userdata('asm_name');
    $asm_desc = $this->session->userdata('asm_desc');
    $asm_type = $this->session->userdata('asm_type');
    $total_question = $this->session->userdata('total_question');
    if($this->session->userdata('info_flag') == 1)
        $controller = "assessment/update_asm_info";
    else
        $controller = "assessment/init_create_asm";
    echo form_open($controller);
?>
                <label>Assessment Name</label>
                <input type="text" name="asm_name" class="input-block-level" value="<?php echo $asm_name; ?>" />
                <label>Assessment Description</label>
                <textarea type="text" rows="10" name="asm_desc" class="input-block-level"><?php echo $asm_desc; ?></textarea>
                <div class="row">
                    <div class="span4">
                        <select name="asm_type">
                    <?php
                        $get_asm_type = $this->Manage_assessment_type->get_asm_type();
                        foreach($get_asm_type as $dd)
                        {
                            echo "<option value='". $dd['AssessmentTypeID'] ."'";
                            if($dd['AssessmentTypeID'] == $asm_type)
                                echo "selected=\"selected\"";
                            echo ">". $dd['Name'] ."</option>";
                        }
                    ?>
                        </select>
                    </div>
                    <input type="text" name="total_question" class="input-medium" placeholder="Total Question" value="<?php echo $total_question; ?>" />
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary btn-large input-large">Submit</button>
<?php
                echo form_close();
                echo form_open("assessment/clear_create_asm_session"); //Destroy session data
?>
                    <button type="submit" class="btn btn-large input-large">Reset</button> <!--เอาไว้ลบค่าในช่องทั้งหมดที่ใส่ไป-->
<?php
                echo form_close();
?>
                </div>
<hr>





