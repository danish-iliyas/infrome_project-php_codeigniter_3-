<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		// $this->load->view('welcome_message');
		$this->load->view('login');
		// die();
	}
	public function login_post() {
		$this->load->model('UserModel');
		
		$this->form_validation->set_rules('userid', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			// Load login page with validation errors
			$this->load->view('login');
		} else {
			$userid = $this->input->post('userid');
			$password = $this->input->post('password');
			
			// Check user credentials
			$user = $this->UserModel->authenticate($userid, $password);
			
			if ($user) { 
				// User authenticated
				$this->session->set_userdata('user_id', $user->id);
				$this->session->set_userdata('userid', $user->userid);
				$this->session->set_userdata('level', $user->level); // Save user level in session
				
				// Redirect user based on their level
				switch ($user->level) {
					case 1: // Admin
						// Load admin-specific dashboard or view
						$data['user_id'] = $this->session->userdata('user_id');
						$data['level'] = $this->session->userdata('level');
						$data['userid'] = $this->session->userdata('userid'); 
						// redirect('Dashboard');
						// print_r($data);
						$this->load->view('dashboard', $data); 
						break;
	
					case 2: // Central Admin
						// Call the function to get doctors under the Central Admin
						$this->getAllDoctorUnderCentralAdmin();
						break;
	
					case 3: // Doctor
						// Load doctor-specific dashboard or view
						// $data['user_id'] = $this->session->userdata('user_id');
						// $data['level'] = $this->session->userdata('level');
						// $data['userid'] = $this->session->userdata('userid'); 
						// print_r($data);
						// $this->load->view('dashboard',$data);
						redirect('Dashboard/doctorDashboard');
						break;
	
						case 4: // Health Worker
							// Load the Child model
							$this->load->model('ChildModel');
							
							
							$data['user_id'] = $this->session->userdata('user_id');
							$data['level'] = $this->session->userdata('level');
							$data['userid'] = $this->session->userdata('userid'); 
						
							
							print_r($data['user_id']); 
						
							$data['total_children'] = $this->ChildModel->getTotalChildrenByHealthWorkerId($data['user_id']);
						
							
							// print_r($data); 
						
							
							$this->load->view('dashboard', $data);
							break;
						
	
					case 5: // User
						// Load user-specific dashboard or view
						$this->load->view('user_dashboard', ['userid' => $user->userid]);
						break;
	
					default:
						// Redirect to login with error if user level is invalid
						$this->session->set_flashdata('error', 'Invalid user level');
						redirect('login');
						break;
				}
			} else {
				// Invalid credentials, redirect back to login with error
				$this->session->set_flashdata('error', 'Invalid credentials');
				redirect('login');
			}
		}
	}
	
	public  function logout() {
		$this->session->sess_destroy();
		redirect('Login');
	}
	// getting all doctor for central admin 

	public function getAllDoctorUnderCentralAdmin() {
		
		if ($this->session->userdata('user_id') !== NULL && $this->session->userdata('level') == 2) {
			// Only allow Central Admin access (level = 2)
			
			$this->load->model('UserModel');
	
			$central_admin_id = $this->session->userdata('user_id'); // Get the current Central Admin ID
			     $data['user_id'] = $this->session->userdata('user_id');
				 $data['level'] = $this->session->userdata('level');
				 $data['userid'] = $this->session->userdata('userid');
			// Fetch doctors for this Central Admin
			$data['doctors'] = $this->UserModel->getAllDoctorByCentralAdmin($central_admin_id); 
			// print_r($data['doctors']);
			
			// Debug doctors array
			// print_r($data['doctors']);
			// die("Doctor data");

			 
			// Other data (like active user count)
			$data['doctor_count'] = count($data['doctors']); // Count of doctors
			
			// Load the dashboard view
			$this->load->view('dashboard', $data);
		} else {
			redirect('login');
		}
	}
	
}
