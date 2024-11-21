<?php
class Staff_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Function to check staff credentials and return their data
    public function verify_staff_credentials($name, $password)
    {
        // Fetch the staff details by name
        $this->db->where('username', $name);
        $query = $this->db->get('staff');

        // If a row is found, verify the password
        if ($query->num_rows() == 1) {
            $staff = $query->row();

            // Verify password with the hashed password stored in the database
            if ($staff->password === $password) {
                return $staff;  // Return staff data if credentials are correct
            }
        }

        return false;  // Return false if credentials don't match
    }

    
}