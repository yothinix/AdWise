<?php
class Manage extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
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
    /*public function del($id)
    {
        $this->db->delete("login",array('id'=>$id));
        redirect("member","refresh");
        exit();
    }
    public function edit($id)
    {
        if($this->input->post("btsave")!=null)
        {

            $ar=array(

                'ID'=>$this->input->post("ID"),
                'Name'=>$this->input->post("Name"),
                'Lastname'=>$this->input->post("Lastname")
            );

            $this->db->where('id',$id);
            $this->db->update("login",$ar);
            redirect("member","refresh");
            exit();
        }
        <div class="modal hide fade">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Modal header</h3>
        </div>
        <div class="modal-body">
        <p>One fine body…</p>
        </div>
        <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
        </div>
        </div> */

}
?>