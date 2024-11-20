<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrganizationModel extends CI_Model {

    // Insert into organizations table
    public function insert_organization($data) {
        $this->db->insert('organizations', $data);
        return $this->db->insert_id(); // Return the inserted organization's ID
    }

    // Insert into staff table
    public function insert_staff($data) {
        return $this->db->insert('staff', $data);
    }
    public function insert_hierarchy($data) {
        // print_r($data);
        // echo'die';   
        // die ('');
        $this->db->insert('hierarchy_levels', $data);
    }
    public function get_designations_by_org_id($organization_id) {
        $this->db->where('organization_id', $organization_id); // Filter by org ID
        $query = $this->db->get('hierarchy_levels'); // Fetch from the hierarchy_levels table
        return $query->result_array();
    }
}
?>
