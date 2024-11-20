<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrganizationController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrganizationModel');

    }
    public function index()
    {
        // $this->load->view('includes/headerr', ); 
        // $this->load->view('includes/sliderbarr', ); 
        $this->load->view('organizationHome.php');


    }

    public function saveOrganization()
    {
        // Get organization details
        $organizationData = [
            'organizationname' => $this->input->post('organizationname'),
            'contact_person' => $this->input->post('contact_person'),
            'level' => $this->input->post('level'),
            'is_active' => 1
        ];
        // print_r($organizationData); 
        // die();
        // Insert into organizations table and get the inserted ID
        $organization_id = $this->OrganizationModel->insert_organization($organizationData);

        // print_r($organization_id); 
        // die();

        if ($organization_id) {
            // Get contact details
            $staffData = [
                'username' => $this->input->post('name'),
                'userid' => $this->input->post('userid'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'gender' => $this->input->post('gender'),
                'organization_id' => $organization_id
            ];
           $desiginationdata = [
            'name' => $this->input->post('name'),
            'organization_id' => $organization_id
           ];
           
            $this->OrganizationModel->insert_hierarchy($desiginationdata);
            // print_r( $this->OrganizationModel->insert_hierarchy($desiginationdata));
            // die();
            $this->OrganizationModel->insert_staff($staffData);


            $this->session->set_flashdata('success', 'Data saved successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to save data.');
        }

        redirect('Home');
    }

    
      public function view_level(){
        $organization_id = $this->session->userdata('organization_id');
        if ($organization_id) {
            $data['designations'] = $this->OrganizationModel->get_designations_by_org_id($organization_id);
            $this->load->view('addLevels', $data);
        } else {
            // Redirect to login or error page if organization_id is not in session
            $this->session->set_flashdata('error', 'You must be logged in to view designations.');
            redirect('addLevels');
        }
    }
           
      public function add() {
        $designation = $this->input->post('designation'); // Get input from form
        $organization_id = $this->session->userdata('organization_id');
        $desiginationdata = [
            'name' => $designation,
            'organization_id' => $organization_id
           ];
        if (!empty($designation)) {
            // Save the designation
            $this->OrganizationModel->insert_hierarchy($desiginationdata);

            // Redirect back to the index
            redirect('Home');
        } else {
            // Handle empty input case
            $this->session->set_flashdata('error', 'Designation cannot be empty!');
            redirect('designation');
        }
    }
          
}
