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
        $this->db->insert('assessment',$data);
    }

    function delete_asm($AssessmentID)
    {
        $this->db->delete('assessment', array('AssessmentID' => $AssessmentID));
    }

}
?>

