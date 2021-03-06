<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function signin($username,$password)
    {
        $this->db->where("username",$username);
        $this->db->where("password",$password);

        $query=$this->db->get("user");
        if($query->num_rows()>0)
        {
            foreach($query->result() as $rows)
            {
                //add all data to session
                $newdata = array(
                    'user_id' 		=> $rows->ID,
                    'user_name' 	=> $rows->Username,
                    'user_email'    => $rows->Email,
                    'logged_in' 	=> TRUE
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }

    function signup()
    {
        $data = array(
            'username'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'password'=>md5($this->input->post('password'))
        );
        $this->db->insert('user',$data);
    }

    function profile($username)
    {
        $query = $this->db->query("
        SELECT Name,Lastname,Gender,Birthday,Phone,Email
        FROM user
        WHERE Username='$username'
        ");

        return $query->result();
    }

    function update($user,$data)
    {
        $this->db->where('Username', $user);
        $this->db->update('user', $data);
    }

    function password($user)
    {
        $this->db->where('password',md5($this->input->post('password')));

        $pass=array(
            'password'=>md5($this->input->post('newpass'))
        );

        $this->db->where('Username',$user);
        $this->db->update('user', $pass);
    }

    function manage_user()
    {
        $query = $this->db->query("SELECT * FROM user");
        return $query->result();
    }

    function status_dashboard($user_id)
    {
        $query = $this->db->query("SELECT user_test.Status as Status, 
            assessment.Name as Assessment, assessment.AssessmentID as AID 
            FROM user_test 
            INNER JOIN assessment ON assessment.AssessmentID = user_test.AssessmentID 
            AND user_test.UserID = ".$user_id);
        return $query->result();
    }

    //เพิ่มเข้ามา    query จาก table assessment กับ user_test หาค่าจาก user ID ที่ส่งมา
    function status_user($userID)
    {
        $query = $this->db->query("SELECT * FROM user_test INNER JOIN assessment ON user_test.AssessmentID = assessment.AssessmentID && user_test.UserID =".$userID);
        return $query->result();
    }
    //เพิ่มเข้ามา


    function dashboard($username)
    {
        $query = $this->db->query("
        SELECT Name,Lastname,Email,Username
        FROM user
        WHERE Username='$username'
        ");

        return $query->result();
    }

    function get_assessment()
    {
        $query = $this->db->query("
        SELECT AssessmentID, Name, Description
        FROM assessment");

        return $query->result();
    }

    function upload($filepath)  //เก็บลง database
    {
        $username = $this->session->userdata('user_name');

        $data = array(
            'Image' => $filepath
        );
        $query = $this->db->update('user', $data, array('Username' => $username ));
    }

    function img($username)
    {
        $query = $this->db->query("
        SELECT Image
        FROM user
        WHERE Username='$username'
        ");

        return $query->result();
    }

    function get_creatorName($creatorID)
    {
        $Username = "";
        $query = $this->db->query("
        SELECT Username
        FROM user
        WHERE ID = '$creatorID'
        ");
        foreach($query->result() as $row)
            $Username = $row->Username;
        return $Username;
    }

    function up_user($userID,$data)
    {
        $this->db->where('ID', $userID);
        $this->db->update('user', $data);
    }

    function check_email($email)
    {
        $query = $this->db->query("SELECT * FROM user WHERE Email = '$email'");
        return $query->result();
    }

    function check_password($password)
    {
        $query = $this->db->query("SELECT * FROM user WHERE Password = '$password'");
        return $query->result();
    }

    function check_db($username,$email)
    {
        $query = $this->db->query("SELECT * FROM user WHERE Username ='$username' OR Email = '$email'");
        return $query->result();
    }
}
?>
