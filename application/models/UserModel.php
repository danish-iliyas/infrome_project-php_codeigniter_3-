<?php
class UserModel extends CI_Model {

    public function authenticate($userid, $password) {
        $this->db->where('userid', $userid);
        $this->db->where('password', $password); // Assuming MD5 hashing
        $this->db->where('is_active', 1);
        $query = $this->db->get('staff'); // Adjust table name if needed

          
        // echo $this->db->last_query(); 
        // print_r($query->row());
        // die();
        if ($query->num_rows() === 1) {
            return $query->row(); // Return the user object
        } else {
            return FALSE; // Authentication failed
        }
    }
    public function insert_user($data) {
        // Insert the user data into the database
        return $this->db->insert('staff', $data);
    }

    public function get_users_by_level($level) {
        $this->db->select('id, userid');
        $this->db->from('staff');
        $this->db->where('level', $level);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_user() {
        
        $query = $this->db->get('staff'); // Fetch rows with specific user_id
    
        $result = $query->result_array(); // Get the result as an array
    
        // Return both children and the total count
        return [
            'users' => $result,
             // Count the number of children
        ];
    }
    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('staff'); // Adjust the table name as necessary
    }
    public function update_status($id, $is_active) {
        $this->db->where('id', $id);
        return $this->db->update('staff', ['is_active' => $is_active]); // Adjust the table name as necessary
    }
    public function all_user() {
        $this->db->where('level', 2); // Add condition for level = 2
        $total_users = $this->db->count_all_results('staff');

        $this->db->where('level', 1); // Add condition for level = 2    
        $total_admin = $this->db->count_all_results('staff');
        return [
            'total_users' => $total_users,
            'total_admin' => $total_admin
        ] ;
    }  



    // model for doctor 

    public function getAllDoctorByCentralAdmin($central_admin_id) {
        $this->db->select('userid');
        $this->db->select('id');
        $this->db->from('staff');
        $this->db->where('level', 3); // Level 3 represents doctors
        $this->db->where('creater_id', $central_admin_id); // Registered by this Central Admin
        
        $query = $this->db->get();
        
        // Debug the query
        // echo $this->db->last_query(); // This will print the query being executed
        return $query->result_array(); // Return the array of doctors
    }
}
    

