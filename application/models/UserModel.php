<?php
class UserModel extends CI_Model {

    public function authenticate($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // Assuming MD5 hashing
        $this->db->where('status', 1);
        $query = $this->db->get('login'); // Adjust table name if needed

          
        // echo $this->db->last_query(); 
        // print_r($query->row());
        // die();
        if ($query->num_rows() === 1) {
            return $query->row(); // Return the user object
        } else {
            return FALSE; // Authentication failed
        }
    }
}
