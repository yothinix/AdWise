<?php

class Manage_assessment extends CI_Model {

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

}
?>

