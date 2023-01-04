<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Clinic extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->model('api/clinic_model');
    }

    public function clinic_get()
    {
        $id = $this->input->get('id');
        $org_id = $this->input->get('org_id');

        if ($id || $org_id) {
            $data = $this->clinic_model->getData($id, $org_id);
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
        } else {
            $this->response([
                'status' => false,
                'data' => 'Check Clinic ID.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function clinic_post()
    {
        $org_name = $this->security->xss_clean($this->input->post("org_name"));
        $org_country = $this->security->xss_clean($this->input->post("org_country"));
        $org_state = $this->security->xss_clean($this->input->post("org_state"));
        $org_district = $this->security->xss_clean($this->input->post("org_district"));
        $org_city = $this->security->xss_clean($this->input->post("org_city"));
        $org_city = $this->security->xss_clean($this->input->post("org_pincode"));
        $org_address = $this->security->xss_clean($this->input->post("org_address"));
        $org_email = $this->security->xss_clean($this->input->post("org_email"));
        $org_No = $this->security->xss_clean($this->input->post("org_No"));
        $org_addedby = $this->security->xss_clean($this->input->post("org_addedby"));

        $org = $this->db->select('org_id')->from($this->org)->order_by('id', 'DESC')->get()->row() ?? '_0';
        $org_logo = $this->input->post("img");

        $org_id =  substr($org_name, 0, 3) . '_0' . explode('_', $org)[1] + 1;

        if (!empty($_FILES['img'])) {
            $fileName = $_FILES['img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/images/users/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')) {
                echo $this->upload->display_errors();
                $img = '';
            } else {
                $path = $this->upload->data();
                $img = $path['file_name'];
            }
        } else {
            $img = '';
        }

        $data = array(
            "org_id" => $org_id,
            "org_name" => $org_name ?? '',
            "org_country" => $org_country ?? '',
            "org_state" => $org_state ?? '',
            "org_district" => $org_district ?? '',
            "org_city" => $org_city ?? '',
            "org_pincode" => $org_pincode ?? '',
            "org_address" => $org_address ?? '',
            "org_email" => $org_email ?? '',
            "org_No" => $org_No ?? '',
            "org_addedby" => $org_addedby,

            'created_at' => date('Y-m-d H:i:s'),
        );

        $insertData = $this->clinic_model->insertdata($data);
        if ($insertData) {
            $this->response([
                'status' => TRUE,
                'message' => "You're Registered Successfully",
                'data' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "status" => False,
                "Message" => "Registration Failed"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function clinicupdate_post()
    {
        $id = $this->post('id');

        $org_name = $this->security->xss_clean($this->input->post("org_name"));
        $org_country = $this->security->xss_clean($this->input->post("org_country"));
        $org_state = $this->security->xss_clean($this->input->post("org_state"));
        $org_district = $this->security->xss_clean($this->input->post("org_district"));
        $org_city = $this->security->xss_clean($this->input->post("org_city"));
        $org_city = $this->security->xss_clean($this->input->post("org_pincode"));
        $org_address = $this->security->xss_clean($this->input->post("org_address"));
        $org_email = $this->security->xss_clean($this->input->post("org_email"));
        $org_No = $this->security->xss_clean($this->input->post("org_No"));
        $addedby = $this->security->xss_clean($this->input->post("addedby"));

        $org_logo = $this->input->post("img");
        $org_id = $this->input->post('org_id');

        if (!empty($_FILES['img'])) {
            $fileName = $_FILES['img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/images/users/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')) {
                echo $this->upload->display_errors();
                $img = '';
            } else {
                $path = $this->upload->data();
                $img = $path['file_name'];
            }
        } else {
            $img = '';
        }

        $data = array(
            "id" => $id,

            "org_name" => $org_name ?? '',
            "org_country" => $org_country ?? '',
            "org_state" => $org_state ?? '',
            "org_district" => $org_district ?? '',
            "org_city" => $org_city ?? '',
            "org_pincode" => $org_pincode ?? '',
            "org_address" => $org_address ?? '',
            "org_email" => $org_email ?? '',
            "org_No" => $org_No ?? '',
            "org_addedby" => $org_addedby ?? '',

            "org_id" => $org_id,
        );

        if ($data == '') {
        } else {
            $data = $this->clinic_model->updatedata($id, $data);
            $given_data = $this->clinic_model->getdata($id, $org_id);
        }

        if ($data) {
            $this->response([
                'status' => true,
                'message' => 'Clinic Data Updated Successfully.',
                'data' => $given_data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function clinic_delete()
    {
        $id = $this->delete('id');

        $data = $this->clinic_model->deletedata($id);

        if ($data == null) {
            $this->response([
                "status" => FALSE,
                "message" => "Data not found"
            ], REST_Controller::HTTP_BAD_REQUEST);
        } elseif (!empty($data)) {
            if ($data) {
                $this->response([
                    "status" => TRUE,
                    "id" => $id,
                    "message" => "Data Deleted "
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "status" => FALSE,
                    "message" => "Unable to Delete"
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                "status" => FALSE,
                "message" => "Data not found"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
