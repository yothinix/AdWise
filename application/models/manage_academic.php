<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_academic extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function academic()
    {
        $query = $this->db->query("
        SELECT *
        FROM academic
        ");

        return $query->result();
    }

    function academic_db()
    {
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

    function tag_db($Tags_name)
    {
        $query = $this->db->query("
            SELECT Tags_id
            FROM tags
            WHERE Tags_name = '{$Tangs_name}'
            ");

        $Tags_id = 0;
        foreach($query->result() as $tgid)
            $Tags_id = $tgid->Tags_id;

        return $Tags_id;
    }
}
?>