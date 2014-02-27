<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_academic extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function academic()
    {
        $query = $this->db->query("
        SELECT * FROM academic INNER JOIN tags_academic
        ON tags_academic.Academic_id = academic.Academic_id
        GROUP BY `Name`
        ");

        return $query->result();
    }

    function get_tags($Academic_id)
    {
        $query = $this->db->query("
        SELECT tags_id FROM academic INNER JOIN tags_academic
        ON tags_academic.Academic_id = academic.Academic_id
        WHERE academic.Academic_id = '$Academic_id'
        ");

        return $query->result();
    }

    function academic_db()
    {
        $Academic_name = $this->input->post('Academic_name');
        $Academic_detail = $this->input->post('Academic_detail');

        $data = array
        (
            'Name' => $Academic_name,
            'Detail' => $Academic_detail
        );
        $this->db->insert('academic', $data);

        $query = $this->db->query("
            SELECT Academic_id
            FROM academic
            WHERE Name = '{$Academic_name}'
            AND Detail = '{$Academic_detail}'
            ");

        $Academic_id = 0;
        foreach($query->result() as $acid)
            $Academic_id = $acid->Academic_id;

        return $Academic_id;
    }

    function tags_db($Tags_name)
    {
        $query = $this->db->query("
            SELECT Tags_id
            FROM tags
            WHERE Tags_name = '{$Tags_name}'
            ");

        $Tags_id = 0;
        foreach($query->result() as $tgid)
            $Tags_id = $tgid->Tags_id;

        return $Tags_id;
    }

    //clear all tags in aca
    function  delete_aca($Academic_id){
        $this->db->query("
            DELETE FROM tags_academic
            WHERE Academic_id = $Academic_id
            ");
    }
    function tags_chk($Academic_id,$Tags_id)
    {
        $data = array(
            'Academic_id' => $Academic_id,
            'Tags_id' => $Tags_id
        );
        //if($Tags_id != 0){
            $this->db->insert('tags_academic', $data);
        //}
    }

    //update name detail
    function update_academic($Academic_id){
        $Academic_name = $this->input->post('name');
        $Academic_detail = $this->input->post('detail');
        $this->db->query("
            UPDATE academic
            SET NAME = '{$Academic_name}',Detail = '{$Academic_detail}'
            WHERE Academic_id = $Academic_id
            ");

    }

    function tags_aca($Academic_id,$Tags_id)
    {
        $data = array(
            'Academic_id' => $Academic_id,
            'Tags_id' => $Tags_id
        );
        if($Tags_id != 0){
            $this->db->insert('tags_academic', $data);
        }
    }

    function get_name($Tags_id)
    {
        $query = $this->db->query("
            SELECT Tags_name
            FROM tags
            WHERE Tags_id = '{$Tags_id}'
            ");

        return $query->result();
    }
}
?>