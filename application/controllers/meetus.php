<?php
class Meetus extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $username = $this->session->userdata('user_name');

        if($username == NULL)
        {
            $data['title']= 'AdWise | Meet Us';
            $this->load->view('login/header',$data);
            $this->load->view('meet_us',$data);
        }
        else{
            $data['title']= 'AdWise | Meet Us';
            $this->load->view('header',$data);
            $this->load->view('meet_us',$data);
        }
    }
}
?>