<?php

class Site_model extends CI_Model {

    function get_question($AID, $QID)
    {
        $query = $this->db->query("
        SELECT QuestionNr, Detail, ChoiceID
        FROM question
        WHERE AssessmentID='{$AID}'
        AND QuestionNr='{$QID}'");

        return $query->result();
    }

    function get_choice($ChoiceID)
    {
        $query = $this->db->query("
        SELECT ChoiceID, Detail
        FROM choice
        WHERE ChoiceID='{$ChoiceID}'
        ");

        return $query->result();

    }
}
?>

