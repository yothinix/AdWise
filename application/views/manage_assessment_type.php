<style type = "text/css">
    th
    {
        background : #6C7B8B;
        color : white;
        test-align : left;

    }

</style>

<h2 style="margin-top: -30px">Manage Assessment Type</h2>
<a href="#CreateAsmType" style="margin-top: -40px" class="btn pull-right" role="button" data-toggle="modal">+ Create Assessment Type</a>
<hr />
<table class="table table-bordered">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">No. Choice</th>
        <th style="text-align: center">No. Answer</th>
        <th style="text-align: center">No. Answer Group</th>
        <th style="text-align: center">Controller</th>
    </tr>

<?php
    foreach($get_assessment_type as $row)
    {
        $Asm_type_ID = $row->AssessmentTypeID;
?>
        <tr>
            <td style="text-align: center"><?php echo $row->AssessmentTypeID ?></td>
            <td><?php echo $row->Name ?></td>
            <td><?php echo $row->TotalChoice ?></td>
            <td><?php echo $row->TotalAnswer ?></td>
            <td><?php echo $row->TotalAnswerGroup ?></td>
            <td>
                <a href="#EditAsmType<?php echo $Asm_type_ID ?>" class="btn btn-small" role="button" data-toggle="modal"><i class="icon-pencil"></i></a>
                <a href="#myModal<?php echo $Asm_type_ID ?>" role="button" class="btn" data-toggle="modal"><i class="icon-trash"></i></a>
        </tr>

<!-- Delete Modal -->
        <div id="myModal<?php echo $Asm_type_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete Assessment</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/delete_asm_type/{$Asm_type_ID}"); ?>">Yes</a>
                <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>

<!-- Edit Assessment Type Modal -->
        <div id="EditAsmType<?php echo $Asm_type_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                <h3 id="myModalLabel">Edit Assessment Type</h3>
            </div>
            <div class="modal-body" style="margin-top: -20px">
            <?php
            echo form_open("manage/update_asm_type/{$Asm_type_ID}");
            ?>
            <small>Name</small>
            <input type="text" name="asm_type_name" class="input-block-level" value="<?php echo $row->Name ?>" />
            <small>Description</small>
            <input type="text" name="asm_type_desc" class="input-block-level" value="<?php echo $row->Description ?>" />
            <small>Total Choice</small>
            <input type="text" name="no_choice" class="input-block-level" value="<?php echo $row->TotalChoice ?>" />
            <small>Total Answer</small>
            <input type="text" name="no_answer" class="input-block-level" value="<?php echo $row->TotalAnswer ?>" />
            <small>Total Answer Group</small>
            <input type="text" name="no_answer_group" class="input-block-level" value="<?php echo $row->TotalAnswerGroup ?>" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update Assessment Type</button>
                <button type="reset" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
<?php
    echo form_close();
?>
            </div>
        </div>
<!-- ./Edit Assessment Type Modal -->

<?php
    }
?>
</table>

<!-- Create Assessment Type Modal -->
<div id="CreateAsmType" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Create Assessment Type</h3>
    </div>
    <div class="modal-body">
<?php
    echo form_open("manage/create_asm_type");
?>
        <small>Name</small>
        <input type="text" name="asm_type_name" class="input-block-level" />
        <small>Description</small>
        <input type="text" name="asm_type_desc" class="input-block-level" />
        <small>Total Choice</small>
        <input type="text" name="no_choice" class="input-block-level" />
        <small>Total Answer</small>
        <input type="text" name="no_answer" class="input-block-level" />
        <small>Total Answer Group</small>
        <input type="text" name="no_answer_group" class="input-block-level" />
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Create Assessment Type</button>
        <button type="reset" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
<?php
    echo form_close();
?>
    </div>
</div>
