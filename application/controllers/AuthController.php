<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	/**
	 * AdminController 
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
		$this->load->view('welcome_message');
	
	}
    public function dashboard(){
		// $this->load->view('includes/header');
        $this->load->view('admindashboard');
    }
	public function login()
	{
		<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function login() {
        $this->load->library('form_validation');
        $this->load->model('UserModel');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Load login page with validation errors
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
                $this->session->set_userdata('level', $user->level);
                
                // Redirect based on user role
                switch ($user->level) {
                    case 0:
                        redirect('superadmin/dashboard'); // Redirect to superadmin dashboard
                        break;
                    case 1:
                        redirect('admin/dashboard'); // Redirect to admin dashboard
                        break;
                    case 2:
                        redirect('user/dashboard'); // Redirect to user dashboard
                        break;
                    default:
                        redirect('login'); // Default fallback
                        break;
                }
            } else {
                // Authentication failed
                $this->session->set_flashdata('error', 'Invalid credentials');
                redirect('login');
            }
        }
    }
}

	}
}
