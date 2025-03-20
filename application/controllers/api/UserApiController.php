<?php

// **************** ZMQ Development ****************

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use RestServer\Libraries\REST_Controller;

class UserApiController extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('api/UserApiModal');
    }

    public function index_post() {
        echo "Sorry, Check the URL again!";
    }

    public function users_get() {
        // Users from a data store e.g. database
        
       $data = [
            'status' => TRUE,
            'message' => 'Successfully retrieved users data.',
            'users' => [
                ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com'],
                ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com']
            ]
        ];

        // Send the response back to the client with HTTP_OK (200)
       $this->response($data, REST_Controller::HTTP_OK);
        // print_r(json_encode(array('insertedData' => $data))); 
    }
    
    public function tesing_Login_post() {
        // Get the email and password from the POST data
        $userid = $this->input->post('userid');
        $password = $this->input->post('password');

        // Validate the input
        if (empty($userid) || empty($password)) {
            $this->response([
                'status' => FALSE,
                'message' => 'Email and password are required.'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        // Call the login method from the model
        $result = $this->UserApiModal->tesing_Login($userid, $password);

        // Return the response based on the result
        if ($result['status']) {
            $this->response($result, REST_Controller::HTTP_OK); // Successful login
        } else {
            $this->response($result, REST_Controller::HTTP_UNAUTHORIZED); // Invalid credentials
        }
    }
    
    public function user_login_post() {
         $jsonData = file_get_contents('php://input'); // get input data in json format
         $userData = json_decode($jsonData, true); // 
         $data_temp = $this->UserApiModal->userAuthonticationModel($userData);

         print_r(json_encode($data_temp));

    }
    
    public function child_partial_registeration_post()
    {
         $jsonData = file_get_contents('php://input'); // get input data in json format
         $childData = json_decode($jsonData, true); // 
         $data_temp = $this->UserApiModal->childPartialRegisteration($childData);

         print_r(json_encode($data_temp)); 
    }
    
    
    public function child_partial_or_full_registeration_post(){
        
         $jsonData = file_get_contents('php://input'); // get input data in json format
         $childData = json_decode($jsonData, true); // 
         $data_temp = $this->UserApiModal->completeChildPartial_or_fullRegisteration($childData);

         print_r(json_encode($data_temp));   
    }

}

?>