<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reminder_admin_model extends CI_Model {

    public function m_get_stu_data() {
        $query = "select *  from users us  
            inner join students st on st.UsersId = us.Id
            inner join batch ba on st.BatchId = ba.Id
            inner join survey sv on sv.BatchId = ba.Id 
            where  sv.IsAnswer = 0 and st.IsSend = 0
            group by us.Id
           ";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function m_get_stu_email_all() {
        $query = "select us.EmailPN,us.Id  from users us  
            inner join students st on st.UsersId = us.Id
            inner join batch ba on st.BatchId = ba.Id
            inner join survey sv on sv.BatchId = ba.Id 
            where  sv.IsAnswer = 0  
            group by us.Id
           ";
        $result = $this->db->query($query);
        return $result->result_array();
    }
    public function m_get_user($id) {
        $this->db->where('Id', $id);
        $result = $this->db->get('users');
        return $result->result_array();
    }

    public function m_add_reminder($subject, $message, $stu_id) {
        $sender = $this->session->userdata('firstname')."  ". $this->session->userdata('lastname');
        $query = "insert into reminder (subject , message ,stuId ,isReminder, sender ) values('$subject','$message',$stu_id, 1, '$sender')";   
        $this->db->query( "update students set IsSend = 1 where UsersId = $stu_id");
        $this->db->query($query);
    }
    
    public  function m_get_all_data($id) {
         $query = " select * from survey sv
                inner join batch bt on sv.BatchId = bt.Id
                inner join students st on bt.Id = st.BatchId
                inner join users us on st.UsersId = us.Id
                where st.UsersId = $id and sv.IsAnswer = 0;
            ";
        $result = $this->db->query($query);
        return $result->result_array();
        
    } 
}
