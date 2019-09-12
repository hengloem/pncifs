<?php
/**
 * This model contains all functions for managing users
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */

class SurveyStudentAdmin_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        $this->load->database();
    }
    /**
     * m_get_survey_data to get new survey
     * @return type array
     * @author Sreyleang.SEAK
     * KEEP
     */
     public function m_get_years()
    {
        /**
         * select * from batch bat order by bat.Id desc;
         */
        $this->db->select('*');
        $this->db->from('batch bat');
        $this->db->order_by('bat.Id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    //#m_get_student : to get student that belong to a tutor
    public function m_get_student(){
        /**
         * #to get student that belong to a tutor
        select u.Id, concat(u.FirstName,' ',u.LastName) as 'Stdent name' from users u 
        inner join students st on u.Id = st.UsersId
        where st.TutorsId = 26;
         */
        $this->db->select('*');
        $this->db->from('students st','u.Id = st.UsersId','inner');
        $this->db->where('');
    }
    public function m_get_reported_student()
    {
        /**
         * select us.FirstName,us.LastName,que.QuestionTitle,ans.AnswerText,rep.ReportsText from users us 
            inner join students stu on stu.UsersId = us.Id 
            inner join batch bat on stu.BatchId = bat.Id
            inner join survey sur on sur.BatchId = bat.Id 
            inner join questions que on que.SurveyId = sur.Survey_Id
            inner join answers ans on ans.Question_Id = que.QuestionId
            inner join reports rep on rep.Answers_Id = ans.AnswersId where rep.IsReport = 1;
         */
        
        $this->db->select('*');
        $this->db->from('users us');
        $this->db->join('students stu','stu.UsersId = us.Id');
        $this->db->join('batch bat','stu.BatchId = bat.Id');
        $this->db->join('survey sur','sur.BatchId = bat.Id');
        $this->db->join('questions que','que.SurveyId = sur.Survey_Id');
        $this->db->join('answers ans','ans.Question_Id = que.QuestionId');
        $this->db->join('reports rep','rep.Answers_Id = ans.AnswersId');
        $this->db->where('rep.IsReport = 1');
        
          $query = $this->db->get();
        return $query->result_array();
    }
    /**
     * m_get_survey_by_batch for get survey by that user choose by batch
     * author sreyleang SEAK
     */
    
    public function m_get_survey_by_batch($batch)
    {
        #query in sql
        #select * from survey sur inner join batch bat on sur.BatchId = bat.Id where bat.Year = 2017;
        $this->db->select('*');
        $this->db->from('survey sur');
        $this->db->join('batch bat','sur.BatchId = bat.Id');
        $this->db->where("bat.Id = $batch");
        $query = $this->db->get();
        return $query->result_array();
    }
     
    public function m_getStudent_not_submit($survey)
    {
        /**
         * query in sql
         *  select * from students stu 
         * inner join batch bat on stu.BatchId = bat.Id 
            inner join survey sur on sur.BatchId = bat.Id 
            where sur.IsAnswer = 0 && sur.Survey_Id = 6 ;
         */
        $this->db->select('*');
        $this->db->from('users us');
        $this->db->join('students stu','stu.UsersId = us.Id');
        $this->db->join('batch bat','stu.BatchId = bat.Id');
        $this->db->join('survey sur','sur.BatchId = bat.Id ');
        $this->db->where('sur.IsAnswer =', 0)->where("sur.Survey_Id = $survey");
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function m_get_surveyAnswer($stu_id,$survey)
    {
        /**
         * sql query
         * select que.QuestionTitle,ans.AnswerText from users us 
            inner join students stu on stu.UsersId = us.Id
            inner join batch bat on stu.BatchId = bat.Id
            inner join survey sur on sur.BatchId = bat.Id
            inner join questions que on que.SurveyId = sur.Survey_Id
            inner join answers ans on ans.Question_Id = que.QuestionId
            where sur.Survey_Id = 4 && us.Id = 27;
         */
        
//        echo $stu_id.'<br/>';
//        echo $survey;exit();
//        $this->db->select('*');
//        $this->db->from('users us');
//        $this->db->join('students stu','stu.UsersId = us.Id');
//        $this->db->join('batch bat','stu.BatchId = bat.Id');
//        $this->db->join('survey sur','sur.BatchId = bat.Id');
//        $this->db->join('questions que','que.SurveyId = sur.Survey_Id');
//        $this->db->join('answers ans','ans.Question_Id = que.QuestionId ','left');
//        $this->db->where("sur.Survey_Id = $survey")->where("us.Id = $stu_id");
//        $query = $this->db->get();
        
        
        $query = "select  que.QuestionTitle , ans.AnswerText from users us 
            inner join students stu on stu.UsersId = us.Id
            inner join batch bat on stu.BatchId = bat.Id
            inner join survey sur on sur.BatchId = bat.Id
            inner join questions que on que.SurveyId = sur.Survey_Id
            left join answers ans on ans.Question_Id = que.QuestionId
            where stu.UsersId = $stu_id and sur.Survey_Id = $survey";
        
        $result = $this->db->query($query);
        return $result->result_array();
    }
    
}

