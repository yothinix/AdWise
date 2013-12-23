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
            $awg1 = $this->ResultExp_model->get_awg_name($out[$j][1]);
            $awg2 = $this->ResultExp_model->get_awg_name($out[$j][2]);
            $statement[$j] = "Pair({$out[$j][0]}) = AnswerGroup({$awg1}) + AnswerGroup({$awg2})";
        }

        $sorted = $this->re_Sort($summation_array);
        $resultID = $this->re_Compare($sorted);

        ////////////////////////////////////////////////////////////////
        $data = array(
            'main_content' => 'result_test',
            'summation_array' => $summation_array,
            'Total_AnswerGroup' => $Total_AnswerGroup,
            'str_array' => $str_array,
            'out' => $out,
            'statement' => $statement,
            'resultID' => $resultID,
            'sorted' => $sorted
            
        );
        $this->load->view('/includes/template', $data);

        return $summation_array;
    }

    function re_Sort($summation_array) //($summation_array, $Resultexp) AKA sort_pair
    {
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
        //override Result expression input
        $str = "pair(1) = {awg(1),awg(2)};
                pair(2) = {awg(3),awg(4)};
                pair(3) = {awg(5),awg(6)};
                pair(4) = {awg(7),awg(8)};";

        $str_array = explode(";", str_replace(' ','',trim(preg_replace('/\s\s+/', ' ', $str))),-1);

        $out = array();
        for($i=1;$i<=4;$i++)
        {
            preg_match_all('/\((.*?)\)/', $str_array[$i-1], $matches);
            $out[$i] = $matches[1];
            //0 = pairID, awgID:1, awgID:2 ... awgID:n
        }

        //////////// under this line is the main method of re_sort function /////////////////// 

        //out[$i][$k] and out[$i][$l] need to pair with summation_array[$k] before compare

        $compare_array = array();
        $pair_array = array();      //for identified 'out' array and 'summation' array
        $total_answer_group = 8;    //can pull from database
        $k = 1;
        $total_pair = 4;
        while($k<=$total_answer_group)
        {
            for($i=1;$i<=$total_pair;$i++)
            {
                for($j=1;$j<=2;$j++)
                {
                    $compare_array[$i][$j] = $summation_array[$k];
                    $pair_array[$out[$i][$j]] = $compare_array[$i][$j];
                    $k++;
                }
            }
        }
        $ASGPattern = array();
        $temp = array();
        $return_array = array();
        for($i=1;$i<=$total_pair;$i++)
        {
            for($pair_ID = 1;$pair_ID<=$total_answer_group; $pair_ID++)
            {
                $ASGPattern[$i] = max($compare_array[$i]);
                if(($ASGPattern[$i] == $pair_array[$pair_ID]) && ($pair_ID != $temp[$i-1]) && ($pair_ID != $temp[$i-2]))
                {
                    $temp[$i] = $pair_ID;  //problem cannot identified AWG_ID when value is equal :( need to lock ID that used
                    $pair_ID = $total_answer_group;
                    $return_array[$i] = $this->ResultExp_model->get_awg_name((int) $temp[$i]);
                }
            }
        }

        return $return_array;
    }

    function re_Compare($ASGPattern)
    {
        $ASGPattern = implode('', $ASGPattern);
        $ResultID = $this->ResultExp_model->get_result_ID($ASGPattern);
        $ResultName = $this->ResultExp_model->get_result_Name($ResultID);
        $date = date('Y/m/d H:i:s');
        
        //Save relation AssessmentID+UserID = ResultID into Database too!
        $data = array(
            'UserID' => $this->session->userdata('user_id'),
            'AssessmentID' => $this->session->userdata('assessmentID'),
            'TestDate' => $date,
            'ResultID' => $ResultID
        ); 
        $this->ResultExp_model->save_user_test($data);

        return $ResultName;
    }

}

//    current issue
//    - how and where to save Result Expression to database
//    - how to keep record of user test data
//    
//    bug
//    - identified pair_ID line 181
//    - ghost query (effect a lot in processing method)
// 
//
