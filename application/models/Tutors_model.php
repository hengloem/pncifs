<?php

class Tutors_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * Update Profile tutors or admin
     * @return true/false true = can update , false = cannot update
     * @author Makara Ngoem
     */
    public function edit_profile_tutor($id) {
        $array = array(
            'FirstName' => $_POST['firstname'],
            'LastName' => $_POST['lastname'],
            'EmailPN' => $_POST['pnemail'],
            'SkypeId' => $_POST['skypeid'] 
        );
        $this->db->where('users.Id', $id);
        $this->db->update('users', $array);

        $this->db->where('tutors.UsersId', $id);
        $this->db->update('tutors', array('tutors.Specialization' => $_POST['specialization']));
    }

    /**
     * Get the list of tutors or one of them
     * @param int $id optional id of one them
     * @return array record of tutors
     * @author Benoit Pitet
     */
    public function getTutors($id = 0) {
        $this->db->select('tutors.*');
        if ($id === 0) {
            $query = $this->db->get('tutors');
            return $query->result_array();
        }
        $query = $this->db->get_where('tutors', array('tutors.UsersId' => $id));
        return $query->row_array();
    }

    public function IsUserTutor($id) {
        $res = $this->getTutors($id);
        if (count($res) > 0) {
            return true;
        }

        return FALSE;
    }

    /**
     * Get data from database
     * @author Seavmeng Chham
     * @return type associative array with two table users and tutors
     */
    public function m_get_data() {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('tutors', 'users.Id = tutors.UsersId', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Insert data into database.
     * @author Seavmeng Chham
     * @return this m_insert() return true or false
     */
    function m_get_user_tutor($id) {
        $data = $this->db->query("select * from users usr 
                            inner join tutors tut
                            on usr.Id = tut.UsersId where usr.Id = $id");
        return $data->result_array();
//        $this->db->select('*');
//        $this->db->from('users');
//        $this->db->join('tutors', 'users.Id = tutors.UsersId', 'inner');
//        $query = $this->db->get();
//        return $query->result_array();
    }

    /**
     * @return this m_insert() return true or false
     */
    public function m_insert() {
        $this->FirstName = $_POST['FirstName'];
        $this->LastName = $_POST['LastName'];
        $this->EmailPN = $_POST['EmailPN'];
        $this->SkypeID = $_POST['SkypeID'];
        ////if want the tutor to ba an admin.
        if (isset($_POST['IsAdministrator'])) {
            $this->IsAdministrator = 1;
        } else {
            $this->IsAdministrator = 0;
        }
        $this->Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        $this->db->insert("users", $this);
        ///insert value to tutors 
        /// the current id of user add is the id of tutor who has one specialization.
        $user_last_id = $this->db->insert_id();
        $data->UsersId = $user_last_id;
        $data->Specialization = $_POST['Specialization'];
        $this->db->insert("tutors", $data);
    }

    /**
     * Delete tutor users in database
     * @param type $id pass from controller user for update where.
     * @return type true or false
     * @author Seavmeng Chham
     */
    public function m_delete_tutors($id) {
        $this->db->where('UsersId', $id);
        return $this->db->delete('tutors');
    }

    /**
     * Delete users in database
     * @param type $id 
     * @return boolean 
     * @author Seavmeng Chham 
     */
    public function m_delete_user($id) {
        $this->db->delete('Users', array('Id' => $id));
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete tutor user in student table (just update field TutorsId to NULL)
     * @param type $id
     * @return boolean
     * @author Seavmeng Chham
     */
    public function m_delete_tutors_in_student($id) {

        $data = array(
            'TutorsId' => null
        );
        $this->db->where('TutorsId', $id);
        if ($this->db->update('students', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $id use to update where
     * @return type return true : update success , false : update unsuccess
     * 
     */
    public function m_update($id) {
        $this->db->where('users.Id', $id);
        $arr->FirstName = $_POST['firstname'];
        $arr->LastName = $_POST['lastname'];
        $arr->EmailPN = $_POST['pnemail'];
        $arr->SkypeID = $_POST['skypeid'];
        if (isset($_POST['issuspended'])) {
            $arr->IsSuspended = 1;
        } else {
            $arr->IsSuspended = 0;
        }
        if ($this->db->update('users', $arr)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete specialization in table tutor.
     * @param type $id
     * @return boolean 
     * @author Seavmeng Chham
     */
    public function m_update_spcialization($id) {
        $this->Specialization = $_POST['Specialization'];
        $this->db->where('tutors.UsersId', $id);
        if ($this->db->update('tutors', $this)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return this old password for change new password
     */
    public function m_get_old_password() {
        $id = $this->uri->segment(3);
        $oldPass = $this->db->query("select u.password from users u where id = '$id'");
        return $oldPass->result_array();
    }

//input password for create new password and compair
    public function m_get_new_password() {
        $password = $this->input->post('password');
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

//return new password if condition true
    public function updatePw($pw, $id) {
        $this->db->where("Id", $id);
        $pw = password_hash($pw, PASSWORD_DEFAULT);
        $res = $this->db->update("users", array("Password" => $pw));

        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata("msg", "Update password successed!");
            return true;
        }
        $this->session->set_flashdata("msg", "Update password failed!");
        return false;
    }

    /**
     * 
     * @param type get year of students
     * @author Vin Touch
     */
    public function m_get_student_year() {
        $query = $this->db->get('batch');
        return $query->result_array();
    }

    /**
     * 
     * @param type get list of information students
     * @author Vin Touch
     */
    public function m_get_list_student(){
        $query = $this->db->get('students');
        return $query->result_array();
        
    }

    /**
     * Get all survey in specific batch by batch id.
     * @author Seavmeng.chham
     * @return array
     */
    public function m_get_survey_by_batch($batch_id) {
        $query = "select * from batch b
            inner join survey s on b.Id = s.BatchId
            where b.Id = $batch_id;";
        $result = $this->db->query($query);
        return $result->result_array();
    }
    /**
     * Get all student in survey
     */
    public function m_get_student_survey($sur_id, $batch_id) {
        $query = "select * from students st
            inner join batch ba on st.BatchId = ba.Id
            inner join survey sv on sv.BatchId = ba.Id
            inner join users us on us.Id = st.UsersId
            where sv.Survey_Id = $sur_id  and ba.Id = $batch_id";
        $result = $this->db->query($query);
        return $result->result_array();
      
    }
    
    /*
     * get all student data with their report
     */
    public function m_get_question_survey() {   
    /**
    select * from students st
inner join answers an on st.UsersId = an.Users_Id
inner join batch ba on ba.Id = st.BatchId
inner join survey su on su.BatchId = ba.Id
inner join questions qu on an.Question_Id = qu.QuestionId
left join reports re on re.Answers_Id = an.AnswersId
where st.UsersId = 3 and su.Survey_Id = 2
group by qu.QuestionId

    */ 
        $this->db->join('students','students.UsersId =users.Id');
        $this->db->join('batch','batch.Id =students.BatchId');
        $this->db->join('survey','survey.BatchId = batch.Id');
        $this->db->join('surveytypes','surveytypes.Id =survey.SurveyTypesId');
        $this->db->join('questions','questions.SurveyId =survey.Survey_Id');
        $this->db->join('answers','answers.Question_Id =questions.QuestionId');
        $this->db->join('reports','answers.AnswersId = reports.Answers_Id','left');
        $query = $this->db->get('users');
        return $query->result_array();
    }

}
