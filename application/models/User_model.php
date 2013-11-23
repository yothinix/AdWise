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
        FROM User
        WHERE Username='$username'
        ");

            return $query->result();
    }

    function update($user,$data)
    {
        $this->db->where('Username', $user);
        $this->db->update('user', $data);
    }

    function dashboard($username)
    {
        $query = $this->db->query("
        SELECT Name,Lastname,Email,Username
        FROM User
        WHERE Username='$username'
        ");

        return $query->result();
    }
}
?>
