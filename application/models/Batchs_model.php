<?php

/**
 * This model contains all functions for managing batches
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
class Batchs_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * Get the list of batches or one of them
     * @param int $id optional id of one batch
     * @return array record of batches
     * @author Benoit Pitet
     */
    public function getItems($id = 0) {
        $this->db->select('batch.*');
        if ($id === 0) {
            $query = $this->db->get('batch');
            return $query->result_array();
        }
        $query = $this->db->get_where('batch', array('batch.Id' => $id));
        return $query->row_array();
    }
    
    /**
     * Get the list of batch
     * @param int $id
     * @return array record of batch
     * @author Heng.LOEM
     * * */
    public function m_get_batch() {
        $this->db->select('*');
        $this->db->from('batch bat');
        $this->db->order_by('bat.Id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * To get all data from Table Student
     * @author Seavmeng Chham
     */
    public function m_get_batch_in_student() {
        $this->db->distinct();
        $this->db->select('BatchId');
        $this->db->from('students');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get the batches corresponding to the code given as parameter
     * @param string $code of one batch
     * @return one batch array data or null
     * @author Benoit Pitet
     */
    public function getBatchIdByCode($code) {
        $this->db->select('batch.*');
        $query = $this->db->get_where('batch', array('batch.Code' => $code));
        $res = $query->row();
        if ($res) {
            return $res->Id;
        } else {
            return null;
        }
    }

    /**
     * Delete a batch from the database
     * @param int $id identifier of the item
     * @author Benoit Pitet
     */
    public function deleteItem($id) {
        $query = $this->db->delete('batch', array('Id' => $id));
    }

    /**
     * Insert a new item into the database. Inserted data are coming from a HTML form post data
     * @return new item Id
     * @author Benoit Pitet
     */
    public function insertItem($code) {

        $datetime1 = DateTime::createFromFormat('Y-m-d', $this->input->post('startdate'))->format('Y-m-d');
        $datetime2 = DateTime::createFromFormat('Y-m-d', $this->input->post('enddate'))->format('Y-m-d');
        
        $data = array(
            'Year' => $this->input->post('year'),
            'InternshipStartDate' => $datetime1,
            'InternshipEndDate' => $datetime2,
            'Code' => $code,
        );
        $this->db->insert('Batch', $data);
        return $this->db->insert_id();
    }

    public function unique_code($l = 8) {
        return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    }

    /**
     * Update a given item in the database. Update data are coming from a HTML form
     * @return type
     * @author Benoit Pitet
     */
    public function updateItem() {

        $datetime1 = DateTime::createFromFormat('Y-m-d', $this->input->post('startdate'))->format('Y-m-d');
        $datetime2 = DateTime::createFromFormat('Y-m-d', $this->input->post('enddate'))->format('Y-m-d');
        ;
        $data = array(
            'Year' => $this->input->post('year'),
            'InternshipStartDate' => $datetime1,
            'InternshipEndDate' => $datetime2,
        );
        $this->db->where('Id', $this->input->post('id'));
        $result = $this->db->update('Batch', $data);
        return $result;
    }

    /**
     * get batch of year
     * @return type
     * @author vin touch
     */
    public function m_get_year() {
        $query = $this->db->get('batch');
        return $query->result_array();
    }

    /**
     * get slide presentation of batch by id
     * @return type
     * @author vin touch
     */
    public function get_slide_present($id) {
        $this->db->where('Id', $id);
        $query = $this->db->get('batch');
        return $query->result_array();
    }

    /**
     * get batch of upload to table by year
     * @return type
     * @author vin touch
     */
    function m_upload($table, $data) {
        $this->db->where('id', $_SESSION['selected_id']);
        return $this->db->update($table, $data);
    }

    /**
     * get batch of delete data 
     * @return type
     * @author vin touch
     */
    function m_delete_file($table,$id) {
        $this->db->where('Id',$id);
        return $this->db->delete($table);
        
    }
    
    function m_update_file_name($id,$data){
        $this->db->where('Id',$id);
        return $this->db->update('batch',$data);
    }
  

}
