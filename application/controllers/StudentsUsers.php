<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentsUsers extends CI_Controller {

     /**
     * Default constructor
     * @author Benoit PITET
     */
    public function __construct() {
        parent::__construct(); 
        checkLogin($this);
        $this->load->model('students_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
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
        $data['users'] = $this->students_model->getUsersStudentsWithBatch();
        $data['title'] = 'List of Students';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('students_users/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Display a for that allows updating a given user
     * @param int $id User identifier
     * @author Benoit PITET
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
        /**SPECIAL ALERT MESSAGE
        * get new survey for admin as tutor account [Login successfully]
        * @author Heng LOEM
        */
        $this->load->model('Adminsurvey_model');
        $tutorid = $this->session->userdata('id');
        $data['tutor_student_data'] = $this->Adminsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
        $this->load->model('batchs_model');
        $this->load->model('users_model');
        $data['title'] = 'Edit student information';
        
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('pnemail', 'PN Email', 'required|valid_email');
        $this->form_validation->set_rules('skypeid', 'Skype ID', 'required');
        $this->form_validation->set_rules('personnalemail', 'Personal email', 'required|valid_email|differs[pnemail]');
        $this->form_validation->set_rules('batchid', 'Batch', 'required');
        $this->form_validation->set_rules('major', 'Major', 'required');
                       
//        $data['users_data'] = $this->students_model->getUsersStudentsWithBatch($id);
        $data['users_data'] = $this->students_model->get_student_with_batch($id);
        $data['batches'] = $this->batchs_model->getItems();
        if (empty($data['users_data'])) {
            show_404();
        }

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('students_users/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $updateUsersTable = $this->users_model->updateUsers();
            $updateStudentTable = $this->students_model->updateStudent($id, $this->input->post('batchid'));            
            if ($updateUsersTable && $updateStudentTable) {
                $this->session->set_flashdata('msg', 'The user has been successfully updated');
                redirect('studentsusers');
            } else {
                $this->session->set_flashdata('error', 'Error updating item');   
                $this->load->view('templates/header', $data);
                $this->load->view('templates/menu', $data);
                $this->load->view('students_users/edit', $data);
                $this->load->view('templates/footer');         
            }
        }
    }

    /**
     * Delete a given user
     * @param int $id User identifier
     * @author Benoit PITET
     */
    public function delete($id) { 
        //Test if user exists
         $this->load->model('users_model');
         $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            log_message('debug', '{controllers/students_users/delete} user not found');
            show_404();
        } else {
            // Delete first row in table 'student'
            // Then delete row in table 'user'
            if ($this->students_model->deleteItem($id)) {
                $this->users_model->deleteUser($id);
            } else {
                $this->session->set_flashdata('error', 'Error deleting the user');
                redirect('studentsusers');
            }
         }
        log_message('info', 'User #' . $id . ' has been deleted by user #' . $this->session->userdata('id'));
        $this->session->set_flashdata('msg', 'The user has been successfully deleted');
        redirect('studentsusers');
    }

    /**
     * Reset the password of a user
     * Can be accessed by admin
     * @param int $id User identifier
     */
    public function resetpassword($id) {
                
        // Check that user is admin
        // TODO
        //Test if user exists
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            log_message('debug', '{controllers/students_users/reset} user not found');
            show_404();
        } else {
            $data = getUserContext($this);
            $data['target_user_id'] = $id;
            $data['users_item'] = $this->users_model->getUsers($id);
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password1', 'Password', 'trim|required');
            $this->form_validation->set_rules('password2', 'Reenter Password', 'trim|required|matches[password1]');

            if ($this->form_validation->run() === TRUE) {
                
                
                // Change password with new value
                $result = $this->users_model->changePassword($id, $this->input->post('password1'));
                if ($result) { // Change OK, redirect to user profile
                        //Send an e-mail to the user requesting a new password
                        $this->load->library('email');
                        $this->email->set_newline("\r\n");  //Workaround FakeSMTP
                        $this->load->library('parser');
                        $target_user_email = $data['users_item']['lastname'];
                        $data = array(
                            'Title' => 'Your password has been reset',
                            'BaseURL' => base_url(),
                            'Firstname' => $data['users_item']['firstname'],
                            'Lastname' => $data['users_item']['lastname'],
                            'Login' => $data['users_item']['login'],
                            'Password' => $this->input->post('password1')
                        );
                        $message = $this->parser->parse('emails/password_forgotten', $data, TRUE);
                    if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE) {
                            $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
                        } else {
                        $this->email->from('do.not@reply.me', 'League Manager');
                        }
                        $this->email->to($target_user_email);
                        $this->email->subject('[League Manager] Your password has been reset');
                        $this->email->set_mailtype("html");
                        $this->email->message($message);
                        $this->email->send();
                        
                        $this->session->set_flashdata('msg', 'The password has been changed');
                        redirect(base_url() . 'users/edit/' . $id);
                } else { // Display error stay on same page
                    $this->session->set_flashdata('error', 'An error occurs changing the user password');  
                }  
            }
            
            $data['title'] = 'Reset user password';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('students_users/reset-password', $data);
            $this->load->view('templates/footer', $data);  
        }
    }

    /**
     * Form validation callback : prevent from login duplication
     * @param type $login
     * @return boolean true if the field is valid, false otherwise
     * @author Benoit Pitet
     */
    public function login_check($login) {
        if (!$this->users_model->isLoginAvailable($login)) {
            $this->form_validation->set_message('login_check', 'Username already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /**
     * Return the public user info form in read only mode
     * @param int $id User identifier
     */
    public function getPublicInfo($id) {
        //$this->auth->check_is_granted('edit_user');
        expires_now();
        $data = getUserContextData($this);
        
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            show_404();
        }
        $this->load->view('students_users/popup', $data);        
    }
        
    public function changepassword() {
        $data = getUserContextData($this);
        $this->load->model('users_model');
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('oldpassword','Old Password','trim|required');
        $this->form_validation->set_rules('password1','Password','trim|required');
        $this->form_validation->set_rules('password2','Reenter Password','trim|required|matches[password1]');

        if ($this->form_validation->run() == FALSE)
        {
            if ($this->input->method() == 'post') {
                 $this->session->set_flashdata('error', 'Bad data');   
            }            
        } else {
            // Check old password 
            if (! $this->users_model->checkCredentials($this->login, $this->input->post('oldpassword'))) {
                $this->session->set_flashdata('error', 'Wrong password');     
            }
            else
            {
               // Change password with new value
               $result = $this->users_model->changePassword($this->user_id, $this->input->post('password1'));
               if ($result) { // Change OK, redirect to user profile
                    $this->session->set_flashdata('msg', 'Your password has been changed');             
                    redirect(base_url() . 'users/edit/' . $this->user_id);
               }
               else // Display error stay on same page
               {
                   $this->session->set_flashdata('error', 'An error occurs changing your password');  
               }              
            } 
        }
        
        $data['title'] = 'Change password';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('students_users/change-password', $data);
        $this->load->view('templates/footer', $data);
        
        
    }

    public function myprofile($id) {
        $data = getUserContextData($this);
        $data['user'] = $this->students_model->getUsersStudentsWithBatch($this->session->userdata('id'));
        $data['title'] = 'My profile';
        //***
        $data['tutor_data'] = $this->students_model->m_tutor_data(); //get tutor of student from database
        $data['supervisor_data'] = $this->students_model->m_supervisor_data(); ///get supervisor of student from database
        ///****
        $data['user_id'] = $this->students_model->m_get_user_students($id); //get list of student from database
        $data['Major'] = $this->students_model->m_get_major(); //get major of students

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('students_users/myprofile', $data); //open form profile
        $this->load->view('templates/footer');
    }

    /**
     * check validation callback : prevent show validation if no update
     * @param type $editProfile_validation
     * @return message error
     * @author vin touch
     */
    function editProfile_validation($id) {
        $data = getUserContextData($this);
        $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('pnemail', 'PN Email', 'required|valid_email');
        $this->form_validation->set_rules('personalemail', 'Personal Email', 'required|valid_email');
        $this->form_validation->set_rules('skypeid', 'Skype ID', 'required');
        $result = $this->form_validation->run();

        if ($result) {
            $this->session->set_flashdata('msg', 'Your data update successful');
            $this->students_model->edit_profile($id);
            redirect(base_url());
        } else {
            $this->session->set_flashdata('error', 'Your data can not update');
            $this->myprofile($id);
        }
    }

    public function form_password() {
        $data = getUserContextData($this);
        $data['title'] = 'Change Your Password';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('students_users/change_password', $data);
    }

    /**
     * 
     * @param type $id
     * @author Sreyleang Seak
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
        $data['student_data'] = $this->students_model->m_stu_data();
        //***Seavmeng code
        $data['tutor_data'] = $this->students_model->m_tutor_data();
        $data['supervisor_data'] = $this->students_model->m_supervisor_data();
        ///****
        $data['title'] = 'Student detail information';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('students_users/stuDetail', $data);
        $this->load->view('templates/footer');
    }

}
