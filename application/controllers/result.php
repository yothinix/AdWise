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
        $seed_itemsets = array();
        $seed = array();
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
            $seed[$counter] = $this->data_prep($items->ResultID);
            $counter++;
        }
        
        for($i = 1; $i <= sizeof($seed); $i++)
            $seed_itemsets = array_merge($seed_itemsets, $seed[$i]);

        $output_from_extract = $this->extract_itemsets($seed_itemsets);

        $data = array(
            'main_content' => 'result_all',
            'ResultID' => $ResultID_array,
            'seed_itemsets' => $seed_itemsets,
            'output_from_extract' => $output_from_extract
        );
        $this->load->view('/includes/template', $data);
    }

    function data_prep($result_id)
    {
        $ocp_array = array();
        $seed_itemsets = array();
        $ocp_set = $this->Result_model->get_ocp_from_result($result_id);
        $ocp_set_row = $this->Result_model->count_result_ocp_row($result_id);
        for($i = 0; $i < $ocp_set_row; $i++)
        {
            $ocp_array[$i][0] = $ocp_set[$i]['Occupation_id'];
            $ocp_array[$i][1] = $this->Result_model->get_ocp_name($ocp_set[$i]['Occupation_id']);
            $ocp_array[$i][2] = $this->Result_model->get_relate_tagid($ocp_set[$i]['Occupation_id']);
            $ocp_array[$i][3] = $this->Result_model->count_tag_ocp_row($ocp_set[$i]['Occupation_id']);
        }
            // $ocp_array[x][0] => use to call Occupation_id
            // $ocp_array[x][1] => use to call Occupation Name
            // $ocp_array[x][2][y]['Tags_id'] => use to call Tags_id
            // $ocp_array[x][3] => refer to number of tags relate to occupation_id
            // x,y = key

        for($x = 0; $x < $ocp_set_row; $x++)
        {
            $seed_itemsets[$x][1] = $ocp_array[$x][0];
            for($y = 0; $y < $ocp_array[$x][3]; $y++)
            {
                $seed_itemsets[$x][2][$y] = $ocp_array[$x][2][$y]['Tags_id'];
            }
        }
        // $seed_itemsets[x][1] => use to call Occupation_id
        // $seed_itemsets[x][2][y] => use to call Tags_id
        // x,y = key
        return $seed_itemsets;
    }

    function extract_itemsets($_array)
    {
        $this->load->helper('array');
        //extract itemsets from transaction and create Lk table
        // $Lk[x][0] => stand for itemsets //now use itemsets instead of 0
        // $Lk[x][1] => stand for minimum_support //now use support instead of 1
        $Lk = array();
        //initial
        for($i = 0; $i < sizeof($_array[0][2]); $i++)
        {
            $Lk[$i]['itemset'] = $_array[0][2][$i];
            $Lk[$i]['support'] = 1;
        }
        
        //find support of itemsets a.k.a frequent itemsets
        for($x = 1; $x < sizeof($_array); $x++)            //every TID
        {
            for($y = 0; $y < sizeof($_array[$x][2]); $y++)  //every Tags items
            {
                for($z = 0; $z < sizeof($Lk); $z++)         //check with exist itemsets in Lk
                {
                    if($_array[$x][2][$y] == $Lk[$z]['itemset'])
                        $Lk[$z]['support']++;
                }
                array_push($Lk, array('itemset' => $_array[$x][2][$y], 'support' => 1));
            }
        }
        
        $Lk = array_reverse($Lk);
        foreach($Lk as $k => $v)
        {
            foreach($Lk as $key => $value)
            {
                if($k != $key && $v['itemset'] == $value['itemset'])
                {
                    unset($Lk[$k]);
                }
            }
        }

        return $Lk; 
    }

}
