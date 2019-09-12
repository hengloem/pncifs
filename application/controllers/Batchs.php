<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Batchs extends CI_Controller {
	
	
	/**
	* Default constructor
	     */
	public function __construct() {
		parent::__construct();
		checkLogin($this);
		$this->load->model('batchs_model');
        $this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
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
                
		$data['title'] = 'Students Batches';  
//                $data['batch_student'] = $this->batchs_model->m_get_batch_in_student();
		$data['batches'] = $this->batchs_model->getItems();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('batchs/index', $data);
		$this->load->view('templates/footer', $data);
		
		
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
                
		$data['title'] = 'Add batch';
		$this->form_validation->set_rules('year', 'Year', 'required|integer');
        $this->form_validation->set_rules('startdate', 'Start Date', 'required');
        $this->form_validation->set_rules('enddate', 'End Date', 'required');
         
        if ($this->form_validation->run() === FALSE) {
            log_message('info', 'Form not validated');        
            
        } else {
            log_message('info', 'Form validated');    
            // Calling model method to create item
			$code = $this->batchs_model->unique_code();
            $newId = $this->batchs_model->insertItem($code);  
            // Create new item 
            if ($newId) {
                $this->session->set_flashdata('msg', 'The new batch has been created. The code to give to students is: '. $code);
                redirect('batchs');
            }
            else
            {
                $this->session->set_flashdata('msg', 'The batch could not be created');
            }            
        }

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('batchs/add', $data);
		$this->load->view('templates/footer', $data);
		
	}


    public function delete($id) { 
        
		// Test if item exists
        $data = $this->batchs_model->getItems($id); 
        if (empty($data['Id'])) {
            log_message('debug', '{controllers/batchs/delete} batch not found');
            show_404();
        } else {
            $this->batchs_model->deleteItem($id);
        }
        log_message('info', 'Batch #' . $id . ' has been deleted by user #' . $this->session->userdata('id'));
        $this->session->set_flashdata('msg', 'The batch has been successfully deleted');
        redirect('batchs');
    }




	public function edit($batchId) {
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
                
		$data['title'] = 'Edit batch';
		$this->form_validation->set_rules('year', 'Year', 'required|integer');
        $this->form_validation->set_rules('startdate', 'Start Date', 'required');
        $this->form_validation->set_rules('enddate', 'End Date', 'required');
         
        if ($this->form_validation->run() === FALSE) {
			$item = $this->batchs_model->getItems($batchId);
			$data = array_merge($data,$item);
            log_message('info', 'Form not validated');
        } else {
            log_message('info', 'Form validated');    
			// Update item
            $res = $this->batchs_model->updateItem();  
            if ($res) {
                $this->session->set_flashdata('msg', 'The batch has been edited.');
                redirect('batchs');
            }
            else
            {
                $this->session->set_flashdata('msg', 'The batch could not be updated');
            }            
        }

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('batchs/edit', $data);
		$this->load->view('templates/footer', $data);
		
	}
	
	
}
