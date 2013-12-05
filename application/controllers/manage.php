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

    function manage_academic()
    {
        $user = $this->Manage_academic->academic();
        $data = array(
            'main_content' => 'manage_academic',
            'manage_academic' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function del_academic($Academic_id)
    {
        $this->db->delete('academic',array('Academic_id' => $Academic_id));
        $this->manage_academic();
    }

    function create_academic()
    {
        $data = array(
            'name'=>$this->input->post('name'),
            'detail'=>$this->input->post('detail'),
            'tag'=>($this->input->post('tag'))
        );
        $this->Manage_academic->create_academic($data);
        $this->manage_academic();
    }

    function update($academic_id)
    {
        $data = array(
            'name'=>$this->input->post('name'),
            'detail'=>$this->input->post('detail'),
            'tag'=>($this->input->post('tag'))
        );
        $this->Manage_academic->update($academic_id ,$data);
        $this->manage_academic();
    }

    function manage_assessment()
    {
        $get_assessment = $this->Assessment_model->get_assessment();
        $data = array(
            'main_content' => 'manage_assessment',
            'get_assessment' => $get_assessment
        );
        $this->load->view('includes/template', $data);
    }

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

        //then load manage assessment page again
        $this->manage_assessment_type();
    }

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

        //then load manage assessment page again
        $this->manage_answer_group();
    }

    /*Manage_result function*/

    function  manage_result()
    {
        $this->load->model('Manage_result_data');
        $user = $this->Manage_result_data->get_manage_result();
        $data = array(
            'main_content' => 'manage_result',
            'manage_result' => $user
        );
        $this->load->view('includes/template', $data);
    }

    function create_result()
    {
        $data = array(
            'name'=>$this->input->post('name'),
            'detail'=>$this->input->post('detail')

        );
        $this->Manage_result_data->create_result($data);
        $this->manage_result();
    }

    function update_result($ResultID)
    {
        $data = array(
            'Name'=>$this->input->post('name'),
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

    /*Manage_Occupation function*/

    function manage_occupation_data()
    {
        $data = array(
            'main_content' => 'manage_occupation_data',
        );
        $this->load->view('manage occupation data', $data);
    }

    function  manage_occupation()
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
        $data = array(
            'name'=>$this->input->post('name'),
            'detail'=>$this->input->post('detail'),
            'tag'=>($this->input->post('tag')),
            //'academic_id'=>($this->input->post('academic'))//
        );
        $this->Manage_occupation->create_occupation($data);
        $this->manage_occupation();
    }

    function update($occupation_id)
    {
        $data = array(
            'name'=>$this->input->post('name'),
            'detail'=>$this->input->post('detail'),
            'tag'=>($this->input->post('tag'))
            //'academic_id'=>($this->input->post('academic'))//
        );
        $this->Manage_occupation->update($occupation_id ,$data);
        $this->manage_occupation();
    }


}
?>