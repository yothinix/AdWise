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

    function update_asm_info()
    {
        $data = array
        (
            'Name' => $this->input->post('asm_name'),
            'Description' => $this->input->post('asm_desc'),
            'AssessmentTypeID' => $this->input->post('asm_type'),
            'TotalQuestion' => $this->input->post('total_question')
        );
        $this->db->where('AssessmentID', $this->session->userdata('AssessmentID'));
        $this->db->update('assessment', $data);
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
    
    function add_answer($Answer_detail, $Answer_group, $QNR)
    {
        $data = array
            (
                'Detail' => $Answer_detail,
                'QuestionNr' => $QNR,
                'AnswerGroupID' => $Answer_group,
                'AssessmentID' => $this->session->userdata('AssessmentID')
            );
        $this->db->insert('choice', $data);
        
        $query = $this->db->query("
            SELECT ChoiceID
            FROM choice
            WHERE Detail = '{$Answer_detail}'
            AND AnswerGroupID = '{$Answer_group}'
            ");
        
        $choiceID = 0; 
        foreach($query->result() as $dd)
            $choiceID = $dd->ChoiceID;

        return $choiceID;
    }

    function update_answer($Answer_detail, $Answer_group, $QNR, $CID)
    {
        $data = array
            (
                'Detail' => $Answer_detail,
                'AnswerGroupID' => $Answer_group
            );
        $this->db->where('ChoiceID', $CID);
        $this->db->update('choice', $data);
        
        $query = $this->db->query("
            SELECT ChoiceID
            FROM choice
            WHERE Detail = '{$Answer_detail}'
            AND AnswerGroupID = '{$Answer_group}'
            ");
        
        $choiceID = 0; 
        foreach($query->result() as $dd)
            $choiceID = $dd->ChoiceID;

        return $choiceID;
    }

    function add_question()
    {
        $data = array(
            'QuestionNr' => $this->input->post('data_qnr'),
            'Detail' => $this->input->post('data_detail'),
            'AssessmentID' => $this->session->userdata('AssessmentID')
        );
        $this->db->insert("question", $data);

        return $data['QuestionNr'];
    }

    function update_question()
    {
        $data = array(
            'QuestionNr' => $this->input->post('data_qnr'),
            'Detail' => $this->input->post('data_detail'),
            'AssessmentID' => $this->session->userdata('AssessmentID')
        );
        $this->db->where('QID', $this->session->userdata('QID'));
        $this->db->update('question', $data);

        return $data['QuestionNr'];
    }

    function delete_asm($AssessmentID)
    {
        $this->db->delete('assessment', array('AssessmentID' => $AssessmentID));
    }

    function get_asm_info($AssessmentID)
    {
        $query = $this->db->query
            ("SELECT Name, Description, AssessmentTypeID, CreatorID
              FROM assessment
              WHERE AssessmentID = '{$AssessmentID}'
            ");

        return $query->result();
    }

    function get_all_question($AssessmentID)
    {
        $query = $this->db->query
            ("SELECT QuestionNr, Detail
              FROM question
              WHERE AssessmentID = '{$AssessmentID}'
              ");
        return $query->result();
    }

    function get_question_data($AssessmentID, $QuestionNr)
    {
        $data = array();
        $query = $this->db->query
            ("SELECT QuestionNr, Detail, QID
              FROM question
              WHERE QuestionNr = '{$QuestionNr}'
              AND AssessmentID = '{$AssessmentID}'
            ");
        foreach($query->result() as $row)
        {
            $data['QuestionNr'] = $row->QuestionNr;
            $data['Q_Detail'] = $row->Detail; 
            $data['QID'] = $row->QID;
        }
        return $data;
    }

    function get_choice_data($AssessmentID, $QuestionNr)
    {
        $query = $this->db->query
            ("SELECT ChoiceID, Detail, AnswerGroupID
              FROM choice
              WHERE AssessmentID = '{$AssessmentID}'
              AND QuestionNr = '{$QuestionNr}'
             ");
        return $query->result();
    }

    function add_ResultExpID($AssessmentID, $ResultExpID)
    {
        $data = array('ResultExpressionID' => $ResultExpID);
        $this->db->where('AssessmentID', $AssessmentID);
        $this->db->update('assessment', $data);

        //clear session relate
        $this->session->unset_userdata('Expression');
    }

    function get_ResultExpID($AssessmentID)
    {
        $ResultExpID = 0;
        $query = $this->db->query
            ("SELECT ResultExpressionID
              FROM assessment
              WHERE AssessmentID = '{$AssessmentID}'
              ");
        foreach($query->result() as $row)
            $ResultExpID = $row->ResultExpressionID;

        return (int) $ResultExpID;
    }

    function get_Expression($ResultExpID)
    {
        $Expression = "";
        $query = $this->db->query
            ("SELECT Expression
              FROM result_expression
              WHERE ResultExpID = '{$ResultExpID}'
              ");
        foreach($query->result() as $row)
            $Expression = $row->Expression;

        return $Expression;
    }

}
?>

