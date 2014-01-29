<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ResultExp_model extends CI_Model {

    function getResultID($resultArray)
    {
        $ResultID = $this->db->query("
        SELECT ResultID
        FROM result
        WHERE Name = '{$resultArray}'
        ");
        return $ResultID;
    }

    function load_asw_sheet($userID, $AID)
    {
        $sessionID = $this->session->userdata('session_id');
        $query = $this->db->query("
        SELECT QuestionNr, ChoiceID
        FROM test
        WHERE UserID = '{$userID}'
        AND AssessmentID = '{$AID}'
        AND sessionID ='{$sessionID}'
        ");

        return $query->result();
    }

    function CID2AWG($CID)
    {
        $query = $this->db->query("
        SELECT AnswerGroupID
        FROM choice
        WHERE ChoiceID = '{$CID}'
        ");

        return $query->result();
    }

    function get_total_awg($AID)
    {
        $asm_type_ID = 0;
        $out = 0;

        $query_asm = $this->db->query("
        SELECT AssessmentTypeID
        FROM assessment
        WHERE AssessmentID = '{$AID}'
        ");

        $query_asm_result = $query_asm->result();
        
        foreach($query_asm_result as $row)
            $asm_type_ID = $row->AssessmentTypeID;
        
        $query_awg = $this->db->query("
        SELECT TotalAnswerGroup
        FROM assessment_type
        WHERE AssessmentTypeID = '{$asm_type_ID}'
        ");

        foreach($query_awg->result() as $i)
            $out = $i->TotalAnswerGroup;
        
        return $out;
    }

    function get_awg_name($awgID)
    {
        $query = $this->db->query("
        SELECT Name
        FROM answer_group
        WHERE AnswerGroupID = '{$awgID}'
        ");

        foreach ($query->result() as $row)
            $output = $row->Name;

        return $output;
    }

    function get_result_ID($result_pattern)
    {
        $output = 0;
        $query = $this->db->query("
            SELECT ResultID
            FROM result
            WHERE Name = '{$result_pattern}'
            ");

        foreach($query->result() as $row)
            $output = $row->ResultID;

        return $output;
    }

    function get_result_Name($resultID)
    {
        $output = 0;
        $query = $this->db->query("
            SELECT Name
            FROM result
            WHERE ResultID = '{$resultID}'
            ");

        foreach($query->result() as $row)
            $output = $row->Name;

        return $output;
    }

    function save_user_test($data)
    {
        $this->db->insert('user_test', $data); 
    }

    function update_user_test($data, $userID, $AsmID)
    {
        $this->db->where('UserID', $userID);
        $this->db->where('AssessmentID', $AsmID);
        $this->db->update('user_test', $data);
    }

    function get_asm_status($userID, $AsmID)
    {
        $output;
        $query = $this->db->query("
            SELECT Status
            FROM user_test
            WHERE UserID = '{$userID}'
            AND AssessmentID = '{$AsmID}'
            ");

        foreach($query->result() as $row)
            $output = $row->Status;

        return $output;
    }

    function get_result_expression($AsmID)
    {
        $query1 = $this->db->query("
            SELECT ResultExpressionID
            FROM assessment
            WHERE AssessmentID = '{$AsmID}'
            ");

        foreach($query1->result() as $temp)
            $ResultExpressionID = $temp->ResultExpressionID;

        $query2 = $this->db->query("
            SELECT Expression
            FROM result_expression
            WHERE ResultExpID = '{$ResultExpressionID}'
            ");

        foreach($query2->result() as $row)
            $output = $row->Expression;

        return $output;
    }

    function add_resultexp($data) 
    {
        $ResultExpID = 0;
        $this->db->set('Expression', $data);
        $this->db->insert('result_expression');
        
        $query = $this->db->query
           ("SELECT ResultExpID
             FROM result_expression
             WHERE Expression = '{$data}' 
             ");
        foreach($query->result() as $row)
            $ResultExpID = $row->ResultExpID;
        
        return $ResultExpID;
    }

    function update_resultexp($data)
    {
        $ResultExpID = $this->session->userdata('ResultExpID');
        $expression = array('Expression' => $data);
        $this->db->where('ResultExpID', $ResultExpID);
        $this->db->update('result_expression', $expression);

        return $ResultExpID;
    }

}
