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

    .modal-body
    {
        font-size: 16px;
    }
    </style>

    <h2 style="margin-top: -30px">Manage Result</h2>
    <a href="#create" role="button" class="btn pull-right" data-toggle="modal" style="margin-top: -40px">+ Create Result</a>
    <hr />
    <table class="table table-bordered">

        <tr>
            <th style="text-align: center; width: 50px">ID</th>
            <th style="text-align: center; width: 80px">Name</th>
            <th style="text-align: center">Detail</th>
            <th style="text-align: center; width: 130px">Controller</th>
        </tr>

        <?php
        foreach($manage_result as $row)
        {
        $ResultID = $row->ResultID;

        ?>

        <tr>
            <td style="text-align: center"><?php echo $row->ResultID; ?>  </td>
            <td><b><?php echo $row->Name; ?></b></td>
            <td><?php echo $row->Detail; ?>  </td>
            <td style="text-align: center">
                <!-- View -->
                <a role="button"  class="btn btn-small" href="#view<?php echo $ResultID; ?>" data-toggle="modal"><i class="icon-file"></i></a>
                <!-- Edit -->
                <a role="button"  class="btn btn-small" href="#edit<?php echo $ResultID; ?>" data-toggle="modal"><i class="icon-pencil"></i></a>
                <!-- Delete -->
                <a role="button"  class="btn btn-small" href="#del<?php echo $ResultID; ?>" data-toggle="modal"><i class="icon-trash"></i></a>  </td>
        </tr>

            <!-- Modal View -->
            <div id="view<?php echo $ResultID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">View Result</h3>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-left: 10px; margin-top: 5px">
                        <b>Name </b> <?php echo $row->Name ?>
                        <br>
                        <b>Detail </b> <?php echo $row->Detail ?>
                        <br>
                        <b>Occupation </b>
                        <?php
                        $Occupation = $this->Manage_result_data->get_ocp($ResultID);
                        foreach($Occupation as $ocp)
                        {
                            $Occupation_id = $ocp->Occupation_id;
                            $Occupation_Name = $this->Manage_result_data->get_name($Occupation_id);
                            foreach($Occupation_Name as $que1){
                                echo $que1->Name;?>&nbsp&nbsp<?php
                            }
                        }
                        ?>
                        <br>
                        <b>Academic </b>
                        <?php
                        $Occupation = $this->Manage_result_data->get_ocp($ResultID);
                        foreach($Occupation as $ocp)
                        {
                            $Occupation_id = $ocp->Occupation_id;

                            $Academic = $this->Manage_result_data->get_aca($Occupation_id);
                            foreach($Academic as $aca){
                                $Academic_id = $aca->Academic_id;
                                $Academic_name = $this->Manage_result_data->get_name_aca($Academic_id);
                                foreach($Academic_name as $que2){
                                    echo $que2->Name;?>&nbsp&nbsp<?php
                                }
                            }
                        }?>
                    </div>
                    <div class="row" style="text-align: center">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
                </div>
            </div>

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
                            <input type="text" id="name" name="name" class="input-block-level" value="<?php echo $row->Name ?>">
                        </div>
                    </div>
                    <div class="control-group" style="margin-left: 10px; margin-right: 10px">
                        <label class="control-label" for="inputDetail">Detail :</label>
                        <div class="controls">
                            <textarea type="text" rows="5" id="detail" name="detail" class="input-block-level" ><?php echo $row->Detail ?></textarea>
                        </div>
                    </div>
                    <div class="control-group" style="margin-left: 10px; margin-right: 10px">
                        <label class="control-label" for="inputOccupation">Occupation :</label>
                        <div class="example occupation">
                            <div class="bs-docs-example">
                                <input type="text" placeholder="Occupation" name="Occupation" id="Occupation" value="
                                <?php
                                $Occupation = $this->Manage_result_data->get_ocp($ResultID);
                                foreach($Occupation as $ocp)
                                {
                                    $Occupation_id = $ocp->Occupation_id;
                                    $Occupation_Name = $this->Manage_result_data->get_name($Occupation_id);
                                    foreach($Occupation_Name as $que1){
                                        echo ",";
                                        echo $que1->Name;
                                    }
                                }
                                ?>
                                ">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="control-group" style="margin-left: 10px; margin-right: 10px">
                        <label class="control-label" for="inputAcademic">Academic :</label>
                        <div class="example academic">
                            <div class="bs-docs-example">
                                <input type="text" placeholder="Academic" name="Academic" id="Academic" value="">
                            </div>
                        </div>
                    </div> -->
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
            <div class="example occupation">
                <div class="bs-docs-example">
                    <input type="text" placeholder="Occupation :" name="Occupation" id="Occupation" >
                </div>
            </div>
            <!--<div class="example academic">
                <div class="bs-docs-example">
                    <input type="text" placeholder="Academic :" name="Academic" id="Academic" >
                </div>
            </div> -->
            <br>
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <?php echo form_close(); ?>
        </div>
    </div>

<script src="<?php echo base_url("assets/js/bootstrap-tagsinput.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/tag_typehead.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/tag_input_change.js"); ?>"></script>