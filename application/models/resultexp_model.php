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
        $query = $this->db->query("
        SELECT QuestionNr, ChoiceID
        FROM test
        WHERE UserID = '{$userID}'
        AND AssessmentID = '{$AID}'
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
        $query_asm = $this->db->query("
        SELECT AssessmentTypeID
        FROM assessment
        WHERE AssessmentID = '{$AID}'
        ");

        $query_asm_result = $query_asm->result();
        foreach($query_asm_result as $row)
        {
            $asm_type_ID = $row->AssessmentTypeID;
        }
        $query_awg = $this->db->query("
        SELECT TotalAnswerGroup
        FROM assessment_type
        WHERE AssessmentTypeID = '{$asm_type_ID}'
        ");

        return $query_awg->result();
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
        $query = $this->db->query("
            SELECT ResultID
            FROM result
            WHERE Name = '{$result_pattern}'
            ");

        foreach($query->result() as $row)
            $output = $row->ResultID;

        return $output;
    }

}
