<style type = "text/css">
    th
    {
        background : #6C7B8B;
        color : white;
        test-align : left;

    }

    td
    {
        font-size: 14px;
    }

</style>

<h2 style="margin-top: -30px">Manage Answer Group</h2>
<a href="#CreateAnswerGroup" style="margin-top: -40px" class="btn pull-right" role="button" data-toggle="modal">+ Create Answer Group</a>
<hr />
<table class="table table-bordered">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Detail</th>
        <th style="text-align: center">Controller</th>
    </tr>

    <?php
    foreach($get_answer_group as $row)
    {
        $Answer_group_ID = $row->AnswerGroupID;
    ?>
        <tr>

            <td style="text-align: center"><?php echo $row->AnswerGroupID ?></td>
            <td><?php echo $row->Name ?></td>
            <td><?php echo $row->Detail ?></td>
            <td style="text-align: center">
                <a href="#EditAnswerGroup<?php echo $Answer_group_ID; ?>" class="btn btn-small" role="button" data-toggle="modal"><i class="icon-pencil"></i></a>
                <a href="#myModal<?php echo $Answer_group_ID ?>" class="btn" role="button" data-toggle="modal"><i class="icon-trash"></i></a>
        </tr>

        <!-- Delete Answer Group Modal -->
        <div id="myModal<?php echo $Answer_group_ID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete Answer Group</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/delete_answer_group/{$Answer_group_ID}"); ?>">Yes</a>
                <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>

        <!-- Edit Answer Group Modal -->
        <div id="EditAnswerGroup<?php echo $Answer_group_ID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Answer Group: <?php echo $Answer_group_ID ?></h3>
            </div>
            <div class="modal-body">
                <?php
                echo form_open("manage/edit_answer_group/{$Answer_group_ID}");
                ?>
                <small>Name</small>
                <input type="text" id="answer_group_name" name="answer_group_name" class="input-block-level" placeholder="Answer Group" value="<?php echo $row->Name; ?>"/>
                <small>Detail</small>
                <textarea type="text" rows="10" id="answer_group_detail" name="answer_group_detail" class="input-block-level" placeholder="Detail"><?php echo $row->Detail; ?></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" href="#">Done</button>
                <button type="reset" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <?php
                echo form_close();
                ?>
            </div>
        </div>

        <?php
        echo form_close();
    }
    ?>
</table>

<!-- Create Answer Group Modal -->
<div id="CreateAnswerGroup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Create Answer Group</h3>
    </div>
    <div class="modal-body">
        <?php
        echo form_open("manage/create_answer_group");
        ?>
        <small>Name</small>
        <input type="text" id="answer_group_name" name="answer_group_name" class="input-block-level" placeholder="Answer Group" />
        <small>Detail</small>
        <textarea type="text" rows="10" id="answer_group_detail" name="answer_group_detail" class="input-block-level" placeholder="Detail" ></textarea>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" href="#">Create Answer Group</button>
        <button type="reset" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php
        echo form_close();
        ?>
    </div>
</div>
