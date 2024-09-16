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
		// $this->load->library('form_validation');
		;
		$this->load->model('UserModel');
		// print_r($_POST);
		// die(); // Add the semicolon here
	
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		 // Add the semicolon here
		if ($this->form_validation->run() === FALSE) {
		// 	// Load login page with validation errors
			// print_r($_POST);
		die();
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
	
			// Check user credentials
			$user = $this->UserModel->authenticate($username, $password);
			
	
			if ($user) {
				// User authenticated
				$this->session->set_userdata('user_id', $user->login_id);
				$this->session->set_userdata('username', $user->username);
			    $this->session->set_userdata('level', $user->level); // Save user role in session
			    
				       
			    //       //output for debug
				//   $level = $this->session->userdata('level');
                //    //  echo "User level: " . $level;
                //           // die();
			 

                    //  if ($level === 0) {
					// 	echo "User level: " . $level;
                    //    die();
                    //     }                             
			  

	
				// Redirect to a single dashboard
				redirect('Dashboard');
			} else {
				// Authentication failed
				$this->session->set_flashdata('error', 'Invalid credentials');
				redirect('Login');
			}
		}
	}
	public  function logout() {
		$this->session->sess_destroy();
		redirect('Login');
	}
	
}
