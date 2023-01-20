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
        // $this->test = 'test_cases';
        $this->tests_master = 'tests_master';
    }

    public function test_master_get()
    {

        $master_id = $this->input->get('master_name');


        $data = array();
        if (!empty($master_id)) {


            $master_id = $this->db->select('test_master_name')->from($this->tests_master)->where('test_master_name', $master_id)->get()->result();
            $length = count($master_id);

            for ($i = 0; $i < $length; ++$i) {
                $master = $master_id[$i]->test_master_name;

                $data['test_master'] = $this->db->select('master_id,test_id,test_master_name,tests.test,status')->from($this->tests_master)->join('tests',"$this->tests_master.test_id = tests.id")->where("test_master_name", $master)->get()->result();
            }
        } else {
            $master = $this->db->select('DISTINCT(test_master_name)')->from($this->tests_master)->order_by("test_master_name  ASC")->get()->result();


            $length = count($master);

            for ($i = 0; $i < $length; ++$i) {


                $master_id = $master[$i]->test_master_name;

                $data['test_master'][$i] = $this->db->select('master_id,test_id,test_master_name,tests.test,status')->from($this->tests_master)->join('tests',"$this->tests_master.test_id = tests.id")->where("test_master_name", $master_id)->get()->result();

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

    public function test_master_post()
    {
        $test_id = $this->security->xss_clean($this->input->post('test_id'));

        // $master_id =  $this->security->xss_clean($this->input->post('master_id'));

        $test_master_name =  $this->security->xss_clean($this->input->post('test_master_name'));

        $data = array(
            'test_id' => $test_id,
            'master_id' => $master_id,
            'test_master_name' => $test_master_name,

            'created_at' => date('Y-m-d H:i:s'),
        );

        $insert = $this->db->insert($this->tests_master, $data);
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

        // $master_id =  $this->security->xss_clean($this->input->post('master_id'));

        $test_master_name =  $this->security->xss_clean($this->input->post('test_master_name'));

        $data = array();
        if (!empty($test_id) && !empty($id)) {
            $data['test_id'] = $test_id;
        }

        // if (!empty($master_id) && !empty($id)) {
        //     $data['master_id'] = $master_id;
        // }

        if (!empty($test_master_name) && !empty($id)) {
            $data['test_master_name'] = $test_master_name;
        }

        $update = $this->db->update($this->tests_master, $data, array('id' => $id));
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

        $id = $this->input->get('id');
        $data = $this->db->delete($this->tests_master, array('id' => $id));

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
