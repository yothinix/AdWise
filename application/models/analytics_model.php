<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Analytics_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    function get_user_test_data($AssessmentID)
    {
        $query = $this->db->query("SELECT user_test.UserID, user.Gender, user_test.ResultID
            FROM user_test
            INNER JOIN user ON user_test.UserID = user.ID");


        $query = $this->db->query
            ("SELECT UserID, ResultID
              FROM user_test
              WHERE AssessmentID = '{$AssessmentID}'
              ");

        return $query->result_array();
    }

    function assessment()
    {
        $query = $this->db->query("SELECT AssessmentID,Name FROM assessment");
        return $query->result_array();
    }

    function get_user_sex($UserID)
    {
        $gender = 0;
        $query = $this->db->query
            ("SELECT Gender
              FROM user
              WHERE ID = '{$UserID}'
              ");
        foreach($query->result() as $item)
            $gender = $item->Gender;

        return $gender;
    }

    function graph_data($AssessmentID,$Gender){
        $query = $this->db->query
            ("SELECT AssessmentID, ResultID, COUNT( ResultID ) AS TotalResult
              FROM user_test
              INNER JOIN user ON UserID = ID
              AND AssessmentID = ".$AssessmentID."
              AND Gender = ".$Gender."
              GROUP BY ResultID
            ");
        return $query->result();

    }
}

?>
