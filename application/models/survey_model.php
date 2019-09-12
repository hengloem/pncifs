<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class survey_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * m_get_survey_by_tutor_data used to get a list of survey 
     * @return Array record
     * @author seavmeng.chham
     */
    public function m_get_survey_type() {
        $query = $this->db->get('surveyTypes');
        return $query->result_array();
    }

    public function m_add_survey() {
        if ($this->input->post('publish')) {
            $IsPublish = '1';
        } else {
            $IsPublish = '0';
        }
        $array_survey = array(
            'SurveyTitle' => $this->input->post('title'),
            'Description' => $this->input->post('description'),
            'Deadline' => $this->input->post('deadline'),
            'SurveyTypesId' => $this->input->post('surveyType'),
            'BatchId' => $this->input->post('batch'),
            'IsPublish' => $IsPublish
        );

        $this->db->insert('survey', $array_survey);
        return $this->db->insert_id();
    }

    public function m_add_question($array_ques_id, $array_ques, $surveyTypeId, $IsMandatory) {
        for ($i = 0; $i < count($array_ques_id); $i++) {
            $this->db->insert('questions', array('Order' => $array_ques_id[$i],
                'QuestionTitle' => $array_ques[$i],
                'Ismandatory' => $IsMandatory[$i],
                'SurveyId' => $surveyTypeId));
        } 
        $this->db->query("UPDATE students SET IsSend = 0 ");
        return true;
    }

    /**
     * 
     * @return type
     * @author Seavmeng Chham
     */
    public function m_get_survey() {
        if ($this->input->post('batch')) {
            $this->db->where('BatchId', $this->input->post('batch'));
            $result = $this->db->get('survey');
            return $result->result_array();
        }
        $current_batch = $this->m_get_max_batch();
        foreach ($current_batch as $key => $value) {
            $this->db->where('BatchId', $current_batch[$key]);
        }

        $query = $this->db->get('survey');
        return $query->result_array();
    }

    public function m_get_max_batch() {
        $query = $this->db->query('select max(s.BatchId) from survey s');
        return $query->row_array();
    }

    public function m_delete_survey($id) {
        $this->db->delete('questions', array('SurveyId' => $id));
        $this->db->delete('survey', array('Survey_Id' => $id));
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function m_get_question_survey($id) {
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('SurveyId', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function m_get_survey_by_id($id) {
        $this->db->select('*');
        $this->db->from('survey');
        $this->db->where('Survey_Id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function m_update_survey($id) {
        if ($this->input->post('publish')) {
            $IsPublish = '1';
        } else {
            $IsPublish = '0';
        }
        $array_survey = array(
            'SurveyTitle' => $this->input->post('title'),
            'Description' => $this->input->post('description'),
            'Deadline' => $this->input->post('deadline'),
            'SurveyTypesId' => $this->input->post('surveyType'),
            'BatchId' => $this->input->post('batch'),
            'IsPublish'=>$IsPublish
        );
        $this->db->where('Survey_Id', $id);
        $this->db->update('survey', $array_survey);
        return true;
    }

    public function m_update_question($ques_id, $order, $question_text , $isMan) {
        $query = "update questions que set que.QuestionTitle = '$question_text', que.Order = $order, que.Ismandatory = '$isMan' where que.QuestionId = $ques_id ; ";
        $this->db->query($query);
    }

    public function m_insert_question($question_text, $order, $survey_id,$isMan) {
        $this->db->insert('questions', array('Ismandatory'=>$isMan,'QuestionTitle' => $question_text, 'Order' => $order, 'SurveyId' => $survey_id));
        return $this->db->insert_id();
    }

//    public function m_update_question($ques_id, $array_mandatory, $array_ques) {
//        for ($i = 0; $i < count($array_ques); $i++) {
//            $query = "update questions set Ismandatory = '$array_mandatory[$i]',"
//                    . "Description = '$array_ques[$i]' where QuestionId = $ques_id[$i] ; ";
//            $this->db->query($query);
//        }
//        return true;
//    }
}
