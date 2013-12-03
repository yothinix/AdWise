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
        $data = array
        (
            'Name' => $this->input->post('asm_name'),
            'Description' => $this->input->post('asm_desc'),
            'AssessmentTypeID' => $this->input->post('asm_type')
        );
        $this->db->insert('assessment',$data);
    }

    function delete_asm($AssessmentID)
    {
        $this->db->delete('assessment', array('AssessmentID' => $AssessmentID));
    }

}
?>

