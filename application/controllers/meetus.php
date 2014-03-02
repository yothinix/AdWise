<?php
class Meetus extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $username = $this->session->userdata('user_name');

        if($username == NULL)
        {
            $data['title']= 'AdWise | When Student found their ways';
            $this->load->view('login/header',$data);
            $this->load->view('meet_us',$data);
        }
        else{
            $data['title']= 'AdWise | When Student found their ways';
            $this->load->view('header',$data);
            $this->load->view('meet_us',$data);
        }
    }
}
?>