<style type = "text/css">
    th
    {
        background : #6C7B8B;
        color : white;
        test-align : left;

    }

</style>

<h2 style="margin-top: -30px">Assessment Manager</h2>
<hr />
<table class="table table-bordered">
            <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">Name</th>
                <th style="text-alignnter">Creator</th>
                <th style="text-align: center">No. Participant</th>
                <th style="text-align: center">Rank</th>
                <th style="text-align: center">Controller</th>
    </tr>

    <?php
    foreach($get_assessment as $row)
    {
        echo form_open('manage/manage_assessment'); //name of the function to send form of manage_assesssment query
    ?>
    <tr>

        <td><?php echo $row->AssessmentID ?>  </td>
        <td><?php echo $row->Name ?>  </td>
        <td><?php echo $row->CreatorID ?>  </td>
        <td><?php echo "no of participant"; ?>  </td>
        <td><?php echo "rank"; ?>  </td>
        <td><a  style="margin-left: 20px"class="btn btn-small" href="#"><i class="icon-file"></i></a>
            <a  class="btn btn-small" href="#"><i class="icon-pencil"></i></a>
            <a  class="btn btn-small" href="#"><i class="icon-trash"></i></a>  </td>

    </tr>

    <?php
    echo form_close();
    }
    ?>




</table>