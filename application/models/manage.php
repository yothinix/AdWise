<?php
class Manage extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function manage_user()
    {
        $query = $this->db->query("SELECT ID,Name,Lastname FROM user");
        return $query->result();
    }

}
?>