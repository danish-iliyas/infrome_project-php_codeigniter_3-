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
			} else {
				echo "Failed to save data.";
			}
		}
			
			
			// print($name); //
		
	}
	
}
