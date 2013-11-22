<?php
class Manage extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array('main_content' => 'manage_user');
        $this->load->view('includes/template', $data);
    }
}
?>