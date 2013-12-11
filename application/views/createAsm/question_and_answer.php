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
<?php
$prev = "asm_info";
$next = "review_qa";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Assessment Info</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Review Q&A &rarr;</a>
    </li>
</ul>
<hr>
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




