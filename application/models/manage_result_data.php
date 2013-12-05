<?php
class Manage_result_data extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function get_manage_result()
    {
        $query = $this->db->query("SELECT ResultID,Name,Detail FROM result");
        return $query->result();
    }

    function create_result($data)
    {
        $this->db->insert('result', $data);
    }

    function update_result($ResultID,$data)
    {
        $this->db->where('ResultID', $ResultID);
        $this->db->update('result', $data);
    }
}
?>