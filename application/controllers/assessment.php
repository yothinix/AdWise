<?php

class Assessment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Assessment_model');
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
        $TotalQuestion = $this->Assessment_model->get_asm_info($AssessID);

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

    function test($AID, $QID)
    {
        if($this->session->userdata('SelectChoice') == false)
        {
            $this->test_all($AID,$QID);
        }
        else
        {
            $this->Assessment_model->testdata();
            $this->test_all($AID,$QID);
        }
    }

    function result()
    {
        //do ResultExpression กระทำกับ Session Data (AssessmentID, QID, ChoiceID, AnswerGroup, ResultID)

        $data = array(
            'main_content' => 'result'
        );
        $this->load->view('/includes/template', $data);
    }

/*//////////Manage_Assessment / Create_Assessment controller function ///////////*/

    function create_asm_view($page)
    {
        $data = array(
            'main_content' => "createAsm/{$page}"
        );
        $this->load->view('/includes/template', $data);
    }

    function question_and_answer()
    {
        $data = array(
            'main_content' => 'createAsm/question_and_answer'
        );
        $this->load->view('/includes/template', $data);
    }

    function init_create_asm()
    {
        $this->load->model('Manage_assessment');
        $this->Manage_assessment->insert_asm_info();
        $this->create_asm_view("createAsm/asm_info");
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

/*//////////Manage_Assessment / Create_Assessment controller function ///////////*/

}
