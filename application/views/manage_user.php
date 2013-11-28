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
        echo form_open('manage/manage_user');
    ?>

    <tr>

        <td><?php echo $row->ID ?>  </td>
        <td><?php echo $row->Name ?>  </td>
        <td><?php echo $row->Lastname ?>  </td>
        <td><button type="button" class="btn btn-warning">In Progress</button> </td>
        <td><button type="button" class="btn btn-success">Complete</button>  </td>
        <td><button type="button" class="btn btn-danger">Incomplete</button> </td>
        <td><a  style="margin-left: 20px"class="btn btn-small" href="#"><i class="icon-file"></i></a>
            <a  class="btn btn-small" href="#"><i class="icon-pencil"></i></a>
            <a  class="btn btn-small" href="#"><i class="icon-trash"></i></a>  </td>

    </tr>

    <?php
    echo form_close();
    }
    ?>




</table>