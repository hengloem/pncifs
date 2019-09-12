<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorsurvey_model extends CI_Model{
    /**
     * Default constructor
     */
    public function __construct() {
        $this->load->database();
    }
    /**
     * m_get_survey_belong_to_a_tutor used to get a list of survey with specific student  
     * @return Array record
     * @author Heng.LOEM
     */
    public function m_get_student_belong_to_a_tutor($id = 0) {
        /**
         * #query to get student that follow by a totur
            select u.Id, concat(u.FirstName,' ',u.LastName) as 'Stdent name' from users u 
            inner join students st on u.Id = st.UsersId
            where st.TutorsId = 26;
         */
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->join('students st','u.Id = st.UsersId','inner');
        if ($id === 0) {
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->where('st.TutorsId = ', $id);
        $query = $this->db->get();
        return $query -> result_array();
    }
    
    /**
     * m_get_survey_belong_to_a_student used to get a survey that belong to specific student name
     * @return Array record
     * @author Heng.LOEM
     */
    public function m_get_survey_belong_to_a_student($id){
        /**
         * #query to get a survey's student
            select st.UsersId, sv.SurveyTitle, sv.Description, sv.Deadline,b.Year from students st 
            inner join batch b on st.BatchId = b.Id
            inner join survey sv on b.Id = sv.BatchId
            inner join surveytypes svt on sv.SurveyTypesId = svt.Id
            where st.UsersId = 27;
         */
        $this->db->select('*');
        $this->db->from('students st');
        $this->db->join('batch b','st.BatchId = b.Id','inner');
        $this->db->join('survey sv','b.Id = sv.BatchId','inner');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->where('st.UsersId = ', $id)->where('sv.IsCheck != ', 1);
        $query = $this->db->get();
        return $query -> result_array(); 
    }
    //DATE Saturday 20, May 2017
    /**
     * m_get_new_survey used to get the last information about survey
     * @param $id
     * @return result_array
     * @author Heng LOEM
     */
    public function m_get_new_survey($id)
    {
        $this->db->select('*,count(sv.IsPublish) as "published" ');
        $this->db->from('survey sv');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->join('batch b','sv.BatchId = b.Id','inner');
        $this->db->join('students st','b.Id = st.BatchId','inner');
        $this->db->join('users us','us.Id = st.UsersId','inner');
        $this->db->where('sv.IsPublish = ', 1)->where('sv.IsCheck != ', 1)->where('st.UsersId = ',$id);
        $query = $this->db->get();
        return $query->result_array();
    }   
    /**try to get a group of tutor that have a student
     * @authur: Heng LOEM
     */
    public function m_get_group_student($id){
        /**
         * select * from students st group by st.TutorsId having st.TutorsId = 1 is not null;
         */
        $query = $this->db->query("select * from students st group by st.TutorsId having st.TutorsId = $id is not null");
        return $query->result_array();
    }
    /**
     * m_get_survey_preview : get a list of survey
     * @return Array_result
     * @author Heng.LOEM
     */
    public function m_get_survey_preview($id, $userId){
        /**
         * #query to get survey with student specific id
            select concat(us.FirstName, ' ', us.LastName) as "Student name", sv.SurveyTitle, sv.Description,svt.Name, sv.Deadline from survey sv
            inner join surveytypes svt on sv.SurveyTypesId = svt.Id
            inner join batch b on sv.BatchId = b.Id
            inner join students st on b.Id = st.BatchId
            inner join users us on us.Id = st.UsersId
            *where sv.Survey_Id = 1;
            *where st.UsersId = 27;
         */
        $this->db->select('*');
        $this->db->from('survey sv');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->join('batch b','sv.BatchId = b.Id','inner');
        $this->db->join('students st','b.Id = st.BatchId','inner');
        $this->db->join('users us','us.Id = st.UsersId','inner');
        $this->db->where('sv.Survey_Id = ', $id)->where('st.UsersId = ', $userId);//User student id example : id = 27
        $query = $this->db->get();
        return $query -> result_array();
    }
    
    /**
     * m_get_question_preview : get a list of question with specific student
     * @return Array_result
     * @author Heng.LOEM
     */
    public function m_get_question_preview($id, $userId){
        /**
         * #query to get a question belong to a specific student in a batch
            select q.QuestionId, q.Description as "Question Title" from questions q
            inner join survey sv on q.SurveyId = sv.Survey_Id
            inner join surveytypes svt on sv.SurveyTypesId = svt.Id
            inner join batch b on svt.Id = b.Id
            inner join students st on b.Id = st.BatchId
            *where sv.Survey_Id = 1;
            *where st.UsersId = 27;
         */
        $this->db->select('*');
        $this->db->from('questions q');
        $this->db->join('survey sv','q.SurveyId = sv.Survey_Id','inner');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->join('batch b','svt.Id = b.Id','inner');
        $this->db->join('students st','b.Id = st.BatchId','inner');
        $this->db->where('sv.Survey_Id = ', $id)->where('st.UsersId',$userId);
        $query = $this->db->get();
        return $query -> result_array();
    }
/**
     * m_get_answer_preview : used to retrieve an answer after student has sub
     * @return result_array
     * @param $id
     * @author Heng LOEM
     */
    public function m_get_answer_preview($id, $userId){
        /**
         * #query to retrieve question and answer with specific studetn $id
            select q.QuestionId, q.QuestionTitle as "Question Title", a.AnswerText as "Answers" from questions q
            inner join answers a on q.QuestionId = a.AnswerId
            *where q.SurveyId = 1; 
            *where a.Users_Id = 27;
         */
        $this->db->select('*');
        $this->db->from('questions q');
        $this->db->join('answers a', 'q.QuestionId = a.AnswersId', 'inner');
        $this->db->where('q.SurveyId =', $id)->where('a.Users_Id',$userId);
        $query = $this->db->get();
        return $query ->result_array();
    }
    /**
     * m_insert_report used used to insert data to table report
     * @param $id
     * @author Heng LOEM
     */
    public function m_insert_report($id,$reportsText){
        $isReport = 1;
        $this->db->insert('reports',array(
            'ReportsText'=>$reportsText,
            'Answers_Id'=>$id,
            'IsReport'=> $isReport));
        return $this->db->insert_id();
    }    
    
    /**
     * m_get_checked_survey used to get a survey that tutor has completed
     * @param $id
     * @author Heng LOEM
     */
    public function m_get_checked_survey($id){
        /**
         * select * from students st 
            inner join batch b on st.BatchId = b.Id
            inner join survey sv on b.Id = sv.BatchId
            inner join surveytypes svt on sv.SurveyTypesId = svt.Id
            where st.UsersId = 27 and sv.IsCheck = 1;
         */
        $this->db->select('*');
        $this->db->from('students st');
        $this->db->join('batch b','st.BatchId = b.Id','inner');
        $this->db->join('survey sv','b.Id = sv.BatchId','inner');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->where('st.UsersId = ', $id)->where('sv.IsCheck = ', 1);
        $query = $this->db->get();
        return $query -> result_array();
    }
    /**
     * m_checked_survey : get a list of survey that tutor has checked and he want to preview it.
     * @return Array_result
     * @author Heng.LOEM
     */
    public function m_checked_survey($id, $userId){
        $this->db->select('*');
        $this->db->from('survey sv');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->join('batch b','sv.BatchId = b.Id','inner');
        $this->db->join('students st','b.Id = st.BatchId','inner');
        $this->db->join('users us','us.Id = st.UsersId','inner');
        $this->db->where('sv.Survey_Id = ', $id)->where('st.UsersId = ', $userId);
        $query = $this->db->get();
        return $query -> result_array();
    }
    /**
     * m_get_checked_report used to get a list of report with q and a
     * @param type $id
     * @param type $userId
     * @return type
     */
    public function m_get_checked_report($id, $userId){
        $this->db->select('*');
        $this->db->from('questions qt');
        $this->db->join('answers ans','qt.QuestionId = ans.Question_Id','inner');
        $this->db->join('reports rp','ans.AnswersId = rp.Answers_Id','inner');
        $this->db->where('qt.SurveyId = ', $id)->where('ans.Users_Id',$userId);
        $query = $this->db->get();
        return $query -> result_array();
    }
    
    /**
     * m_update_to_checked_survey used to update survey to checked
     * @param $id get from survey_id
     * @author Heng LOEM
     */
    public function m_update_to_checked_survey($id){
        $this->db->where('sv.Survey_Id = ', $id);
        $this->db->update('survey sv',array('sv.IsCheck' => 1));
    }
    
}
