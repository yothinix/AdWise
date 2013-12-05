<style type = "text/css">
    th
    {
        background : #6C7B8B;
        color : white;
        test-align : left;

    }

    </style>

    <h2 style="margin-top: -30px">Manage Result</h2>
    <a href="#create" role="button" class="btn pull-right" data-toggle="modal" style="margin-top: -40px">+ Create Result</a>
    <hr />
    <table class="table table-bordered">

        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">Name</th>
            <th style="text-align: center">Detail</th>
            <th style="text-align: center">Controller</th>
        </tr>

        <?php
        foreach($manage_result as $row)
        {
        $ResultID = $row->ResultID;

        ?>

        <tr>

            <td><?php echo $row->ResultID; ?>  </td>
            <td><?php echo $row->Name; ?>  </td>
            <td><?php echo $row->Detail; ?>  </td>
            <td style="text-align: center">
                <!-- Edit -->
                <a role="button"  class="btn btn-small" href="#edit<?php echo $ResultID; ?>" data-toggle="modal"><i class="icon-pencil"></i></a>
                <!-- Delete -->
                <a role="button"  class="btn btn-small" href="#del<?php echo $ResultID; ?>" data-toggle="modal"><i class="icon-trash"></i></a>  </td>

        </tr>

            <!-- Modal Edit -->

            <div id="edit<?php echo $ResultID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Edit Result</h3>
                </div>
                <div class="modal-body">
                        <?php
                        $attr = array(
                            'class' => "form-horizontal",
                            'style' => "margin-top: -20px; margin-left: 10px; margin-right: 10px"
                        );
                        echo form_open("manage/update_result/{$ResultID}",$attr); ?>
                        <div class="control-group" style="margin-left: 10px; margin-right: 10px">
                            <label class="control-label" for="inputName">Name :</label>
                            <div class="controls">
                                <input type="text" id="name" ame="name" class="input-block-level" value="<?php echo $row->Name ?>">
                            </div>
                        </div>
                        <div class="control-group" style="margin-left: 10px; margin-right: 10px">
                            <label class="control-label" for="inputDetail">Detail :</label>
                            <div class="controls">
                                <input type="text" id="detail" name="detail" class="input-block-level" value="<?php echo $row->Detail ?>">
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

            <div id="del<?php echo $ResultID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Delete</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure ?</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/delete_result/{$ResultID}"); ?>"> Yes </a>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
            </div>

        <?php
        }
        ?>

    </table>

    <!-- Modal Create -->
    <div id="create" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Result Creator</h3>
        </div>
        <div class="modal-body" style="text-align: center">
            <?php echo form_open('manage/create_result'); ?>
            <input type="text" name="name" id="name" class="input-block-level" placeholder="Name :">
            <br>
            <input type="text" name="detail" id="detail" class="input-block-level" placeholder="Detail :">
            <br>
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <?php echo form_close(); ?>
        </div>
    </div>