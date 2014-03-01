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
    
    function get_ocp_from_result($ResultID)
    {
        $query = $this->db->query
            ("SELECT Occupation_id
              FROM result_occupation
              WHERE ResultID ='{$ResultID}'
              ");

        return $query->result_array();
    }

    function count_result_ocp_row($ResultID)
    {
        $query = $this->db->query
            ("SELECT Occupation_id
              FROM result_occupation
              WHERE ResultID ='{$ResultID}'
              ");
        return $query->num_rows();
    }

    function get_ocp_name($ocp_id)
    {
        $name = "";
        $query = $this->db->query
            ("SELECT Name
              FROM occupation
              WHERE Occupation_id = '{$ocp_id}'
              ");

        foreach($query->result() as $items)
            $name = $items->Name;

        return $name;
    }

    function get_ocp_data($ocp_id)
    {
        $query = $this->db->query
            ("SELECT Name, Detail
              FROM occupation
              WHERE Occupation_id = '{$ocp_id}'
              ");
        return $query->result_array();
    }

    function get_relate_tagid($ocp_id)
    {
        $query = $this->db->query
            ("SELECT Tags_id
              FROM tags_occupation
              WHERE Occupation_id = '{$ocp_id}'
              ");
        return $query->result_array();
    }

    function count_tag_ocp_row($ocp_id)
    {
        $query = $this->db->query
            ("SELECT Tags_id
              FROM tags_occupation
              WHERE Occupation_id ='{$ocp_id}'
              ");
        return $query->num_rows();
    }
}
