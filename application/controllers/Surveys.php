<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Surveys extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->helper('url_helper');
        $this->load->model('survey_model');
        $this->load->model('tutorsurvey_model');
        $this->load->model('batchs_model');
    }

    public function index() {
//        echo 'surveys is running';
//        exit;

        $data = getUserContextData($this);
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        $this->load->model('Adminsurvey_model');
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
        foreach ($stuIndex as $index_stu){
            $stuId = $index_stu['UsersId'];
        }
        $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
        /*END OF ALERT MESSAGE*/
        
        $data['batch_data'] = $this->batchs_model->m_get_batch();
        $data['survey_data'] = $this->survey_model->m_get_survey();
        $data['title'] = 'List of Surveys';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('survey/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * This function used for check validation before add survey
     * @author Seavmeng.chham
     */
    public function check_error() {
        $this->form_validation->set_rules('title', 'Survey Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run()) {///can add if filled all field
            $this->c_process_add();
        } else {
            $this->add();
        }
    }

    public function add() {
        $data = getUserContextData($this);
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        $this->load->model('Adminsurvey_model');
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
        foreach ($stuIndex as $index_stu){
            $stuId = $index_stu['UsersId'];
        }
        $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
        /*END OF ALERT MESSAGE*/
        
        $data['batch_data'] = $this->batchs_model->m_get_batch();
        $data['survey_type'] = $this->survey_model->m_get_survey_type();

        $data['title'] = 'Create Surveys';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('survey/add', $data);
        $this->load->view('templates/footer');
    }

    public function c_process_add() {
        $data = getUserContextData($this);
        $array_mandatory = array();
        $array_ques_id = array();
        $array_ques = array();
        $question_id = $this->input->post('ques_id');
        $question = $this->input->post('ques');
        $surveyTypeId = $this->input->post('surveyType');
        $IsMandatory = $this->input->post('IsMandatory');
        /// add element to array.
        //loop Ismandatory
        for ($i = 1; $i <= count($question_id); $i++) {
            $_POST["status_$i"] = isset($_POST["status_$i"]) ? $_POST["status_$i"] : 0;
            array_push($array_mandatory, $_POST["status_$i"]);
        }

        foreach ($question_id as $key => $value) {
            array_push($array_ques_id, $question_id[$key]);
            array_push($array_ques, $question[$key]);
//            array_push($array_mandatory, $IsMandatory[$key]);
        }
        $add_success_id = $this->survey_model->m_add_survey();
        $add_questoin = $this->survey_model->m_add_question($array_ques_id, $array_ques, $add_success_id, $array_mandatory);
        if ($add_questoin === true) {
            $this->session->set_flashdata('msg', 'The survey has been successfully add');
            redirect('surveys');
        } else {
            $this->session->set_flashdata('error', 'The error add question in survey');
            redirect('surveys');
        }
    }

    public function delete($id) {
        if ($this->survey_model->m_delete_survey($id) === true) {
            $this->session->set_flashdata('msg', 'The survey has been successfully deleted');
            redirect('surveys');
        } else {
            $this->session->set_flashdata('error', 'The survey cannot deleted.');
            redirect('surveys');
        }
    }

    public function detail($id) {
        $data = getUserContextData($this);
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        $this->load->model('Adminsurvey_model');
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
        foreach ($stuIndex as $index_stu){
            $stuId = $index_stu['UsersId'];
        }
        $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
        /*END OF ALERT MESSAGE*/
        
        $data['question_data'] = $this->survey_model->m_get_question_survey($id);
        $data['survey_data'] = $this->survey_model->m_get_survey_by_id($id);
        $data['survey_type'] = $this->survey_model->m_get_survey_type();
        $data['batch_data'] = $this->batchs_model->m_get_batch();
        $data['title'] = 'View detail of Surveys';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('survey/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data = getUserContextData($this);
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        $this->load->model('Adminsurvey_model');
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
        foreach ($stuIndex as $index_stu){
            $stuId = $index_stu['UsersId'];
        }
        $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
        /*END OF ALERT MESSAGE*/
        
        $data['question_data'] = $this->survey_model->m_get_question_survey($id);
        $data['survey_data'] = $this->survey_model->m_get_survey_by_id($id);
        $data['survey_type'] = $this->survey_model->m_get_survey_type();
        $data['batch_data'] = $this->batchs_model->m_get_batch();
        $data['title'] = 'Edit Surveys';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('survey/edit', $data);
        $this->load->view('templates/footer');
    }

    public function c_process_edit($id) {
     
        $array_mandatory = array();
        $array_ques_id = array();
        $array_ques = array();
        $question = $this->input->post('question');
        $ques_id = $this->input->post('ques_id');
        $isMandatory = $this->input->post('isMand');
//        var_dump($isMandatory);        die();
        
        $survey_id = $id; 
        for ($i = 0; $i < count($ques_id); $i++) {
            $order = $i + 1;
            if ($ques_id[$i] > 0) {
                // can update 1 question 
                $this->survey_model->m_update_question($ques_id[$i], $order, $question[$i] ,$isMandatory[$i]); 
            } else {
               $add_ques_succ = $this->survey_model->m_insert_question($question[$i], $order, $survey_id , $isMandatory[$i]); 
            }
        }
        if ($this->survey_model->m_update_survey($id)) {
              $this->session->set_flashdata('msg', 'The survey has been successfully update');
            redirect('surveys');
        }
//        if($add_ques_succ > 0 && $this->survey_model->m_update_survey($id) === true) {
//            $this->session->set_flashdata('msg', 'The survey has been successfully update');
//            redirect('surveys');
//        }

//        var_dump($ques_new);
        //loop Ismandatory
//        for ($i = 1; $i <= count($ques_id); $i++) {
//            $_POST["IsMan_$i"] = isset($_POST["IsMan_$i"]) ? $_POST["IsMan_$i"] : 0;
//            array_push($array_mandatory, $_POST["IsMan_$i"]);
//        }
//        var_dump($question);
//        var_dump($ques_id);
//        exit();
//        // add value to array.
//        foreach ($question as $key => $value) {
//            array_push($array_ques, $question[$key]);
//            array_push($array_ques_id, $ques_id[$key]);
//        }
//
//        if ($this->survey_model->m_update_survey($id) === true) {
//            $this->survey_model->m_update_question($array_ques_id, $array_mandatory, $array_ques);
//            $this->session->set_flashdata('msg', 'The survey has been successfully update');
//            redirect('surveys');
//        } else {
//            $this->session->set_flashdata('error', 'The survey error update');
//            redirect('surveys');
//        }
    }

}
