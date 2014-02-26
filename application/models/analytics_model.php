<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Analytics_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    function get_user_test_data($AssessmentID)
    {
        //I mention about this function in HipChat
        //I want the table look like below (it can be using JOIN)
        //  ____________________________
        // | UserID | Gender| ResultID |
        // ----------------------------
        //
        //
        $query = $this->db->query
            ("SELECT UserID, ResultID
              FROM user_test
              WHERE AssessmentID = '{$AssessmentID}'
              ");

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
}

?>
