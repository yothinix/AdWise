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

    .nav-tabs a {
        font-size: 14px;
    }
</style>

<h2 style="margin-top: -30px">Create Assessment</h2>
<hr/>

<?php $tab = 1; ?>

<div class="row" ng-app>
    <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <li <?php if($tab == 1) echo "class=\"active\""; ?>><a href="#tab1" data-toggle="tab">Assessment Info</a></li>
            <li><a href="#tab2" data-toggle="tab">Question & Answers</a></li>
            <li><a href="#tab3" data-toggle="tab">Review Q&A</a></li>
            <li><a href="#tab4" data-toggle="tab">Result Condition</a></li>
            <li><a href="#tab5" data-toggle="tab">Review Condition</a></li>
            <li><a href="#tab6" data-toggle="tab">Submit Questions</a></li>
        </ul>
        <div class="tab-content">

<!-- ASM_Info_Tab -->
            <div class="tab-pane active" id="tab1">
                <?php
                    echo form_open("assessment/init_create_asm"); //Save ASM_info_data to initialize
                ?>
                <input type="text" id="asm_name" name="asm_name" class="input-block-level" placeholder="Assessment Name" value="<?php echo set_value('asm_name'); ?>" />
                <textarea type="text" rows="10" id="asm_desc" name="asm_desc" class="input-block-level" placeholder="Assessment Description" value="<?php echo set_value('asm_desc'); ?>"></textarea>
                <div class="row">
                    <div class="span4">
                        <?php
                        $options = array(
                            'desc' => 'Type name',
                            '1'  => 'Single Choice',
                            '2'    => 'Multiple Choice',
                            '3'   => 'True/False',
                            'ASM_type_ID' => 'ASM_Type_Name',   //ดึงจาก DB แบบนี้
                        );

                        echo form_dropdown('asm_type', $options, 'desc');
                        ?>
                    </div>
                    <input type="text" id="total_question" name="total_question" class="input-medium" placeholder="Total Question" value="<?php echo set_value('total_question'); ?>" />
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-success btn-large input-large">Submit</button>
                    <button class="btn btn-danger btn-large input-large">Reset</button> <!--เอาไว้ลบค่าในช่องทั้งหมดที่ใส่ไป-->
                </div>
                <?php
                    echo form_close();
                ?>
                <hr>
                <ul class="pager">
                    <li class="previous">
                        <a href="<?php echo base_url("index.php/manage/manage_assessment"); ?>">&larr; Manage Assessment</a>
                    </li>
                    <li class="next">
                        <a href="#tab2" data-toggle="tab">Question & Answer &rarr;</a>
                    </li>
                </ul>
            </div>

<!-- Question_And_Answer_Tab -->
            <div class="tab-pane" id="tab2">

<!-- Script in AngularJS -->
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.3/angular.min.js"></script>
                <script type="text/javascript">
                    function TodoCtrl($scope) {
                        $scope.todos = [
                            {}];

                        $scope.addTodo = function() {
                            $scope.todos.push({text:$scope.todoText, done:false});
                            $scope.todoText = '';
                        };
                    }
                </script>
<!-- HTML in AngularJS -->
                <div>
                    <div ng-controller="TodoCtrl">
                        <span>Total Question: {{todos.length}}</span>
                        <ul class="unstyled">
                            <li ng-repeat="todo in todos">
                                <fieldset>Question</fieldset>
                                <form class="form-inline">
                                    <input type="text" class="input-small" placeholder="Question No.">
                                    <input type="text" class="input-xxlarge" placeholder="Question Detail">
                                    <fieldset>Answer</fieldset>
                                    <input type="text" class="input-small" placeholder="Answer No.">
                                    <input type="text" class="input-xxlarge" placeholder="Answer Detail">
                                    <?php
                                    $options = array(
                                        'desc' => 'Answer group',
                                        '1'  => 'Single Choice',
                                        '2'    => 'Multiple Choice',
                                        '3'   => 'True/False',
                                        'ASM_type_ID' => 'ASM_Type_Name',   //ดึงจาก DB แบบนี้
                                    );
                                    echo form_dropdown('shirts', $options, 'desc');
                                    ?>
                                    <input type="text" class="input-small" placeholder="Answer No.">
                                    <input type="text" class="input-xxlarge" placeholder="Answer Detail">
                                    <?php
                                    $options = array(
                                        'desc' => 'Answer group',
                                        '1'  => 'Single Choice',
                                        '2'    => 'Multiple Choice',
                                        '3'   => 'True/False',
                                        'ASM_type_ID' => 'ASM_Type_Name',   //ดึงจาก DB แบบนี้
                                    );
                                    echo form_dropdown('shirts', $options, 'desc');
                                    ?>
                                </form>
                                <hr>
                            </li>
                        </ul>
                        <form ng-submit="addTodo()">
                            <input type="submit" class="btn input-large" style="margin-top: -20px" value="+ Add more Question">
                        </form>
                    </div>
                </div>
                <hr>
                <ul class="pager">
                    <li class="previous">
                        <a href="#tab1" data-toggle="tab">&larr; Assessment Info</a>
                    </li>
                    <li class="next">
                        <a href="#tab3" data-toggle="tab">Review Q&A &rarr;</a>
                    </li>
                </ul>
            </div>

<!-- Review_Assessment_Tab -->
            <div class="tab-pane" id="tab3">
                <div style="text-align: center">
                    <h3>Assessment Name</h3>
                    <p> Type: <small>Assessment Type</small> Creator: <small>Creator Name</small></p>
                    <p>
                        <small>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor
                    id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac,
                    vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                       </small>
                    </p>
                </div>
                <hr/>
                <div id="question" style="margin-left: 30px">

                    <input type="text" name="txt" id = "txt" value="" onkeyup = "copyIt()"><br>
                    <input type="text" name="txt1" id = "txt1"  value=""><br>

                    <script type = "text/javascript">
                        function copyIt() {
                            var x = document.getElementById("txt").value;
                            document.getElementById("txt1").value = x;
                        }
                    </script>

                    <h4>1. โต๊ะของคุณเป็นอย่างไร</h4>
                        <div id="answer">
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                Option one is this and that—be sure to include why it's great
                            </label>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Option two can be something else and selecting it will deselect option one
                            </label>
                        </div>
                </div>
                <br/>
                <div id="question" style="margin-left: 30px">
                    <h4>2. เก้าอี้ของคุณเป็นอย่างไร</h4>
                    <div id="answer">
                        <label class="radio">
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            Option one is this and that—be sure to include why it's great
                        </label>
                        <label class="radio">
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Option two can be something else and selecting it will deselect option one
                        </label>
                    </div>
                </div>
                <br/>
                <div id="question" style="margin-left: 30px">
                    <h4>3. ตู้ของคุณเป็นอย่างไร</h4>
                    <div id="answer">
                        <label class="radio">
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            Option one is this and that—be sure to include why it's great
                        </label>
                        <label class="radio">
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Option two can be something else and selecting it will deselect option one
                        </label>
                    </div>
                </div>
                <hr>
                <ul class="pager">
                    <li class="previous">
                        <a href="#tab2" data-toggle="tab">&larr; Question & Answer</a>
                    </li>
                    <li class="next">
                        <a href="#tab4" data-toggle="tab">Result Condition &rarr;</a>
                    </li>
                </ul>
            </div>

<!-- Result_Condition_Tab -->
<div class="tab-pane" id="tab4">

    <!-- Script in AngularJS -->
    <script type="text/javascript">
        function ResultCtrl($scope) {
            $scope.results = [
                {}];

            $scope.addResult = function() {
                $scope.results.push({text:$scope.resultText, done:false});
                $scope.resultText = '';
            };
        }
    </script>
    <!-- HTML in AngularJS -->
    <div>
        <div ng-controller="ResultCtrl">
            <span>Total Result: {{results.length}}</span>
            <ul class="unstyled">
                <li ng-repeat="result in results">
                    <div class="row-fluid">
                        <div class="span2">
                            <select class="input-block-level">
                                <option>Result 1</option>
                                <option>Result 2</option>
                            </select>
                        </div>
                        <div class="span2">
                            <select class="input-block-level">
                                <option>Answer group 1</option>
                                <option>Result 2</option>
                            </select>
                        </div>
                        <div class="span2">
                            <select class="input-block-level">
                                <option>Answer group 2</option>
                                <option>Result 2</option>
                            </select>
                        </div>
                        <div class="span2">
                            <select class="input-block-level">
                                <option>Answer group 3</option>
                                <option>Result 2</option>
                            </select>
                        </div>
                        <div class="span2">
                            <select class="input-block-level">
                                <option>Answer group 4</option>
                                <option>Result 2</option>
                            </select>
                        </div>
                    </div>
                </li>
            </ul>
            <hr>
            <form ng-submit="addResult()">
                <input type="submit" class="btn input-large" style="margin-top: -20px" value="+ Add another result">
            </form>
        </div>
    </div>
    <hr>
    <ul class="pager">
        <li class="previous">
            <a href="#tab3" data-toggle="tab">&larr; Review Q&A</a>
        </li>
        <li class="next">
            <a href="#tab5" data-toggle="tab">Review Condition &rarr;</a>
        </li>
    </ul>
</div>

<!-- Review Result Condition Tab -->
<div class="tab-pane" id="tab5">
    <hr>
    <ul class="pager">
        <li class="previous">
            <a href="#tab4" data-toggle="tab">&larr; Result Condition</a>
        </li>
        <li class="next">
            <a href="#tab6" data-toggle="tab">Submit Question &rarr;</a>
        </li>
    </ul>
</div>

<!-- Submit_Assessment_Tab -->
            <div class="tab-pane" id="tab6">
                <form class="form-horizontal"> <!--//Save ASM_info_data to initialize-->
                        <div class="control-group">
                            <label class="control-label" for="creator">Creator</label>
                            <div class="controls">
                                <input type="text" id="creator" placeholder="Name">
                            </div>
                        </div>

                    <div class="control-group">
                        <label class="control-label" for="inputBirthday"> Birthday </label>
                        <div class="controls">
                            <div class='input-append' id='datetimepicker1'>
                                <input type='text' name="birthday" data-format='yyyy-MM-dd'>
                         <span class='add-on'>
                         <i data-date-icon='icon-calendar'>
                         </i>
                         </span>
                            </div>
                        </div>
                    </div>
                    <script type='text/javascript'>
                        $(function() {
                            $('#datetimepicker1').datetimepicker({
                                language: 'pt-BR'
                            });
                        });
                    </script>

                        <hr/>
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-success btn-large input-large">Submit</button>
                        </div>
                </form>
                <hr>
                <ul class="pager">
                    <li class="previous">
                        <a href="#tab5" data-toggle="tab">&larr; Review Condition</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!--/span-->
<hr>

<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-datetimepicker.min.js"); ?>"></script>




