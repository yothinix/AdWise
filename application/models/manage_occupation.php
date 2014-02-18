<?php
class Manage_occupation extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function get_manage_occupation()
    {
        $query = $this->db->query("
        SELECT * FROM occupation INNER JOIN tags_occupation
        ON tags_occupation.Occupation_id = occupation.Occupation_id
        GROUP BY `Name`
        ORDER BY occupation.Occupation_id
        ");

        return $query->result();
    }

    function get_tags($Occupation_id)
    {
        $query = $this->db->query("
        SELECT tags_id FROM occupation INNER JOIN tags_occupation
        ON tags_occupation.Occupation_id = occupation.Occupation_id
        WHERE occupation.Occupation_id = '$Occupation_id'
        ");

        return $query->result();
    }

    function ocp_db()
    {
        $Occupation_name = $this->input->post('Occupation_name');
        $Occupation_detail = $this->input->post('Occupation_detail');

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

    function tags_ocp($Occupation_id,$Tags_id)
    {
        $data = array(
            'Occupation_id' => $Occupation_id,
            'Tags_id' => $Tags_id
        );

        $this->db->insert('tags_occupation', $data);
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

    function aca_db($Academic_name)
    {
        $query = $this->db->query("
            SELECT Academic_id
            FROM academic
            WHERE Name = '{$Academic_name}'
            ");

        $Academic_id = 0;
        foreach($query->result() as $acaid)
            $Academic_id = $acaid->Academic_id;

        return $Academic_id;
    }

    function ocp_aca($Occupation_id,$Academic_id)
    {
        $data = array(
            'Occupation_id' => $Occupation_id,
            'Academic_id' => $Academic_id
        );

        $this->db->insert('occupation_academic', $data);
    }

    function get_academic($Occupation_id)
    {
        $query = $this->db->query("
        SELECT Academic_id FROM occupation INNER JOIN occupation_academic
        ON occupation_academic.Occupation_id = occupation.Occupation_id
        WHERE occupation.Occupation_id = '$Occupation_id'
        ");

        return $query->result();
    }

    function get_name_aca($Academic_id)
    {
        $query = $this->db->query("
        SELECT Name
        FROM academic
        WHERE Academic_id = '{$Academic_id}'
        ");

        return $query->result();
    }
}
?>