<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Final_Report extends CI_Controller {

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
        $this->load->model('StudenSurvey_model');
    }

    /**
     * Display the batch of years
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
        $data['year'] = $this->batchs_model->m_get_year();

        $data['title'] = 'Final Presentation';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('admin_final_report/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_filter($id) {
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
        $data['year'] = $this->batchs_model->m_get_year();
        $data['slide_present'] = $this->batchs_model->get_slide_present($id);
        $_SESSION['selected_id'] = $id;

        $data['title'] = 'Final Presentation';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('admin_final_report/index', $data);
        $this->load->view('templates/footer');
    }

    /* return back as array of file upload
     * for upload file
     * author Vin Touch
     */

    function upload_file() {
        if (isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != '') {
            $data = array('FinalReportTemplateFileName' => $_FILES['fileToUpload']['name']);
            $result = $this->batchs_model->m_upload('batch', $data);
            if ($result) {
                $this->moveFile();
            }
        } else {
            $this->session->set_flashdata('error', 'Choose file to upload your data!');
            redirect(base_url().'final_report');
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
            $destination = 'uploads_report/' . $_FILES['fileToUpload']['name'];
            if (!file_exists($destination)) {
                move_uploaded_file($filename, $destination);
            }
        }
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
            redirect(base_url().final_pres);
        }
    }

    /* return back as array of file upload
     * for delete file
     * author Vin Touch
     */

    public function delete($id) {
        $data = array('FinalReportTemplateFileName' => NULL);
//        echo $_SESSION['tem_file_name'];
        if($this->batchs_model->m_update_file_name($id,$data)){
            unlink('uploads_report/'.$_SESSION['tem_file_name']);
             $this->session->set_flashdata('msg', 'Your file deleted');
              redirect(base_url().'final_report/get_filter/'.$id);
        }
        $this->get_filter($id); 

        
    }

}
