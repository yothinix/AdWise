<?php
class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if(($this->session->userdata('username')!=""))
        {
            //$this->welcome();
        }
        else{
            $data['title']= 'AdWise | When Student found their ways';
            $this->load->view('login/header',$data);
            $this->load->view('login/signup',$data);
            $this->load->view('login/footer',$data);
        }
    }

    function signin()
    {
        $username=$this->input->post('username');
        $password=md5($this->input->post('password'));

        $result=$this->User_model->signin($username,$password);
        if($result)
        {
            $this->dashboard();
        }
        else
        {
            $this->form_validation->set_message('$username','ไม่มี user');
        }
    }

    function signout()
    {
        $newdata = array(
            'user_id'    => '',
            'user_name'  => '',
            'user_email' => '',
            'logged_in'  => FALSE,
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->index();
    }

    function signup()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|xss_clean');
        $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
        $this->form_validation->set_rules('re-type_password', 'Re-type Password', 'trim|required|matches[password]');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('login/Failed');
        }
        else
        {
            $this->User_model->signup();
            $data = array('main_content' => 'assessment_list');
            $this->load->view('includes/template', $data);
        }
    }

    function profile()
    {
        $username = $this->session->userdata('user_name');

        $profile = $this->User_model->profile($username);
        $data = array(
            'main_content' => 'login/profile',
            'profile' => $profile
        );
        $this->load->view('includes/template', $data);
    }

    function update()
    {
        $username = $this->session->userdata('user_name');

        $this->load->model('User_model');
        /*$data=array(
            'name'=>$this->input->post('name'),
            'lastname'=>$this->input->post('lastname'),
            'phone'=>$this->input->post('phone'),
            'email'=>($this->input->post('email'))
        );
        $this->db->update('user',$data,array('username' => 'pattie1211'));*/

        $data = array(
            'name'=>$this->input->post('name'),
            'lastname'=>$this->input->post('lastname'),
            'gender'=>$this->input->post('gender'),
            'birthday'=>$this->input->post('birthday'),
            'phone'=>$this->input->post('phone'),
            'email'=>($this->input->post('email'))
        );

        $this->User_model->update("$username", $data);
        $this->profile();
    }

    function changepassword()
    {
        $username = $this->session->userdata('user_name');

        $data = array(
            'main_content' => 'login/changepassword',
        );
        $this->load->view('includes/template', $data);
    }

    function password()
    {
        $username = $this->session->userdata('user_name');

        $this->load->model('User_model');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('password','password','trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('newpass', 'newpass', 'trim|required|min_length[8]|max_length[32]');
        $this->form_validation->set_rules('confirm', 'confirm', 'trim|required|matches[newpass]');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Failed');
        }
        else
        {
            $this->User_model->password($username);
            $this->profile();
        }
    }

    function dashboard()
    {
        $username = $this->session->userdata('user_name');
        $dashboard = $this->User_model->dashboard($username);
        $data = array(
            'main_content' => 'dashboard',
            'dashboard' => $dashboard
        );

        $assessment = $this->User_model->get_assessment();
        $data2 = array(
            'main_content' => 'assessment_list'
        );
        $this->load->view('includes/template', $data, $data2);
    }

    function upload()
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
            $this->user_model->upload($filepath['file_name']); //อัดไฟล์พาร์ธเข้ามาในนี้
            $this->profile();
        }
        else
        {
            //$data['error'] = $this->upload->display_errors();
            //$this->load->view('upload/insert_view',$data);
        }
    }

}
?>
