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
        $data=array(
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
        $query = $this->db->query("SELECT ID, Name, Lastname FROM user");
        return $query->result();
    }

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


}
?>
