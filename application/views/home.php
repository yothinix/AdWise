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
</style>
<script>
    var isAns = true;
    function ans(ans){
        if(isAns){
            isAns = false;
            document.getElementById("ans").value = ans;
            document.getElementById("question-form").submit();
        }
    }
</script>
<h2 style="margin-top: -30px">Assessment: </h2>
<hr/>
<div class="row">

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

        $asm_info = $this->Assessment_model->get_asm_info($AssessmentID); //เอาค่ามาจาก session
        foreach($asm_info as $asm_info_row)
        {
            echo "<div class=\"span4\">";
            ?>
            <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
            <?php
            echo heading("$asm_info_row->Name", 3);
            echo "<p>$asm_info_row->Description</p>";
            ?>
            <p><a class="btn btn-primary btn-large btn-block" href="
    <?php
                echo base_url("index.php/assessment/test/{$asm_info_row->AssessmentID}/1");
                ?>
        "><i class="icon-hdd icon-white"></i> Save Progress</a></p>
            <?php    echo "</div><!-- /.span4 -->";
        }
    ?>
    <div id="test" class="row span8" style="margin-left: 10px">
<?php
    $attr = array(
        'id' => "question-form",
        'name'=> "question-form"
    );
    echo form_open("assessment/test/{$AssessmentID}/{$Next}", $attr);
?>
            <input type="hidden" name="no" id="no" value="1" />
			<input type="hidden" name="ans" id="ans" value="" />
<?php
    $quiz = $this->Assessment_model->get_question($AssessmentID,$QuestionNr);
    foreach($quiz as $row)
    {
        echo "<h2 style=\"text-align: center\">$row->QuestionNr. $row->Detail ?</h2>";
    }
            $choice = $this->Assessment_model->get_choice($row->AssessmentID, $row->QuestionNr); //QID ที่ตรงกับ QuestionNr นั้น
            foreach($choice as $row)
            {
                echo "<div class=\"row\">
                        <div class=\"span4\">
                            <a class=\"btn btn-primary\" href=\"javascript:ans($row->ChoiceID)\">ตัวเลือก $row->ChoiceID</a>
                        </div><!--/span2-->
                        <div class=\"span8\" style =\"margin-left: -40px\">
                            <p>$row->Detail</p>
                        </div><!--/span4-->
                    </div><!--/row-->";
            }
    ?>
</div>
<br/>

<div class="pagination" style="text-align: center">
    <ul>
        <li><a href="<?php echo base_url("$baseTestUrl/$AssessmentID/$Prev"); ?>">«</a></li>
        <?php
            $TotalQuestion = $this->Assessment_model->get_asm_info($AssessmentID);
            foreach($TotalQuestion as $row)
                $TTQ = $row->TotalQuestion;

            for($i=1; $i<=$TTQ; $i++)
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
<?php
    echo form_close();
?>
</div>
