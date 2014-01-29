<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_tags extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function tags()
    {
        $query = $this->db->query("SELECT * FROM tags");

        return $query->result();
    }

    function create_tags($data)
    {
        $this->db->insert('tags', $data);
    }

    function update($Tags_id,$data)
    {
        $this->db->where('tags_id', $Tags_id);
        $this->db->update('tags', $data);
    }
}
?>