<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// application/controllers/LoginController.php
class LoginController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Staff_model');
        $this->load->model('OrganizationModel');
        $this->load->library('session');
    }

    // Function to display the login form
    public function index()
    {
        // Check if user is already logged in (to prevent showing login page again)
        if ($this->session->userdata('name')) {
            redirect('Home');  // Redirect to the dashboard or home page
        }

        // Load the login form
        $this->load->view('login');
    }

    // Function to handle login form submission
    public function login_post()
    {
       
        // Get the form data
        $name = $this->input->post('username');
        $password = $this->input->post('password');
        //  print_r(''.$name.''.$password.'');
        // Verify the credentials
        $staff = $this->Staff_model->verify_staff_credentials($name, $password);

        // print_r($staff ) ;
        // echo"dksj";
        //die();  
        
        // If login is successful, set session data
        if ($staff) {
            // Set session data
            $organization_id = $staff->organization_id;
            $level = $this->OrganizationModel->get_level($organization_id);
    
            $session_data = array(
                'name' => $staff->username,
                'organization_id' => $staff->organization_id,
                'level' => $level ,
                'logged_in' => true
            );
            // print_r(json_encode($session_data));
            // die();
             $this->session->set_userdata($session_data);
         

         
            //   print_r($level);
            //   die("hi");
            // Redirect to the dashboard or homepage after successful login
            redirect('Home');  // Modify 'dashboard' to whatever page you want to redirect
        } else {
            // If login failed, set an error message and reload the login form
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('default_controller');
        }
    }

    // Function to logout
    public function logout()
    {
        // Destroy the session and redirect to login page
        $this->session->sess_destroy();
        redirect('');
    }
}
