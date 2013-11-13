<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function signin($username,$password)
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
                    'logged_in' 	=> TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }

    public function signup()
    {
        $data=array(
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'password'=>md5($this->input->post('password'))
        );
        $this->db->insert('user',$data);
    }

    public function profile($ID)
    {
        $sql= "select name,lastname,phone,email from User where ID='$ID'";
        $rs=$this->db->query($sql);


        $this->db->insert('user',$data);
    }

}
?>
