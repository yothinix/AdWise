<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_academic extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function academic()
    {
        $query = $this->db->query("SELECT * FROM academic");
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

    //clear all tags in aca
    function  delete_aca($Academic_id){
        $this->db->query("
            DELETE FROM tags_academic
            WHERE Academic_id = $Academic_id
            ");
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
}
?>
