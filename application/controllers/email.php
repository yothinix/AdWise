<?php

class Email extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login/signin');
        }
        else
        {
            $email= $this->input->post('email');
            $this->load->helper('string');
            //$rs = random_string('alnum', 12);

            $data = array(
                'rs' => $rs
            );
            $this->db->where('email', $email);
            $this->db->update('users', $data);

            //now we will send an email

            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
            $config['smtp_port'] = 465;
            $config['smtp_user'] = 'adwiseiteproject13@gmail.com';
            $config['smtp_pass'] = 'iteproject2013';

            $this->load->library('email', $config);

            $this->email->from('adwiseiteproject13@gmail.com', 'AdWise');
            $this->email->to($email);

            $this->email->subject('Get your forgotten Password');
            $this->email->message('Your password is'.$rs );

            $this->email->send();
            echo "Please check your email address.";
        }
    }

    public function email_check($str)
    {
        $query = $this->db->get_where('users', array('email' => $str), 1);

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