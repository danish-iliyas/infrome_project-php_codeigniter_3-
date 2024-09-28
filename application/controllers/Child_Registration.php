<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Child_Registration extends CI_Controller {

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

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Retrieve the name from the POST request
			$data = [
				'username' => $this->input->post('username'),
				'email'=>$this->input->post('email'),
				'password'=>$this->input->post('password'),
				'level'=>$this->input->post('level'),
				'gender'=>$this->input->post('gender'),
				'status'=>$this->input->post('status'),

 			];
			
			// print_r($data);
			// die();

			 $this->load->model('UserModel');
			if ($this->UserModel->insert_user($data)) {
				echo "Data saved successfully!";
				redirect('employee_info');
			} else {
				echo "Name already exists or failed to save data.";
				redirect('employee_info');
			}
		}


		// $this->load->view('includes/header');
		// $this->load->view('registration');
		// $this->load->view('includes/footer');
	}

	public function delete_user($login_id) {
		// Load the UserModel model
		$this->load->model('UserModel');
	
		// Call the model function to delete the user
		$deleted = $this->UserModel->delete_user($login_id);
	
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
