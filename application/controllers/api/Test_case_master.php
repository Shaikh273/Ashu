<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class Test_case_master extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->test = 'test_cases';
    }

    public function test_master_get()
    {
        $master_id = $this->input->get('master_id');

        $data = array();
        if (!empty($master_id)) {

            $data = $this->db->select('master_id,test_id,test_master_name')->from('tests_master')->where("master_id", $master_id)->get()->result();
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

    public function test_master_post()
    {
        $test_id = $this->security->xss_clean($this->input->post('test_id'));
        $master_id =  $this->security->xss_clean($this->input->post('master_id'));
        $test_master_name =  $this->security->xss_clean($this->input->post('test_master_name'));

        $data = array(
            'test_id' => $test_id,
            'master_id' => $master_id,
            'test_master_name' => $test_master_name,

            'created_at' => date('Y-m-d H:i:s'),
        );

        $insert = $this->db->insert('tests_master', $data);
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

    public function test_master_update_post()
    {
        $id = $this->security->xss_clean($this->input->post('id'));
        $test_id = $this->security->xss_clean($this->input->post('test_id'));
        $master_id =  $this->security->xss_clean($this->input->post('master_id'));
        $test_master_name =  $this->security->xss_clean($this->input->post('test_master_name'));

        $data = array();
        if (!empty($test_id) && !empty($id)) {
            $data['test_id'] = $test_id;
        }
        if (!empty($master_id) && !empty($id)) {
            $data['master_id'] = $master_id;
        }
        if (!empty($test_master_name) && !empty($id)) {
            $data['test_master_name'] = $test_master_name;
        }

        $update = $this->db->update('tests_master', $data, array('id' => $id));
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

    public function test_master_delete()
    {
        $test_id = $this->input->get('test_id');
        $data = $this->db->delete("spiritual_count", array('test_id' => $test_id));

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
