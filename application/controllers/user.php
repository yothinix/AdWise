<?php
class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
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
            redirect('/user/index?error');
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
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $check = $this->User_model->check_db($username,$email);

        if($check == NULL)
        {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('re_password', 'Re-type Password', 'trim|required|matches[password]');

            if($this->form_validation->run() == FALSE)
            {
                redirect('/user/index?wrong');
            }
            else
            {
                $this->User_model->signup();
                redirect('/user/index?complete');
            }
        }
        else
        {
            redirect('/user/index?wrong');
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

        $password = md5($this->input->post('password'));
        $check = $this->User_model->check_password($password);

        if($check == NULL)
        {
            redirect('/user/changepassword?error');
        }
        else
        {
            $this->form_validation->set_rules('password','password','trim|required|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('newpass', 'newpass', 'trim|required|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('confirm', 'confirm', 'trim|required|matches[newpass]');

            if($this->form_validation->run() == FALSE)
            {
                redirect('/user/changepassword?error');
            }
            else
            {
                $this->User_model->password($username);
                redirect('/user/changepassword?success');

            }
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

        $path = FCPATH . 'uploads';
        $config['upload_path'] = $path;
        //$config['upload_path'] = 'uploads/';
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
            $this->profile();
        }
        else
        {
            //$data['error'] = $this->upload->display_errors();
            //$this->load->view('upload/insert_view',$data);
        }
    }

    function reset_password()
    {
        $email = $this->input->post('email');
        $check = $this->User_model->check_email($email);

        if($check == NULL)
        {
            redirect('/user/index?failed');
        }
        else
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if ($this->form_validation->run() == FALSE)
            {
                redirect('/user/index?failed');
            }
            else
            {
                $this->load->helper('string');
                $password = random_string('alnum', 12);

                $data = array(
                    'password' => MD5($password)
                );

                $this->db->where('email', $email);
                $this->db->update('user', $data);

                //now we will send an email
                $this->load->library('email');
                $this->email->set_newline("\r\n");

                $this->email->from('adwiseiteproject13@gmail.com', 'AdWise');
                $this->email->to($email);
                $this->email->subject('Get your forgotten Password');
                $this->email->message("You have requested the new password, Here is you new password: ".$password);

                if($this->email->send())
                {
                    redirect('/user/index?success');
                }
                else
                {
                    redirect('/user/index?failed');
                }
            }
        }
    }
}
?>
