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

		//   print_r($data['children']);
        //     die();

          $data['level'] = $level;
		  $data['username'] = $this->session->userdata('username');
		  $data['total_users'] =$total_data['total_users'];
		  $data['total_children'] = $total_data['total_children']; 
            //checking  of the data 
            // print_r($data['total_users']); //outpot = 2
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
            $data['level'] = $this->session->userdata('level');
			$data['username'] = $this->session->userdata('username');
			
			
	   	    // print_r($data['username']);
            // exit(); // or die();
            // Load the child information view			
			$this->load->view('includes/sliderbar', $data); 
            $this->load->view('child_information', $data);
        } 
		  
		else {
            redirect('login');
        }
    }
	
}
