<?php
/**
 * This model contains all functions for managing users
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */

class Users_model extends CI_Model {

    /**
     * Default constructor
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * Get the list of users or one user
     * @param int $id optional id of one user
     * @return array record of users
     * @author Benoit Pitet
     */
    public function getUsers($id = 0) {
        $this->db->select('users.*');
        if ($id === 0) {
            $query = $this->db->get('users');
            return $query->result_array();
        }
        $query = $this->db->get_where('users', array('users.Id' => $id));
        return $query->row_array();
    }

    /**
     * Check if a an email (PN email) is already used before creating the user
     * @param type $emailPN login identifier
     * @return bool true if available, false otherwise
     * @author Benoit Pitet
     */
    public function isEmailPNAvailable($emailPN) {
        $this->db->from('users');
        $this->db->where('EmailPN', $emailPN);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete a user from the database
     * @param int $id identifier of the user
     * @author Benoit Pitet
     */
    public function deleteUser($id) {
        $this->db->delete('Users', array('Id' => $id));  
        if ($this->db->affected_rows() == 1)
        {
             return true;
        }
        else {
             return false;
        }           
    }

    /**
     * Insert a new user into the database. Inserted data are coming from a HTML form
     * @return new user Id
     * @author Benoit Pitet
     */
    public function setUsers($isAdmin = false) {
        //Hash the clear password using bcrypt
        $password = $this->input->post('password');
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'FirstName' => $this->input->post('firstname'),
            'LastName' => $this->input->post('lastname'),
            'EmailPN' => $this->input->post('pnemail'),
            'SkypeID' => $this->input->post('skypeid'),
            'password' => $hash,
            'IsAdministrator' => $isAdmin,            
        );
        $this->db->insert('users', $data);

        return $this->db->insert_id();
    }

    /**
     * Update a given user in the database. Update data are coming from a HTML form
     * @return type boolean
     * @author Benoit Pitet
     */
    public function updateUsers() {        

        $data = array(
            'FirstName' => $this->input->post('firstname'),
            'LastName' => $this->input->post('lastname'),
            'EmailPN' => $this->input->post('pnemail'),
            'SkypeID' => $this->input->post('skypeid'),
        );
        
        // Update administrator things only if the current user is an admin
        if ($this->session->userdata('is_admin'))
        {
            $isAdm = ($this->input->post('isadmin') !== null) ? 1 : 0; ;
            $isSuspended = ($this->input->post('issuspended') !== null) ? 1 : 0;
                   
            $data['IsAdministrator'] = $isAdm;
            $data['IsSuspended'] = $isSuspended;
        }

        $this->db->where('Id', $this->input->post('id'));
        $result = $this->db->update('users', $data);
        return ($this->db->error()['code'] == 0);  
    }

    /**
     * Reset a password. Generate a new password and store its hash into db.
     * @param int $id User identifier
     * @return string clear password
     * @author Benoit Pitet
     */
    public function resetClearPassword($id) {
        $password = $this->randomPassword(10);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        //Store the new password into db
        $data = array(
            'Password' => $hash
        );
        $this->db->where('Id', $id);
        $this->db->update('users', $data);
        return $password;
    }


    /**
     * Reset a password passed as parameter. Store its hash into db
     */
    public function changePassword($id, $newPassword) {
        //Hash the clear password using bcrypt (8 iterations)
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        
        //Store the new password into db
        $data = array(
            'password' => $hash
        );
        $this->db->where('Id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() == 1)
         {
             return true;
         }
         else {
             return false;
         }
    }
    
    /**
     * Generate a random password
     * @param int $length length of the generated password
     * @return string generated password
     * @author Benoit Pitet
     */
    private function randomPassword($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    /**
     * Check the provided credentials
     * @param string user email to authenticate
     * @param string $password password
     * @return Id of the user is succesfully authenticated, false otherwise
     * @author Benoit Pitet
     */
    public function checkCredentials($emailPN, $password) {
        $this->db->from('users');
        $this->db->where('EmailPN', $emailPN);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            //No match found
            return false;
        } else {
            $row = $query->row();
            $hash = $row->Password;
            if (password_verify($password, $hash)) {
                return $row->Id;   
            } else {
                // Password does not match stored password.
                return false;
            }
        }
    }

    
    
    
    public function updateLastConnectionDate($id){   
        
        // Update last connection datetime utc
        $data = array(
            'LastConnection' => gmdate('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() == 1)
         {
             return true;
         }
         else {
             return false;
         }
    }
    


     /**
     * Try to return the user ID from the email field
     * @param type $email string
     * @return int or null if no user was found
     */
    public function getUserIdByEmail($email) {
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            //No match found
            return null;
        } else {
            return $query->row()->Id;
        }
    }

}
