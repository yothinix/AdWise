<?php 

class Manage extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Assessment_model');
        $this->load->model('Manage_assessment_type');
        $this->load->model('Manage_academic');
        $this->load->model('Manage_answer_group');
        $this->load->model('Manage_occupation');
        $this->load->model('Manage_result_data');
        $this->load->model('Manage_tags');
        $this->load->model('Analytics_model');
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
            $this->manage_user();
        }
    }

//////////////// Manage User Controller Function Group/////////////////////////

    function manage_user()
    {
        $user = $this->User_model->manage_user();
        $data = array(
            'main_content' => 'manage_user',
            'manage_user' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function delete_user($userID)
    {
        $this->db->delete('user', array('ID' => $userID));
        $this->manage_user();
    }

    function update_user($ID)
    {
        $data = array(
            'name'=>$this->input->post('name'),
            'lastname'=>$this->input->post('lastname'),
            'gender'=>$this->input->post('gender'),
            'birthday'=>$this->input->post('birthday'),
            'phone'=>$this->input->post('phone'),
            'email'=>$this->input->post('email')
        );
        $this->User_model->up_user($ID ,$data);
        $this->manage_user();
    }

    function upload_photo()
    {
        $username = $this->session->userdata('user_name');

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['file_name'] = date("YmdHis");

        $this->load->library('upload');
        $this->upload->initialize($config);
    }

/////////// Manage Academic Controller Function Group ////////////////

    function manage_academic()
    {
        $user = $this->Manage_academic->academic();
        $data = array(
            'main_content' => 'manage_academic',
            'manage_academic' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function create_academic()
    {
        $Academic_id = $this->Manage_academic->academic_db(); //ได้ academic id
        $this->manage_academic();
    }

    function del_academic($Academic_id)
    {
        $this->db->delete('academic',array('Academic_id' => $Academic_id));
        $this->db->delete('occupation_academic',array('Academic_id' => $Academic_id));
        $this->manage_academic();
    }

    function update_academic($Academic_id)
    {
        $this->Manage_academic->update_academic($Academic_id);
        $this->Manage_academic->delete_aca($Academic_id); // ลบ clear all tags ก่อนจะทำการจับคู่ใหม่
        $this->manage_academic();
    }

/////////// Manage Assessment Controller Function Group/////////////////////////

    function manage_assessment()
    {
        $get_assessment = $this->Assessment_model->get_assessment();
        $data = array(
            'main_content' => 'manage_assessment',
            'get_assessment' => $get_assessment
        );
        $this->load->view('includes/template', $data);
    }

    function set_asm_status($AID)
    {
        $this->Assessment_model->set_status($AID);
        $this->manage_assessment();
    }

    function unset_asm_status($AID)
    {
        $this->Assessment_model->unset_status($AID);
        $this->manage_assessment();
    }

/////////// Manage Assessment Type Controller Function Group////////////////////

    function manage_assessment_type()
    {
        $get_assessment_type = $this->Manage_assessment_type->get_assessment_type();
        $data = array(
            'main_content' => 'manage_assessment_type',
            'get_assessment_type' => $get_assessment_type
        );
        $this->load->view('includes/template', $data);
    }

    function create_asm_type()
    {
        $this->Manage_assessment_type->insert_asm_type();
        $this->manage_assessment_type();
    }

    function update_asm_type($Asm_type_ID)
    {
        $this->Manage_assessment_type->update_asm_type($Asm_type_ID);
        $this->manage_assessment_type();
    }

    function delete_asm_type($AssessmentTypeID)
    {
        $this->load->model('Manage_assessment_type');
        $this->Manage_assessment_type->delete($AssessmentTypeID);
        $this->manage_assessment_type();
    }

/////////// Manage Answer Group Controller Function Group///////////////////

    function manage_answer_group()
    {
        $get_answer_group = $this->Manage_answer_group->get_answer_group();
        $data = array(
            'main_content' => 'manage_answer_group',
            'get_answer_group' => $get_answer_group
        );
        $this->load->view('includes/template', $data);
    }

    function create_answer_group()
    {
        $this->Manage_answer_group->insert_answer_group();
        $this->manage_answer_group();
    }

    function edit_answer_group($AnswerGroupID)
    {
        $this->Manage_answer_group->update_answer_group($AnswerGroupID);
        $this->manage_answer_group();
    }

    function delete_answer_group($AnswerGroupID)
    {
        $this->load->model('Manage_assessment_type');
        $this->Manage_answer_group->delete($AnswerGroupID);
        $this->manage_answer_group();
    }

/////////// Manage Result Controller Function Group/////////////////////////

    function manage_result()
    {
        $user = $this->Manage_result_data->get_manage_result();
        $data = array(
            'main_content' => 'manage_result',
            'manage_result' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function create_result()
    {
        $this->load->model('Manage_result_data');

        $ResultID = $this->Manage_result_data->result_db();
        $Occupation = $this->input->post('Occupation');
        $TotalOcp = substr_count($Occupation,',')+1;
        $Tags_Key = explode(",", $Occupation);
        $counter = 0;
        while($counter < $TotalOcp)
        {
            $Occupation_id = $this->Manage_result_data->ocp_db($Tags_Key[$counter]); //ได้ tag id
            $this->Manage_result_data->result_ocp($ResultID,$Occupation_id);
            $counter++;
        }
        $this->manage_result();
    }

    function update_result($ResultID)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'Detail'=>$this->input->post('detail')
        );
        $this->Manage_result_data->update_result($ResultID ,$data);
        $this->manage_result();
    }

    function delete_result($ResultID)
    {
        $this->db->delete('result', array('ResultID' => $ResultID));
        $this->manage_result();
    }

/////////// Manage Occupation Controller Function Group/////////////////////////

    function manage_occupation_data()
    {
        $data = array(
            'main_content' => 'manage_occupation_data',
        );
        $this->load->view('manage occupation data', $data);
    }

    function manage_occupation()
    {
        $this->load->model('Manage_occupation');
        $user = $this->Manage_occupation->get_manage_occupation();
        $data = array(
            'main_content' => 'manage_occupation',
            'manage_occupation' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function delete_occupation($Occupation_id)
    {
        $this->db->delete('occupation', array('Occupation_id' => $Occupation_id));
        $this->manage_occupation();
    }

    function create_occupation()
    {
        $this->load->model('Manage_occupation');
        $Occupation_id = $this->Manage_occupation->ocp_db();

        $Tags = $this->input->post('Tags');
        $TotalTags = substr_count($Tags,',')+1;
        $Tags_Key = explode(",", $Tags);
        $counter = 0;
        while($counter < $TotalTags)
        {
            $Tags_id = $this->Manage_occupation->tags_db($Tags_Key[$counter]);
            $this->Manage_occupation->tags_ocp($Occupation_id,$Tags_id);
            $counter++;
        }

        $Academic = $this->input->post('Academic');
        $TotalAcademic = substr_count($Academic,',')+1;
        $Academic_Key = explode(",", $Academic);
        $counter = 0;
        while($counter < $TotalAcademic)
        {
            $Academic_id = $this->Manage_occupation->aca_db($Academic_Key[$counter]);
            $this->Manage_occupation->ocp_aca($Occupation_id,$Academic_id);
            $counter++;
        }

        $this->manage_occupation();
    }

    function update_occupation($occupation_id)
    {
        $data = array(
            'Name'=>$this->input->post('name'),
            'Detail'=>$this->input->post('detail'),
            'Tag'=>($this->input->post('tag'))
        );
        $this->Manage_occupation->update($occupation_id ,$data);
        $this->manage_occupation();
    }

////////////// Manage Tags Controller Function Group //////////////

    function manage_tags()
    {
        $user = $this->Manage_tags->tags();
        $data = array(
            'main_content' => 'manage_tags',
            'manage_tags' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function del_tags($Tags_id)
    {
        $this->db->delete('tags',array('Tags_id' => $Tags_id));
        $this->manage_tags();
    }

    function create_tags()
    {
        $data = array(
            'tags_name'=>$this->input->post('tags_name')
        );
        $this->Manage_tags->create_tags($data);
        $this->manage_tags();
    }

    function update_tags($Tags_id)
    {
        $data = array(
            'tags_name'=>$this->input->post('tags_name')
        );
        $this->Manage_tags->update($Tags_id,$data);

        $this->manage_tags();
    }

    function taginput()
    {
        $this->load->view('taginput.html');
    }

    ////////////// Analytics Function //////////////

    function analytics()
    {
        $this->load->model('Analytics_model');

        $user_test_data = $this->Analytics_model->get_user_test_data(1); 
        //AssessmentID input method will change later
        $sex = 0;

        $assessment = $this->Analytics_model->assessment();

        $data = array(
            'main_content' => 'Analytics/analytics',
            'user_test_data' => $user_test_data,
            'assessment' => $assessment,
            'result_male' => 0,
            'result_female' => 0

        );
        $this->load->view('includes/template', $data);
    }
        
    function manage_parameter($set_param)
    {
        $this->load->model('assessment_model');
        if($set_param == 1)
        {
            $this->Assessment_model->set_parameter();
                
        }

        $minimum_support = $this->Assessment_model->get_parameter();
        $data = array(
            'main_content' => 'manage_parameter',
            'min_sup'      => $minimum_support,
        );
        $this->load->view('includes/template', $data);

    }

    function graph()
    {
        $this->load->model('Analytics_model');
        $AssessmentID = $this->input->post('asmID');
        $graph_id = $this->input->post('graphID');
        $graph_data = $this->input->post('graph_data');
        $data = array();

        if($graph_id == 1 && $graph_data == 1) //case pie chart with male and female data graph_id 1 = pie, graph_data 1 = gender
        {
            $male_array = array();
            $female_array = array();
            $male = $this->Analytics_model->get_pie_gender_male($AssessmentID);
            $female = $this->Analytics_model->get_pie_gender_female($AssessmentID);

            for($index = 0; $index < sizeof($male); $index++)
            {
                array_push($male_array, array($male[$index]['Name'],(int) $male[$index]['Value']));
            }

            for($index = 0; $index < sizeof($female); $index++)
            {
                array_push($female_array, array($female[$index]['Name'],(int) $female[$index]['Value']));
            }
                    $data = array(
                        'main_content' => 'Analytics/pie_gender',
                        'male' => $male_array,
                        'female' => $female_array

             );

        }else if ($graph_id == 1 && $graph_data == 2) //case pie chart  data graph_id 1 = pie, graph_data 2 = age
                {
                    $age = $this->Analytics_model->get_pie_age($AssessmentID);
                    $data = array(
                        'main_content' => 'Analytics/pie_age',
                        'age' => $age

                    );

        }else if ($graph_id == 1 && $graph_data == 3) //case pie chart  data graph_id 1 = pie, graph_data 3 = total
                {
                    $total = $this->Analytics_model->get_pie_total($AssessmentID);

                    $data = array(
                        'main_content' => 'Analytics/pie_total',
                        'total' => $total

                    );
                }
        if($graph_id == 2 && $graph_data == 1) //case line chart with male and female data graph_id 2 = pie, graph_data 1 = gender
        {
            $male_array = array();
            $female_array = array();
            $male = $this->Analytics_model->get_pie_gender_male($AssessmentID);
            $female = $this->Analytics_model->get_pie_gender_female($AssessmentID);

            for($index = 0; $index < sizeof($male); $index++)
            {
                array_push($male_array, array($male[$index]['Name'],(int) $male[$index]['Value']));
            }

            for($index = 0; $index < sizeof($female); $index++)
            {
                array_push($female_array, array($female[$index]['Name'],(int) $female[$index]['Value']));
            }
            $data = array(
                'main_content' => 'Analytics/line_gender',
                'male' => $male_array,
                'female' => $female_array

            );

        }else if ($graph_id == 2 && $graph_data == 2) //case line chart with male and female data graph_id 2 = pie, graph_data 2 = age
                {
                    $age = $this->Analytics_model->get_pie_age($AssessmentID);
                    $data = array(
                        'main_content' => 'Analytics/line_age',
                        'age' => $age
                    );

        }else if ($graph_id == 2 && $graph_data == 3) //case line chart with male and female data graph_id 1 = pie, graph_data 3 = total
                {
                    $total = $this->Analytics_model->get_line_total($AssessmentID);
                    $data = array(
                        'main_content' => 'Analytics/line_total',
                        'total' => $total
                    );
                }


        if($graph_id == 3 && $graph_data == 1) //case column chart with male and female data graph_id 2 = pie, graph_data 1 = gender
        {
            $male = $this->Analytics_model->get_column_gender_male($AssessmentID);
            $female = $this->Analytics_model->get_column_gender_female($AssessmentID);

                    $data = array(
                        'main_content'   => 'Analytics/column_gender',
                        'male' => $male,
                        'female' => $female
            );

        }else if ($graph_id == 3 && $graph_data == 2) //case column chart with male and female data graph_id 2 = pie, graph_data 2 = age
        {
                    $age = $this->Analytics_model->get_pie_age($AssessmentID);
                    $data = array(
                        'main_content' => 'Analytics/column_age',
                        'age' => $age
                    );

        }else if ($graph_id == 3 && $graph_data == 3) //case column chart with male and female data graph_id 1 = pie, graph_data 3 = total
        {
                    $total = $this->Analytics_model->get_line_total($AssessmentID);
                    $data = array(
                        'main_content' => 'Analytics/column_total',
                        'total' => $total
                    );
        }

            $this->load->view('includes/template', $data);
        }
}
?>
