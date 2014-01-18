<?php

class Manage_assessment_type extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_assessment_type()
    {
        $query = $this->db->get('assessment_type');
        return $query->result();
    }

    function delete($AsmTypeID)
    {
        $this->db->delete('assessment_type', array('AssessmentTypeID' => $AsmTypeID));
    }

    function update_asm_type($ASMTID)
    {
        $data = array
        (
            'Name' => $this->input->post('asm_type_name'),
            'Description' => $this->input->post('asm_type_desc'),
            'TotalChoice' => $this->input->post('no_choice'),
            'TotalAnswer' => $this->input->post('no_answer'),
            'TotalAnswerGroup' => $this->input->post('no_answer_group')
        );
        $this->db->where('AssessmentTypeID', $ASMTID);
        $this->db->update('assessment_type',$data);
    }

    function insert_asm_type()
    {
        $data = array
        (
            'Name' => $this->input->post('asm_type_name'),
            'Description' => $this->input->post('asm_type_desc'),
            'TotalChoice' => $this->input->post('no_choice'),
            'TotalAnswer' => $this->input->post('no_answer'),
            'TotalAnswerGroup' => $this->input->post('no_answer_group')
        );
        $this->db->insert('assessment_type',$data);
    }

    function get_asm_type()
    {
        $this->db->select('AssessmentTypeID, Name');
        $this->db->order_by('AssessmentTypeID', "asc");
        $query = $this->db->get('assessment_type');
        if($query)
        {
            $query = $query->result_array();
            return $query;
        }
    }

    function get_attr($AsmTypeID)
    {
        $query = $this->db->query("
        SELECT AssessmentTypeID, TotalChoice, TotalAnswer, TotalAnswerGroup
        FROM assessment_type
        WHERE AssessmentTypeID='{$AsmTypeID}'
        ");

        return $query->result();
    }

    function get_total_choice($AsmTypeID)
    {
        $output = 0;
        $query = $this->db->query("
            SELECT TotalChoice
            FROM assessment_type
            WHERE AssessmentTypeID = '{$AsmTypeID}'
            ");

        foreach($query->result() as $row)
            $output = $row->TotalChoice;

        return (int) $output;
    }
    
    function get_asm_type_name($AsmTypeID)
    {
        $query = $this->db->query
            ("SELECT Name
              FROM assessment_type
              WHERE AssessmentTypeID = '{$AsmTypeID}'
              ");
        foreach($query->result() as $dd)
            $Name = $dd->Name;

        return $Name;
    }
    
}
?>

