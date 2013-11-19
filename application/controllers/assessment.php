<?php

class Assessment extends CI_Controller {

    public $QuestionNr;
    public $AssessID;

    function test($AssessID,$QuizNo)
    {
        $data = array(
            'QuestionNr' => $QuizNo,
            'AssessmentID' => $AssessID,
            'main_content' => 'home'
        );
        $this->load->view('/includes/template', $data);
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

    function asmlist()
    {
        $data = array(
            'main_content' => 'assessment_list'
        );
        $this->load->view('/includes/template', $data);
    }
}
