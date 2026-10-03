<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutor_follow_by_admin extends CI_Controller {

    /**
     * Default constructor 
     * @author Benoit PITET
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->model('batchs_model');
        $this->load->model('tutors_model');
        $this->load->model('students_model');
        $this->load->model('Tutorsurvey_model');
        $this->load->model('StudenSurvey_model');
    }

    /**
     * Display the page of batch
     * @author Vin Touch
     */
    public function index() {
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
        $data['year'] = $this->tutors_model->m_get_student_year();
        $data['title'] = 'PNC Internship Follow-up';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_survey_follow_up/tutor_follow', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Display the list of all student
     * @author Vin Touch
     */
    public function get_filter_tutor() {
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
        $data['year'] = $this->tutors_model->m_get_student_year();
        $data['student'] = $this->tutors_model->m_get_list_student();

        $batch_id = $this->input->post('batch');
        // set session to store batch  and survey id for keep it in select option
        $this->session->set_userdata('ses_year', $batch_id);

        /**
         * get survey in each batch to display when  select year in batch.
         * @author Seavmeng.chham
         */
        $data['sur_by_bacth'] = $this->tutors_model->m_get_survey_by_batch($batch_id);

        $data['title'] = 'Welcome Tutor Survey Follow Up Students';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_survey_follow_up/tutor_follow', $data);
        $this->load->view('templates/footer');
    }
 
    public function get_student_survey() { 
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
        $sur_id = $this->input->post('survey');
        $data['year'] = $this->tutors_model->m_get_student_year();
        $batch_id = $this->session->userdata('ses_year');
        $data['stu_list'] = $this->tutors_model->m_get_student_survey($sur_id, $batch_id);
        
        $data['stu_report'] =  $this->tutors_model->m_get_question_survey();
        
        $this->session->set_userdata('ses_survey',$sur_id);
        $data['sur_by_bacth'] = $this->tutors_model->m_get_survey_by_batch($batch_id); 
        
        
        $data['title'] = 'Welcome Tutor Survey Follow Up Students';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_survey_follow_up/tutor_follow', $data);
        $this->load->view('templates/footer');
    }
}
