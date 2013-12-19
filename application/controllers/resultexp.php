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

        ////////////////////// End Summation ///////////////////////////
        /*
        * === Result Expression ===
        Total_AWG = 8;
        AWG = {1,2,3,4,5,6,7,8};	//ใช้ ID ของ AWG เทียบเอา
        // 1=>I, 2=>E, 3=>S, 4=>N, 5=>T, 6=>F, 7=>J, 8=>P

        == sort_pair == //หาตัวแทนคู่ลำดับ
        pair(1) = {AWG(1),AWG(2)};
        pair(2) = {AWG(3),AWG(4)};
        pair(3) = {AWG(5),AWG(6)};
        pair(4) = {AWG(7),AWG(8)};

        == compare pattern ==
        pattern = pair(1)+pair(2)+pair(3)+pair(4)
        *
        */

        $str = "pair(1) = {awg(1),awg(2)};
                pair(2) = {awg(3),awg(4)};
                pair(3) = {awg(5),awg(6)};
                pair(4) = {awg(7),awg(8)};";

        /*$str = trim(preg_replace('/\s\s+/', ' ', $str));    //remove new line
        $str2 = str_replace(' ','',$str);                   //remove space
        $str_array = explode(";",$str2,-1);                 //explode each statement to array*/

        $str_array = explode(";", str_replace(' ','',trim(preg_replace('/\s\s+/', ' ', $str))),-1);

        $out = array();
        for($i=1;$i<=4;$i++)
        {
            preg_match_all('/\((.*?)\)/', $str_array[$i-1], $matches);
            $out[$i] = $matches[1];
            //0 = pairID, awgID:1, awgID:2 ... awgID:n
        }

        //Test string output position
        for($j=1;$j<=4;$j++)
        {
            $statement[$j] = "pair({$out[$j][0]}) = {arg({$out[$j][1]}) + arg({$out[$j][2]})}";
        }
        ////////////////////////////////////////////////////////////////
        $data = array(
            'main_content' => 'result_test',
            'summation_array' => $summation_array,
            'Total_AnswerGroup' => $Total_AnswerGroup,
            'str_array' => $str_array,
            'out' => $out,
            'statement' => $statement
        );
        $this->load->view('/includes/template', $data);

        return $summation_array;
    }

    function re_core() //($ASGArray, $Resultexp) AKA sort_pair
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