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
$prev = "review_qa";
$next = "review_condition";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Review Q&A</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Review Condition &rarr;</a>
    </li>
</ul>
<hr>
    <h3>Result Expression</h3>
    <div style="text-align: center">
<?php
    $controller = "";
    if($this->session->userdata('re_flag') == 1)
        $controller = "assessment/update_resultexp";
    else
        $controller = "assessment/add_resultexp";

    $AsmID = $this->session->userdata('AssessmentID');
    $attr = array('class' => "form-inline");
    echo form_open($controller, $attr);
?>
    <textarea type="text" rows="10" name="result_exp" class="input-block-level" placeholder ="Result Expression"><?php echo $this->session->userdata('Expression'); ?></textarea>
        <div style="text-align: center; margin-top: 20px">
            <a href="#re_desc" role="button" class="btn" data-toggle="modal">How To</a>
            <input type="submit" name="add_exp" class="btn btn-primary" value="Add Expression" />
        </div>
<?php
    echo form_close();
?>
    </div>
<hr>

<!-- Modal -->
<div id="re_desc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">How To</h3>
  </div>
  <div class="modal-body">
    <p> <h5>Result Expression</h5> เป็นรูปแบบของภาษาที่ทีม AdWise ได้พัฒนาขึ้นโดยอาศัยความสัมพันธ์ของตำแหน่งของกลุ่มคำตอบ (Answer group) เทียบกับรูปแบบผลลัพธ์ (Result) ที่มีอยู่ในระบบ การประมวลผลในแต่ละตำแหน่งของผลลัพธ์จะคิดเป็น 1 คำสั่ง (expression) ซึ่งแต่ละคำสั่งจะถูกคั่นด้วยเครื่องหมาย semicolon (;) โดยในการประมวลผลคำตอบ Result Expression จะเลือกกลุ่มคำตอบในคำสั่งที่มีค่าผลรวมที่ผู้ใช้ทำการตอบสูงสุดเป็นตัวแทนกลุ่มในการหาผลลัพธ์ต่อไป 
    </p>
    <h5>Example Usage</h5>
    <pre>pair(1) = {awg(3),awg(2),awg(1)};</pre>
    <p>จากตัวอย่าง หมายความว่า ตำแหน่งแรกของผลลัพธ์สามารถเกิดขึ้นได้จากกลุ่มคำตอบที่มี id = 3,2,1 ได้</p>
  </div>
</div>
