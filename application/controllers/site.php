<?php

class site extends CI_Controller {
    function index()
    {
        $QuestionNr = 1;
        $choice_nr = array();
        $data = array(
            'QuestionNr' => $QuestionNr,
            'choice_nr' => $choice_nr
        );

        $this->load->view('home', $data);
    }

    function question_controller()
    {
        if(isset($_POST["prev"]))
        {
            $QuestionNr--;
        }
        if(isset($_POST["next"]))
        {
            $QuestionNr++;
        }
    }

}
