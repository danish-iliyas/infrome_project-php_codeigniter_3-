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

        if($this->child_exists($data['name'])) {
            return false;
        }
        return $this->db->insert('child_registration', $data); // Inserts data including user_id
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
}