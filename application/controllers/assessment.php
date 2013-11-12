<?php

class Assessment extends CI_Controller {

    public $QuestionNr;

    function test($QuizNo)
    {
        $data = array(
            'QuestionNr' => $QuizNo,
            'main_content' => 'home'
        );
        $this->load->view('/includes/template', $data);
    }

    function index()
    {
        $this->asmlist();
    }

    function asmlist()
    {
        $data = array(
            'main_content' => 'assessment_list'
        );
        $this->load->view('/includes/template', $data);
    }
}
