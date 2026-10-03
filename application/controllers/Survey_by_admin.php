<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_by_admin extends CI_Controller {
    /**
    * Default constructor
    */
    public function __construct() {
	parent::__construct();
	checkLogin($this);
	$this->load->model('Adminsurvey_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
	$this->load->library('form_validation');
    }
    /**
     * Display the list of all survey in tutor page
     * @author Heng.LOEM
     */
    public function index() {
        $data = getUserContextData($this);
        $tutorid = $this->session->userdata('id');
        //get student belong to a tutor
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        //get group of tutor that have a student to follow up
        $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
        foreach ($stuIndex as $index_stu){
            $stuId = $index_stu['UsersId'];
        }
        $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
        /*END OF ALERT MESSAGE*/
        
        //get survey belong to a student
        $id = $this->input->post('select');
        //$_SESSION declared to catch an id and store it as SESSION //remember the selected
        $_SESSION['current_select'] = $id;
        if($id == NULL){
            $index = $this->Adminsurvey_model->m_get_group_student($tutorid);
            foreach ($index as $index_data){
                $id = $index[0]['UsersId'];
            }
            $data['student_survey_data'] = $this->Adminsurvey_model->m_get_survey_belong_to_a_student($id);
            
            //get checked survey that tutor has completed
            $data['tutor_checked_survey_data'] = $this->Adminsurvey_model->m_get_checked_survey($id);
        }else{
            $data['student_survey_data'] = $this->Adminsurvey_model->m_get_survey_belong_to_a_student($id); 
            
            //get checked survey that tutor has completed
            $data['tutor_checked_survey_data'] = $this->Adminsurvey_model->m_get_checked_survey($id);
        }
        //to get the feature of the page
        $data['title'] = 'Survey following by tutor';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('admin_survey_as_tutor/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * c_get_survey_with_question used to get the information about survey
     * @param type $Id Description get id to do preview on survey table
     * @author Heng.LOEM
     */
    public function c_preview_survey_detail($id, $userId){
        $data = getUserContextData($this);
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        //get group of tutor that have a student to follow up
        $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
        foreach ($stuIndex as $index_stu){
            $stuId = $index_stu['UsersId'];
        }
        $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
        /*END OF ALERT MESSAGE*/
        
        /**
         * get specific survey, question ; aswer that belong to a specific student also
         */
        $data['surveys_data'] = $this->Adminsurvey_model->m_get_survey_preview($id, $userId);
        $data['questions_data'] = $this->Adminsurvey_model->m_get_question_preview($id, $userId);
        $data['answers_data'] = $this->Adminsurvey_model->m_get_answer_preview($id, $userId);
        
        //to get the feature of the page
        $data['title'] = 'Preview survey information';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('admin_survey_as_tutor/detail', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * c_process_report used to add a comment of tutor
     * @return $id
     * @author Heng.LOEM
     */
    public function c_process_report($id){
        $data = getUserContextData($this); 
        $reportsText = $this->input->post('ReportsText'); 
        //Try to get a student id, to define which report that tutor comment to a specific student
        $insert_report =   $this->Adminsurvey_model->m_insert_report($id, $reportsText);
        if ($insert_report > 0) {
            $this->session->set_flashdata('msg', 'You have reported to the answer!');
            redirect('surveysbytutor');
        } else {
            $this->session->set_flashdata('error', 'Your cannot reported to the answer!');
            redirect('surveysbytutor');
        }
    }
    /**
     * c_get_detail_again used to get a detail page after he submit a comment
     * @return $id
     * @author Heng LOEM
     */
    public function c_get_detail_again(){
        
    }
    
    /**
     * c_process_submit used to submit survey after the tutor has completed check it
     * @param $id
     * @author Heng LOEM
     */
    public function c_process_submit($id){
        $data = getUserContextData($this);
        $push_submit = $data['tutor_checked_survey_data'] = $this->Adminsurvey_model->m_update_to_checked_survey($id);
        if($push_submit){
            $this->session->set_flashdata('error', 'Your survey is not submite.');
            redirect('surveysbytutor');
        }else{
            $this->session->set_flashdata('msg', 'Your survey is submitted.');
            redirect('surveysbytutor');
        }
    }
    
    /**
     * c_preview_checked_survey used to preview the survey that tutor has completed
     * @package $id
     * @author Heng LOEM
     */
    public function c_preview_checked_survey($id, $userId){
        $data = getUserContextData($this); 
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        //get group of tutor that have a student to follow up
        $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
        foreach ($stuIndex as $index_stu){
            $stuId = $index_stu['UsersId'];
        }
        $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
        /*END OF ALERT MESSAGE*/
        
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        
        /**
         * get specific survey, question ; aswer that belong to a specific student also
         */
        $data['checked_surveys_data'] = $this->Adminsurvey_model->m_checked_survey($id, $userId);
        $data['checked_questions_data'] = $this->Adminsurvey_model->m_get_question_preview($id, $userId);
        $data['checked_answers_data'] = $this->Adminsurvey_model->m_get_answer_preview($id, $userId);
        $data['checked_report_data'] = $this->Adminsurvey_model->m_get_checked_report($id, $userId);
        //to get the feature of the page
        $data['title'] = 'Check survey information';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutor_surveys/checked_report', $data);
        $this->load->view('templates/footer');
    }
}
