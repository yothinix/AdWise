<style type = "text/css">
    th
    {
        background : #6C7B8B;
        color : white;
        test-align : left;

    }

</style>

<h2 style="margin-top: -30px">Manage User</h2>
<hr />
<table class="table table-bordered">
            <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">Name</th>
                <th style="text-alignnter">Lastname</th>
                <th style="text-align: center">ASM1</th>
                <th style="text-align: center">ASM2</th>
                <th style="text-align: center">ASM3</th>
                <th style="text-align: center">Controller</th>


    </tr>

    <?php
    $user = $this->User_model->manage_user();
    foreach($user as $row)
    {
        $userID = $row->ID;
        echo form_open('manage/manage_user');
    ?>

    <tr>

        <td><?php echo $row->ID ?>  </td>
        <td><?php echo $row->Name ?>  </td>
        <td><?php echo $row->Lastname ?>  </td>
        <td><button type="button" class="btn btn-warning">In Progress</button> </td>
        <td><button type="button" class="btn btn-success">Complete</button>  </td>
        <td><button type="button" class="btn btn-danger">Incomplete</button> </td>
        <td><a href="#myModal" role="button" style="margin-left: 10px" class="btn" data-toggle="modal"><i class="icon-file"></i></a>
            <a href="#myModal" role="button" style="margin-left: 10px" class="btn" data-toggle="modal"><i class="icon-pencil"></i></a>
            <a href="#myModal<?php echo $userID; ?>" role="button" style="margin-left: 10px" class="btn" data-toggle="modal"><i class="icon-trash"></i></a>
            <!-- Modal -->
            <div id="myModal<?php echo $userID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                    <h3 id="myModalLabel">Delete User</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure? </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/delete_user/{$userID}"); ?>">    Yes    </a>
                    <button class="btn ">Cancel</button>
                </div>
            </div>
        </td>

    </tr>

    <?php
    echo form_close();
    }
    ?>




</table>

<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-modal.js"); ?>"></script>
