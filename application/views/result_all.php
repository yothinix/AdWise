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
<div class="row" style="margin-left:10px">
<div class="span6">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th style="text-align: center">Career Path</th>
                </tr>
              </thead>
              <tbody>
<?php 
    for($index = 0; $index < sizeof($ocp_data); $index++)
    {
        echo "<tr><td><h4>{$ocp_data[$index][0]['Name']}</h4></td></tr>";
    }
?>
</tbody></table></div>
<div class="span6">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th style="text-align: center">Academic Path</th>
                </tr>
              </thead>
              <tbody>
<?php
   //use same data_model as career path [need to fill data in occupation_academic 
    for($index = 0; $index < sizeof($ocp_data); $index++)
    {
        echo "<tr><td><h4>{$ocp_data[$index][0]['Name']}</h4></td></tr>";
    }
?>
</tbody></table></div>
</div>
</div>

<hr>

<div class="row">
<div class="span6">
<div class="row">
<?php
    echo "----------- Occupation_array ------------";
    var_dump($ocp_data); 
?>
</div>
<div class="row">
<?php
    echo "----------- Result_array -----------------";
    var_dump($Result_array); 
?>
</div>
</div>
<div class="span6">
<?php
    echo "---------- Debugging Variable ------------";
    var_dump($seed_itemsets); 
?>
</div>
</div>

