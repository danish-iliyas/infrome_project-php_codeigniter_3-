<?php
class ChildModel extends CI_Model {

    public function child_exists($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('child_registration');
        
        // Check if the query returns any result
        return $query->num_rows() > 0; // This returns true if any rows exist
    }

    public function insert_child_data($data) {
        // $name = $data['name'];
        // echo "Name: $name<br>";
        // die('here');

        if ($this->is_name_exists($data['name'])) {
            return false; // Name already exists
        }
        return $this->db->insert('child_registration', $data); // Inserts data including user_id
    }
    public function is_name_exists($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('child_registration');

        // Check if any rows are returned
        return $query->num_rows() > 0;
    }

    public function get_children_by_user($user_id) {
        $this->db->where('registered_by', $user_id);
        $query = $this->db->get('child_registration'); // Fetch rows with specific user_id
    
        $result = $query->result_array(); // Get the result as an array
    
        // Return both children and the total count
        return [
            'children' => $result,
            'total_children' => count($result) // Count the number of children
        ];
    }
    public function get_all_children_user() {
       
        $child_query = $this->db->get('child_registration');
        $child_result = $child_query->result_array(); //  result as an array
        
        // total children
        $total_children = $this->db->count_all_results('child_registration');
    
        // Fetch the total number of users with level = 2
        $this->db->where('level', 2); // Add condition for level = 2 
        $total_users = $this->db->count_all_results('staff'); // Count users in login table with level 2
        
        // Return the result as an array including both child data and user/child counts
        return [
            'children' => $child_result,
            'total_users' => $total_users,
            'total_children' => $total_children
        ];

    }
    public function getChildrenByDoctor($doctorId) {
        // Select the required child details and health worker name
        $this->db->select('child_partial_registration.child_name, child_partial_registration.dateofbirth, child_partial_registration.gender, child_partial_registration.father_name, child_partial_registration.mother_name, staff.userid as health_worker_name');
        
        // From child_partial_registration table
        $this->db->from('child_partial_registration');
        
        // Join the login table to get the health worker's name
        $this->db->join('staff', 'staff.id = child_partial_registration.healthworker_id');
        
        // Filter by doctorId (creater_id corresponds to the doctor's id)
        $this->db->where('staff.creater_id', $doctorId);
        
        // Ensure the user is a health worker (level = 4) and their account is active (is_active = 1)
        $this->db->where('staff.level', 4);  // Health Worker level
        $this->db->where('staff.is_active', 1); // Active is_active
        
        // Execute the query
        $query = $this->db->get();
        
        // Check if any rows were returned
        if ($query->num_rows() > 0) {
            // Return the result as an array
            return $query->result_array();
        } else {
            // Return an empty array if no data is found
            return [];
        }
    }
     

    // get child by specfic Doctor 
    public function getChildrenByDoctorLevel($doctorId) {
        // Select child details along with the health worker's name
        $this->db->select('child_partial_registration.child_name, child_partial_registration.dateofbirth, child_partial_registration.gender, child_partial_registration.father_name, child_partial_registration.mother_name, staff.userid as health_worker_name');
        // print_r($doctorId);
        // echo("$doctorId");
        // echo("hi");
        // die();
        // From child_partial_registration table
        $this->db->from('child_partial_registration');
        
        // Join the staff table to get the health worker's name
        $this->db->join('staff', 'staff.id = child_partial_registration.healthworker_id');
        
        // Ensure health workers are under the logged-in doctor
        $this->db->where('staff.creater_id', $doctorId);
        
        // Ensure the health worker is level 4 (Health Worker level)
        $this->db->where('staff.level', 4);
        
        // Ensure the health worker's account is active
        $this->db->where('staff.is_active', 1);
        
        // Execute the query
        $query = $this->db->get();
        
        // Debug the generated SQL query
        // echo $this->db->last_query();  // This will display the query in the output

        // Check if any rows were returned
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            // Debug: No rows found
            echo 'No rows found.';
            return [];
        }
    }
    public function getChildrenByHealthWorkerId($healthWorkerId) {
        // Select the required child details and health worker name
        $this->db->select('child_partial_registration.child_name, child_partial_registration.dateofbirth, child_partial_registration.gender, child_partial_registration.father_name, child_partial_registration.mother_name, staff.userid as health_worker_name');
        
        // From child_partial_registration table
        $this->db->from('child_partial_registration');
        
        // Join the staff table to get the health worker's name
        $this->db->join('staff', 'staff.id = child_partial_registration.healthworker_id');
        
        // Filter by healthWorkerId (id corresponds to the health worker's ID)
        $this->db->where('staff.id', $healthWorkerId);
        
        // Ensure the health worker's account is active (is_active = 1)
        $this->db->where('staff.is_active', 1); // Active health worker
        
        // Execute the query
        $query = $this->db->get();
        
        // Check if any rows were returned
        if ($query->num_rows() > 0) {
            // Return the result as an array
            return $query->result_array();
        } else {
            // Return an empty array if no data is found
            return [];
        }
    }
    
    public function getTotalChildrenByHealthWorkerId($healthWorkerId) {
        // Count the total number of children assigned to the health worker
        $this->db->where('healthworker_id', $healthWorkerId);
        return $this->db->count_all_results('child_partial_registration');
    }
    
     // Fetch the health worker name under a doctor
     public function getHealthWorkersWithTotalChildren($doctorId) {
        $this->db->select('hw.id as healthworker_id, hw.userid as healthworker_name, COUNT(cpr.child_id) as total_children');
        $this->db->from('staff as hw');
        $this->db->join('child_partial_registration as cpr', 'hw.id = cpr.healthworker_id', 'left');
        $this->db->where('hw.creater_id', $doctorId);  // Fetch health workers under the doctor
        $this->db->group_by('hw.id');  // Group by health worker to count children
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array();  // Return the result as an array
        } else {
            return [];  // Return an empty array if no health workers found
        }
    }
    // public function getChildrenDataByDoctor($doctorId) {
    //     $this->db->select('hw.id as healthworker_id, hw.userid as healthworker_name, COUNT(cpr.child_id) as total_children');
    //     $this->db->from('staff as hw');
    //     $this->db->join('child_partial_registration as cpr', 'hw.id = cpr.healthworker_id', 'left');
    //     $this->db->where('hw.creater_id', $doctorId);
    //     $this->db->group_by('hw.id');
        
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function getTotalChildrenByHealthWorker($doctorId) {
        $this->db->select('COUNT(cpr.child_id) as total_children');
        $this->db->from('child_partial_registration cpr');
        $this->db->join('staff s', 's.id = cpr.healthworker_id');
        $this->db->where('s.creater_id', $doctorId);  // Health worker under doctor
        $query = $this->db->get();
        return $query->row()->total_children ?? 0;
    }
    
}