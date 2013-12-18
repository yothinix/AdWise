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
    var tricker = true;
    function ans(choice)
    {
        if(tricker)
        {
            tricker = false;
            document.getElementById("ans").value = choice;
            document.getElementById("question-form").submit();
        }
    }
</script>
<h2 style="margin-top: -30px">Assessment: </h2>
<hr/>
<div class="row">

<?php
    $Prev = $QuestionNr-1;
    $Next = $QuestionNr+1;

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
			<input type="hidden" name="ans" id="ans" value="" />
<?php
    foreach($quiz as $row)
    {
        echo "<h2 style=\"text-align: center\">$row->QuestionNr. $row->Detail ?</h2>";
    }
            foreach($choice as $row)
            {
                $currentChoiceID = $row->ChoiceID;
                echo "<div class=\"row\">
                        <div class=\"span4\">
                            <a class=\"btn btn-primary\" href=\"javascript:ans($currentChoiceID)\">ตัวเลือก $row->ChoiceID</a>
                        </div><!--/span4-->
                        <div class=\"span8\" style =\"margin-left: -40px\">
                            <p>$row->Detail</p>
                        </div><!--/span8-->
                    </div><!--/row-->";
            }
    ?>

        <?php
            $select = $this->input->post('ans');
            $this->session->set_userdata('assessmentID', $AssessmentID);
            $this->session->set_userdata('QuestionNr', $Prev);
            $this->session->set_userdata('SelectChoice', $select);
            var_dump($this->session->all_userdata());
        ?>

</div>
<br/>

<div class="pagination" style="text-align: center">
    <ul>
        <li><a href="<?php echo base_url("$baseTestUrl/$AssessmentID/$Prev"); ?>">«</a></li>
        <li><a href="<?php echo base_url("$baseTestUrl/$AssessmentID/$QuestionNr"); ?>"><?php echo $QuestionNr ?></a></li>
        <li><a href="<?php echo base_url("$baseTestUrl/$AssessmentID/$Next"); ?>">»</a></li>
    </ul>
</div>
<?php
    echo form_close();
?>
</div>
