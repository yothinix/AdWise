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
        $this->update_tag_json();
    }

    function update($Tags_id,$data)
    {
        $this->db->where('tags_id', $Tags_id);
        $this->db->update('tags', $data);
        $this->update_tag_json();
    }

    function delete_tags($Tags_id)
    {
        $this->db->delete('tags',array('Tags_id' => $Tags_id));
        $this->update_tag_json();
    }

    function update_tag_json()
    {
        $posts = array();
        $query = $this->db->query("SELECT * FROM tags");
        foreach($query->result() as $row)
        {
            $Tags_name = $row->Tags_name;
            $posts[] = ($Tags_name);
        }
        $data = json_encode($posts);
        $path = FCPATH;
        write_file("{$path}/assets/tags.json", $data, 'w');
    }

}
?>
