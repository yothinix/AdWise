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

    <h2 style="margin-top: -30px">Assessment List</h2>
<hr/>

<div class="row">

<?php
$assessment = $this->Assessment_model->get_asm_list();
foreach($assessment as $row)
{
    echo "<div class=\"span4\">";
?>
        <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
<?php
    echo heading("$row->Name", 3);
    echo "<p>$row->Description</p>";
?>
    <p><a class="btn btn-primary btn-large btn-block" href="
<?php
    echo base_url("index.php/assessment/test/{$row->AssessmentID}/1");
?>
        ">Start Test &raquo;</a></p>
<?php    echo "</div><!-- /.span4 -->";
}
?>
</div><!--/span-->
<hr>



