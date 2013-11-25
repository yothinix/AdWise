<?php

class Assessment_model extends CI_Model {

    function get_question($AID, $QID)
    {
        $query = $this->db->query("
        SELECT AssessmentID, QuestionNr, Detail, QID
        FROM question
        WHERE AssessmentID='{$AID}'
        AND QuestionNr='{$QID}'
        ");

        return $query->result();
    }

    function get_choice($AID, $QNR)
    {
        $query = $this->db->query("
        SELECT ChoiceID, Detail
        FROM choice
        WHERE AssessmentID = '{$AID}'
        AND QuestionNr = '{$QNR}'
        ");

        return $query->result();
    }

    function get_assessment()
    {
        $query = $this->db->query("
        SELECT AssessmentID, Name, Description
        FROM assessment
        ");

        return $query->result();
    }

    function get_asm_info($AssessmentID)
    {
        $query = $this->db->query("
        SELECT AssessmentID, Name, Description, TotalQuestion
        FROM assessment
        WHERE AssessmentID='{$AssessmentID}'
        ");

        return $query->result();
    }

    function check_admin($username)
    {
        $query = $this->db->query("
        SELECT Role
        FROM user
        WHERE Username='{$username}'
        ");

        return $query->result();
    }
}
?>

