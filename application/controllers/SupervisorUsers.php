<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class SupervisorUsers extends CI_Controller {

    /**
     * Default constructor
     * @author Heng.LOEM
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->model('supervisor_model');
        $this->load->model('users_model');
    }

    /**
     * Display the list of all supervisor
     * @author Heng.LOEM
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
        
        $data['supervisor_data'] = $this->supervisor_model->m_get_supervisor_data();
        
        //to get the feature of the page
        $data['title'] = 'List of supervisor';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('supervisor_users/index', $data);
        $this->load->view('templates/footer');
    }
    /**
     * c_add used to open add form
     * @author Heng.LOEM 
     */
    public function c_add() {
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
        
        $data['title'] = 'Create supervisor account';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('supervisor_users/add', $data);
        $this->load->view('templates/footer');
    }
    /**
     * c_check_validation_add used to validation add form
     * @author Heng.LOEM
     */
    public function c_check_validation_add() {
        $this->form_validation->set_rules('FirstName', 'First Name', 'required|callback_validate_only_letter');
        $this->form_validation->set_rules('LastName', 'Last Name', 'required|callback_validate_only_letter');
        $this->form_validation->set_rules('Companyname', 'Company name', 'required');
        $this->form_validation->set_rules('Position', 'Position', 'required|callback_validate_letter_with_space');
        $this->form_validation->set_rules('Departmentname', 'Department name', 'required|callback_validate_letter_with_space');
        
        $this->form_validation->set_rules('Emailpersonal', 'Personal email', 'required|valid_email|is_unique[supervisor.Emailpersonal]');
        $this->form_validation->set_rules('EmailPN', 'Company email', 'required|valid_email|is_unique[users.EmailPN]');
        
        $this->form_validation->set_rules('PhoneNumber', 'Phone number', 'required|callback_validate_phone_number|is_unique[supervisor.PhoneNumber]');
        if ($this->form_validation->run() === false) {
            $this->c_add();
        } else {
            $this->c_process_add();
        }
    }
    /**
     * validation text with white space
     * @return TRUE or FALSE
     * @author Heng.LOEM
     */
    public function validate_letter_with_space($position, $department){
        $position = $_POST['Position'];
        $department = $_POST['Departmentname'];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$position,$department)) {
            $this->form_validation->set_message('validate_letter_with_space', 'Only letters and white space allowed');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    /**
     * validation only text, no white space or number allowed
     */
    public function validate_only_letter($firstname, $lastname){
        $firstname = $_POST['FirstName'];
        $lastname = $_POST['LastName'];
        // check if name only contains letters
        if (!preg_match("/^[a-zA-Z]*$/",$firstname, $lastname)) {
            $this->form_validation->set_message('validate_only_letter', 'Only letters allowed');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    /**
     * validation phone number
     */
    public function validate_phone_number($value) {
            $value = trim($value);
            $match = '/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{3}[-. ]?[0-9]{3}$/';
            $replace = '/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/';
            $return = '($1) $2-$3';
        if (preg_match($match, $value)) {
            return preg_replace($replace, $return, $value);
        } else {
            $this->form_validation->set_message('validate_phone_number', 'Invalid Phone. Example: (855) 015-239-369');
            return false;
        }
    }
    /**
     * c_confirm_pasword used to check password that user has inputed
     * @author Heng.LOEM
     */
    public function c_confirm_password() {
        $pass1 = $_POST['Password'];
        $pass2 = $_POST['password2'];
        if ($pass1 != "" && $pass2 != "" && $pass1 == "123" && $pass2 == "123" && $pass1 == $pass2) {
            $result_sup_user = $this->supervisor_model->m_insert_supervisor_user();
            $result_sup = $this->supervisor_model->m_insert_supervisor(); 
            if ($result_sup_user == TRUE && $result_sup == TRUE) {
                $this->session->set_flashdata('error', 'cannot add new record');
                redirect(base_url() . "supervisorusers");
            } else {
                $this->session->set_flashdata('msg', 'sucessful add new record');
                redirect(base_url() . "supervisorusers");
            }
        } else {
            $this->session->set_flashdata('error', 'password not match');
            $this->c_add();
        }
    }
    
    /**
     * c_process_add used add data
     * @author Heng.LOEM
     */
    public function c_process_add() {
        $this->c_confirm_password();
    }
    //===========================================================================>
    /**
     * c_delete_supervisor
     * @author Heng.LOEM
     */
    public function c_delete_supervisor($id){
        //delete supervisor with users table
        $delete_supervisor_in_stu = $this->supervisor_model->m_delete_supervisor_in_stu($id);
        //delete supervisor in current table
        $delete_supervisor = $this->supervisor_model->m_delete_supervisor($id);
        // check if model pass value true or not 
        // True : can delete
        if ($delete_supervisor_in_stu) {
            if ($delete_supervisor) {
                $this->users_model->deleteUser($id);
                $this->session->set_flashdata('msg', 'sucessful delete record');
                redirect(base_url() . "supervisorusers");
            }
        }
        //False : cannot delete
        else {
            $this->session->set_flashdata('error', 'unsucessful delete record');
            redirect(base_url() . "supervisorusers");
        }
    }
    //===========================================================================>
    
    /**
     * c_edit used to open form edit
     * @get array from database
     * @author Heng.LOEM
     */
    public function c_edit($id){
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
        $data['sup_id'] = $id;
        $data['supervisor_data'] = $this->supervisor_model->m_get_supervisor_data();
        
        $data['title'] = 'Edit supervisor account';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('supervisor_users/edit', $data);
        $this->load->view('templates/footer'); 
    }
    /**
     * c_check_validation_edit used to validation add form
     * @author Heng.LOEM
     */
    public function c_check_validation_edit($id) {
        $this->form_validation->set_rules('FirstName', 'First Name', 'required|callback_validate_only_letter');
        $this->form_validation->set_rules('LastName', 'Last Name', 'required|callback_validate_only_letter');
        $this->form_validation->set_rules('Companyname', 'Company name', 'required');
        $this->form_validation->set_rules('Position', 'Position', 'required|callback_validate_letter_with_space');
        $this->form_validation->set_rules('Departmentname', 'Department name', 'required|callback_validate_letter_with_space');
        $this->form_validation->set_rules('Emailpersonal', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('PhoneNumber', 'Phone number', 'required|callback_validate_phone_number');
        
        if ($this->form_validation->run() === false) {
            $this->c_edit($id);
        } else {
            $this->c_process_edit($id);
        }
    }

    /**
     * c_process_edit used to update field data in database
     * @param type $id specific the user
     * @author Heng.LOEM
     */
    public function c_process_edit($id) {
        //update users table
        $result_supervisor_user = $this->supervisor_model->m_update_supervisor_user($id);
        //update supervisor table
        $result_supervisor = $this->supervisor_model->m_update_supervisor_field($id);
        if ($result_supervisor_user == true && $result_supervisor_user == true) {
            $this->session->set_flashdata('msg', 'sucessful update record');
            redirect(base_url() . "supervisorusers");
        } else {
            $this->session->set_flashdata('error', 'unsucessful update record');
            redirect(base_url() . "supervisorusers");
        }
    }

    /**
     * c_preview_detail used to view detail of supervisor field
     * @return $id Description array
     * @author Heng.LOEM
     */
    public function c_preview_detail($id){
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
        $data['sup_id'] = $id;
        $data['supervisor_data'] = $this->supervisor_model->m_get_supervisor_data();
        
        $data['title'] = 'Preview supervisor account';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('supervisor_users/detail', $data);
        $this->load->view('templates/footer'); 
    }
}
