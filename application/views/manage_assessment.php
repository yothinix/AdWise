<style type = "text/css">
    th
    {
        background : #6C7B8B;
        color : white;
        test-align : left;

    }

    .onoffswitch {
        position: relative; width: 100px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }

    .onoffswitch-checkbox {
        display: none;
    }

    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        border: 0px solid #999999; border-radius: 0px;
    }

    .onoffswitch-inner {
        width: 200%; margin-left: -100%;
        -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
        -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
    }

    .onoffswitch-inner > div {
        float: left; position: relative; width: 50%; height: 30px; padding: 0; line-height: 30px;
        font-size: 12px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
        -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
    }

    .onoffswitch-inner .onoffswitch-active {
        padding-left: 48px;
        background-color: #C2C2C2; color: #FFFFFF;
    }

    .onoffswitch-inner .onoffswitch-inactive {
        padding-right: 48px;
        background-color: #C2C2C2; color: #FFFFFF;
        text-align: right;
    }

    .onoffswitch-switch {
        width: 50px; margin: 0px; text-align: center;
        border: 0px solid #999999;border-radius: 0px;
        position: absolute; top: 0; bottom: 0;
    }
    .onoffswitch-active .onoffswitch-switch {
        background: #1B9CF2; left: 0;
    }
    .onoffswitch-inactive .onoffswitch-switch {
        background: #EB1111; right: 0;
    }

    .onoffswitch-active .onoffswitch-switch:before {
        content: " "; position: absolute; top: 0; left: 50px;
        border-style: solid; border-color: #1B9CF2 transparent transparent #1B9CF2; border-width: 15px 10px;
    }


    .onoffswitch-inactive .onoffswitch-switch:before {
        content: " "; position: absolute; top: 0; right: 50px;
        border-style: solid; border-color: transparent #EB1111 #EB1111 transparent; border-width: 15px 10px;
    }


    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
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
                <th style="text-align: center">Status</th>
                <th style="text-align: center">Controller</th>
    </tr>

    <?php
    foreach($get_assessment as $row)
    {
        $ASMID = $row->AssessmentID;
        $status = $row->status;
    ?>
    <tr>

        <td style="text-align: center"><?php echo $row->AssessmentID ?></td>
        <td><a href="<?php echo base_url("index.php/assessment/test/{$row->AssessmentID}/1"); ?>"><?php echo $row->Name ?></a></td>
        <td><?php foreach($this->User_model->get_creatorName($row->CreatorID) as $row){echo $row->Username;} ?>  </td>
        <td style="text-align: center"><?php echo "no of participant"; ?>  </td>
        <td style="text-align: center">
            <div class="onoffswitch">
                <input type="checkbox" id="myonoffswitch<?php echo $ASMID?>" name="onoffswitch" class="onoffswitch-checkbox"
                    <?php if($status == 1) echo "checked"; else echo ""; ?>>
                <label class="onoffswitch-label" for="myonoffswitch<?php echo $ASMID?>">
                    <div class="onoffswitch-inner">
                        <div class="onoffswitch-active"><div class="onoffswitch-switch">PUBLISH</div></div>
                        <div class="onoffswitch-inactive"><div class="onoffswitch-switch">DRAFT</div></div>
                    </div>
                </label>
            </div>
        </td>
        <td>
            <a  style="margin-left: 20px"class="btn btn-small" href="#"><i class="icon-file"></i></a>
            <a  class="btn btn-small" href="#edit<?php echo $ASMID ?>" role="button" class="btn" data-toggle="modal"><i class="icon-pencil"></i></a>
            <a href="#delete<?php echo $ASMID ?>" role="button" class="btn" data-toggle="modal"><i class="icon-trash"></i></a>
        </td>
    </tr>

        <!-- Edit Assessment Modal -->
        <div id="edit<?php echo $ASMID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Publish Assessment</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/set_asm_status/{$ASMID}"); ?>">Yes</a>
                <a class="btn" href="<?php echo base_url("index.php/manage/unset_asm_status/{$ASMID}"); ?>">No</a>
            </div>
        </div>

        <!-- Delete Assessment Modal -->
        <div id="delete<?php echo $ASMID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        }
    ?>
</table>
