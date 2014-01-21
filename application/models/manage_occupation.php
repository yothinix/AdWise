<?php
class Manage_occupation extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    function get_manage_occupation()
    {
        $query = $this->db->query("SELECT Occupation_id,Name,Detail,Academic_id,Tag FROM occupation");
        return $query->result();
    }


    function create_occupation($data)
    {
        $this->db->insert('occupation', $data);
    }


    function update($occupation_id, $data)
    {
        $this->db->where('Occupation_id', $occupation_id);
        $this->db->update('occupation', $data);
    }

}
?>