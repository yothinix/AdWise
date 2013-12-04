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

    function delete($AnswerGroupID)
    {
        $this->db->delete('answer_group', array('AnswerGroupID' => $AnswerGroupID));
    }

}
?>

