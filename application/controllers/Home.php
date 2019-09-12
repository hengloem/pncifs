<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	
	/**
	* Default constructor
	     */
	public function __construct() {
		parent::__construct();
		checkLogin($this);
                $this->load->model('StudenSurvey_model');
                $this->load->model('Tutorsurvey_model');
                $this->load->model('Adminsurvey_model');
                $this->load->model('reminder_student_model');
	}
	
	

	public function index() {
		$data = getUserContextData($this);
                /**
                * get new survey alert message for student account [Login successfully]
                 * @author Sreyleang SEAK
                */
                $studentid = $this->session->userdata('id');
                $data['get_new_survey_data'] =  $this->StudenSurvey_model->m_get_new_survey($studentid);
                

                /**
                 * if tutor doesn't have a student to follow up, the menu Survey will be hide
                 */
                $tutorid = $this->session->userdata('id');
                $data['tutor_student_data'] = $this->Tutorsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
                
                /**TUTOR PART
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
                
                /**ADMIN PART
                 * get new survey for admin as tutor account [Login successfull]
                 * @author Heng LOEM
                 */
                //get group of tutor that have a student to follow up
                $stuIndex = $this->Adminsurvey_model->m_get_group_student($tutorid);
                foreach ($stuIndex as $index_stu){
                    $stuId = $index_stu['UsersId'];
                }
                $data['get_new_survey'] = $this->Adminsurvey_model->m_get_new_survey($stuId);
                
                //$tutorid = $this->session->userdata('id');
                //$data['tutor_student_data'] = $this->Tutorsurvey_model->m_get_student_belong_to_a_tutor($tutorid);
                /**
                 * add default notification in reminder student.
                 */
                 $data['reminder_data'] = $this->reminder_student_model->m_get_reminder_student($this->session->userdata('id'));

		$data['title'] = 'Home page';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/footer', $data);
		
		
	}
	
	
}
