<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_academic extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function academic()
    {
        //$query = $this->db->query("
        //SELECT Academic_id,Name,Detail,Tag
        //FROM academic
        //");

        //return $query->result();

        $query = $this->db->query("
        SELECT * FROM academic");

        return $query->result();
    }

    function create_academic($data)
    {
        $this->db->insert('academic', $data);
    }

    function update($academic_id,$data)
    {
        $this->db->where('Academic_id', $academic_id);
        $this->db->update('academic', $data);
    }
}
?>