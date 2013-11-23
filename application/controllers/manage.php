<?php
class Manage extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if(($this->session->userdata('user_name')!=""))
        {
            $data['title']= 'AdWise | When Student found their ways';
            $this->load->view('login/header',$data);
            $this->load->view('login/signup',$data);
            $this->load->view('login/footer',$data);
        }
        else
        {
            $this->asmlist();
        }
    }

    function manage_user()
    {
        $data = array('main_content' => 'manage_user');
        $this->load->view('includes/template', $data);
    }
}
?>