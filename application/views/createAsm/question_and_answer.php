<style>
    /* ROW CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */

    .row h3 {
        font-weight: normal;
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

    //session data for update question_form
    $data = array('QuestionNr' => 0, 'Q_Detail' => "");
    if($data['QuestionNr'] == 0) $data['QuestionNr'] = "Question No.";
    else $data['QuestionNr'] = $this->session->userdata('QuestionNr');
    if($data['Q_Detail'] == "") $data['Q_Detail'] = "Question Detail";
    else $data['Q_Detail'] = $this->session->userdata('Q_Detail');
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
                    <small>Question No. </small>
                    <input type="text" name="data_qnr" class="input-small" value="<?php echo $this->session->userdata('QuestionNr'); ?>"/>
                    <small>Detail </small>
                    <input type="text" name="data_detail" class="input-xxlarge" value="<?php echo $this->session->userdata('Q_Detail'); ?>"/>
                <fieldset>Answer</fieldset>
                <?php
                    $TotalChoice = $this->Manage_assessment_type->get_total_choice($asm_type);
                    $counter = 1;

                    //วนลูปสร้าง Answer ตาม AssessmentType ตรงนี้
                    while($counter <= $TotalChoice)
                    {
                ?>
                <div> 
                    <small><?php echo "Answer Detail ({$counter})"; ?></small>
                    <input type="text" name="<?php echo "data_choice_{$counter}_detail"; ?>" class="input-xlarge" value="<?php echo $this->session->userdata("C_Detail_{$counter}"); ?>"/>
                        <small>Answer Group </small>
                            <select name="<?php echo "data_choice_{$counter}_awg"; ?>" class="input-small"> 
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
                    <?php
                    }
                    ?>
                    <br>
                    <input type="submit" name="mysubmit" class="btn btn-success input-large" style="margin-top:5px" value="+ Add Question" />
                    <br>
                        <?php
                            echo "#### DEBUG ####";
                            var_dump($this->session->userdata('QNR'));
                            var_dump($this->session->userdata('CID'));
                            echo "under is all userdata";
                            var_dump($this->session->all_userdata());
                            echo form_close();
                        ?>
                </div>
            </div>
        <hr>




