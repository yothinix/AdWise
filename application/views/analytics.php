<style type = "text/css">
    th {
        background : #6C7B8B;
        color : white;
        test-align : left;
        height: 500px;
        width: 600px;
    }
    td {
        font-size: 14px;
    }
    .modal-body {
        font-size: 14px;

    }
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 999px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        cursor: inherit;
        display: block;
    }
    .btn-submit {
        position: relative;
        overflow: hidden;
    }
    .btn-submit input[type=submit] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 999px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        cursor: inherit;
        display: block;
    }
</style>
<style>

    body {
        overflow-y:scroll;
    }

    text {
        font: 12px sans-serif;
    }

    .mypiechart {
        width: 500px;
        height: 400px;
        border: 2px;
    }
    #Male_discrete svg{
        height: 500px;
        min-width: 100px;
        min-height: 100px;

    }
    #Female_discrete svg{
        height: 500px;
        min-width: 100px;
        min-height: 100px;

    }
</style>
<link href="<?php echo base_url("/assets/js/pie/src/nv.d3.css"); ?>" rel="stylesheet" type="text/css">
<h2 style="margin-top: -30px">Analytics</h2>
<body class='with-3d-shadow with-transitions'>
<?php
$controller = "manage/get_analytics";
echo form_open($controller);
?>

 <table style="position: absolute;">
     <tr>
         <td>
            <select name="assessmentID">
                <option value="" style="display:none;"><---- Select Assessment ----></option>
                <?php
                foreach($assessment as $row){
                    echo "<option value='".$row["AssessmentID"]."' >".$row["Name"]."</option>";
                }
                ?>

            </select>
         </td>
         <td>
             <select id="graphID" name="graphIDD">
                 <option value="" style="display:none;"><------- Select Graph -------></option>
                 <?php
                 $graph = $this->Analytics_model->graph();
                 foreach($graph as $gh)
                 {
                     $graphID = $gh->graphID ?>
                    <option value="<?php echo $gh->graphID ?>" > <?php echo $gh->name ?> </option>
                 <?php }
                 ?>
             </select>
         </td>
         <td>
             <select >
                 <option value="" style="display:none;"><-------- Select Data --------></option>



             </select>
         </td>
         <td style=" padding-bottom:13px ">
            <button type="submit" class="btn" >Submit</button>
         </td>
     </tr>
</table>

<?php 
echo form_close();
?>

<table style="margin-top: 80px;" >
    <tr>
        <td>
<h2 id="Male_h" style="position: absolute; visibility: hidden;">Male</h2>
            <svg id="Male" class="mypiechart" style="margin-top: 50"></svg>
        </td>
        <td>
<h2 id="Female_h" style="position: absolute; visibility: hidden;" >Female</h2>
            <svg id="Female" class="mypiechart" style="margin-top: 50"></svg>
        </td>
    </tr>
</table>

<hr \>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/lib/d3.v3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/nv.d3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/legend.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/pie.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/pieChart.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/utils.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/discrete/nv.d3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/discrete/lib/d3.v3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/discrete/src/tooltip.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/discrete/src/utils.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/discrete/src/models/axis.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/discrete/src/models/discreteBar.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/discrete/src/models/discreteBarChart.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/horizontal/lib/d3.v2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/horizontal/lib/horizon.js"); ?>"></script>



<script>

    //This is JSON data via JavaScript Template
//Need to json_encode the php array before sending to relate function
    var male = <?php echo $result_male; ?>;
    var female = <?php echo $result_female; ?>;
    var data = <?php echo json_encode($check); ?>;
    var graph = 0;
    if(data=='data'){
        graph = <?php echo $graph_Select; ?>;
        var header_male = document.getElementById("Male_h");
        var header_female = document.getElementById("Female_h");

        header_male.style.visibility='visible';
        header_female.style.visibility='visible';

    }

    if(graph == 1){
        ///alert("1");
        nv.addGraph(function() {

            var width = 430,
                height = 430;

            var chart = nv.models.pieChart()
                .x(function(d) { return d.label })
                .y(function(d) { return d.value })
                .color(d3.scale.category10().range())
                .width(width)
                .height(height);

            d3.select("#Male")
                .datum(male)
                .transition().duration(1200)
                .attr('width', width)
                .attr('height', height)
                .call(chart);

            d3.select("#Female")
                .datum(female)
                .transition().duration(1200)
                .attr('width', width)
                .attr('height', height)
                .call(chart);


            chart.dispatch.on('stateChange', function(e) { nv.log('New State:', JSON.stringify(e)); });

            return chart;
        });
    }else if(graph == 2){
        //alert("2");

        nv.addGraph(function() {
            var chart = nv.models.discreteBarChart()
                    .x(function(d) { return d.label })
                    .y(function(d) { return d.value })
                    .staggerLabels(true)
                    //.staggerLabels(historicalBarChart[0].values.length > 8)
                    .tooltips(false)
                    .showValues(true)
                    .transitionDuration(250)
                ;

            d3.select("#Male")
                .datum(return_data(male))
                .call(chart);

            d3.select("#Female")
                .datum(return_data(female))
                .call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });
    }else if (graph == 4){
        nv.addGraph(function() {
            var chart = nv.models.discreteBarChart()
                    .x(function(d) { return d.label })
                    .y(function(d) { return d.value })
                    .staggerLabels(true)
                    //.staggerLabels(historicalBarChart[0].values.length > 8)
                    .tooltips(false)
                    .showValues(true)
                    .transitionDuration(250)
                ;

            d3.select("#Male")
                .datum(male)
                .call(chart);

            d3.select("#Feale")
                .datum(female)
                .call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });
    }

    function return_data(data){

        return  [
            {
                key: "Cumulative Return",
                values: data
            }
        ];
    }


</script>
