<?php

class Resultexp extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('ResultExp_model');
    }

    function Summation($userID, $AID)   //Answer_Array[AssessmentID, QuestionNo, ChoiceID]
    {
        //เปิดผ่าน URL นี้นะ >> http://localhost/project/index.php/resultexp/Summation/3/1
        
        $Total_AnswerGroup = 0;
        $total_awg = $this->ResultExp_model->get_total_awg($AID);
        foreach($total_awg as $row)
        {
            $Total_AnswerGroup = $row->TotalAnswerGroup;
        }
        //get From database จำนวนเท่ากับ Total AnswerGroup ในตาราง ASM_type

        $summation_array = array();
        for($i=1; $i<=$Total_AnswerGroup;$i++)
        {
            $summation_array[$i] = 0;
        }

        $sheet = $this->ResultExp_model->load_asw_sheet($userID, $AID);
        foreach($sheet as $items)
        {
            $awg = $this->ResultExp_model->CID2AWG($items->ChoiceID);
            foreach($awg as $awg_items)
            {
                $awg = $awg_items->AnswerGroupID;
            }
            $summation_array[$awg]++;
        }

        $data = array(
            'main_content' => 'result_test',
            'summation_array' => $summation_array,
            'Total_AnswerGroup' => $Total_AnswerGroup
        );
        $this->load->view('/includes/template', $data);

        return $summation_array;
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