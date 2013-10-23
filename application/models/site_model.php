<?php

class Site_model extends CI_Model {

    function get_question()
    {
        $query = $this->db->get('question');
        return $query->result();
    }

/*    function add_record($data)
    {
        $this->db->Insert('data', $data);
        return;
    }

    function update_record($data)
    {
        $this->db->where('id', 2);
        $this->db->update('data', $data);
    }

    function delete_row()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('data');
    }*/
}
?>

