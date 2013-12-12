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
$prev = "review_qa";
$next = "review_condition";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Review Q&A</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Review Condition &rarr;</a>
    </li>
</ul>
<hr>
                <!-- Script in AngularJS -->
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.3/angular.min.js"></script>
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




