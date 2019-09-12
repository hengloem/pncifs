<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class view_student_survey extends CI_Controller {

    /**
     * Default constructor
     * @author Heng.LOEM
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->model('SurveyStudentAdmin_model');
        $this->load->model('users_model');
        $this->load->model('survey_model');
        $this->load->model('tutorsurvey_model');
        $this->load->model('batchs_model');
        $this->load->model('Adminsurvey_model');
    }

    /**
     * Display the list of all supervisor
     * @author Heng.LOEM
     */
    public function index() {
        $data = getUserContextData($this);
        $tutorid = $this->session->userdata('id');
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

        $tutorid = $this->session->userdata('id');
        //get student belong to a tutor
        /*END OF ALERT MESSAGE*/

        
        //remember the selected//GET batch $id from dropdown list, only get an Id when user has selectet.
        //$_SESSION declared to catch an id and store it as SESSION
        //**batch
        $batch = $this->input->post('batch');
        $_SESSION['current_select'] = $batch;
        //If id == null, it will show current year
        if($batch == NULL){
            $year_index = $this->SurveyStudentAdmin_model->m_get_years();
            foreach ($year_index as $yearindext){
                $batch = $year_index[0]['Id'];
                //var_dump($batch); exit();
            }
            $data['survey_byBatch'] = $this->SurveyStudentAdmin_model->m_get_survey_by_batch($batch);
        }else{
            $data['survey_byBatch'] = $this->SurveyStudentAdmin_model->m_get_survey_by_batch($batch);
        }
        //get list of batch value *each year
        $data['batch_data'] = $this->SurveyStudentAdmin_model->m_get_years();
        
        //**survey
        $survey = $this->input->post("survey");
        $_SESSION['get_select'] = $survey;
        //If id == null, it will show current year
        if($survey == NULL){
            $survey_index = $this->SurveyStudentAdmin_model->m_get_survey_by_batch($batch);
            foreach ($survey_index as $surveyindext){
                $survey = $survey_index[0]['Survey_Id'];
//                var_dump($survey); exit();
            }
            $data['studentSurvey_data'] = $this->SurveyStudentAdmin_model->m_getStudent_not_submit($survey);
        }else{
            $data['studentSurvey_data'] = $this->SurveyStudentAdmin_model->m_getStudent_not_submit($survey);
        }
        //get list of question and answer that belong to a survey
//        $data['questions_data'] = $this->SurveyStudentAdmin_model->m_get_surveyAnswer($survey);        
        
        //to get the feature of the page
        $data['title'] = 'List of supervisor';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data); 
        $this->load->view('student_survey_admin/index', $data);
        $this->load->view('templates/footer');
    }
    /**
     *  To show the questions in survey.
     *  
     */
    public function read_survey($stu_id,$sur_id) {
//        echo $stu_id;echo $sur_id;exit();
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
          
        $data['questions_data'] = $this->SurveyStudentAdmin_model->m_get_surveyAnswer($stu_id,$sur_id);    
        $data['title'] = 'List of supervisor';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data); 
        $this->load->view('student_survey_admin/ReadSurvey', $data);
        $this->load->view('templates/footer');
//        $this->input->post();
    }
 
}
