<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentsTutorsAssoc extends CI_Controller {

    /**
     * Default constructor
     * @author Heng.LOEM
     */
    public function __construct() {
        parent::__construct();
        checkLogin($this);
        $this->load->model('students_model');
        $this->load->model('batchs_model');
        $this->load->model('users_model');
        $this->load->model('tutors_model');
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
        //remember the selected
        //GET batch $id from dropdown list, only get an Id when user has selectet.
        $id = $this->input->post('select');
        //$_SESSION declared to catch an id and store it as SESSION
        $_SESSION['current_select'] = $id;
        //If id == null, it will show current year
        if($id == NULL){
            // index declared for store batch table, we will loop it to catch the first index from batch table
            $index = $this->batchs_model->m_get_batch();
            foreach ($index as $index_data){
                $id = $index[0]['Id'];
            }
            //get student list//get from student_model
            $data['users'] = $this->students_model->getUsersStudentsWithBatch($id);
        }else{
            //$_SESSION['is_selected'] = $_POST['select'];
            //id has value, passed to get batch
            //get student list//get from student_model
            $data['users'] = $this->students_model->getUsersStudentsWithBatch($id);
        }
        //*********
        //get batch list//get from batchs_model
        $data['batch_data'] = $this->batchs_model->m_get_batch();
        //get tutors list//get from users_model
        $data['tutors_data'] = $this->tutors_model->m_get_data();

        $data['title'] = 'Associate students and tutors';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('students_tutors_assoc/index', $data);
        $this->load->view('templates/footer');
    }
/**
 * To associate student with tutor
 * @author Seavmeng Chham
 * 
 */
    public function update_student() {
        $new_stu_id = array();
        $new_tutor_id = array(); 
        $new_tutor_id = $this->input->post('select');
        $old_tutor_id = $this->input->post('old_tutor_id'); 
        foreach ($new_tutor_id as $key => $value) {
            if ($new_tutor_id[$key] != $old_tutor_id[$key]) {
                $stu_id = $this->input->post('user_id');

                array_push($new_stu_id, $stu_id[$key]);
                array_push($new_tutor_id, $new_tutor_id[$key]); 
            }
        }
//         var_dump($new_stu_id);
//         var_dump($new_tutor_id);
        $updatesucc = $this->students_model->m_update_stu_tutor($new_stu_id, $new_tutor_id); 
        if ($updatesucc === true) {
            $this->session->set_flashdata('msg', 'You have sucessful associate student with tutor ');
            redirect(base_url() . "studentstutorsassoc");
        } else {
            $this->session->set_flashdata('error', 'You are unsucessful associate student with tutor');
            redirect(base_url() . "studentstutorsassoc");
        } 
    }

}
