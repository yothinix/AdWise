<?php

class site extends CI_Controller {

    public $QuestionNr;

    function assessment($QuizNo)
    {
        $data = array(
            'QuestionNr' => $QuizNo,
            'main_content' => 'home'
        );
        $this->load->view('/includes/template', $data);
    }

    function index()
    {
        $this->assessment(1);
    }

    function quiz_nav($ctrl)
    {
        if($ctrl == 1)
        {
            global $QuestionNr;
            $QuestionNr = $QuestionNr-1;
            $data = array(
                'QuestionNr' => $$QuestionNr,
                'main_content' => 'home'
            );
            $this->load->view('home', $data);
        }
        elseif($ctrl == 2)
        {
            global $QuestionNr;
            $QuestionNr = $QuestionNr+1;
            $data = array(
                'QuestionNr' => $QuestionNr,
                'main_content' => 'home'
            );

            $this->load->view('home', $data);
        }
    }


    /*function submit()
    {
        $next = $this->input->post('next');
        $data['main_content'] = "home";
        $data['QuestionNr'] = 2;

        if($this->input->post('ajax'))
        {
            $this->load->view($data['main_content']);
        }
        else
        {
            $this->load->view('includes/template', $data);
        }
    }*/
}
