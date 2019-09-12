<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_final_pres extends CI_Controller {

    /**
     * Default constructor
     * @author Vin Touch
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->model('batchs_model');
        $this->load->model('tutors_model');
        $this->load->model('students_model');
        $this->load->model('StudenSurvey_model');
        $this->load->model('reminder_student_model');
    }

    /**
     * Display the batch of years
     * @author Vin Touch
     */
    public function index() {
        $data = getUserContextData($this);
        /*
         * get new survey alert message for student account [Login successfully]
         * @author Sreyleang SEAK
         */
        $studentid = $this->session->userdata('id');
        $data['get_new_survey_data'] = $this->StudenSurvey_model->m_get_new_survey($studentid);

        $data['users'] = $this->students_model->getUsersStudentsWithBatch(); // get id from batch
        $data['stu_id'] = $this->session->userdata('id'); //get id from user student login
        /**
        * add default notification in reminder student.
         * @author Seavmeng.chham
        */
        $data['reminder_data'] = $this->reminder_student_model->m_get_reminder_student($this->session->userdata('id'));

        $data['title'] = 'Student Final Presentation';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('student_final_presetation/index', $data);
        $this->load->view('templates/footer');
    }

    /* return back as array of file upload
     * for upload file
     * author Vin Touch
     */

    function upload_file() {
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
            $data = array('FinalPresTemplateFileName' => $_FILES['fileToUpload']['name']);
            $result = $this->batchs_model->m_upload('batch', $data);
            if ($result) {
                $this->moveFile();
            }
        } else {
            $this->session->set_flashdata('error', 'Choose file to upload your data!');
        }
        $this->get_filter($_SESSION['selected_id']);
    }

    /* return back as array of file upload
     * for move file(replace file in database)
     * author Vin Touch
     */

    function moveFile() {
        if (isset($_FILES)) {
            $filename = $_FILES['fileToUpload']['tmp_name'];
            $destination = 'uploads/' . $_FILES['fileToUpload']['name'];
            if (!file_exists($destination)) {
                move_uploaded_file($filename, $destination);
            }
        }
    }

    /*
     * for download file template
     * author Vin Touch
     */

    public function download_file() {

        $this->load->helper('download');

        $filename = $this->input->post("filename");

        if (is_file("uploads/$filename") != '') {
            $result = force_download("uploads/$filename", null);
            echo $result;
        } else {
            $this->session->set_flashdata('error', 'File Not Found!');
            redirect(base_url() . 'student_final_pres/index/' . $id);
        }
    }

}
