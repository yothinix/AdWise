<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Analytics_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function assessment()
    {
        $query = $this->db->query("SELECT AssessmentID,Name FROM assessment");
        return $query->result_array();
    }

    function graph_data($AssessmentID, $Gender)
    {
        $query = $this->db->query
            ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
              FROM user_test
              INNER JOIN user ON UserID = ID
              INNER JOIN result ON result.ResultID = user_test.ResultID
              AND AssessmentID = '{$AssessmentID}'
              AND Gender = '{$Gender}'
              GROUP BY ResultID
              ");

        return $query->result_array();
    }

}

?>
