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
    $prev = "asm_info";
    $next = "review_qa";
    $TotalChoice = (int) $this->Manage_assessment_type->get_total_choice($this->session->userdata('asm_type'));
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Assessment Info</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Review Q&A &rarr;</a>
    </li>
</ul>
<hr>
<!-- HTML in AngularJS -->
<div>
    <div>
        <span>Total Question: <?php echo $this->session->userdata('total_question'); ?></span>
            <fieldset>Question</fieldset>
                <?php
                    $attr = array('class' => "form-inline");
                    echo form_open('assessment/add_question_and_answer', $attr);
                    $asm_type = $this->session->userdata('asm_type');
                ?>
                <input type="text" name="data_qnr" class="input-small" placeholder="Question No."/>
                <input type="text" name="data_detail" class="input-xxlarge" placeholder="Question Detail"/>
                <fieldset>Answer</fieldset>
                <?php
                    $TotalChoice = $this->Manage_assessment_type->get_total_choice($asm_type);
                    $counter = 0;

                    //วนลูปสร้าง Answer ตาม AssessmentType ตรงนี้
                    while($counter < $TotalChoice)
                    {
                ?>
                <div> 
                    <input type="text" name="<?php echo "data_choice_{$counter}_detail"; ?>" class="input-xxlarge" placeholder="Answer Detail"/>
                    <div class="row">
                        <div class="span4">
                            <select name="<?php echo "data_choice_{$counter}_awg"; ?>"> 
                                <?php
                                    $get_answer_group = $this->Manage_answer_group->get_awg();
                                    foreach($get_answer_group as $dd) 
                                    {
                                        echo "<option value='". $dd['AnswerGroupID'] ."'";
                                        if($dd['AnswerGroupID'] == $this->session->userdata('answer_group'))
                                            echo "selected=\"selected\"";
                                            echo ">". $dd['Name'] ."</option>";
                                    }
                                    $counter++;
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <br>
                    <input type="submit" name="mysubmit" class="btn input-large" style="margin-top:-20px" value="+ Add more Question" />
                    <pre>
                        <?php
                            var_dump($this->session->userdata('QNR'));
                            var_dump($this->session->userdata('CID'));
                            echo form_close();
                        ?>
                    </pre>
                </div>
            </div>
        <hr>




