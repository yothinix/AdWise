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

<h2 style="margin-top: -30px">Manage Tags</h2>
<a href="#create" role="button" class="btn pull-right" data-toggle="modal" style="margin-top: -40px">+ Create Tag</a>
<hr>
<table class="table table-bordered">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Controller</th>
    </tr>

    <?php
    $user = $this->Manage_tags->tags();
    foreach($user as $row)
    {
    $Tags_id = $row->Tags_id;
    ?>

    <tr>
        <td style="text-align: center"><?php echo $row->Tags_id ?>  </td>
        <td><?php echo $row->Tags_name ?></td>
        <td style="text-align: center">
            <!-- Edit -->
            <a role="button"  class="btn btn-small" href="#edit<?php echo $Tags_id; ?>" data-toggle="modal"><i class="icon-pencil"></i></a>
            <!-- Delete -->
            <a role="button"  class="btn btn-small" href="#del<?php echo $Tags_id; ?>" data-toggle="modal"><i class="icon-trash"></i></a>  </td>
    </tr>

        <!-- Modal Edit -->
        <div id="edit<?php echo $Tags_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Tag</h3>
            </div>
            <div class="modal-body">
                <?php
                $form = array('class' => 'form-horizontal');
                echo form_open("manage/update_tags/{$Tags_id}",$form); ?>
                <div class="control-group">
                    <label class="control-label" for="inputName">Name</label>
                    <div class="controls">
                        <input type="text" name="tags_name" class="input-block-level" value="<?php echo $row->Tags_name ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="control-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
                <?php echo form_close(); ?>
            </div> <!-- ปิด modal-header -->
        </div> <!-- ปิด edit -->

        <!-- Modal Delete -->
        <div id="del<?php echo $Tags_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete</h3>
            </div>
            <div class="modal-body">
                <p>คุณต้องการจะลบใช่หรือไม่ ?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/del_tags/{$Tags_id}"); ?>"> Yes </a>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div> <!-- ปิด delete -->

    <?php } ?>
</table>

<!-- Modal Create -->
<div id="create" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Create Tag</h3>
    </div>
    <div class="modal-body" style="text-align: center; margin-top: 25px">
        <?php echo form_open('manage/create_tags'); ?>
        <label>Name <input type="text" name="tags_name" class="span10" style="margin-left: 10px"></label>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" style="margin-left: -32px; margin-right: 10px">Add New Tag</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php echo form_close(); ?>
    </div>
</div>