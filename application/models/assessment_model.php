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
        SELECT AssessmentID, Name, Description, AssessmentTypeID, CreatorID, status
        FROM assessment
        ");

        return $query->result();
    }

    function get_asm_list()
    {
        $query = $this->db->query("
        SELECT AssessmentID, Name, Description, CreatorID, status, TotalQuestion
        FROM assessment
        WHERE status = '1'
        ");

        return $query->result();
    }

    function get_asm_info($AssessmentID)
    {
        $query = $this->db->query("
        SELECT AssessmentID, Name, Description, TotalQuestion, AssessmentTypeID
        FROM assessment
        WHERE AssessmentID='{$AssessmentID}'
        ");

        return $query->result();
    }

    function get_total_question($AssessmentID)
    {
        $output = 0;
        $query = $this->db->query("
            SELECT TotalQuestion
            FROM assessment
            WHERE AssessmentID = '{$AssessmentID}'
            ");

        foreach($query->result() as $row)
            $output = $row->TotalQuestion;

        return $output;
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
            'ChoiceID' => $this->session->userdata('SelectChoice'),
            'sessionID' => $this->session->userdata('session_id')
        );
        $this->db->insert('test',$data);
    }

    function set_status($aid)
    {
        $this->db->update('assessment', array('status' => 1 ), array('AssessmentID' => $aid));
    }

    function unset_status($aid)
    {
        $this->db->update('assessment', array('status' => 0 ), array('AssessmentID' => $aid));
    }

    function reset_test_data($Assessment_id, $UserID)
    {
        $this->db->delete('test', array('UserID' => $UserID, 'AssessmentID' => $Assessment_id));
    }

    function get_participant($AssessmentID)
    {
        $variable;
        $query = $this->db->query("SELECT COUNT(Status) as Participant FROM user_test WHERE AssessmentID = {$AssessmentID}");
        foreach($query->result_array() as $item)
            $variable = $item['Participant'];
        return $variable;
    }

    function get_parameter()
    {
        $parameter = $this->db->query("SELECT value FROM parameter WHERE name='minimum support'")->result_array();
        return $parameter[0]['value'];
    }

    function set_parameter()
    {
        $this->db->where('name', 'minimum support');
        $this->db->update('parameter', array('value' => $this->input->post('min_sup')));
    }
}
?>

