<?php
class Manage extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Assessment_model');
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
            $this->manage_user();
        }
    }

    function manage_user()
    {
        $user = $this->User_model->manage_user();
        $data = array(
            'main_content' => 'manage_user',
            'manage_user' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function delete_user($userID)
    {
        $this->db->delete('user', array('ID' => $userID));
        $this->manage_user();
    }

    function manage_assessment()
    {
        $get_assessment = $this->Assessment_model->get_assessment();
        $data = array(
            'main_content' => 'manage_assessment',
            'get_assessment' => $get_assessment
        );
        $this->load->view('includes/template', $data);
    }

    function update_user($ID)
    {
        $data = array(
            'name'=>$this->input->post('name'),
            'lastname'=>$this->input->post('lastname'),
            'gender'=>$this->input->post('gender'),
            'birthday'=>$this->input->post('birthday'),
            'phone'=>$this->input->post('phone'),
            'email'=>$this->input->post('email')
        );
        $this->User_model->up_user($ID ,$data);
        $this->manage_user();
    }

    function upload_photo()
    {
        $username = $this->session->userdata('user_name');

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['file_name'] = date("YmdHis");

        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('photo'))
        {
            $filepath = $this->upload->data();
            $this->User_model->upload($filepath['file_name']); //อัดไฟล์พาร์ธเข้ามาในนี้
            $this->manage_user();
        }
        else
        {
            //$data['error'] = $this->upload->display_errors();
            //$this->load->view('upload/insert_view',$data);
        }
    }
}
?>