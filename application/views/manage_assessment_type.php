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

        <!-- Modal -->
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
                <h3 id="myModalLabel">Create Assessment Type</h3>
            </div>
            <div class="modal-body">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Assessment Type Detail</a></li>
                        <li><a href="#tab2" data-toggle="tab">Result Expression</a></li>
                    </ul>
                    <div class="tab-content"> <!-- ทำฟอร์มครอบทั้ง Modal เลยเริ่มตรงนี้ -->
                        <div class="tab-pane active" id="tab1">
                            <?php
                            echo form_open("manage/update_asm_type/{$Asm_type_ID}");
                            ?>
                                <input type="text" id="asm_type_name" name="asm_type_name" class="input-block-level" value="<?php echo $row->Name ?>" placeholder="Name"/>
                                <input type="text" id="asm_type_desc" name="asm_type_desc" class="input-block-level" value="<?php echo $row->Description ?>" placeholder="Description" />
                                <input type="text" id="no_choice" name="no_choice" class="input-block-level" value="<?php echo $row->TotalChoice ?>" placeholder="Total Choice"/>
                                <input type="text" id="no_answer" name="no_answer" class="input-block-level" value="<?php echo $row->TotalAnswer ?>" placeholder="Total Answer"/>
                                <input type="text" id="no_answer_group" name="no_answer_group" class="input-block-level" value="<?php echo $row->TotalAnswerGroup ?>" placeholder="Total Answer Group"/>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <textarea type="text" rows="10" id="result_expression" name="result_expression" class="input-block-level" placeholder="Result Expression" ></textarea>
                            <div style="text-align: center">
                                <button class="btn btn-warning">Check Expression</button>
                                <button class="btn btn-success">Add Expression</button>
                            </div>
                        </div>
                    </div>
                </div>
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
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Assessment Type Detail</a></li>
                <li><a href="#create_result_expression" data-toggle="tab">Result Expression</a></li>
            </ul>
            <div class="tab-content"> <!-- ทำฟอร์มครอบทั้ง Modal เลยเริ่มตรงนี้ -->
                <div class="tab-pane active" id="tab1">
                    <?php
                    echo form_open("manage/create_asm_type");
                    ?>
                    <input type="text" id="asm_type_name" name="asm_type_name" class="input-block-level" placeholder="Assessment Type Name" />
                    <input type="text" id="asm_type_desc" name="asm_type_desc" class="input-block-level" placeholder="Description" />
                    <input type="text" id="no_choice" name="no_choice" class="input-block-level" placeholder="No. of Choice" />
                    <input type="text" id="no_answer" name="no_answer" class="input-block-level" placeholder="No. of Answer" />
                    <input type="text" id="no_answer_group" name="no_answer_group" class="input-block-level" placeholder="No. of Answer Group" />
                </div>
                <div class="tab-pane" id="create_result_expression">
                    <textarea type="text" rows="10" id="result_expression" name="result_expression" class="input-block-level" placeholder="Result Expression" ></textarea>
                    <div style="text-align: center">
                        <button class="btn btn-warning">Check Expression</button>
                        <button class="btn btn-success">Add Expression</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Create Assessment Type</button>
        <button type="reset" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php
        echo form_close();
        ?>
    </div>
</div>
