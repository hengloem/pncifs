<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Supervisor_model extends CI_Model{
    /**
     * Default constructor
     * **/
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /**
     * get the list of supervisor data from database
     * @return array
     * @author Heng.LOEM
     * **/
    public function m_get_supervisor_data() {
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->join('supervisor s','u.Id = s.UsersId','inner');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**used to insert new record to table user
     * @return TRUE or FALSE
     * @author Heng.LOEM
     * **/
    public function m_insert_supervisor_user(){
        $this->FirstName = $_POST['FirstName'];
        $this->LastName = $_POST['LastName'];
        $this->EmailPN = $_POST['EmailPN'];
        $this->Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        //insert value to users table
        $this->db->insert('users', $this);
    }
    /**
     * used to insert new record to table supervisor
     * @return TRUE or FALSE
     * @author Heng.LOEM
     */
    public function m_insert_supervisor(){
        $sup->Companyname = $_POST['Companyname'];
        $sup->Position = $_POST['Position'];
        $sup->Departmentname = $_POST['Departmentname'];
        $sup->Emailpersonal = $_POST['Emailpersonal'];
        $sup->PhoneNumber = $_POST['PhoneNumber'];
        //insert value to supervisor table with last id of users table
        $supervisor_last_id = $this->db->insert_id();
        $sup->UsersId = $supervisor_last_id;
        //inserting
        $this->db->insert('supervisor', $sup);        
    }
    //===========================================================================>
    /**
     * m_delete_supervisor_in_stu used to delete supervisor id in table student
     * @param type $id
     * @return boolean
     * @author Heng.LOEM
     */
    public function m_delete_supervisor_in_stu($id){
        $data = array(
            'SupervisorId' => null
        );
        $this->db->where('SupervisorId', $id);
        if ($this->db->update('students', $data)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * m_delete_supervisor used to delete supervisor id in table user
     */
    public function m_delete_supervisor($id){
        $this->db->where('UsersId', $id);
        return $this->db->delete('supervisor');
    }
    //===========================================================================>
    /**
     * m_update_supervisor_user used to update users table field
     * @param type $id Description get value from post
     * @author Heng.LOEM
     */
    public function m_update_supervisor_user($id){
        $this->FirstName = $_POST['FirstName'];
        $this->LastName = $_POST['LastName'];
        $this->EmailPN = $_POST['EmailPN'];
        $this->db->where('users.Id', $id);
        //update value to users table
        if ($this->db->update('users', $this)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * m_update_supervisor_field used to update supervisor table field
     * @param type $id Description get value from post
     * @author Heng.LOEM
     */
    public function m_update_supervisor_field($id){
        
        $sup->Companyname = $_POST['Companyname'];
        $sup->Position = $_POST['Position'];
        $sup->Departmentname = $_POST['Departmentname'];
        $sup->Emailpersonal = $_POST['Emailpersonal'];
        $sup->PhoneNumber = $_POST['PhoneNumber'];
        //update value to supervisor table with last id of users table        
        $this->db->where('supervisor.UsersId', $id);
        if ($this->db->update('supervisor', $sup)) {
            return true;
        } else {
            return false;
        }
    }
}
