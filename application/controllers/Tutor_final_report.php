<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutor_final_report extends CI_Controller {

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
     * Default view
     * @author Heng LOEM
     */
    public function index() {
        $data = getUserContextData($this);
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Tutorsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
                /**
                 * get new survey for tutor account [Login successfully]
                 * @author Heng LOEM
                 */
                //get group of tutor that have a student to follow up
                $stuIndex = $this->Tutorsurvey_model->m_get_group_student($tutorid);
                foreach ($stuIndex as $index_stu){
                    $stuId = $index_stu['UsersId'];
                }
                $data['get_new_survey'] = $this->Tutorsurvey_model->m_get_new_survey($stuId);
                /*end of tutor follow up student*/
                //get survey belong to a student
        $data['year'] = $this->batchs_model->m_get_year();
        $data['title'] = 'Tutors Final Report';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_report_presentation/index', $data);
        $this->load->view('templates/footer');
    }

    /* return back as array of years
     * for display years of batch
     * author Vin Touch
     */

    public function get_filter($id) {
        $data = getUserContextData($this);
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Tutorsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
                /**
                 * get new survey for tutor account [Login successfully]
                 * @author Heng LOEM
                 */
                //get group of tutor that have a student to follow up
                $stuIndex = $this->Tutorsurvey_model->m_get_group_student($tutorid);
                foreach ($stuIndex as $index_stu){
                    $stuId = $index_stu['UsersId'];
                }
                $data['get_new_survey'] = $this->Tutorsurvey_model->m_get_new_survey($stuId);
                /*end of tutor follow up student*/
                //get survey belong to a student
        $data['year'] = $this->batchs_model->m_get_year();
        $data['slide_present'] = $this->batchs_model->get_slide_present($id);
        $_SESSION['selected_id'] = $id;

        $data['title'] = 'Tutor Report Presentation';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_report_presentation/index', $data);
        $this->load->view('templates/footer');
    }

    /* return back as array of file upload
     * for download file
     * author Vin Touch
     */

    public function download_file() {

        $this->load->helper('download');

        $filename = $this->input->post("filename");

        if (is_file("uploads_report/$filename")) {
            $result = force_download("uploads_report/$filename", null);
            echo $result;
        } else {
            $this->session->set_flashdata('error', 'File Not Found!');
            redirect(base_url() . Tutor_final_report);
        }
    }

}
