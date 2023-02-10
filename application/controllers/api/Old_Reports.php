<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class Old_Reports extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->old = 'old_reports';
    }

    public function old_reports_get($pat_id = '')
    {
        $pat_id = $this->security->xss_clean($pat_id);
        $data = $this->db->select('*')->from($this->old)->where('pat_id', $pat_id)->order_by("id  ASC")->get()->result();

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

    public function old_reports_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $reports = '';

        if (!empty($_FILES['reports'])) {
            $fileName = $_FILES['reports']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/old_reports/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
            $config['max_size']     = '10024';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('reports')) {
                $message1 = strip_tags($this->upload->display_errors());
            } else {
                $path = $this->upload->data();
                $reports = $path['file_name'];
            }
        } else {
            $message1 = '';
        }
        // print_r($reports);die();

        $data = array(
            'pat_id' => $pat_id,
            'reports' => $reports,
            'created_at' => date('Y-m-d H:i:s'),
        );

        $insert = $this->db->insert($this->old, $data);
        if ($insert) {
            $this->response([
                "status" => true,
                "message" => "Reports Submitted Successfully",
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "status" => false,
                "message" => !empty($message1) ? $message1 : "Internal Server Error"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
