<?php

class Manage_answer_group extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_answer_group()
    {
        $query = $this->db->get('answer_group');
        return $query->result();
    }

    function insert_answer_group()
    {
        $data = array(
            'Name' => $this->input->post('answer_group_name'),
            'Detail' => $this->input->post('answer_group_detail')
        );
        $this->db->insert('answer_group', $data);
    }

    function delete($AnswerGroupID)
    {
        $this->db->delete('answer_group', array('AnswerGroupID' => $AnswerGroupID));
    }

}
?>

