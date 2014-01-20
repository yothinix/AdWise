<?php

class Assessment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Assessment_model');
        $this->load->model('Manage_assessment_type');
        $this->load->model('Manage_answer_group');
        $this->load->library('session');
    }

    public $QuestionNr;
    public $AssessID;

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
            $this->asmlist();
        }
    }

    function asmlist()
    {
        $data = array(
            'main_content' => 'assessment_list'
        );
        $this->load->view('/includes/template', $data);
    }

    function test_all($AssessID,$QuizNo)
    {
        $asm_info = $this->Assessment_model->get_asm_info($AssessID);
        $quiz = $this->Assessment_model->get_question($AssessID,$QuizNo);
        $choice = $this->Assessment_model->get_choice($AssessID,$QuizNo);
        $TotalQuestion = $this->Assessment_model->get_total_question($AssessID);

        $data = array(
            'QuestionNr' => $QuizNo,
            'AssessmentID' => $AssessID,
            'asm_info' => $asm_info,
            'quiz' => $quiz,
            'choice' => $choice,
            'TotalQuestion' => $TotalQuestion,
            'baseTestUrl' => "index.php/assessment/test",
            'main_content' => 'home'
        );
        $this->load->view('/includes/template', $data);
    }

    function test($AID, $QNR)
    {
        if($this->session->userdata('SelectChoice') == false)
        {
            $this->test_all($AID,$QNR);
        }
        
        else
        {
            $this->Assessment_model->testdata();
            $this->test_all($AID,$QNR);
        }
    }

    function result()
    {
        //do ResultExpression กระทำกับ Session Data (AssessmentID, QID, ChoiceID, AnswerGroup, ResultID)
        $data = array(
            'UserID' => $this->session->userdata('user_id'),
            'AsmID' => $this->session->userdata('assessmentID'),
            'main_content' => 'finish'
        );
        $this->load->view('/includes/template', $data);
    }

/*//////////Manage_Assessment / Create_Assessment controller function ///////////*/

    function create_asm_view($page)
    {
        $this->load->model('Manage_assessment');
        $this->load->model('Manage_assessment_type');
        $data = array(
            'main_content' => "createAsm/{$page}"
        );
        $this->load->view('/includes/template', $data);
    }

    function init_create_asm()
    {
        $this->load->model('Manage_assessment');
        $this->Manage_assessment->insert_asm_info();
        $this->create_asm_view("question_and_answer");
    }

    function add_question_and_answer()
    {
        $this->load->model('Manage_assessment');
        $QNR = $this->Manage_assessment->add_question();
        $this->session->set_userdata('QNR', $QNR);
        $asm_type = $this->session->userdata('asm_type'); 
        $TotalChoice = $this->Manage_assessment_type->get_total_choice($asm_type);
        $counter = 0; 
        $CID = array();
        while($counter < $TotalChoice)
        {
            //need to call A_detail, A_group from array identifier
            $Answer_detail = $this->input->post("data_choice_{$counter}_detail");
            $Answer_group = $this->input->post("data_choice_{$counter}_awg");
            $CID[$counter] = $this->Manage_assessment->add_answer($Answer_detail, $Answer_group, $QNR);
            $counter++;
        }
        $this->session->set_userdata('CID', $CID);
        $this->create_asm_view("review_qa");
    }

    function get_qa_data($AssessmentID, $QuestionNr)
    {
        $this->load->model('Manage_assessment');
        $this->load->model('Manage_assessment_type');
        //send the question data through session_id
        $Q_data = $this->Manage_assessment->get_question_data($AssessmentID, $QuestionNr);
        $this->session->set_userdata('QID', $Q_data['QID']);
        $this->session->set_userdata('QuestionNr', $Q_data['QuestionNr']);
        $this->session->set_userdata('Q_Detail', $Q_data['Q_Detail']);
        $A_data = $this->Manage_assessment->get_choice_data($AssessmentID, $QuestionNr);
        $counter = 0;
        foreach($A_data as $row)
        {
            $this->session->set_userdata("ChoiceID_{$counter}", $row->ChoiceID);
            $this->session->set_userdata("C_Detail_{$counter}", $row->Detail);
            $this->session->set_userdata("AnswerGroupID_{$counter}", $row->AnswerGroupID);
            $counter++;
        }
        $this->session->set_userdata('form_flag', 1);
        $this->create_asm_view("question_and_answer");
    }

    function update_qa()
    {
        $this->load->model('Manage_assessment_type');
        $this->load->model('Manage_assessment');
        
        //everything that relate to update database going below this line
        
        $QNR = $this->Manage_assessment->update_question();
        $this->session->set_userdata('QNR', $QNR);
        $asm_type = $this->session->userdata('asm_type'); 
        $TotalChoice = $this->Manage_assessment_type->get_total_choice($asm_type);
        $counter = 0; 
        $CID = array();
        while($counter < $TotalChoice)
        {
            $ChoiceID = $this->session->userdata("ChoiceID_{$counter}");
            $Answer_detail = $this->input->post("data_choice_{$counter}_detail");
            $Answer_group = $this->input->post("data_choice_{$counter}_awg");
            $CID[$counter] = $this->Manage_assessment->update_answer($Answer_detail, $Answer_group, $QNR, $ChoiceID);
            $counter++;
        }
        $this->session->set_userdata('CID', $CID);

        //unset all session relate to update_qa
        $this->session->unset_userdata('QID');
        $this->session->unset_userdata('QuestionNr');
        $this->session->unset_userdata('Q_Detail');
        $AsmTypeID = $this->session->userdata('asm_type');
        $total_choice = $this->Manage_assessment_type->get_total_choice($AsmTypeID);
        $counter = 0;
        while($counter <= $total_choice)
        {
            $this->session->unset_userdata("ChoiceID_{$counter}");
            $this->session->unset_userdata("C_Detail_{$counter}");
            $this->session->unset_userdata("AnswerGroupID_{$counter}");
            $counter++;
        }
        $this->session->unset_userdata('form_flag');
        $this->create_asm_view("review_qa");
    }

    function delete_asm($AssessmentID)
    {
        $this->load->model('Manage_assessment');
        $this->Manage_assessment->delete_asm($AssessmentID);

        //then load manage assessment page again
        $get_assessment = $this->Assessment_model->get_assessment();
        $data = array(
            'main_content' => 'manage_assessment',
            'get_assessment' => $get_assessment
        );
        $this->load->view('includes/template', $data);
    }

    function clear_create_asm_session()
    {
        $array_items = array(
            'asm_name' => '',
            'asm_desc' => '',
            'asm_type' => '',
            'total_question' => ''
        );
        $this->session->unset_userdata($array_items);
        $this->create_asm_view("asm_info");
    }

    function edit($AID)
    {
        $asm_info = $this->Assessment_model->get_asm_info($AID);
        foreach($asm_info as $row)
        {
            $asm_name = $row->Name;
            $asm_desc = $row->Description;
            $asm_type = $row->AssessmentTypeID;
            $total_q  = $row->TotalQuestion;
            $this->session->set_userdata('asm_name', $asm_name);
            $this->session->set_userdata('asm_desc', $asm_desc);
            $this->session->set_userdata('asm_type', $asm_type);
            $this->session->set_userdata('total_question', $total_q);
            $this->session->set_userdata('AssessmentID', $AID);
        }
        $this->create_asm_view("asm_info");
    }

    function add_resultexp()
    {
        //Need to store in to place
        //1) result_expression->Expression then get ResultExpID from latest insert and send to (2)
        //2) assessment->ResultExpressionID according to AssessmentID
        $this->load->model('ResultExp_model');
        $this->load->model('Manage_assessment');
        $AssessmentID = $this->session->userdata('AssessmentID');

        $result_exp = $this->input->post('result_exp');
        $ResultExpID = $this->ResultExp_model->add_resultexp($result_exp);
        $this->Manage_assessment->add_ResultExpID($AssessmentID, $ResultExpID);

        $this->create_asm_view("review_condition");
    }

    function update_resultexp()
    {
        $this->load->model('ResultExp_model');
        $this->load->model('Manage_assessment');
        $AssessmentID = $this->session->userdata('AssessmentID');

        $result_exp = $this->input->post('result_exp');
        $ResultExpID = $this->ResultExp_model->update_resultexp($result_exp);
        $this->Manage_assessment->add_ResultExpID($AssessmentID, $ResultExpID);
        
        //unset all session relate to update result_condition
        $this->session->unset_userdata('Expression');
        $this->session->unset_userdata('ResultExpID');
        $this->session->unset_userdata('re_flag');
        $this->create_asm_view('review_condition');
    }

    function get_condition_data($AsmID)
    {
        $this->load->model('Manage_assessment');
        //get data to fill the form
        $ResultExpID = $this->Manage_assessment->get_ResultExpID($AsmID);
        $Expression = $this->Manage_assessment->get_Expression($ResultExpID);
        $this->session->set_userdata('Expression', $Expression);
        $this->session->set_userdata('ResultExpID', $ResultExpID);
        $this->session->set_userdata('re_flag', 1);
        $this->create_asm_view("result_condition");
    }

}
