<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Analytics_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function assessment()
    {
        $query = $this->db->query("SELECT assessment.AssessmentID as AssessmentID,assessment.name as Name
                                   FROM user_test
                                   INNER JOIN assessment ON assessment.AssessmentID = user_test.AssessmentID
                                   GROUP BY user_test.AssessmentID
                                   ORDER BY user_test.AssessmentID
                                  ");
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

    function graph()
    {
        $query = $this->db->query
            ("SELECT graphID,name
              FROM graph
            ");
        return $query->result();
    }

}

?>
