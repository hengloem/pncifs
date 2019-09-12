<?php
/**
 * This model contains all functions for managing users
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */

class StudenSurvey_model extends CI_Model {

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
    public function m_get_survey_data($id)
    {
        /**
         * select * from students st 
        inner join batch b on st.BatchId = b.Id
        inner join survey sv on b.Id = sv.BatchId
        inner join surveytypes svt on sv.SurveyTypesId = svt.Id
        where st.UsersId = 27;
         */
        $this->db->select('*');
        $this->db->from('survey sv');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->join('batch b','sv.BatchId = b.Id','inner');
        $this->db->join('students st','b.Id = st.BatchId','inner');
        $this->db->join('users us','us.Id = st.UsersId','inner');
        $this->db->where('st.UsersId = ', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * m_get_done_survey to get all the survey that the student has completed
     * @return type array
     * @author Sreyleang.YOUN
     * 
     * Note : ...KEEP
     */
    public function m_get_done_survey($id){
        $this->db->select('*');
        $this->db->from('survey s');
        $this->db->join('surveytypes', 'surveytypes.Id = s.SurveyTypesId','inner');
        $this->db->join('batch bat', 's.BatchId = bat.Id','inner');
        $this->db->join('students stu','stu.BatchId = bat.Id','inner'); 
        $this->db->where('s.IsAnswer = ', 1)->where('stu.UsersId = ',$id);
        $query = $this->db->get();
        return $query->result_array();
    }


    /**
     * m_get_old_survey to get old survey after student has answer
     * @return type array
     * @author Sreyleang.SEAK
     * 
     * Note : This function is undering investigation, for it is waiting table answer from database
     */
    public function m_update_to_done_survey($id){
        $this->db->where('sv.Survey_Id = ', $id);
        $this->db->update('survey sv',array('sv.IsAnswer' => 1));
    }
    
    /**
     * m_get_new_survey used to get the last information about survey
     * @param $id
     * @return result_array
     * @author Sreyleang.SEAK
     * KEEP
     */
    public function m_get_new_survey($id)
    {
        /**
         * select *,count(sv.IsPublish) from students st 
        inner join batch b on st.BatchId = b.Id
        inner join survey sv on b.Id = sv.BatchId
        where st.UsersId = 27 and sv.IsPublish = 1;
         */
        $this->db->select('*,count(sv.IsPublish) as "publishdata" ');
        $this->db->from('students st');
        $this->db->join('batch b','st.BatchId = b.Id','inner');
        $this->db->join('survey sv','b.Id = sv.BatchId','inner');
        $this->db->where('st.UsersId = ', $id)->where('sv.IsPublish = ',1)->where('sv.IsAnswer != ', 1);
        $query = $this->db->get();
        return $query->result_array();
    }    
    /**
     * m_get_survey used to get a survey description
     * @return type result_array
     * @param $id
     * @author: Sreyleang SEAK
     */
    public function m_get_survey($id){
        /**
         * 1. select * from survey sv
        inner join surveytypes svt on sv.SurveyTypesId = svt.Id
        where sv.Survey_Id = 3;
         */
        $this->db->select('*');
        $this->db->from('survey sv');
        $this->db->join('surveytypes svt','sv.SurveyTypesId = svt.Id','inner');
        $this->db->where('sv.Survey_Id = ', $id);
        $query = $this->db->get();
        return $query -> result_array();
    }
    /**
     * m_get_description used to get question list
     * @return type result_array
     * @param $id
     * @author: Sreyleang SEAK
     KEEP*/
    public function m_get_description($id)
    {   
        $this->db->select('*');
        $this->db->from('questions q');
        $this->db->where('q.SurveyId = ',$id); 
        $query = $this->db->get();
        return $query -> result_array();
    }
    /**
     * this function is for add answer to the database
     */
    public function m_add_answer($quesIdHidden,$answerText,$studentid)
    {
        //$Answer=$this->input->post('AnswerText');
        if($this->input->post('Isreturn')) {
            $isreturn = 1;
        }else {
            $isreturn = 0;
        }
        $data = array(
        'Isreturn'=>$isreturn,
        'AnswerText'=>$answerText,
        'Question_Id'=>$quesIdHidden,
        'Users_Id'=>$studentid
        );
        
       $this->db->insert('answers',$data);
       return $this->db->insert_id();
        }     
    /**
     * m_update_survey_to_save is used to update survey to save, if(IsSave ==  TRUE):update
     * @param type $quesIdHidden
     * @param type $answerText
     * @param type $studentid
     * @return type
     */
        public function m_update_survey_to_save($id){
            $this->db->where('sv.Survey_Id = ', $id);
            $this->db->update('survey sv',array('sv.IsSave' => 1));
        }
    /**
     * m_submit_answer used to submit the survey after the survey has completed all question
     * @param type $quesIdHidden
     * @param type $answerText
     * @param type $studentid
     * @return type result_array
     */
        public function m_submit_answer($quesIdHidden,$answerText,$studentid)
        {
            if($this->input->post('Isreturn')) {
                $isreturn = 1;
            }else {
                $isreturn = 0;
            }
            $data = array(
            'Isreturn'=>$isreturn,
            'AnswerText'=>$answerText,
            'Question_Id'=>$quesIdHidden,
            'Users_Id'=>$studentid
            );
            $this->db->insert('answers',$data);
            return $this->db->insert_id();
        }     
       public function m_get_answer($id)
       {
            $query = "select * from answers ans 
            inner join questions que on ans.Question_Id = que.QuestionId where  que.SurveyId = $id;";
            $result =     $this->db->query($query);
            return $result->result_array();

       }
       public function m_update_answer($answerText,$answerId)
       {
            if($this->input->post('Isreturn')) {
             $isreturn = 1;
            }else {
                $isreturn = 0;
            }
            $data = array(
            'Isreturn'=>$isreturn,
            'AnswerText'=>$answerText
            );
            $this->db->where('AnswersId' , $answerId);
            $this->db->update('answers',$data);
            return true;
       }
}

