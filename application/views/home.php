<style>
     #quiz_no {
        margin-top: -30px;
    }
</style>

<?php

    $quiz = $this->Assessment_model->get_question($AssessmentID,$QuestionNr);
    foreach($quiz as $row)
    {
        echo "<h2 id=\"quiz_no\">$row->QuestionNr. $row->Detail ?</h2>";
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
                echo "<div class=\"span3\">
                    <p>$row->Detail</p>
                    <p><a class=\"btn btn-primary btn-block\" href=\"#\">ตัวเลือก $row->ChoiceID</a></p>
                    </div><!--/span-->";
            }
        }
    ?>
</div>
<br/>

<?php
    $baseTestUrl = "index.php/assessment/test";
    $pageList = array(
        '1' => base_url("$baseTestUrl/$AssessmentID/1"),
        '2' => base_url("$baseTestUrl/$AssessmentID/2"),
        '3' => base_url("$baseTestUrl/$AssessmentID/3"),
        '4' => base_url("$baseTestUrl/$AssessmentID/4"),
        '5' => base_url("$baseTestUrl/$AssessmentID/5"),
        '6' => base_url("$baseTestUrl/$AssessmentID/6"),
        '7' => base_url("$baseTestUrl/$AssessmentID/7"),
        '8' => base_url("$baseTestUrl/$AssessmentID/8"),
        '9' => base_url("$baseTestUrl/$AssessmentID/9"),
        '10' => base_url("$baseTestUrl/$AssessmentID/10")
    );
    $Prev = $QuestionNr-1;
    $Next = $QuestionNr+1;
?>
<div class="pagination" style="margin-left: 220px">
    <ul>
        <li><a href="<?php echo base_url("$baseTestUrl/$AssessmentID/$Prev"); ?>">«</a></li>
        <?php
            for($i=1; $i<=10; $i++)
            {
                echo "<li ";
                if($QuestionNr == "$i")
                    echo "class=\"active\"";
                echo "><a href=\"$pageList[$i]\">$i</a></li>";
            }
        ?>
        <li><a href="<?php echo base_url("$baseTestUrl/$AssessmentID/$Next"); ?>">»</a></li>
    </ul>
</div>
