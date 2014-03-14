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
        $query = $this->db->query("SELECT assessment.AssessmentID as AssessmentID,assessment.name as Name
                                   FROM user_test
                                   INNER JOIN assessment ON assessment.AssessmentID = user_test.AssessmentID
                                   GROUP BY user_test.AssessmentID
                                   ORDER BY user_test.AssessmentID
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

    function data_graph()
    {
        $query = $this->db->query
            ("SELECT name,dataID
              FROM graph_data
            ");
        return $query->result();

    }

    function get_pie_gender_male($AssessmentID)
    {
        $result_array = array();
        $query = $this->db->query
            ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
              FROM user_test
              INNER JOIN user ON UserID = ID
              INNER JOIN result ON result.ResultID = user_test.ResultID
              AND AssessmentID = '{$AssessmentID}'
              AND Gender = '0'
              GROUP BY ResultID
              ");
        foreach($query->result() as $row)
        {
            array_push($result_array, array('Name' => $row->Name, 'Value' => $row->TotalResult));
        }
        return $result_array;
    }

    function get_pie_gender_female($AssessmentID)
    {
        $result_array = array();
        $query = $this->db->query
            ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
              FROM user_test
              INNER JOIN user ON UserID = ID
              INNER JOIN result ON result.ResultID = user_test.ResultID
              AND AssessmentID = '{$AssessmentID}'
              AND Gender = '1'
              GROUP BY ResultID
              ");
        foreach($query->result() as $row)
        {
            array_push($result_array, array('Name' => $row->Name, 'Value' => $row->TotalResult));
        }
        return $result_array;

    }

    function get_pie_age($AssessmentID)
    {
        $query = $this->db->query
            ("SELECT user.Birthday as Birthday, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
              FROM user_test
              INNER JOIN user ON UserID = ID
              INNER JOIN result ON result.ResultID = user_test.ResultID
              AND AssessmentID = '{$AssessmentID}'
              GROUP BY user.Birthday
              ");

        $birthday = $query->result();
           foreach($birthday as $BD){
               $birthDate = explode("-", $BD->Birthday);
               $cal_age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
               if($cal_age < 200 && $cal_age > 0){
                   // array_push($result_array, array('Name' => $cal_age, 'Value' => ));
                   echo "Age is: ".$cal_age." Result : ".$BD->TotalResult." Result ID : ".$BD->ResultID;
                   echo "<br>";
               }


        }

    }

    function get_pie_total($AssessmentID)
            {
                $total_array = array();
                $query = $this->db->query
                    ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS Total
                      FROM user_test
                      INNER JOIN user ON UserID = ID
                      INNER JOIN result ON result.ResultID = user_test.ResultID
                      GROUP BY ResultID
                      ");
                $i=0;
                $total = $query->result();
                foreach($total as $rows){
                    array_push($total_array, array((string)$rows->Name,(int)$rows->Total));
                    echo $total_array[$i];
                }
                return $total_array;
            }

    function get_line_gender_male($AssessmentID)
        {
        $query = $this->db->query
                ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
                      FROM user_test
                      INNER JOIN user ON UserID = ID
                      INNER JOIN result ON result.ResultID = user_test.ResultID
                      AND AssessmentID = '{$AssessmentID}'
                      AND Gender = '0'
                      GROUP BY ResultID
                      ");
            return $query->result();
        }

    function get_line_gender_female($AssessmentID)
        {
        $query = $this->db->query
                ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
                      FROM user_test
                      INNER JOIN user ON UserID = ID
                      INNER JOIN result ON result.ResultID = user_test.ResultID
                      AND AssessmentID = '{$AssessmentID}'
                      AND Gender = '1'
                      GROUP BY ResultID
                      ");
            return $query->result();
        }

    function get_line_age($userID)
        {
            $query = $this->db->query
                ("SELECT  Birthday
                          FROM user

                      ");

            $birthday = $query->result();
            foreach($birthday as $BDS)
            {
                foreach($BDS as $BD){
                    $birthDate = explode("-", $BD);
                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
                    echo "Age is: ".$age;
                    echo "<br>";
                }

            }
        }

    function get_line_total($AssessmentID)
    {
        $query = $this->db->query
            ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS Total
                      FROM user_test
                      INNER JOIN user ON UserID = ID
                      INNER JOIN result ON result.ResultID = user_test.ResultID
                      GROUP BY ResultID
                      ");
        return $query->result();
    }

    function get_column_gender_male($AssessmentID)
        {
            $query = $this->db->query
                ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
                      FROM user_test
                      INNER JOIN user ON UserID = ID
                      INNER JOIN result ON result.ResultID = user_test.ResultID
                      AND AssessmentID = '{$AssessmentID}'
                      AND Gender = '0'
                      GROUP BY ResultID
                      ");
            return $query->result();
        }

    function get_column_gender_female($AssessmentID)
        {
            $query = $this->db->query
                ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS TotalResult
                      FROM user_test
                      INNER JOIN user ON UserID = ID
                      INNER JOIN result ON result.ResultID = user_test.ResultID
                      AND AssessmentID = '{$AssessmentID}'
                      AND Gender = '1'
                      GROUP BY ResultID
                      ");
            return $query->result();
        }

    function get_column_age($userID)
        {
            $query = $this->db->query
                ("SELECT Birthday
                      FROM user

                      ");

            $birthday = $query->result();
            foreach($birthday as $BDS)
            {
                foreach($BDS as $BD){
                    $birthDate = explode("-", $BD);
                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
                    echo "Age is: ".$age;
                    echo "<br>";
                }

            }
        }
    function get_column_total($AssessmentID)
    {
        $query = $this->db->query
            ("SELECT result.Name as Name, user_test.ResultID, COUNT( user_test.ResultID ) AS Total
                      FROM user_test
                      INNER JOIN user ON UserID = ID
                      INNER JOIN result ON result.ResultID = user_test.ResultID
                      GROUP BY ResultID
                      ");
        return $query->result();
    }
}
?>