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
$TotalChoice = (int) $this->Manage_assessment_type->get_total_choice($this->session->userdata('asm_type'));
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
<script src="http://code.angularjs.org/1.2.6/angular.min.js"></script>
<script type="text/javascript">
    var count = 1;
    var cutoff = <?php echo $this->session->userdata('total_question'); ?>;
    function FormController($scope)
    {
        //var data = $scope.data = [{ 
        //    'QNR1':['Question_Detail',{'ANID':['Detail', 'AWG']}],
        //    '1':['What is the book ?',{'1':['Harry potter', 'I'], '2':['REWORK', 'E']}]
        //}];

        $scope.datas = [{
            qnr:'',
            detail:'',    
            choice:{
                0:{id: '', detail: '', awg: ''}, 
                1:{id: '', detail: '', awg: ''}
            } 
        }]; 

        $scope.addQuestion = function() {
            if(count != cutoff)
            {
                $scope.datas.push({
                    qnr:'',
                    detail:'',
                    choice:[{id: '', detail: '', awg: ''}] 
                });  
                count++;
            }
            else
            {
                alert("You Enter all of the Question");
            }
        };
        
        $scope.addChoice = function() {
            data.choice.push({id: '', detail: '', awg: ''}); 
            //use to push choice data set [] count by Assessment_type
        };

}
</script>
<!-- HTML in AngularJS -->
<div>
    <div ng-controller="FormController">
        <span>Total Question: {{datas.length}} / <?php echo $this->session->userdata('total_question'); ?></span>
        <ul class="unstyled">
            <li ng-repeat="data in datas">
            <fieldset>Question</fieldset>
                <form class="form-inline">
                    <?php
                        $asm_type = $this->session->userdata('asm_type');
                    ?>
                    <input type="text" ng-model="data.qnr" class="input-small" placeholder="Question No."/>
                    <input type="text" ng-model="data.detail" class="input-xxlarge" placeholder="Question Detail"/>
                    <fieldset>Answer</fieldset>
                    <?php
                        $TotalChoice = $this->Manage_assessment_type->get_total_choice($asm_type);
                        $counter = 0;

                        //วนลูปสร้าง Answer ตาม AssessmentType ตรงนี้
                        while($counter < $TotalChoice)
                        {
                            ?>
                            <div> <!-- เดี๋ยวพอต้องโหลด/เซฟ ข้อมูลจำต้องใส่ dynamic ID ให้หน้า element ทุกตัวในนี้นะ -->
                            <input type="text" ng-model="<?php echo "data.choice.{$counter}.id"; ?>" class="input-small" placeholder="Answer No."/>
                            <input type="text" ng-model="<?php echo "data.choice.{$counter}.detail"; ?>" class="input-xxlarge" placeholder="Answer Detail"/>
                            <div class="row">
                                <div class="span4">
                                <select ng-model="<?php echo "data.choice.{$counter}.awg"; ?>" name="answer_group">
                                    <?php
                                        $get_answer_group = $this->Manage_answer_group->get_awg();
                                        foreach($get_answer_group as $dd) 
                                        {
                                            echo "<option value='". $dd['AnswerGroupID'] ."'";
                                            if($dd['AnswerGroupID'] == $this->session->userdata('answer_group'))
                                            echo "selected=\"selected\"";
                                            echo ">". $dd['Name'] ."</option>";
                                        }
                                        $counter++;
                                    ?>
                                    </select>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                </form>
            </li>
        </ul>
        <a href="" ng-click="addQuestion()" class="btn input-large" style="margin-top: -20px">+ Add more Question</a>
    <pre>datas = {{datas | json}}</pre>
    </div><!-- Div ng-controller -->
</div>
<hr>




