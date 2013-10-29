<?php

class site extends CI_Controller {
    function index(){
        $data = array();

        if($query = $this->Site_model->get_question())
        {
           $data['quiz'] = $query;
        }
        if($query = $this->Site_model->get_choice())
        {
            $data['choice'] = $query;
        }
        $this->load->view('home', $data);
    }
}
