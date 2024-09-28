<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
        if ($this->session->userdata('user_id') !== NULL) {
            

			$this->load->model('ChildModel'); 
			$level = $this->session->userdata('level');
			$user_id = $this->session->userdata('user_id'); // Get the user ID from session
			// Get total number of children registered by the user
			$children_data = $this->ChildModel->get_children_by_user($user_id);
    
    // Pass children and total count to the view
	        $this->load->model('ChildModel');
          $data['children'] = $children_data['children'];
          $data['total_children'] = $children_data['total_children'];

		  $total_data = $this->ChildModel->get_all_children_user();
		  $children_data = $this->ChildModel->get_children_by_user($user_id);

		//   print_r($data['children']);
        //     die();

          $data['level'] = $level;
		  $data['username'] = $this->session->userdata('username');
		  $data['total_users'] =$total_data['total_users'];
		  $data['total_children'] = $total_data['total_children']; 
		//   print_r($data['total_children']); //outpot = 2
		//   die();
		//     //   $data['total_children'] = $children_data['total_children'];
			  
			  $data['total_children_by_user'] = $children_data['total_children'];
            //checking  of the data 
            // print_r($data['level']); //outpot = 2
            // die();
            $this->load->view('dashboard', $data);
			// $this->load->view('child_information', $data);

        } else {
            
            redirect('login'); 
        }
       
	}
       
	public function child_information() {
        if ($this->session->userdata('user_id') !== NULL) {
            $this->load->model('ChildModel');
            $user_id = $this->session->userdata('user_id'); // Get the user ID from session
            
            // Get total number of children registered by the user
            $children_data = $this->ChildModel->get_children_by_user($user_id);

            // Pass children and total count to the view
            $data['children'] = $children_data['children'];
            $data['total_children'] = $children_data['total_children'];
               
			  
	   	    // print_r($data['total_children']);
            // die("hi");

            $data['level'] = $this->session->userdata('level');
			$data['username'] = $this->session->userdata('username');
			
			
	   	    // print_r($data['username']);
            // exit(); // or die();
            // Load the child information view			
			$this->load->view('includes/sliderbar', $data); 
            $this->load->view('registration', $data);
        } 
		  
		else {
            redirect('login');
        }
    }

	
	public function employee_information() {
        if ($this->session->userdata('user_id') !== NULL) {
            // $this->load->model('ChildModel');
            // $user_id = $this->session->userdata('user_id'); // Get the user ID from session
            
            // Get total number of children registered by the user
            // $children_data = $this->ChildModel->get_children_by_user($user_id);
                 $this->load->model('UserModel');
                 $userData = $this->UserModel->get_user();
                 $data['users'] = $userData['users'];
            // Pass children and total count to the view
            // $data['children'] = $children_data['children'];
            // $data['total_children'] = $children_data['total_children'];
               
			  
	   	    // print_r($data['total_children']);
            // die("hi");

            $data['level'] = $this->session->userdata('level');
			$data['username'] = $this->session->userdata('username');
			
			
	   	    // print_r($data['username']);
            // exit(); // or die();
            // Load the child information view			
			$this->load->view('includes/sliderbar', $data); 
            $this->load->view('registration', $data);
        } 
		  
		else {
            redirect('login');
        }
    }
    public function toggle_status($login_id) {
        // Load the UserModel
        $this->load->model('UserModel');
    
        // Get the new status from the POST request
        $new_status = $this->input->post('status');
    
        // Update the user's status in the database
        $this->UserModel->update_status($login_id, $new_status);
    
        // Set a flash message for feedback
        $this->session->set_flashdata('success', 'User status updated successfully.');
    
        // Redirect back to the relevant page
        redirect('employee_info'); // Adjust this route as needed
    }
    
}
