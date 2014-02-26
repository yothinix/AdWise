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

<table>
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
<?php 
    var_dump($user_test_data);
?>
    <hr />

<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/lib/d3.v3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/nv.d3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/legend.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/pie.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/models/pieChart.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/pie/src/utils.js"); ?>"></script>

<script>
    //This is JSON data via JavaScript Template
    //Need to json_encode the php array before sending to relate function
    var testdata = [
        {
            key: "One",
            y: 5
        },
        {
            key: "Two",
            y: 2
        },
        {
            key: "Three",
            y: 9
        },
        {
            key: "Four",
            y: 7
        },
        {
            key: "Five",
            y: 4
        },
        {
            key: "Six",
            y: 3
        },
        {
            key: "Seven",
            y: .5
        }
    ];


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
            .datum(testdata)
            .transition().duration(1200)
            .attr('width', width)
            .attr('height', height)
            .call(chart);

        d3.select("#Female")
            .datum(testdata)
            .transition().duration(1200)
            .attr('width', width)
            .attr('height', height)
            .call(chart);

        chart.dispatch.on('stateChange', function(e) { nv.log('New State:', JSON.stringify(e)); });

        return chart;
    });

    nv.addGraph(function() {

        var width = 500,
            height = 500;

        var chart = nv.models.pieChart()
            .x(function(d) { return d.key })
            //.y(function(d) { return d.value })
            //.labelThreshold(.08)
            //.showLabels(false)
            .color(d3.scale.category10().range())
            .width(width)
            .height(height)
            .donut(true);

        chart.pie
            .startAngle(function(d) { return d.startAngle/2 -Math.PI/2 })
            .endAngle(function(d) { return d.endAngle/2 -Math.PI/2 });

        //chart.pie.donutLabelsOutside(true).donut(true);

        d3.select("#test2")
            //.datum(historicalBarChart)
            .datum(testdata)
            .transition().duration(1200)
            .attr('width', width)
            .attr('height', height)
            .call(chart);

        return chart;
    });

</script>
