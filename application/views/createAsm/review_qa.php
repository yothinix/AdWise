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

    a.delete_qa:link {
        color: #FF0000;
    }
</style>

<h2 style="margin-top: -30px">Create Assessment</h2>
<hr/>
<?php
    $prev = "question_and_answer";
    $next = "result_condition";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Question & Answer</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Result Condition &rarr;</a>
    </li>
</ul>
<hr>
<?php
    $AsmID = $this->session->userdata('AssessmentID');
    $data = array();
    $asm_info = $this->Manage_assessment->get_asm_info($AsmID);
    foreach($asm_info as $row)
    {
        $data['asm_name'] = $row->Name;
        $data['asm_type'] = $this->Manage_assessment_type->get_asm_type_name($row->AssessmentTypeID);
        $data['asm_creator'] = $this->User_model->get_creatorName($row->CreatorID);
        $data['asm_desc'] = $row->Description; 
    }
?>
                <div style="text-align: center">
                    <h3><?php echo $data['asm_name']; ?></h3>
                    <p> Type: <small><?php echo $data['asm_type']; ?></small> Creator: <small><?php echo $data['asm_creator']; ?></small></p>
                    <p><small><?php echo $data['asm_desc']; ?></small></p>
                </div>
                <hr/>
<?php
    $question = $this->Manage_assessment->get_all_question($AsmID);
    foreach($question as $row)
    {
        $QuestionNr = $row->QuestionNr;
        $Q_Detail = $row->Detail;
?>                
                    <div id="question" style="margin-left: 30px">
                    <h4><a href="<?php echo base_url("index.php/assessment/get_qa_data/{$AsmID}/{$QuestionNr}"); ?>"><?php echo "{$QuestionNr}. {$Q_Detail} "; ?></a>
                        <a class="delete_qa" href="<?php echo base_url("index.php/assessment/delete_qa/{$AsmID}/{$QuestionNr}"); ?>">✘</a></h4>
                        <div id="answer">
<?php 
        $choice = $this->Assessment_model->get_choice($AsmID, $QuestionNr);
        foreach($choice as $row2)
        {
            $C_Detail = $row2->Detail;
?>
                            <label class="radio">
                                <input type="radio" name="optionsRadios">
                                <?php echo $C_Detail; ?>
                            </label>
<?php
        }
?>
                        </div>
                    </div>
<?php 
    } 
?>
<a href="<?php echo base_url('index.php/assessment/create_asm_view/question_and_answer'); ?>" class="btn btn-success">+ add more question</a>
<hr>




