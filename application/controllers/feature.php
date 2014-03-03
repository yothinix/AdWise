<?php
class Feature extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $username = $this->session->userdata('user_name');

        if($username == NULL)
        {
            $data['title']= 'AdWise | Features';
            $this->load->view('login/header',$data);
            $this->load->view('feature',$data);
        }
        else{
            $data['title']= 'AdWise | Features';
            $this->load->view('header',$data);
            $this->load->view('feature',$data);
        }
    }
}
?>