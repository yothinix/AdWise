<?php
class Manage extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Manage_occupation');
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


    function manage_occupation_data()
    {
        $data = array(
            'main_content' => 'manage_occupation_data',
        );
        $this->load->view('manage occupation data', $data);

    }

    function delete_user($userID)
    {
        $this->db->delete('user', array('ID' => $userID));
        $this->manage_user();
    }

    function manage_result()
    {
        $data = array(
            'main_content' => 'manage_result',
        );
        $this->load->view('includes/template', $data);

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