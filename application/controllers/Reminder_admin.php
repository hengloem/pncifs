<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_admin extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->helper('url_helper');
        $this->load->model('reminder_admin_model');
        //load library email
        $this->load->library('email');
    }

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
        
        $data['stu_data'] = $this->reminder_admin_model->m_get_stu_data();
        
//        foreach($data['stu_data'] as $rows) {
//        echo $rows['isReminder'];
//            echo '<br/>';
//        }
//        exit;
        $data['title'] = 'Reminder';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('reminder_admin/index', $data);
        $this->load->view('templates/footer');
    }
/**
 * Send reminder to all student
     * @return boolean  true:can send,false:cannot send
     * @author Seavmeng chham
     */
    public function c_send_reminder() {
        $message = $this->input->post('message');
        $subject = $this->input->post('subject');

        $config['smtp_user'] = $this->session->userdata('email');
        $config['smtp_pass'] = $this->session->userdata('password');
        $this->email->initialize($config); //initialize config

        $data['list_of_emails'] = $this->reminder_admin_model->m_get_stu_email_all();
        // to add reminder message to the system
        foreach ($this->reminder_admin_model->m_get_stu_email_all() as $stu_value) {
            $stu_id = $stu_value['Id'];
            $this->reminder_admin_model->m_add_reminder($subject, $message, $stu_id);
         }

        //Get data from model as one dimensional string
        $email_list = implode(', ', array_column($data['list_of_emails'], 'EmailPN')); //Implode array elements with comma as separator
        $config['smtp_user'] = $this->session->userdata('email');
        $config['smtp_pass'] = $this->session->userdata('password');

        $this->email->initialize($config);

        $this->email->from($this->session->userdata('email'), $this->session->userdata('firstname'));
        $this->email->to($email_list);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('msg', 'The message has been sent successfull.');
            redirect('reminder_admin');
        } else {
            $this->session->set_flashdata('error', 'Error password. You should use password like your gmail account');
            redirect('reminder_admin');
        }
    }

    /**
     * Send reminder to student by selected who
     * student you want to send to.
     * @return boolean
     * @author Seavmeng Chham
     */
    public function c_send_reminder_select() {

        $select = $this->input->post('emailStu'); // the email of students
        $message = $this->input->post('message');
        $subject = $this->input->post('subject');
      
        $config['smtp_user'] = $this->session->userdata('email');
        $config['smtp_pass'] = $this->session->userdata('password');
        $this->email->initialize($config);
         
        $stu_email = $this->reminder_admin_model->m_get_stu_email_all();
        //// add reminder to system. 
        $emlist = array();
        foreach($stu_email as $key){
            for($j=0;$j<count($select);$j++) {
                if($select[$j] == $key['Id']) { 
                    array_push($emlist, $key['EmailPN']); 
                    $stu_id = $key['Id'];
                    $this->reminder_admin_model->m_add_reminder($subject,$message, $stu_id);

                } 
            }
        }  
        $email_list = implode(', ', $emlist);  

        $this->email->initialize($config);
        $this->email->from($this->session->userdata('email'), $this->session->userdata('firstname'));// set admin email and password
        
        $this->email->to($email_list);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('msg', 'The message has been sent successfull.');
            redirect('reminder_admin');
        } else {
            $this->session->set_flashdata('error', 'Error password. You should use password like your gmail account');
            redirect('reminder_admin');
        }
    }

    public function get_survey_data($id) { 
        $data['survey_data'] = $this->reminder_admin_model->m_get_all_data($id);
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
        $data['title'] = "List survey student didn't complete";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('reminder_admin/list_survey', $data);
        $this->load->view('templates/footer');
    }

}
