<?php

class Result extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Result_model');
    }

    function view($UserID)
    {
        //this function should get ResultID from user_test
        $ResultID_array = array();
        $counter = 1;
        $query = $this->Result_model->get_resultID($UserID);
        foreach($query as $items)
        {
            $ResultID_array[$counter][0] = $items->ResultID; 
            $data = $this->Result_model->get_result_data($items->ResultID);
            foreach($data as $desc)
            {
                $ResultID_array[$counter][1] = $desc->Name;
                $ResultID_array[$counter][2] = $desc->Detail;
            }
            $counter++;
        }

        $data = array(
            'main_content' => 'result_all',
            'ResultID' => $ResultID_array
        );
        $this->load->view('/includes/template', $data);
        
    }
}
