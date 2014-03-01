<style type = "text/css">
    th {
        background : #6C7B8B;
        color : white;
        test-align : left;
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
        border: 2px;
    }


</style>
<link href="<?php echo base_url("/assets/js/pie/src/nv.d3.css"); ?>" rel="stylesheet" type="text/css">
<h2 style="margin-top: -30px">Analytics</h2>
<body class='with-3d-shadow with-transitions'>
<?php
$controller = "manage/get_analytics";
echo form_open($controller);
?>

 <table style="position: absolute">
     <tr>
         <td>
            <select name="assessmentID">
                <option value="" style="display:none;"><----Please Assessment----></option>
                <?php
                foreach($assessment as $row){
                    echo "<option value='".$row["AssessmentID"]."' >".$row["Name"]."</option>";
                }
                ?>
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

<table style="margin-top: 40px">
    <tr>
        <td>
<h2>Male</h2>
<svg id="Male" class="mypiechart"></svg>
        </td>
        <td>
<h2>Female</h2>
<svg id="Female" class="mypiechart"></svg>
        </td>
    </tr>
</table>

    <hr />

<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/lib/d3.v3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/nv.d3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/legend.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/pie.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/pieChart.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/utils.js"); ?>"></script>

<script>
    var male = <?php echo $result_male; ?>;
    var female = <?php echo $result_female; ?>;
    nv.addGraph(function() {
        var width = 430,
            height = 430;

        var chart = nv.models.pieChart()
            .x(function(d) { return d.key })
            .y(function(d) { return d.y })
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

</script>
