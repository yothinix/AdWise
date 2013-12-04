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

    //ต้องสร้าง
    //- Function ไว้แปลง Result Expression เก็บลงตาราง Result Expression
    //  แล้วเก็บเป็น ID ใน Assessment Type
    //- Function ไว้เช็ค Result Expression ว่าเขียนถูกมั้ยด้วย

}
?>

