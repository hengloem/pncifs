<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class TutorsUsers extends CI_Controller {

    /**
     * Default constructor
     * @author Benoit PITET
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->model('tutors_model');
        $this->load->model('students_model');
        $this->load->model('Tutorsurvey_model');
    }

    /**
     * Display the list of all users
     * @author Benoit PITET
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
        
        $data['admin_id'] =  $this->session->userdata('id');
        $this->load->model('tutors_model');
        $data['tutor_data'] = $this->tutors_model->m_get_data();
        
        $data['title'] = 'List of Tutors';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_users/index', $data);
        $this->load->view('templates/footer');
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
        
        $data['title'] = 'Create tutor account';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_users/add', $data);
        $this->load->view('templates/footer');
    }

    public function view() {
        $this->load->model('tutors_model');
        $this->tutors_model->m_get_data();
    }

    public function c_process_add() {
        $this->confirm_password();
    }

    public function check_validation_edit() {

        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('pnemail', 'PN Email', 'required|valid_email');
        $this->form_validation->set_rules('skypeid', 'Skype ID', 'required');

        if ($this->form_validation->run() === false) {
            $this->edit($this->input->post('id'));
        } else {
            $this->c_process_edit($this->input->post('id'));
        }
    }

    public function confirm_password() {
        $pass1 = $_POST['Password'];
        $pass2 = $_POST['password2'];
        if ($pass1 != "" && $pass2 != "" && $pass1 == $pass2) {
            $this->load->model('tutors_model');
            $result = $this->tutors_model->m_insert();
            if ($result) {
                $this->session->set_flashdata('sms', 'sucessful add new record');
                redirect(base_url() . "tutorsusers");
            } else {
                $this->session->set_flashdata('sms', 'sucessful add new record');
                redirect(base_url() . "tutorsusers");
            }
        } else {
            $this->session->set_flashdata('sms', 'password not match');
            $this->add();
        }
    }

    /**
     * Call edit form with value.
     * @param type $id is specific user
     * @author Seavmeng Chham 
     */
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
        
        $this->load->model('tutors_model');
        $data['user_id'] = $id;
        $data['tutor_data'] = $this->tutors_model->m_get_data();
        $data['title'] = 'Edit Tutors';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_users/edit', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Process edit data in database.
     * @param type $id specific the user
     * @author Seavmeng Chham
     */
    public function c_process_edit($id) {
        $this->load->model('tutors_model');
        $result_tutor = $this->tutors_model->m_update($id);
        $result_special = $this->tutors_model->m_update_spcialization($id);
        if ($result_tutor == true && $result_special == true) {
            $this->session->set_flashdata('sms', 'sucessful update record');
            redirect(base_url() . "tutorsusers");
        } else {
            $this->session->set_flashdata('sms', 'unsucessful update record');
            redirect(base_url() . "tutorsusers");
        }
    }

    /**
     * Delete data from database
     * @param type $id is specific the user
     * @author Seavmeng Chham
     */
    public function delete($id) {
        $this->load->model('tutors_model');
        $this->load->model('users_model');
        $result_delete_tutor_in_stu = $this->tutors_model->m_delete_tutors_in_student($id);
        $restul_delete_tutors = $this->tutors_model->m_delete_tutors($id);
        // check if model pass value true or not 
        // True : can delete
        if ($result_delete_tutor_in_stu) {
            if ($restul_delete_tutors) {
                $this->users_model->deleteUser($id);
                $this->session->set_flashdata('sms', 'sucessful delete record');
                redirect(base_url() . "tutorsusers");
            }
        }
        //False : cannot delete
        else {
            $this->session->set_flashdata('sms', 'unsucessful delete record');
            redirect(base_url() . "tutorsusers");
        }
    }

    public function check_validation_add() {
        $this->form_validation->set_rules('FirstName', 'First Name', 'required');
        $this->form_validation->set_rules('LastName', 'Last Name', 'required');
        $this->form_validation->set_rules('EmailPN', 'PN Email', 'required|valid_email|is_unique[users.EmailPN]');
        $this->form_validation->set_rules('SkypeID', 'Skype ID', 'required');
        $this->form_validation->set_rules('password2', 'Confirm password', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required');
        if ($this->form_validation->run() === false) {
            $this->add();
        } else {
            $this->c_process_add();
        }
    }

    /**
     * 
     */
    public function details($id) {
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
        
        $data['user_id'] = $id;
        $data['tutor_data'] = $this->tutors_model->m_get_data();
        $data['title'] = 'Detail Tutors';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_users/detail', $data);
        $this->load->view('templates/footer');
    }

    public function myprofile($id) {
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
        
        $data['title'] = 'My profile';
        $data['user_id'] = $this->tutors_model->m_get_user_tutor($id); //get data from database
        $data ['list_specialization'] = $this->tutors_model->m_get_data(); //get tutor from database to display in view
        $data['supervisor_data'] = $this->students_model->m_supervisor_data();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_users/myprofile', $data);
        $this->load->view('templates/footer');
    }

    public function form_password() {
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
        
        $data['title'] = 'Change Your Password';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('tutors_users/change_password', $data);
        $this->load->view('templates/footer');
    }

    public function ComparePass() {

        $id = $this->input->post('id'); //get by id of users in database
        $curren_pw = $this->input->post('password'); //get password from input form

        $oldPw = $this->tutors_model->m_get_old_password(); //declear funtion for get old password to compair with new password

        $chkpw = password_verify($curren_pw, $oldPw[0]['password']); //check old password in database

        $newPw = $this->input->post('newpassword'); ///input new password in form
        $confirmnew = $this->input->post('confirmpassword'); ///match new password and comfirmpassword

        if ($newPw != $confirmnew) {//comdition false
            $this->session->set_flashdata("msg", "New password and confirm new password must be the same!");
            redirect("tutorsusers/form_password");
        } else if ($chkpw) {//condition true
            $res = $this->tutors_model->updatePw($newPw, $id);
            if ($res) {//redirect to home page if t
                redirect("tutorsusers");
            } else {
                redirect("tutorsusers/form_password");
            }
        } else {
            $this->session->set_flashdata("msg", "old password incorrect!");
            redirect("tutorsusers/form_password");
        }
    }  
    /**
     * check validation callback : prevent show validation if no update
     * @param type $editProfile_validation
     * @return message error
     * @author vin touch
     */
    function editProfile_validation($id) {
//        echo $id;exit;
        $data = getUserContextData($this);
        $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('pnemail', 'PN Email', 'required|valid_email');
//        $this->form_validation->set_rules('personalemail', 'Personal Email', 'required|valid_email');
        $this->form_validation->set_rules('skypeid', 'Skype ID', 'required');
        $result = $this->form_validation->run();

        if ($result) {
            $this->session->set_flashdata('msg', 'Your data update successful');
            $this->tutors_model->edit_profile_tutor($id); 
            redirect(base_url());
        } else {
            $this->session->set_flashdata('error', 'Your data can not update');
            $this->myprofile($id);
        }
    }

}
