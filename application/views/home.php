<style>
     #quiz_no {
        margin-top: -30px;
    }
</style>
<?php

    $quiz = $this->Assessment_model->get_question($AssessmentID,$QuestionNr);
    foreach($quiz as $row)
    {
        echo "<h3 id=\"quiz_no\">Question $row->QuestionNr</h3>";
        echo "<h2>$row->Detail</h2>";
        $temp_choice = $row->ChoiceID;
        $choice_nr = explode(",", $temp_choice);
    }
?>
<div class="row-fluid">
    <?php
        $head = (int)$choice_nr[0];
        end($choice_nr);
        $tail = (int)$choice_nr[key($choice_nr)];

        for($count=$head; $count<=$tail; $count++)
        {
            $choice = $this->Assessment_model->get_choice($count);
            foreach($choice as $row)
            {
                echo "<div class=\"span4\">
                    <h2>$row->ChoiceID Choice</h2>
                    <p>$row->Detail</p>
                    <p><a class=\"btn btn-primary btn-block btn-large\" href=\"#\">Select Choice $row->ChoiceID</a></p>
                    </div><!--/span-->";
            }
        }
    ?>
    <div class="span4">
        <h3>Controller</h3>
        <div class="row-fluid">
            <div class="span4">
                <?php
                    echo form_open("assessment/test/{$AssessmentID}/{$QuestionNr}");
                    $QuestionNr = $QuestionNr+1;
                    echo form_submit('prev','Prev', "class = 'btn btn-primary btn-block btn-large'");
                    echo form_close();
                ?>
            </div><!--/span4-->
            <div class="span4">
                <?php
                    echo form_open("assessment/test/{$AssessmentID}/{$QuestionNr}");
                    $QuestionNr = $QuestionNr-1;
                    echo form_submit('next','Next', "class='btn btn-primary btn-block btn-large'");
                    echo form_close();
                ?>
            </div><!--/span4-->
        </div><!--/.fluid-container-->
        <br/>
        <p><a class="btn btn-info btn-large btn-block" href="#"><i class="icon-download-alt icon-white"></i> Save Progress </a></p>
    </div><!--/span-->
</div>