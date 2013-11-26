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

    function testdata() //ยังไม่ใช้ติดปัญหา Query ผี 13 entry หาที่มาไม่ได้
    {
        $data=array
        (
            'UserID' => $this->session->userdata('user_id'),
            'AssessmentID' => $this->session->userdata('assessmentID'),
            'QuestionNr' =>$this->session->userdata('QuestionNr'),
            'ChoiceID' => $this->input->post('name of submit element')
        );
        $this->db->insert('test',$data);
    }
}
?>

