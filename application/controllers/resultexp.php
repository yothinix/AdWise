<?php

class ResultExpression extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('ResultExp_model');
    }

    function _re_Summation($AnswerArray)    //Answer_Array[AssessmentID, QuestionNo, ChoiceID]
    {
        //Put below this line into Take an Assessment
        $AssessmentID = $this->session->userdata('AssessmentID');
        $QuestionNr = $this->session->userdata('QuestionNr');
        $SelectChoice = $this->session->userdata('SelectChoice');
        $AnswerArray($AssessmentID, $QuestionNr, $SelectChoice);
        foreach($AnswerArray as &$t) {
            if($t[1]==1){
                array_push($t, "hello World"); // or just $t[] = "hello World";
            }
        }

        //return AnswerGroup_Array
    }

    function _re_Sort($ASGArray, $Pattern_length)
    {
        //return ASGArray in Pattern_length
    }

    function _re_Compare($ASGPattern)
    {
        $n = 0;
        $AsmResult = "";
        $result_404 = 404;                                          //ResultID for 404 case
        $totalResult = $this->session->userdata('total_Result');    //ยังไม่ได้ทำตอน Take an Assessment
        $result_array = $this->session->userdata('result_array');   //ยังไม่ได้ทำตอน Take an Assessment
        $found = false;
        while($n < $totalResult && $found == false)
        {
            if($ASGPattern == $result_array($n))
            {
                $AsmResult = $result_array($n);
                $found = true;
            }
            $n++;
        }
        if($found == false)
        {
            $AsmResult =  $result_404;
        }
        $resultID = $this->ResultExp_model->getResultID($result_array($n)); //ยังไม่สร้าง ResultExp_Model

        return ResultID;

        //Save relation AssessmentID+UserID = ResultID into Database too!
    }
}