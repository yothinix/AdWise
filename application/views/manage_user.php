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
        font-size: 14px;
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
    ?>

    <tr>
        <td style="text-align: center"><?php echo $row->ID ?>  </td>
        <td><?php echo $row->Name ?>  </td>
        <td><?php echo $row->Lastname ?>  </td>
        <td style="text-align: center"><button type="button" class="btn btn-warning">In Progress</button> </td>
        <td style="text-align: center"><button type="button" class="btn btn-success">Complete</button>  </td>
        <td style="text-align: center"><button type="button" class="btn btn-danger">Incomplete</button> </td>
        <td style="text-align: center">
            <a href="#view<?php echo $userID; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-file"></i></a>
            <a href="#edit<?php echo $userID; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-pencil"></i></a>
            <a href="#del<?php echo $userID; ?>" role="button" class="btn" data-toggle="modal"><i class="icon-trash"></i></a>
        </td>
    </tr>

    <!-- Model View -->
        <div id="view<?php echo $userID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header" style="margin-top: 10px; margin-left: 10px; margin-right: 10px">
                <h3 id="myModalLabel">View Profile</h3>
            </div>
            <div class="modal-body" style="margin-top: -10px; margin-left: 20px">
                <div class="span5">
                    <?php
                    $get_image = $this->user_model->img($this->User_model->get_CreatorName($userID));
                    foreach($get_image as $img) //ดึงข้อมูลมาจาก db
                    {
                    $filename = $img->Image;

                    if($filename=="")
                    { ?>
                        <img class="img-circle" style="width: 200px; height: 200px; margin-left: 15px" src="<?php echo base_url("/uploads/default.jpg") ?>" >
                    <?php }
                    else
                    { ?>
                        <img class="img-polaroid" style="width: 200px; height: 200px; margin-left: 15px" src="<?php echo base_url("/uploads/{$filename}") ?>" >
                    <?php } }?>
                </div>
                <div class="row">
                    <div class="span5" style="margin-left: 10px">
                        <b>Name </b> <?php echo $row->Name ?>
                        <br>
                        <b>Lastname </b> <?php echo $row->Lastname ?>
                        <br>
                        <b>Gender </b> <?php if($row->Gender==0) echo "Male"; ?> <?php if($row->Gender==1) echo "Female"; ?>
                        <br>
                        <b>Birthday</b> <?php echo $row->Birthday ?>
                        <br>
                        <b>Phone</b> <?php echo $row->Phone ?>
                        <br>
                        <b>Email </b> <?php echo $row->Email ?>
                    </div>
                </div>
                <div class="row">
                    <div style="text-align: center; margin-top: 20px">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
                </div>
            </div> <!-- ปิด modal-body -->
        </div> <!-- ปิด edit -

    <!-- Model Edit -->


    <!-- Modal Delete -->
    <div id="del<?php echo $userID; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
            <h3 id="myModalLabel">Delete User</h3>
        </div>
        <div class="modal-body">
            <p>Are you sure? </p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-primary" href="<?php echo base_url("index.php/manage/delete_user/{$userID}"); ?>">    Yes    </a>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        </div>
    </div> <!-- ปิด delete -->

    <?php } ?>

</table>

<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-modal.js"); ?>"></script>
