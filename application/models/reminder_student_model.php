<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reminder_student_model extends CI_Model {

    public function m_get_reminder_student($id) {
        $query = "select * from students stu
                inner join reminder rem on stu.UsersId = rem.stuId where rem.isReminder = 1 and rem.isRemove=0  and  stu.UsersId = $id";
        $result = $this->db->query($query); 
        return $result->result_array();
    }
    
    
    public function m_remove_message($id) {
        $query = "UPDATE reminder SET isRemove=1 WHERE  reminId=$id";
        return $this->db->query($query);   
    }
}
