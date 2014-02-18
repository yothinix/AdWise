<?php

class Result extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Result_model');
    }

    function view($UserID)
    {
        $this->load->model('Result_model');
        //this function should get ResultID from user_test
        $ResultID_array = array();
        $counter = 1;
        $query = $this->Result_model->get_resultID($UserID);
        foreach($query as $items)
        {
            $ResultID_array[$counter]['ASM'] = $this->Result_model->get_assessment_name($items->AssessmentID);
            $ResultID_array[$counter]['rID'] = $items->ResultID; 
            $data = $this->Result_model->get_result_data($items->ResultID);
            foreach($data as $desc)
            {
                $ResultID_array[$counter]['rName'] = $desc->Name;
                $ResultID_array[$counter]['rDetail'] = $desc->Detail;
            }
            $counter++;
        }
        
        $result_id = 27; //31 = INTJ,27 = ISFJ
        $ocp_array = $this->data_prep($result_id);
        $ocp_set_row = $this->Result_model->count_result_ocp_row($result_id);

        $data = array(
            'main_content' => 'result_all',
            'ResultID' => $ResultID_array,
            'ocp_array' => $ocp_array,
            'ocp_set_row' => $ocp_set_row
        );
        $this->load->view('/includes/template', $data);
    }

    function data_prep($result_id)
    {
        $ocp_set = $this->Result_model->get_ocp_from_result($result_id);
        $ocp_set_row = $this->Result_model->count_result_ocp_row($result_id);
        $ocp_array = array();
        for($i = 0; $i < $ocp_set_row; $i++)
        {
            $ocp_array[$i][0] = $ocp_set[$i]['Occupation_id'];
            $ocp_array[$i][1] = $this->Result_model->get_ocp_name($ocp_set[$i]['Occupation_id']);
            $ocp_array[$i][2] = $this->Result_model->get_relate_tagid($ocp_set[$i]['Occupation_id']);
            $ocp_array[$i][3] = $this->Result_model->count_tag_ocp_row($ocp_set[$i]['Occupation_id']);

            // $ocp_array[x][0] => use to call Occupation_id
            // $ocp_array[x][1] => use to call Occupation Name
            // $ocp_array[x][2][y]['Tags_id'] => use to call Tags_id
            // $ocp_array[x][3] => refer to number of tags relate to occupation_id
            // x,y = key
        }

        return $ocp_array;
    }
}
