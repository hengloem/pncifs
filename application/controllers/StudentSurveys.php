<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentSurveys extends CI_Controller {

    /**
     * Default constructor
     * @author Heng.LOEM
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->model('students_model');
        $this->load->model('batchs_model');
        $this->load->model('users_model');
        $this->load->model('tutors_model');
        $this->load->model('StudenSurvey_model');
        $this->load->model('tutorsurvey_model');
        $this->load->model('reminder_student_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data = getUserContextData($this);
        //to get the survey that belogn to a student
        $studentid = $this->session->userdata('id');
        $data['student_survey'] = $this->StudenSurvey_model->m_get_survey_data($studentid);

        //get survey when user student has clicked on survey menu        
        $data['get_new_survey_data'] = $this->StudenSurvey_model->m_get_new_survey($studentid);

        //for get list of done survey
        //completed
        
        $data['get_done_survey_data'] = $this->StudenSurvey_model->m_get_done_survey($studentid);
        
        /**
        * add default notification in reminder student.
         * @author seavmeng.chham
        */
        $data['reminder_data'] = $this->reminder_student_model->m_get_reminder_student($this->session->userdata('id'));

        $data['title'] = 'List of Students';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('student_survey/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function c_answer($id) {
        $data = getUserContextData($this);
        //get survey when user student has clicked on survey menu   
        $studentid = $this->session->userdata('id');
        $data['get_new_survey_data'] = $this->StudenSurvey_model->m_get_new_survey($studentid);
         /**
        * add default notification in reminder student.
         * @author seavmeng.chham
        */
        $data['reminder_data'] = $this->reminder_student_model->m_get_reminder_student($this->session->userdata('id'));

        //after student clicked answer it will be update the survey to old survey
        //Not yet working properly, it just under reading
        //$data['surveys_data'] = $this->StudenSurvey_model->m_update_to_done_survey($id);


        /**
         * get a survey detail and question
         */
        $data['get_survey'] = $this->StudenSurvey_model->m_get_survey($id);
        $data['get_description'] = $this->StudenSurvey_model->m_get_description($id);

        $data['title'] = 'Answer the survey';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('student_survey/answer', $data);
        $this->load->view('templates/footer');
    }

    /**
     * c_save to save file but not yet submit
     * @author Sreyleang.SEAK
     */
    public function c_save($id) {
        //echo $id; exit();
        $data = getUserContextData($this);
        //$add_answer = $this->StudenSurvey_model->m_add_answer();
        $quesIdHidden = $this->input->post('questionIdHidden');
        $questionText = $this->input->post('AnswerText');
        $studentid = $this->session->userdata('id');
        for ($i = 0; $i < count($questionText); $i++) {
            // insert one record
            $add_answer = $this->StudenSurvey_model->m_add_answer($quesIdHidden[$i], $questionText[$i], $studentid);
        }
        //push_save get $id of survey and update it to IsSave if  a user clicked on save button, next change to continues button
        $push_save = $data['get_survey'] = $this->StudenSurvey_model->m_update_survey_to_save($id);
        //var_dump($push_save); exit();
        if ($add_answer > 0) {
            $this->session->set_flashdata('msg', 'You have save your survey');
            redirect('StudentSurveys');
        } else {
            $this->session->set_flashdata('error', 'Your survey is no yet save');
            redirect('StudentSurveys');
        }
    }
    public function c_submit($id)
    {
        $data = getUserContextData($this);
        //$add_answer = $this->StudenSurvey_model->m_add_answer();
        $quesIdHidden = $this->input->post('questionIdHidden');
        
        $questionText = $this->input->post('AnswerText');
        
        $studentid = $this->session->userdata('id');
        for ($i = 0; $i < count($questionText); $i++) {
            // insert one record
            $add_answer = $this->StudenSurvey_model->m_submit_answer($quesIdHidden[$i], $questionText[$i], $studentid);
        }
        //get $id of survey id, pass to update to done survey
        $push_submit = $data['get_done_survey_data'] = $this->StudenSurvey_model->m_update_to_done_survey($id);
        if ($add_answer > 0) {
            $this->session->set_flashdata('error', 'Your survey is no yet submit');
            redirect('StudentSurveys');
            
        } else {
            $this->session->set_flashdata('msg', 'You have submit your survey');
            redirect('StudentSurveys');
        }
    }
    
    public function edit($id)
    {
        $data = getUserContextData($this);
        
        $data['stu_id'] = $this->session->userdata('id');
        $data['get_answer'] = $this->StudenSurvey_model->m_get_answer($id);
        $data['get_description'] = $this->StudenSurvey_model->m_get_description($id);
        $data['get_survey'] = $this->StudenSurvey_model->m_get_survey($id);
        $data['get_new_survey_data'] = $this->StudenSurvey_model->m_get_new_survey($id);
        $data['title'] = 'edit the answer the survey';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('student_survey/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function c_update_answer($id)
    {
        $data = getUserContextData($this);
        $answerIdHidden = $this->input->post('answerIdHidden');
        $answerText = $this->input->post('AnswerText');

        for ($i = 0; $i < count($answerText); $i++) {
            // insert one record
            $add_answer = $this->StudenSurvey_model->m_update_answer($answerText[$i], $answerIdHidden[$i]);
        }
        //get $id of survey id, pass to update to done survey
        $push_submit = $data['get_done_survey_data'] = $this->StudenSurvey_model->m_update_to_done_survey($id);
        if ($add_answer) {
            $this->session->set_flashdata('m', 'Your survey is no yet submit');
            redirect('StudentSurveys');
        }
        
    }
}

