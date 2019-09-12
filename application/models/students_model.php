<?php

class Students_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        $this->load->database();
    }
    
    /**
     * get student with batch 
     * @author seavmeng.chham
     * created : 31/05/2017
     */
    public function get_student_with_batch($id) {
         $this->db->select('*');
        $this->db->from('Students s');
        $this->db->join('Users u', 'u.Id = s.UsersId');
        $this->db->join('Batch b', 'b.Id = s.BatchId');
        $this->db->where('s.UsersId = ' . $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    /**
     *  
     * @author Seavmeng Chham
     */
    public function m_update_stu_tutor($stu_id, $new_tutor) {
        for ($i = 0; $i < count($stu_id); $i++) {
            $this->db->set('TutorsId', $new_tutor[$i]);
            $this->db->where('UsersId', $stu_id[$i]);
            $this->db->update('students');
        }
        return true;
    }

    /**
     * Get the list of students or one of them
     * @param int $id optional id of one them
     * @return array record of students
     * @author Benoit Pitet
     */
    public function getStudents($id = 0) {
        $this->db->select('students.*');
        if ($id === 0) {
            $query = $this->db->get('students');
            return $query->result_array();
        }
        $query = $this->db->get_where('students', array('students.UsersId' => $id));
        return $query->row_array();
    }

    public function IsUserStudent($id) {
        $res = $this->getStudents($id);
        if (count($res) > 0) {
            return true;
        }

        return FALSE;
    }

    /**
     * Insert a new user into the database. Inserted not in parameter are coming from a HTML form
     * @return true or false
     * @author Benoit Pitet
     */
    public function setStudents($userId, $batchId, $companyTutorsId = null, $tutorsId = null) {

        $data = array(
            'UsersId' => $userId,
            'EmailPersonal' => $this->input->post('personnalemail'),
            'Major' => $this->input->post('major'),
            'BatchId' => $batchId,
            'SupervisorId' => $companyTutorsId,
            'TutorsId' => $tutorsId
        );
        $this->db->insert('students', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    /**Update : 28/05/2017: 19:50pm
     * Get the list of students with users account informations
     * @param int $id optional id of one them
     * @return array record of students
     * @author Heng LOEM
     */
    public function getUsersStudentsWithBatch($id = 0) {
        //select minimum year from batch student
        //$this->db->select_min('Year');
        /**
         * select * from students st
        inner join users u on u.Id = st.UsersId
        inner join batch b on b.Id = st.BatchId
        where b.Id = 1;
         */
        $this->db->select('*');
        $this->db->from('Students s');
        $this->db->join('Users u', 'u.Id = s.UsersId');
        $this->db->join('Batch b', 'b.Id = s.BatchId');
        if ($id === 0) {
            $query = $this->db->get();
            //var_dump($this->db->last_query());
            return $query->result_array();
        }
        $this->db->where('b.Id = ' . $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Update a given item in the database. Update data are coming from a HTML form
     * @return type
     * @author Benoit Pitet
     */
    public function updateStudent($userId, $batchId, $companyTutorsId = null, $tutorsId = null) {

        $data = array(
            'UsersId' => $userId,
            'BatchId' => $batchId,
            'EmailPersonal' => $this->input->post('personnalemail'),
            'Major' => $this->input->post('major'),
            'BatchId' => $batchId,
            'SupervisorId' => $companyTutorsId,
            'TutorsId' => $tutorsId
        );
        $this->db->where('UsersId', $userId);
        $result = $this->db->update('Students', $data);
        return ($this->db->error()['code'] == 0);
    }

    /**
     * Delete an item from the database
     * @param int $id identifier of the item
     * @author Benoit Pitet
     */
    public function deleteItem($id) {
        $this->db->delete('reminder',array('stuId'=> $id));
        $this->db->delete('students', array('UsersId' => $id));
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get an students from the database
     * @param int $id identifier of the student
     * @author vin touch
     */
    public function m_get_user_students($id) {
        $this->db->select('*');
        $this->db->from('Students s');
        $this->db->join('Users u', 'u.Id = s.UsersId');
        $this->db->join('Batch b', 'b.Id = s.BatchId');
        if ($id === 0) {
            $query = $this->db->get();
            //var_dump($this->db->last_query());
            return $query->result_array();
        }
        $this->db->where('s.UsersId = ' . $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function m_get_major() {
        
    }

    /**
     * @author Sreyleang Seak
     * @return type
     */
    public function m_stu_data() {
        $query = $this->db->query("select us.Id,us.FirstName,us.LastName,us.SkypeID,us.EmailPN,us.LastConnection,stu.EmailPersonal,stu.Major,stu.BatchId,stu.SupervisorId,stu.TutorsId,bat.Year from users us inner join students stu on stu.UsersId = us.Id
        inner join batch bat on stu.BatchId = bat.Id");
        return $query->result_array();
    }

    public function edit_profile($id) {
        $array = array(
            'FirstName'=>$_POST['firstname'],
            'LastName'=>$_POST['lastname'],
            'EmailPN'=>$_POST['pnemail'], 
            'SkypeId'=>$_POST['skypeid']
        );
        
        $arr_stu = array(
            'EmailPersonal'=>$_POST['personalemail'],
            'Major'=>$_POST['specialization']
        ); 
        $this->db->where('users.Id', $id);
        
        $this->db->update('users',$array);
        $this->db->where('students.UsersId', $id);
        $this->db->update('students',$arr_stu); 
    }

    /**
     * @author Sreyleang Seak
     */
    public function m_tutor_data() {
        $query = $this->db->query("select * from users inner join tutors on users.Id = tutors.UsersId");
        return $query->result_array();
    }

    public function m_supervisor_data() {
        $query = $this->db->query("select * from users  inner join supervisor on users.Id = supervisor.UsersId");
        return $query->result_array();
    }

}
