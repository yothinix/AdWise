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
    $AsmID = $this->session->userdata('AssessmentID');
    $attr = array('class' => "form-inline");
    echo form_open("assessment/add_resultexp", $attr);
?>
        <textarea type="text" rows="10" name="result_exp" class="input-block-level" placeholder ="Result Expression"></textarea>
        <div style="text-align: center; margin-top: 20px">
            <input type="submit" name="check_exp" class="btn btn-warning" value="Check Expression" />
            <input type="submit" name="add_exp" class="btn btn-success" value="Add Expression" />
        </div>
<?php
    echo form_close();
?>
    </div>
<hr>




