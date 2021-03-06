<link rel="stylesheet" href="<?php echo base_url("assets/css/docs.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-tagsinput.css"); ?>" >
<link rel="stylesheet" href="<?php echo base_url("assets/css/app.css"); ?>" >

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

<h2 style="margin-top: -30px">Manage Academic</h2>
<a href="#create" role="button" class="btn pull-right" data-toggle="modal" style="margin-top: -40px">+ Create Academic</a>
<hr>
<table class="table table-bordered">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">Academic Name</th>
        <th style="text-align: center">Detail</th>
        <th style="text-align: center">Controller</th>
    </tr>

<?php
    $user = $this->Manage_academic->academic();
    foreach($user as $row)
    {
        $Academic_id = $row->Academic_id;
?>
        <tr>
            <td style="text-align: center"><?php echo $row->Academic_id ?>  </td>
            <td><?php echo $row->Name ?>  </td>
            <td><?php echo $row->Detail ?>  </td>
            <td style="text-align: center">
                <!-- Edit -->
                <a role="button"  class="btn btn-small" href="#edit<?php echo $Academic_id; ?>" data-toggle="modal"><i class="icon-pencil"></i></a>
                <!-- Delete -->
                <a role="button"  class="btn btn-small" href="#del<?php echo $Academic_id; ?>" data-toggle="modal"><i class="icon-trash"></i></a>  </td>
        </tr>

        <!-- Modal Edit -->
        <div id="edit<?php echo $Academic_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Edit Academic</h3>
        </div>
        <div class="modal-body" style="margin-top: -5px">
            <?php
                $form = array('class' => 'form-horizontal');
                echo form_open("manage/update_academic/{$Academic_id}",$form); ?>
                <div class="control-group" >
                    <label class="control-label" for="inputName">Name</label>
                    <div class="controls">
                        <input type="text" id="name" name="name" class="input-block-level" value="<?php echo $row->Name ?>">
                    </div>
                </div>
                <div class="control-group" >
                    <label class="control-label" for="inputDetail">Detail</label>
                    <div class="controls">
                        <input type="text" id="detail" name="detail" class="input-block-level" value="<?php echo $row->Detail ?>">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <div class="control-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
            <?php echo form_close(); ?>
        </div>
        </div> <!-- ปิด edit -->

        <!-- Modal Delete -->
        <div id="del<?php echo $Academic_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete</h3>
        </div>
        <div class="modal-body">
            <p>คุณต้องการจะลบใช่หรือไม่ ?</p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/del_academic/{$Academic_id}"); ?>"> Yes </a>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        </div>
        </div> <!-- ปิด delete -->
<?php } ?>
</table>

<!-- Modal Create -->
<div id="create" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Create Academic</h3>
    </div>
    <div class="modal-body" style="text-align: center;margin-top: 25px ;font-size: 16px">
        <?php echo form_open('manage/create_academic'); ?>
        <label>Name <input type="text" name="Academic_name" id="Academic_name" class="span10" style="margin-left: 10px"></label>
        <label>Detail <input type="text" name="Academic_detail" id="Academic_detail" class="span10" style="margin-left: 10px"></label>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Add New Academic</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php echo form_close(); ?>
    </div>
</div>
