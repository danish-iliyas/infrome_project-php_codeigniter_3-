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

    public function get_level( $id ){
        $this->db->select('level');
        $this->db->where('id' ,$id);
        $query = $this->db->get('organizations');
        if ($query->num_rows() > 0) {
             return $query->row();
        }else{
            return false;
        }
        

    }
    public function get_Counter($organization_id){
        $this->db->select('counter');
        $this->db->where('id' ,$organization_id);
        $query = $this->db->get('organizations');
        $result = $query->row();
        return $result ? $result->counter : null;
    }

    public function update_counter($organization_id, $new_counter_value)
{
    $data = ['counter' => $new_counter_value];
    $this->db->where('id', $organization_id);
    $this->db->update('organizations', $data);
}
    // asigned position 
    public function get_all_levels($organization_id)
    {
        if (!$organization_id) {
            return [];
        }

        // Query to fetch levels for a specific organization
        $this->db->where('organization_id', $organization_id);
        $query = $this->db->get('hierarchy_levels'); // Replace 'hierarchical_levels' with your table name

        return $query->result_array(); // Return results as an array
    }
  

}
?>
