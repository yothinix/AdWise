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

    function update_result($ResultID, $data)
    {
        $this->db->where('ResultID', $ResultID);
        $this->db->update('result', $data);
    }

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
}
?>