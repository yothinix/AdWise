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

    function create_academic($data)
    {
        $this->db->insert('academic', $data);
    }

}
?>