<?php
class Manage_result_data extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function get_manage_result()
    {
        $query = $this->db->query("
        SELECT * FROM result
        ");

        return $query->result();
    }

    function create_result($data)
    {
        $this->db->insert('result', $data);
    }

    //function update_result($ResultID, $data)
    //{
    //    $this->db->where('ResultID', $ResultID);
    //    $this->db->update('result', $data);
    //}

    function result_db()
    {
        $Result_name = $this->input->post('name');
        $Result_detail = $this->input->post('detail');

        $data = array
        (
            'Name' => $Result_name,
            'Detail' => $Result_detail
        );
        $this->db->insert('result', $data);

        $query = $this->db->query("
            SELECT ResultID
            FROM result
            WHERE Name = '{$Result_name}'
            AND Detail = '{$Result_detail}'
            ");

        $ResultID = 0;
        foreach($query->result() as $reid)
            $ResultID = $reid->ResultID;

        return $ResultID;
    }

    function ocp_db($Occupation_name)
    {
        $query = $this->db->query("
            SELECT Occupation_id
            FROM occupation
            WHERE name = '{$Occupation_name}'
            ");

        $Occupation_id = 0;
        foreach($query->result() as $ocpid)
            $Occupation_id = $ocpid->Occupation_id;

        return $Occupation_id;
    }

    function result_ocp($ResultID,$Occupation_id)
    {
        $data = array(
            'ResultID' => $ResultID,
            'Occupation_id' => $Occupation_id
        );

        $this->db->insert('result_occupation', $data);
    }

    function get_ocp($ResultID)
    {
        $query = $this->db->query("
        SELECT * FROM result JOIN result_occupation
        ON result.ResultID = result_occupation.ResultID
        WHERE result.ResultID = '$ResultID'
        ");

        return $query->result();
    }

    function get_name($Occupation_id)
    {
        $query = $this->db->query("
            SELECT Name
            FROM occupation
            WHERE Occupation_id = '{$Occupation_id}'
            ");

        return $query->result();
    }

    function get_aca($Occupation_id)
    {
        $query = $this->db->query("
        SELECT Academic_id FROM occupation_academic
        WHERE Occupation_id = '{$Occupation_id}'
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

    function update_result($ResultID)
    {
        $Name = $this->input->post('name');
        $Detail = $this->input->post('detail');
        $this->db->query("
            UPDATE result
            SET NAME = '{$Name}',Detail = '{$Detail}'
            WHERE ResultID = $ResultID
            ");
    }

    function delete_result($ResultID)
    {
        $this->db->query("
            DELETE FROM result_occupation
            WHERE ResultID = $ResultID
            ");
    }

    function ocp_chk($ResultID,$Occupation_id)
    {
        $data = array(
            'ResultID' => $ResultID,
            'Occupation_id' => $Occupation_id
        );
        $this->db->insert('result_occupation', $data);
    }
}
?>