<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrganizationController extends CI_Controller {

        public function __construct() {
            parent::__construct();

        }
        public function index() {   
            // $this->load->view('includes/headerr', ); 
            // $this->load->view('includes/sliderbarr', ); 
            $this->load->view('organizationHome.php');


        }
      

}
