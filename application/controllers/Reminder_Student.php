<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_Student extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() { 
        parent::__construct();
        checkLogin($this);
        $this->load->helper('url_helper');
        $this->load->model('survey_model');
        $this->load->model('tutorsurvey_model');
        $this->load->model('batchs_model');
        $this->load->model('StudenSurvey_model');
        $this->load->model('reminder_student_model');
    }

    public function index() { 

        $data = getUserContextData($this);
        $data['reminder_data'] = $this->reminder_student_model->m_get_reminder_student($this->session->userdata('id'));
        $studentid = $this->session->userdata('id');
        $data['get_new_survey_data'] = $this->StudenSurvey_model->m_get_new_survey($studentid);
        
        $data['title'] = "List of Student don't complet survey" ;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('reminder_student/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function form_stu_reminder($id){
        $data = getUserContextData($this); 
        
        $data['title'] = 'Form Reminder';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('reminder_student/form_reminder', $data);
        $this->load->view('templates/footer');
    }
    
    
    function delete($id) { 
       $remove =  $this->reminder_student_model->m_remove_message($id);
        if ($remove) {
            $this->session->set_flashdata('msg', 'The message remove successfull.');
            redirect('reminder_student');
        } else {
            $this->session->set_flashdata('error', 'The message remove.');
            redirect('reminder_student');
        } 
    }

    

}
