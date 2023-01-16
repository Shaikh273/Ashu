<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class Test_case extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api/History_model');
        $this->test = 'test_cases';
    }

    public function test_case_get()
    {
        $C_id = $this->input->get('C_id');

        $data = array();
        if (!empty($C_id)) {

            $data['Patients'] = $this->db->select('patients.id AS ID')->from('patients')->where("patients.pat_id = '$C_id'")->get()->result();

            $case_id = $this->db->select('C_id,pat_id')->from('test_cases')->where("test_cases.C_id = '$C_id' XOR test_cases.pat_id = '$C_id'")->get()->result();

            $length = count($case_id);

            for ($i = 0; $i < $length; ++$i) {

                $pat_id = $case_id[$i]->pat_id;

                $data['Patients'][$i] = $this->db->select('*')->from('patients')->where("pat_id = '$pat_id'")->get()->row();

                for ($j = 0; $j < count($case_id); ++$j) {
                    $c_id = $case_id[$j]->C_id;
                    $data['Patients'][$i]->test_cases[$j] = $this->db->select("test_cases.*")->from('test_cases')->join('tests', 'test_cases.test_id = tests.id')->join('patients', 'test_cases.pat_id = patients.pat_id')->where("C_id = '$c_id'")->get()->result();
                    // print_r($data['Patients'][$i]);die();
                }
            }
        }

        if (!empty($data)) {
            $this->response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 'Data Not Found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function test_cases_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $problem =  $this->security->xss_clean($this->input->post('problem'));
        $description =  $this->security->xss_clean($this->input->post('description'));
        $test_id =  $this->security->xss_clean($this->input->post('test_id'));
        $reading =  $this->security->xss_clean($this->input->post('reading'));
        $doctor_id =  $this->security->xss_clean($this->input->post('doctor_id'));
        $status =  $this->security->xss_clean($this->input->post('status'));

        $c_id = $this->db->select('C_id')->from($this->test)->order_by('id', 'DESC')->get()->row()->C_id ?? 'c_c_0';

        if (date('m') <= 3) {
            $year = date('Y') - 1;
            $next_year = date('Y');
        } else {
            $year = date('Y');
            $next_year = date('Y') + 1;
        }
        $c_id =  explode('_', $c_id)[2] + 1;
        $C_id = "Case_{$year}-{$next_year}_0" . $c_id;

        $this->form_validation->set_rules('test_id', 'Cases Id', 'required', array(
            'required' => 'Test Id is Missing'
        ));

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());
            $this->response([
                "status" => false,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = array(
                'C_id' => $C_id,
                'pat_id' => $pat_id,
                'problem' => $problem,
                'description' => $description,
                'test_id' => $test_id,
                'reading' => $reading,
                'doctor_id' => $doctor_id,
                'status' => $status,
            );

            $insert = $this->db->insert('test_cases', $data);
            if ($insert) {
                $this->response([
                    "status" => true,
                    "message" => "Data Inserted Successfully"
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "status" => false,
                    "message" => "Internal Server Error"
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function test_cases_update_post()
    {
        $id = $this->security->xss_clean($this->input->post('id'));
        $c_id = $this->security->xss_clean($this->input->post('C_id'));
        $problem = $this->security->xss_clean($this->input->post('problem'));
        $description = $this->security->xss_clean($this->input->post('description'));
        $test_id = $this->security->xss_clean($this->input->post('test_id'));
        $reading = $this->security->xss_clean($this->input->post('reading'));
        $doctor_id = $this->security->xss_clean($this->input->post('doctor_id'));
        $status = $this->security->xss_clean($this->input->post('status'));

        $data = array();
        if (!empty($problem) && !empty($id)) {
            $data['problem'] = $problem;
        }
        if (!empty($description) && !empty($id)) {
            $data['description'] = $description;
        }
        if (!empty($test_id) && !empty($id)) {
            $data['test_id'] = $test_id;
        }
        if (!empty($reading) && !empty($id)) {
            $data['reading'] = $reading;
        }
        if (!empty($doctor_id) && !empty($id)) {
            $data['doctor_id'] = $doctor_id;
        }
        if (!empty($status) && !empty($id)) {
            $data['status'] = $status;
        }

        $update = $this->db->update('test_cases', $data, array('id' => $id));
        if ($update) {
            $this->response([
                "status" => true,
                "message" => "Data Updated Successfully"
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "status" => false,
                "message" => "Internal Server Error"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function history_delete()
    {

        $case_id = $this->input->get('case_id');
        $data = $this->History_model->deletedata($case_id);

        if ($data) {
            $this->response([
                "status" => $data,
                "message" => "Data Deleted "
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "status" => $data,
                "message" => "Unable to Delete"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
