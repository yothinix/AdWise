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
<h2 style="margin-top: -30px">Analytics</h2>
<div class="row">
    <div class="span6">
        <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
    <div class="span6">
        <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
</div>



<script>
    $(function () {
        $('#container1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Male'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                type: 'pie',
                data: <?php echo json_encode($male); ?>
            }]
        });
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Female'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                type: 'pie',
                data: <?php echo json_encode($female); ?>
            }]
        });
    });
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<?php
echo form_close();
?>
