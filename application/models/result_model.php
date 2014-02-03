<?php

class Result_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function get_resultID($UserID)
    {
        //this model should get ResultID from user_test
        $query = $this->db->query
            ("SELECT ResultID, AssessmentID
              FROM user_test
              WHERE UserID = '{$UserID}'
              ");

        return $query->result();
    }

    function get_result_data($resultID)
    {
        $query = $this->db->query
            ("SELECT Name, Detail
              FROM result
              WHERE resultID = '{$resultID}'
              ");

        return $query->result(); 
    }

    function get_assessment_name($AssessmentID)
    {
        $name = "";
        $query = $this->db->query
            ("SELECT Name 
            FROM assessment 
            WHERE AssessmentID = '{$AssessmentID}'
            ");

        foreach($query->result() as $items)
            $name = $items->Name;

        return $name;
    }
}
