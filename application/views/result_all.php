<style>
    /* ROW CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .row .span4 {
        text-align: center;
    }
    .row h3 {
        font-weight: normal;
    }
    .row .span4 p {
        margin-left: 10px;
        margin-right: 10px;
    }
</style>
<h2 style="margin-top: -30px">Report</h2>
<hr/>
<div class="row">
<?php 
    //Case of the result_all page
    //Case 0: User is not done any Assessment (default case)
    //Case 1: User is finish only 1 Assessment
    //Case 2: User is finish >= 2 Assessment
?>
<div class="user-result">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Assessment</th>
                  <th>Result</th>
                  <th style="text-align: center">Description</th>
                </tr>
              </thead>
              <tbody>
<?php
$counter = 1;
$array_size = count($ResultID);
    while($counter <= $array_size)
    {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$ResultID[$counter]['ASM']}</td>";
        echo "<td>{$ResultID[$counter]['rName']}</td>";
        echo "<td>{$ResultID[$counter]['rDetail']}</td>";
        echo "</tr>";
        $counter++;
    }    
?>
              </tbody>
            </table>
          </div>

<hr>
<?php
    echo "----------- L1 -----------------";
    var_dump($output_from_extract);
    echo "----------- transaction items -------------";
    var_dump($seed_itemsets);
    //var_dump($ocp_array);
?>

<?php
    //var_dump($ResultID);
?>
