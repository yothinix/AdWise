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
    $Assessment_name;
    $asm_info = $this->Assessment_model->get_asm_info($AID);     
    foreach($asm_info as $asm_info_row)
    {
        $Assessment_name = $asm_info_row->Name;
        echo "<div class=\"span4\">";
        ?>
        <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" data-src="holder.js/140x140" src="<?php echo base_url("/resources/assessment.png"); ?>">
        <?php
        echo heading("$asm_info_row->Name", 3);
        echo "<p>$asm_info_row->Description</p>";
        ?>
        <p><a class="btn btn-primary btn-large btn-block" href="
    <?php
            echo base_url("index.php/assessment/test/{$asm_info_row->AssessmentID}/1");
            ?>
        "><i class="icon-repeat icon-white"></i> Test Again</a></p>
        <?php    echo "</div><!-- /.span4 -->";
    }
    ?>
    <div id="result_content" class="span8" style="margin-left: 10px">
        <div id="result_content1" class="row" style="margin-left: 10px">
            <div id="name_asset" class="span7">
            <h2>Your <?php echo $Assessment_name; ?> is:</h2>
            </div>
            <div id="asset_result" class="span4">
                <pre><h1 style="text-align: left"><?php echo $resultID; ?></h1></pre>
            </div>
    <div id="container" style="min-width: 400px; max-width: 600px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
</div><!--/span-->
<hr>

<script type="text/javascript">
$(function () {
	$('#container').highcharts({
	            
        chart: {
	        polar: true,
            type: 'line',
            backgroundColor: '#eeeeee'
        },
        
        plotOptions: {
            series: {
            }
        },

	    title: {
	        text: null
        },
        
        credits: {
            enabled: false
        },

	    pane: {
	    	size: '80%'
	    },
	    
        xAxis: {
            categories: <?php echo $awg_list; ?>,
	        tickmarkPlacement: 'on',
            lineWidth: 0,
            labels : {
                style: {
                    color: 'red',
                        fontWeight: 'bold',
                        fontSize: 15
                },
            }
	    },
	        
	    yAxis: {
	        gridLineInterpolation: 'polygon',
	        lineWidth: 0,
	        min: 0
	    },
	    
        series: [{
            data: <?php echo $summation_array; ?>,
            lineWidth: 4,
	        pointPlacement: 'on',
            marker: {
                fillColor: '#FFFFFF',
                    lineWidth: 2,
                    lineColor: null // inherit from series
            }
        }],

        exporting: {
            enabled: false
        },

        legend: {
            enabled: false
        }


    });
});
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
