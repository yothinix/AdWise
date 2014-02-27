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

<h2 style="margin-top: -30px">Manage Occupation</h2>
<a href="#create" role="button" class="btn pull-right" data-toggle="modal" style="margin-top: -40px">+ Create Occupation</a>
<hr />
<table class="table table-bordered">

    <tr>
        <th style="text-align: center">ID </th>
        <th style="text-align: center">Occupation Name </th>
        <th style="text-align: center">Detail </th>
        <th style="text-align: center; width: 180px">Tag </th>
        <th style="text-align: center">Controller </th>
    </tr>

    <?php
    $user = $this->Manage_occupation->get_manage_occupation();
    foreach($user as $row)
    {
        $Occupation_id = $row->Occupation_id; ?>
        <tr>
            <td style="text-align: center"><?php echo $row->Occupation_id ?>  </td>
            <td><?php echo $row->Name ?>  </td>
            <td><?php echo $row->Detail ?>  </td>
            <td><?php
                $tags = $this->Manage_occupation->get_tags($Occupation_id);
                foreach($tags as $tg)
                {
                    $tags_id = $tg->tags_id;
                    $tags_name = $this->Manage_occupation->get_name($tags_id);
                    foreach($tags_name as $que){
                        echo $que->Tags_name; ?> &nbsp <?php
                    }
                }
                ?>
            </td>
            <td style="text-align: center">
                <!-- View -->
                <a role="button"  class="btn btn-small" href="#view<?php echo $Occupation_id; ?>" data-toggle="modal"><i class="icon-file"></i></a>
                <!-- Edit -->
                <a role="button"  class="btn btn-small" href="#edit<?php echo $Occupation_id; ?>" data-toggle="modal"><i class="icon-pencil"></i></a>
                <!-- Delete -->
                <a role="button"  class="btn btn-small" href="#del<?php echo $Occupation_id; ?>" data-toggle="modal"><i class="icon-trash"></i></a> </td>
        </tr>

        <!-- Modal View -->
        <div id="view<?php echo $Occupation_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">View Occupation</h3>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-left: 10px; margin-top: 5px; font-size: 16px">
                    <b>Name</b> &nbsp <?php echo $row->Name ?>
                    <br>
                    <b>Detail</b> &nbsp <?php echo $row->Detail ?>
                    <br>
                    <b>Tag</b> &nbsp
                    <?php
                    $tags = $this->Manage_occupation->get_tags($Occupation_id);
                    foreach($tags as $tg)
                    {
                        $tags_id = $tg->tags_id;
                        $tags_name = $this->Manage_occupation->get_name($tags_id);
                        foreach($tags_name as $que){
                            echo $que->Tags_name;?>&nbsp<?php
                        }
                    }
                    ?>
                    <br>
                    <b>Academic</b> &nbsp
                    <?php
                    $academic = $this->Manage_occupation->get_academic($Occupation_id);
                    foreach($academic as $aca)
                    {
                        $Academic_id = $aca->Academic_id;
                        $Academic_name = $this->Manage_occupation->get_name_aca($Academic_id);
                        foreach($Academic_name as $an){
                            echo $an->Name;?>&nbsp<?php
                        }
                    }
                    ?>
                </div>
                <div class="row" style="text-align: center">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="edit<?php echo $Occupation_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Edit Occupation</h3>
            </div>
            <div class="modal-body">
                <?php
                $attr = array(
                    'class' => 'form-horizontal',
                    'style' => 'margin-top: -25px; margin-left: 10px; margin-right: 10px'
                );
                echo form_open("manage/update_occupation/{$Occupation_id}", $attr); ?>
                <div class="control-group" style="margin-left:5px; margin-right:5px">
                    <label class="control-label" for="inputName">Name :</label>
                    <div class="controls">
                        <input type="text" id="name" name="name" class="input-block-level" value="<?php echo $row->Name ?>">
                    </div>
                </div>
                <div class="control-group" style="margin-left: 5px; margin-right: 5px">
                    <label class="control-label" for="inputDetail">Detail :</label>
                    <div class="controls">
                        <input type="text" id="detail" name="detail" class="input-block-level" value="<?php echo $row->Detail ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputTag">Tag :</label>
                    <div class="example example_typeahead">
                        <div class="bs-docs-example">
                            <input type="text" name="tags" value="
                            <?php
                            $tags = $this->Manage_occupation->get_tags($Occupation_id);
                            foreach($tags as $tg)
                            {
                                $tags_id = $tg->tags_id;
                                $tags_name = $this->Manage_occupation->get_name($tags_id);
                                foreach($tags_name as $que){
                                    echo ",";
                                    echo $que->Tags_name;
                                }
                            }
                            ?>" >
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputAcademic">Academic :</label>
                    <div class="example academic">
                        <div class="bs-docs-example">
                            <input type="text" name="academic" value="
                            <?php
                            $academic = $this->Manage_occupation->get_academic($Occupation_id);
                            foreach($academic as $aca)
                            {
                                $Academic_id = $aca->Academic_id;
                                $Academic_name = $this->Manage_occupation->get_name_aca($Academic_id);
                                foreach($Academic_name as $an){
                                    echo ",";
                                    echo $an->Name;
                                }
                            }
                            ?>">
                        </div>
                    </div>
                </div>
                <div class="control-group" style="margin-top: 10px; text-align: center">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <!-- Modal Delete -->
        <div id="del<?php echo $Occupation_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure ?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/delete_occupation/{$Occupation_id}"); ?>"> Yes </a>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>
    <?php } ?>
</table>

<!-- Modal Create -->
<div id="create" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Create Occupation</h3>
    </div>
    <div class="modal-body" style="text-align: center">
        <?php echo form_open('manage/create_occupation'); ?>
        <input type="text" name="Occupation_name" id="Occupation_name" class="input-block-level" placeholder="Name">
        <br>
        <input type="text" name="Occupation_detail" id="Occupation_detail" class="input-block-level" placeholder="Detail">
        <br>
        <div class="example example_typeahead">
            <div class="bs-docs-example">
                <input type="text" placeholder="Tag" name="Tags" id="Tags" >
            </div>
        </div>
        <div class="example academic">
            <div class="bs-docs-example">
                <input type="text" placeholder="Academic" name="Academic" id="Academic" >
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Add new occupation</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php echo form_close(); ?>
    </div>
</div>

<script src="<?php echo base_url("assets/js/bootstrap-tagsinput.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/tag_typehead.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/tag_input_change.js"); ?>"></script>



