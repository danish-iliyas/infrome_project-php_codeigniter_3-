<?php
class UserModel extends CI_Model {

    public function authenticate($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password)); // Assuming MD5 hashing
        $query = $this->db->get('login'); // Adjust table name if needed

        if ($query->num_rows() === 1) {
            return $query->row(); // Return the user object
        } else {
            return FALSE; // Authentication failed
        }
    }
}
