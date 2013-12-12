<style type = "text/css">
    th
    {
        background : #6C7B8B;
        color : white;
        test-align : left;

    }

</style>

<h2 style="margin-top: -30px">Manage Assessment</h2>
<?php $page = "asm_info"; ?>
<a href="<?php echo base_url("index.php/assessment/create_asm_view/{$page}"); ?>" style="margin-top: -40px" class="btn pull-right">+ Create Assessment</a>
<hr />
<table class="table table-bordered">
            <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">Name</th>
                <th style="text-alignnter">Creator</th>
                <th style="text-align: center">No. Participant</th>
                <th style="text-align: center">Rank</th>
                <th style="text-align: center">Controller</th>
    </tr>

    <?php
    foreach($get_assessment as $row)
    {
        $ASMID = $row->AssessmentID;
        echo form_open('manage/manage_assessment'); //name of the function to send form of manage_assesssment query
    ?>
    <tr>

        <td style="text-align: center"><?php echo $row->AssessmentID ?></td>
        <td><a href="<?php echo base_url("index.php/assessment/edit/{$row->AssessmentID}"); ?>"><?php echo $row->Name ?></a></td>
        <td><?php foreach($this->User_model->get_creatorName($row->CreatorID) as $row){echo $row->Username;} ?>  </td>
        <td style="text-align: center"><?php echo "no of participant"; ?>  </td>
        <td style="text-align: center"><?php echo "rank"; ?>  </td>
        <td><a  style="margin-left: 20px"class="btn btn-small" href="#"><i class="icon-file"></i></a>
            <a  class="btn btn-small" href="#"><i class="icon-pencil"></i></a>
            <a href="#myModal<?php echo $ASMID ?>" role="button" class="btn" data-toggle="modal"><i class="icon-trash"></i></a>


    </tr>

        <!-- Modal -->
        <div id="myModal<?php echo $ASMID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete Assessment</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?php echo base_url("index.php/assessment/delete_asm/{$ASMID}"); ?>">    Yes    </a>
                <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>

    <?php
    echo form_close();
    }
    ?>
</table>
