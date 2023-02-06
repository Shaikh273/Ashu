<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api/Users_model');
    }

    public function login_post()
    {
        // Get the post data
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Validate the post data
        if (!empty($email) && !empty($password)) {

            // Check if any user exists with the given credentials
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => sha1($password),
                // 'status' => 1
            );

            $user = $this->Users_model->getRows($con);

            if ($user) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            } else {
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
                    "status" => false,
                    "error" => "Wrong email or password."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response([
                "status" => false,
                "message" => "Provide email and password.",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
