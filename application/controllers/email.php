<?php

class Email extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function send_email()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login/signup');
        }
        else
        {
            $email= $this->input->post('email');

            $this->load->helper('string');
            $password= random_string('alnum', 12);

            $data = array(
                'password' => $password
            );

            $this->db->where('email', $email);
            $this->db->update('user', $data);

            //now we will send an email
            $this->load->library('email');
            $this->email->set_newline("\r\n");

            $this->email->from('adwiseiteproject13@gmail.com', 'AdWise');
            $this->email->to($email);
            $this->email->subject('Get your forgotten Password');
            $this->email->message('Please go to this link to get your password.
            http://localhost/ci/get_password/index/'.$password);

            if($this->email->send())
            {
                echo 'Please check your email address.';
            }

            else
            {
                show_error($this->email->print_debugger());
            }
        }
    }

    public function email_check($str)
    {
        $query = $this->db->get_where('user', array('email' => $str), 1);

        if ($query->num_rows()== 1)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('email_check', 'This Email does not exist.');
            return false;

        }
    }
}
?>