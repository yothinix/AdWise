<?php

class Manage_assessment extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Assessment_model');
    }

    function insert_asm_info()
    {
        $asm_name = $this->input->post('asm_name');
        $asm_desc = $this->input->post('asm_desc');
        $asm_type = $this->input->post('asm_type');
        $total_q = $this->input->post('total_question');
        $data = array
        (
            'Name' => $asm_name,
            'Description' => $asm_desc,
            'AssessmentTypeID' => $asm_type,
            'TotalQuestion' => $total_q
        );
        $this->session->set_userdata('asm_name', $asm_name);
        $this->session->set_userdata('asm_desc', $asm_desc);
        $this->session->set_userdata('asm_type', $asm_type);
        $this->session->set_userdata('total_question', $total_q);
        $this->db->insert('assessment', $data);
    }

    function get_assessmentID($asm_name, $asm_type)
    {
        $query = $this->db->query("
            SELECT AssessmentID
            FROM assessment
            WHERE Name = '{$asm_name}'
            AND AssessmentTypeID = '{$asm_type}'
            ");
        
        $AssessmentID = 0;
        foreach($query->result() as $dd)
            $AssessmentID = $dd->AssessmentID;

        return $AssessmentID;
    }
    
    function add_answer($Answer_detail, $Answer_group)
    {
        $data = array
            (
                'Detail' => $Answer_detail,
                'AnswerGroupID' => $Answer_group,
                'AssessmentID' => $this->session->userdata('AssessmentID')
                //QuestionNr needed
            );
        $this->db->insert('choice', $data);
        
        $query = $this->db->query("
            SELECT ChoiceID
            FROM choice
            WHERE Detail = '{$Answer_detail}'
            AND AnswerGroupID = '{$Answer_group}'
            ");
        //Above might add AssessmentID as Identifier if having trouble
        $choiceID = 0; 
        foreach($query->result() as $dd)
            $choiceID = $dd->ChoiceID;

        return $choiceID;
    }

    function add_question($QuestionNr, $Q_Detail)
    {
        $data = array
            (
                'QuestionNr' => $QuestionNr,
                'Detail' => $Q_Detail,
                'AssessmentID' => $this->session->userdata('AssessmentID')
            );
        $this->db->insert("question", $data);
        $query = $this->db->query("
            SELECT QID
            FROM question
            WHERE QuestionNr = '{$QuestionNr}'
            AND Detail = '{$Q_Detail}'
            ");
        //Above might add AssessmentID as Identifier if having trouble
        $QID = 0;
        foreach($query->result() as $dd)
            $QID = $dd->QID;

        return $QID;
    }

    function delete_asm($AssessmentID)
    {
        $this->db->delete('assessment', array('AssessmentID' => $AssessmentID));
    }

}
?>

