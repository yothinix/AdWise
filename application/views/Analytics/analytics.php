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
        echo form_open('manage/graph');
        ?>

         <table style="position: absolute;">
             <tr>
                 <td>
                    <select name="asmID">
                        <option value="" style="display:none;"><---- Select Assessment ----></option>
                        <?php
                        foreach($assessment as $row){
                            echo "<option value='".$row["AssessmentID"]."' >".$row["Name"]."</option>";
                        }
                        ?>

                    </select>
                 </td>
                 <td>
                     <select name="graphID">
                         <option value="" style="display:none;"><------- Select Graph -------></option>
                         <option value="1" >Pie Chart</option>
                     </select>
                 </td>
                 <td>
                     <select name="graph_data" >
                         <option value="" style="display:none;"><-------- Select Data --------></option>
                         <option value="1" >Gender</option>
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









