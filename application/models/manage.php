<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function manage_user()
    {
        $query = $this->db->query("SELECT * FROM user");
        return $query->result();
    }
}
?>