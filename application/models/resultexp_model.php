<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ResultExp_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function getResultID($resultArray)
    {
        $ResultID = $this->db->query("
        SELECT ResultID
        FROM result
        WHERE Name = '{$resultArray}'
        ");
        return $ResultID;
    }
}