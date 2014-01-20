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
    $prev = "result_condition";
    $next = "submit_question";
    $this->load->model('Manage_assessment');    
    $AsmID = $this->session->userdata('AssessmentID');    
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Result Condition</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Submit Question &rarr;</a>
    </li>
</ul>
<hr>
        <p>
            <small>Result Condition of Assessment</small>
            <a href="<?php echo base_url("index.php/assessment/get_condition_data/{$AsmID}"); ?>" class="btn btn-success">Edit Condition</a>
        </p>
        <pre>
<?php
    $ResultExpressionID = $this->Manage_assessment->get_ResultExpID($AsmID);
    $Expression = $this->Manage_assessment->get_Expression($ResultExpressionID);
    $str_array = explode(';', $Expression);
    foreach($str_array as $row)
        echo "<p style='text-align:center'>{$row}</p>";
?>
        </pre>
<hr>




