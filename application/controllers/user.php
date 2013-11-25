<?php
class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
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

        $result=$this->user_model->signin($username,$password);
        if($result)
        {
            $data = array('main_content' => 'assessment_list');
            $this->load->view('includes/template', $data);
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
            $this->user_model->signup();
            $data = array('main_content' => 'assessment_list');
            $this->load->view('includes/template', $data);
        }
    }

    function profile()
    {
        $username = $this->session->userdata('user_name');

        $profile = $this->user_model->profile($username);
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

    function dashboard()
    {
        $username = $this->session->userdata('user_name');

        $dashboard = $this->user_model->dashboard($username);
        $data = array(
            'main_content' => 'dashboard',
            'dashboard' => $dashboard
        );

        $assessment = $this->user_model->get_assessment();
        $data2 = array(
            'main_content' => 'assessment_list'
        );
        $this->load->view('includes/template', $data, $data2);
    }


}
?>
