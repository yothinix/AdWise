<?php

$result = array(); 
$combination = array();

class Result extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Result_model');
    }

    function view($UserID)
    {
        $this->load->model('Result_model');
        $ResultID_array = array();
        $seed_itemsets = array();
        $seed = array();
        $Large_array = array();
        $Candidate_array = array();
        $Result_array = array();
        $index = 3;
        $counter = 1;

        $query = $this->Result_model->get_resultID($UserID);
        foreach($query as $items)
        {
            $ResultID_array[$counter]['ASM'] = $this
                ->Result_model
                ->get_assessment_name($items->AssessmentID);
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
        unset($seed);
        $L1 = $this->extract_itemsets($seed_itemsets);
        //$C2 = $this->generate_candidate_pair($L1);
        $C2 = $this->gen_c2($L1);
        $L2 = $this->extract_n_itemsets($seed_itemsets, $C2);
        $L2 = $this->exclude_min_support($L2, 7, 2); //array | min_sup | L_index

        $Candidate_array[2] = $C2;
        $Large_array[2] = $L2;
        unset($L1);
        unset($C2);
        unset($L2);
        //after this do until found empty set use Lk-1
        do
        {
            $Candidate_array[$index] = $this->generate_Ck($Large_array[$index-1], $index);
            $Large_array[$index] = $this->extract_n_itemsets($seed_itemsets, $Candidate_array[$index]);
            $Large_array[$index] = $this->exclude_min_support($Large_array[$index], 7, $index);
            if($index > 4)
            {
                unset($Large_array[$index-2]);
                unset($Candidate_array[$index-2]);
            }
            $index++;
        }
        while(!(empty($Large_array[$index])));

        $Result_array = $Large_array[$index-1];

        $ocp_array = $this->get_assoc_ocp($seed_itemsets, $Result_array);
        $ocp_data = array();
        
        for($index = 0; $index < sizeof($ocp_array); $index++)
        {
            array_push($ocp_data, $this->get_ocp_detail($ocp_array[$index]));
        }
        $final_index = $index; 
        $data = array(
            'main_content' => 'result_all',
            'ResultID' => $ResultID_array,
            'Result_array' => $Result_array,
            'seed_itemsets' => $seed_itemsets,
            'ocp_array' => $ocp_array,
            'ocp_data' => $ocp_data,
            'index' => $final_index
        );
        $this->load->view('/includes/template', $data);
    }

    function get_assoc_ocp(array $seed_itemsets, array $Result_array)
    {
        $ocp_array = array();
        $flag = 0;
        for($r_index = 0; $r_index < sizeof($Result_array); $r_index++)
        {
            for($s_index = 0; $s_index < sizeof($seed_itemsets); $s_index++)
            {
                $flag = 0;
                for($item = 0; $item < sizeof($Result_array[$r_index]['itemset']); $item++)
                {
                    if($this->check_itemset($Result_array[$r_index]['itemset'][$item]
                        ,$seed_itemsets[$s_index][2]))
                    {
                        $flag++;
                    }

                    if($flag == sizeof($Result_array[$r_index]['itemset']))
                        array_push($ocp_array, $seed_itemsets[$s_index][1]);
                }
            }
        }

        $ocp_array = array_map("unserialize", array_unique(array_map("serialize", $ocp_array)));
        return array_reverse(array_reverse($ocp_array));
    }

    function get_ocp_detail($ocp_id)
    {
        return $this->Result_model->get_ocp_data($ocp_id);
    }

    function generate_Ck(array $Lk_array, $Lk_index) //case index >= 3
    {
        $Ck = array();
        $result_array = array();
        $index_Ck = 0;

        //extract item from $Lk[index]['itemset']
        for($index = 0; $index < sizeof($Lk_array); $index++)
        {
            for($item = 0; $item < sizeof($Lk_array[$index]['itemset']); $item++)
            {
                array_push($Ck, $Lk_array[$index]['itemset'][$item]);
            }
        }
        $Ck = array_map("unserialize", array_unique(array_map("serialize", $Ck)));
        $Ck = array_reverse(array_reverse($Ck));

        if(empty($Ck))
            return array();
        else
        {
            //pairing process
            $Ck = $this->combinations($Ck, $Lk_index);
            for($index = 0; $index < sizeof($Ck); $index++)
            {
                array_push($result_array, array('itemset' => $Ck[$index]));
            }

            return $result_array;
        }
    }

    //http://stackoverflow.com/questions/16310553/php-find-all-somewhat-unique-combinations-of-an-array
    function combinations(array $myArray, $choose) {
        global $result, $combination;
        $n = count($myArray);

        function inner ($start, $choose_, $arr, $n) {
            global $result, $combination;

            if ($choose_ == 0) array_push($result,$combination);
            else for ($i = $start; $i <= $n - $choose_; ++$i) {
                array_push($combination, $arr[$i]);
                inner($i + 1, $choose_ - 1, $arr, $n);
                array_pop($combination);
            }
        }
        inner(0, $choose, $myArray, $n);
        return $result;
    }

    function extract_n_itemsets(array $seed_itemsets, array $candidate_set)
    {
        $Lk = array();
        for($i = 0; $i < sizeof($candidate_set); $i++)
        {
            $Lk[$i]['itemset'] = $candidate_set[$i]['itemset'];
            $Lk[$i]['support'] = 0;
        }
        $flag = 0;
        $logic_check = array();
        //find support of itemsets a.k.a frequent itemsets
        for($x = 0; $x < sizeof($Lk) ; $x++) //itemset in candidate 
        {
            for($y = 0; $y < sizeof($seed_itemsets); $y++) //itemset in seed_element
            {
                $flag = 0;
                for($z = 0; $z < sizeof($Lk[$x]['itemset']); $z++) //item in itemset
                {
                    if($this->check_itemset($Lk[$x]['itemset'][$z], $seed_itemsets[$y][2]))
                    {
                        $flag++;
                    }

                    if($flag == sizeof($Lk[$x]['itemset']))
                    {
                        $Lk[$x]['support']++;
                    }
                }
            }
        }
        return $Lk; 
    }

    function check_itemset($a, array $b)
    {
        return in_array($a, $b); 
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
            $ocp_array[$i][1] = $this
                ->Result_model
                ->get_ocp_name($ocp_set[$i]['Occupation_id']);
            $ocp_array[$i][2] = $this
                ->Result_model
                ->get_relate_tagid($ocp_set[$i]['Occupation_id']);
            $ocp_array[$i][3] = $this
                ->Result_model
                ->count_tag_ocp_row($ocp_set[$i]['Occupation_id']);
        }
        
        for($x = 0; $x < $ocp_set_row; $x++)
        {
            $seed_itemsets[$x][1] = $ocp_array[$x][0];
            for($y = 0; $y < $ocp_array[$x][3]; $y++)
            {
                $seed_itemsets[$x][2][$y] = $ocp_array[$x][2][$y]['Tags_id'];
            }
        }
        unset($ocp_array);
        // $seed_itemsets[x][1] => use to call Occupation_id
        // $seed_itemsets[x][2][y] => use to call Tags_id
        // x,y = key
        return $seed_itemsets;
    }

    function extract_itemsets($_array)
    {
        //extract itemsets from transaction and create Lk table
        $Lk = array();
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
        
        //remove duplicate itemsets
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
        $Lk = array_reverse($Lk);

        return $Lk; 
    }

    function exclude_min_support(array $Lk, $min_sup, $L_index) //use to remove itemset below min_sup
    {
        if($L_index == 1)
        {
            //remove itemsets that have support < min_sup
            foreach($Lk as $key => $value)
            {
                if($value['support'] < $min_sup)
                {
                    unset($Lk[$key]);
                }
            }
            $Lk = array_reverse(array_reverse($Lk)); //use to shift empty key off
            return $Lk;
        }
        
        else
        {
            for($index = 0; $index <= sizeof($Lk); $index++) 
            {
                if($Lk[$index]['support'] < $min_sup)
                    unset($Lk[$index]);
            }
            $Lk = array_reverse(array_reverse($Lk));

            return $Lk;
        }
    }

    function gen_c2($Lk)
    {
        $Lk = $this->exclude_min_support($Lk,7,1);
        $new_Lk = array();
        foreach($Lk as $k => $v)
        {
            foreach($Lk as $key => $value)
            {
                if(!($k != $key && $v['itemset'] == $value['itemset']))
                {
                    array_push($new_Lk, array($v['itemset'],$value['itemset']));
                }
            }
        }
        unset($Lk);
        foreach($new_Lk as $index => $itemset) //unset same item case
        {
            if($itemset[0] === $itemset[1])
                unset($new_Lk[$index]);
        }
        $new_Lk = array_reverse(array_reverse($new_Lk));
        
        $export_array = array();
        foreach($new_Lk as $itemsets)
        {
            array_push($export_array, array('itemset' => $itemsets));
        }
        unset($new_Lk);

        return $export_array;
    }

    function generate_candidate_pair($Lk)
    {
        $Lk = $this->exclude_min_support($Lk, 2, 1);

        $new_Lk = array();
        foreach($Lk as $k => $v)
        {
            foreach($Lk as $key => $value)
            {
                if(!($k != $key && $v['itemset'] == $value['itemset']))
                {
                    array_push($new_Lk, array($v['itemset'],$value['itemset']));
                }
            }
        }
        unset($Lk);
        foreach($new_Lk as $index => $itemset) //unset same item case
        {
            if($itemset[0] === $itemset[1])
                unset($new_Lk[$index]);
        }
        $new_Lk = array_reverse(array_reverse($new_Lk));
        
        //de_duplicate items in new_Lk[x]['itemset'];
        $new_array = array($new_Lk[0]);
        $limit = sizeof($new_Lk);
        for($i = 0; $i < $limit; $i++)
        {
            for($j = $i++; $j < $limit; $j++)
            {
                if(sort($new_Lk[$i]) == sort($new_Lk[$j])) //problem is on this line
                {
                    array_push($new_array, $new_Lk[$i]);
                }
            }
        }
        $new_Lk = array_map("unserialize", array_unique(array_map("serialize", $new_array)));
        unset($new_array);
        $new_Lk = array_reverse(array_reverse($new_Lk));
        
        $export_array = array();
        foreach($new_Lk as $itemsets)
        {
            array_push($export_array, array('itemset' => $itemsets));
        }
        unset($new_Lk);

        return $export_array;
    }
}
