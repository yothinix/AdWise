<?php

class site extends CI_Controller {
    function index(){
        $data = array();
        if($query = $this->Site_model->get_question())
        {
           $data['record'] = $query;
        }
        $this->load->view('home', $data);
    }
}
