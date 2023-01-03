<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller
{
    public function index()
    {
        parent::__construct();
        $this->load->database();
    }


    public function login_get()
    {
        $data = $this->db->select('*')->from('patients')->get()->result();
        if ($data) {
            $this->response([
                'status' => TRUE,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "status" => False,
                "Message" => "Internal Server Error"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function loginnow()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {

                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $this->load->model('user_model');

                if ($this->input->post('login_type') == '') {

                    $this->session->set_flashdata('error', 'Login Failed');
                    redirect(base_url('welcome/login'));
                }
                //------------------------------------admin-login-----------------------------//
                if ($this->input->post('login_type') == 'Admin') {

                    $status = $this->user_model->checkPassword1($password, $email);
                    if ($status != false) {

                        $email = $status->email;

                        $session_data = array(
                            'email' => $email,
                        );

                        $this->session->set_userdata('AdminLoginSession', $session_data);
                        redirect(base_url('welcome/doc_dash'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                }
                //------------------------------------doctor-login-----------------------------//

                elseif ($this->input->post('login_type') == 'doctor') {
                    $status = $this->user_model->checkPassword2($password, $email);
                    if ($status != false) {

                        $email = $status->email;

                        $session_data = array(
                            'email' => $email,
                        );

                        $this->session->set_userdata('DoctorLoginSession', $session_data);
                        redirect(base_url('welcome/doc_dash'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                }
                //------------------------------------optometrists-login-----------------------------//

                elseif ($this->input->post('login_type') == 'optometrists') {
                    $status = $this->user_model->checkPassword5($password, $email);
                    if ($status != false) {

                        $email = $status->email;

                        $session_data = array(
                            'email' => $email,
                        );

                        $this->session->set_userdata('OptometristsLoginSession', $session_data);
                        redirect(base_url('welcome/doc_das'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                }
                //------------------------------------laboratorist-login-----------------------------//

                elseif ($this->input->post('login_type') == 'laboratorist') {
                    $status = $this->user_model->checkPassword3($password, $email);
                    if ($status != false) {

                        $email = $status->email;

                        $session_data = array(
                            'email' => $email,
                        );

                        $this->session->set_userdata('LaboratoristLoginSession', $session_data);
                        redirect(base_url('welcome/doc_dash'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                }
                //------------------------------------nurse-login-----------------------------//

                elseif ($this->input->post('login_type') == 'nurse') {
                    $status = $this->user_model->checkPassword4($password, $email);
                    if ($status != false) {

                        $email = $status->email;
                        $session_data = array(
                            'email' => $email,
                        );

                        $this->session->set_userdata('NurseLoginSession', $session_data);
                        redirect(base_url('welcome/doc_dash'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                }
                //------------------------------------patient-login-----------------------------//

                elseif ($this->input->post('login_type') == 'patient') {
                    $status = $this->user_model->checkPassword6($password, $email);
                    if ($status != false) {
                        // $username = $status->username;
                        $email = $status->email;

                        $session_data = array(
                            // 'username'=>$username,
                            'email' => $email,
                        );

                        $this->session->set_userdata('PatientLoginSession', $session_data);
                        redirect(base_url('welcome/doc_dash'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                }
                //------------------------------------pharmacist-login-----------------------------//

                elseif ($this->input->post('login_type') == 'pharmacist') {
                    $status = $this->user_model->checkPassword7($password, $email);
                    if ($status != false) {
                        // $username = $status->username;
                        $email = $status->email;

                        $session_data = array(
                            // 'username'=>$username,
                            'email' => $email,
                        );

                        $this->session->set_userdata('PharmacistLoginSession', $session_data);
                        redirect(base_url('welcome/doc_dash'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                }
                //------------------------------------accountant-login-----------------------------//

                elseif ($this->input->post('login_type') == 'accountant') {
                    $status = $this->user_model->checkPassword8($password, $email);
                    if ($status != false) {
                        // $username = $status->username;
                        $email = $status->email;

                        $session_data = array(
                            // 'username'=>$username,
                            'email' => $email,
                        );

                        $this->session->set_userdata('AccountantLoginSession', $session_data);
                        redirect(base_url('welcome/doc_dash'));
                    } else {
                        $this->session->set_flashdata('error', 'Email or Password is Wrong');
                        redirect(base_url('welcome/login'));
                    }
                } else {
                    $this->session->set_flashdata('error', 'Email or Password is Wrong');
                    redirect(base_url('welcome/login'));
                }
            } else {
                $this->session->set_flashdata('error', 'Fill all the required fields');
                redirect(base_url('welcome/login'));
            }
        }
    }
}
