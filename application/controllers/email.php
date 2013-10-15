<?php

class Email extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $this->email->from('alexsilizer@gmail.com', 'Yothin Muangsommuk');
        $this->email->to('alexsilizer@gmail.com');
        $this->email->subject('This is an email Test');
        $this->email->message('It is working. Great!');

        $path = $this->config->item('server_root');
        $file = $path . 'adwise/attachments/yourinfo.txt';
        $this->email->attach($file);

        if($this->email->send())
        {
            echo 'Your email was send, fool.';
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }
}

