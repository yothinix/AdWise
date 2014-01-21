<?php
class Manage_occupation extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function get_manage_occupation()
    {
        $query = $this->db->query("
        SELECT *
        FROM occupation
        ");

        return $query->result();
    }

    function ocp_db()
    {
        $data = array
        (
            'Name' => $Occupation_name,
            'Detail' => $Occupation_detail
        );
        $this->db->insert('occupation', $data);

        $query = $this->db->query("
            SELECT Occupation_id
            FROM occupation
            WHERE Name = '{$Occupation_name}'
            AND Detail = '{$Occupation_detail}'
            ");

        $Occupation_id = 0;
        foreach($query->result() as $acid)
            $Occupation_id = $acid->Occupation_id;

        return $Occupation_id;
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

    function tags_ocp($Occupation_id,$Tags_id)
    {
        $data = array(
            'Occupation_id' => $Occupation_id,
            'Tags_id' => $Tags_id
        );

        $this->db->insert('tags_occupation', $data);
    }
}
?>