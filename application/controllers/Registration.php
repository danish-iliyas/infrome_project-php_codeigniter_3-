<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	/**
	 * 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	    
	 
	 * 	http://example.com/index.php/welcome/index
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
		$this->load->view('includes/header');
	}

	public function addchilddata()
	{
		
		$user_id = $this->session->userdata('user_id');
		  
		            //  checking user id from session
                    // echo "User level: " . $user_id;
                    //     return ;

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Retrieve the name from the POST request
			$data = [ 
              'name' => $this->input->post('name'),
			  'father_name' => $this->input->post('father_name'),
			  'mother_name' => $this->input->post('mother_name'),
			  'gender' => $this->input->post('gender'),
			  'registered_by' =>$user_id
			];
			
			$this->load->model('ChildModel');

			if ($this->ChildModel->insert_child_data($data)) {
				echo "Data saved successfully!";
				redirect('child_info');
			} else {
				// Handle the case where the name already exists
				echo "Name already exists or failed to save data.";
				// redirect('child_info');
			}
		}
			
			
			// print($name); //
		
	}

	function addemployee() {
		if ($this->session->userdata('user_id') !== NULL) {
			$this->load->model('UserModel');
			$userData = $this->UserModel->get_user();
			$data['users'] = $userData['users'];
			$data['level'] = $this->session->userdata('level');
			$data['userid'] = $this->session->userdata('userid');
			
			$this->load->view('includes/sliderbar', $data); 
			$this->load->view('form');
		} else {
			redirect('login');
		}
	
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Retrieve the data from the POST request
			$data = [
				'userid' => $this->input->post('userid'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'level' => $this->input->post('level'),
				'gender' => $this->input->post('gender'),
				'is_active' => $this->input->post('is_active')
			];
			print_r($_POST);
			// die("hi");	
	
			// Get the logged-in user's ID (who is creating the new user)
			$adminId = $this->session->userdata('user_id');
	
			// Check the level and add the corresponding fields
			$level = $this->input->post('level');
			// print_r($adminId);
			// die();
			
			if ($level == 2) { // Central Admin
				// When creating a Central Admin, set the Admin's ID in creater_id
				$data['creater_id'] = $adminId; // Store Admin ID
				$data['region_id'] = $this->input->post('region_id'); // Save region for Central Admin
			} else if ($level == 3) { // Doctor
				$data['creater_id'] = $this->input->post('creater_id'); // Central Admin's ID
				print_r($data['creater_id']);

				// die("hi");
			} else if ($level == 4) { // Health Worker
				$data['creater_id'] = $this->input->post('creater_id'); // Doctor's ID
			} else if ($level == 5) { // User
				$data['creater_id'] = $this->input->post('creater_id'); // Health Worker’s ID
			}
	
			$this->load->model('UserModel');
			if ($this->UserModel->insert_user($data)) {
				echo "Data saved successfully!";
				redirect('employee_info');
			} else {
				echo "Name already exists or failed to save data.";
				redirect('employee_info');
			}
		}
	}
	




	public function delete_user($id) {
		// Load the UserModel model
		$this->load->model('UserModel');
	
		// Call the model function to delete the user
		$deleted = $this->UserModel->delete_user($id);
	
		// Check if the deletion was successful
		if ($deleted) {
			// Set a success message
			$this->session->set_flashdata('success', 'User deleted successfully.');
		} else {
			// Set an error message
			$this->session->set_flashdata('error', 'Failed to delete user.');
		}
	
		// Redirect back to the user list or the relevant page
		redirect('employee_info'); // Adjust this route as needed
	}
	
	 
}
