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

<script type="text/javascript">
    function limit()
    {
        $(".alert").alert()   
    }
</script>

<h2 style="margin-top: -30px">Create Assessment</h2>
<hr/>
<?php
    $prev = "asm_info";
    $next = "review_qa";
    $TotalChoice = (int) $this->Manage_assessment_type->get_total_choice($this->session->userdata('asm_type'));
    $Current_Question = $this->Manage_assessment->count_question($this->session->userdata('AssessmentID'));
    $Total_Question = $this->session->userdata('total_question');
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
<div>
    <div>
        <div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Warning! You submit question more than limit!</h4>
            <p>This warning popup in case you submit the question more than total question you entered. To change
the limit please visit Assessment Info. If you want to change question that already added please go to Review Q&A and select 
question you want to edit.
            </p>
            <p>
              <a class="btn btn-danger" href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">
                Edit Assessment Info 
              </a> 
              <a class="btn " href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">
                Review Question and Answer
              </a> 
            </p>
          </div>
        <span><?php echo "Total Question: {$Current_Question} / {$Total_Question}";?></span>
            <fieldset>Question</fieldset>
                <?php
                    $form_controller = "assessment/add_question_and_answer";

                    if($this->session->userdata('form_flag') == 1)
                        $form_controller = "assessment/update_qa";            
                    $attr = array('class' => "form-inline");
                    echo form_open($form_controller, $attr);
                ?>
                    <small>Question No. </small>
                    <input type="text" name="data_qnr" class="input-small" value="<?php echo $this->session->userdata('QuestionNr'); ?>"/>
                    <small>Detail </small>
                    <input type="text" name="data_detail" class="input-xxlarge" value="<?php echo $this->session->userdata('Q_Detail'); ?>"/>
                <fieldset>Answer</fieldset>
                <?php
                    $asm_type = $this->session->userdata('asm_type');
                    $TotalChoice = $this->Manage_assessment_type->get_total_choice($asm_type);
                    $counter = 0;

                    //วนลูปสร้าง Answer ตาม AssessmentType ตรงนี้
                    while($counter < $TotalChoice)
                    {
                        $index = $counter + 1;
                ?>
                <div> 
                    <small><?php echo "Answer Detail ({$index})"; ?></small>
                    <input type="text" name="<?php echo "data_choice_{$counter}_detail"; ?>" class="input-xlarge" value="<?php echo $this->session->userdata("C_Detail_{$counter}"); ?>"/>
                        <small>Answer Group </small>
                            <select name="<?php echo "data_choice_{$counter}_awg"; ?>" class="input-small"> 
                                <?php
                                    $get_answer_group = $this->Manage_answer_group->get_awg();
                                    foreach($get_answer_group as $dd) 
                                    {
                                        echo "<option value='". $dd['AnswerGroupID'] ."'";
                                        if($dd['AnswerGroupID'] == $this->session->userdata("AnswerGroupID_{$counter}"))
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
<?php if($Current_Question != $Total_Question)
          echo "<a href=\"javascript:limit()\" class=\"btn btn-success input-large\" style=\"margin-top:5px\" >+ Add Question</a>";
      else 
          echo "<input type=\"submit\" name=\"mysubmit\" class=\"btn btn-success input-large\" style=\"margin-top:5px\" value=\"+ Add Question\" />";
?>
                    <br>
                        <?php
                            echo "#### DEBUG ####";
                            var_dump($Current_Question);
                            var_dump($this->session->userdata('QNR'));
                            var_dump($this->session->userdata('CID'));
                            echo "under is all userdata";
                            var_dump($this->session->all_userdata());
                            echo form_close();
                        ?>
                </div>
            </div>
        <hr>




