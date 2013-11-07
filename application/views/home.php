
            <?php

            $quiz = $this->Site_model->get_question(1,$QuestionNr); // 2 เหลือทำระบบดึงคำถามจากชุดคำถามตรงนี้
            foreach($quiz as $row){
                echo "<h2 id=\"quiz_no\">Question $row->QuestionNr</h2>";
                echo "<p>$row->Detail</p>";

                $temp_choice = $row->ChoiceID;
                $choice_nr = explode(",", $temp_choice);
            }
            ?>
            <div class="row-fluid">
            <?php
                $head = (int)$choice_nr[0];
                end($choice_nr);
                $tail = (int)$choice_nr[key($choice_nr)];

                for($count=$head; $count<=$tail; $count++){
                    $choice = $this->Site_model->get_choice($count);
                    foreach($choice as $row){
                        echo "
                    <div class=\"span4\">
                    <h2>$row->ChoiceID Choice</h2>
                    <p>$row->Detail</p>
                    <p><a class=\"btn btn-primary btn-block btn-large\" href=\"#\">Select Choice $row->ChoiceID</a></p>
                    </div><!--/span-->
                    ";
                    }
                }
            ?>

            <div class="span4">
                <h3>Controller</h3>
                <div class="row-fluid">
                        <!-- 1 ทำ OnClick ให้เรียกฟังก์ชั่น PHP เพื่ออัพเดทค่า $QuestionNr ให้ได้ -->
                        <div class="span4">

                            <?php
                            $QuestionNr = $QuestionNr-1;
                            echo form_open("site/assessment/{$QuestionNr}");
                            echo form_submit('prev','Prev', "class = 'btn btn-primary btn-block btn-large'");
                            echo form_close();
                            ?>


                        </div><!--/span-->
                        <div class="span4">
                            <?php
                            $QuestionNr = $QuestionNr+1;
                            echo form_open("site/assessment/{$QuestionNr}");
                            echo form_submit('next','Next', "class='btn btn-primary btn-block btn-large'");
                            echo form_close();
                            ?>
                        </div><!--/span-->

                </div><!--/.fluid-container-->
                <br/>
        <p><a class="btn btn-info btn-large btn-block" href="#"><i class="icon-download-alt icon-white"></i> Save Progress </a></p>
            </div><!--/span-->
        </div>


<!--
            <script type="text/javascript">
                $('#next').click(function(){

                    var QuestioNr = <?php /*echo(json_encode($QuestionNr)); */?>;

                    alert(temp);

                    var form_data =
                    {
                        //quiz_no: $('#quiz_no').val()
                        ajax: '1'
                    };

                    $.ajax(function()
                    {
                        url: "<?php /*echo(json_encode(site_uri('site/submit'))); */?>",
                        type: 'POST',
                        data: QuestioNr,
                        success: function(msg){
                        $('#main_content').html(msg);
                    }
                    });
                    return false;
                });
            </script>

            <script type="text/javascript">
                $(document).ready(function(){

                    $("#next").click(function()
                    {
                        var QuestioNr = <?php /*echo(json_encode($QuestionNr)); */?>;
                        $.ajax({
                            type: "POST",
                            url: base_url + "site/submit",
                            data: {textbox: $("#textbox").val()},
                            dataType: "text",
                            cache:false,
                            success:
                                function(data){
                                    alert(data);  //as a debugging message.
                                }
                        });// you have missed this bracket
                        return false;
                    });
                });
            </script>-->