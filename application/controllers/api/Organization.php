<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Organization extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api/Organization_model','organization_model');
        $this->organization = 'organization';
    }

    public function organization_get()
    {
        $id = $this->input->get('id');
        $org_id = $this->input->get('org_id');

        if ($id || $org_id) {
            $data = $this->organization_model->getData($org_id ?? $id);
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
            $data = $this->db->select('*')->from('organization')->get()->result();
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
    }

    public function organization_post()
    {
        $org_name = $this->security->xss_clean($this->input->post("org_name"));
        $org_country = $this->security->xss_clean($this->input->post("org_country"));
        $org_state = $this->security->xss_clean($this->input->post("org_state"));
        $org_district = $this->security->xss_clean($this->input->post("org_district"));
        $org_city = $this->security->xss_clean($this->input->post("org_city"));
        $org_pincode = $this->security->xss_clean($this->input->post("org_pincode"));
        $org_address = $this->security->xss_clean($this->input->post("org_address"));
        $org_email = $this->security->xss_clean($this->input->post("org_email"));
        $org_No = $this->security->xss_clean($this->input->post("org_No"));

        $org_addedby = $this->security->xss_clean($this->input->post("org_addedby"));

        $org = $this->db->select('org_id')->from($this->organization)->order_by('id', 'DESC')->get()->row()->org_id ?? '_0';

        $org_logo = $this->security->xss_clean($this->input->post("img"));

        $org_id =  explode('_', $org)[1] + 1;
        $org_id = substr($org_name, 0, 3) . '_0' . $org_id;

        $org_addedby = $this->security->xss_clean($this->input->post("org_addedby"));
        $org = $this->db->select('org_id')->from($this->organization)->order_by('id', 'DESC')->get()->row()->org_id ?? '_0';
        $org_logo = $this->security->xss_clean($this->input->post("img"));
        $org_id =  explode('_', $org)[1] + 1;
        $org_id = substr($org_name, 0, 3) . '_0' . $org_id;
        // print_r($org_id);die();

        if (!empty($_FILES['img'])) {
            $fileName = $_FILES['img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/organization/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')) {
                echo $this->upload->display_errors();
                $message = strip_tags($this->upload->display_errors());
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $path = $this->upload->data();
                $org_logo = $path['file_name'];
            }
        } else {
            $message = '';
        }

        // $this->form_validation->set_rules(
        //     "mobileNo",
        //     "Mobile No",
        //     "required|numeric|is_unique[organizations.mobile_no]|min_length[10]|max_length[15]",
        //     array(
        //         'max_length' => 'Mobile no. should be maximum 15 digits',
        //         'min_length' => 'Mobile no. should be minimum 10 digits',
        //         'is_unique' => 'Mobile no. already used',
        //         'required' => 'This Field must be filled',
        //         'numeric' => 'Please Enter only Numbers'
        //     )
        // );

        // if ($this->form_validation->run() == false) {

        //     // very important query "LIFES SAVER"
        //     $error = strip_tags(validation_errors());

            // $this->response([
            //     "status" => False,
            //     "message" => "Invalid Details",
            //     "error" => $error
            // ], REST_Controller::HTTP_BAD_REQUEST);
        // } else {

        $data = array(
            "org_id" => $org_id,
            "org_logo" => $org_logo,
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

        $insertData = $this->Organization_model->insertdata($data);
        if ($insertData) {
            $this->response([
                'status' => !empty($message) ? false : true,
                'message' => !empty($message) ? $message : "You're Registered Successfully",
                'data' => $data
            ], !empty($message) ? REST_Controller::HTTP_OK : REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $this->response([
                "status" => False,
                "Message" => "Registration Failed"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
        $data = array(
            "org_id" => $org_id,
            "org_logo" => $org_logo,
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
        $insertData = $this->Organization_model->insertdata($data);
        if ($insertData) {
            $this->response([
                'status' => !empty($message) ? false : true,
                'message' => !empty($message) ? $message : "You're Registered Successfully",
                'data' => $data
            ], !empty($message) ? REST_Controller::HTTP_OK : REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $this->response([
                "status" => False,
                "Message" => "Registration Failed"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }

    public function organizationupdate_post()
    {
        $id = $this->post('id');
        $org_id = $this->input->post('org_id');
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

        $addedby = $this->security->xss_clean($this->input->post("addedby"));

        $org_logo = $this->security->xss_clean($this->input->post("img"));



        if (!empty($_FILES['img'])) {
            $fileName = $_FILES['img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/organization/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->overwrite = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')) {
                echo $this->upload->display_errors();
                $message = strip_tags($this->upload->display_errors());
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $path = $this->upload->data();
                $org_logo = $path['file_name'];
            }
        } else {
            $message = '';
        }

        // $this->form_validation->set_rules(
        //     "mobileNo",
        //     "Mobile No",
        //     "required|numeric|is_unique[organizations.mobile_no]|min_length[10]|max_length[15]",
        //     array(
        //         'max_length' => 'Mobile no. should be maximum 15 digits',
        //         'min_length' => 'Mobile no. should be minimum 10 digits',
        //         'is_unique' => 'Mobile no. already used',
        //         'required' => 'This Field must be filled',
        //         'numeric' => 'Please Enter only Numbers'
        //     )
        // );



        // if ($this->form_validation->run() == false) {

        //     // very important query "LIFES SAVER"
        //     $error = strip_tags(validation_errors());

        //     $this->response([
        //         "status" => False,
        //         "message" => "Invalid Details",
        //         "error" => $error
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // } else {

        $data = array();
        if (!empty($org_name)) {
            $data['org_name'] = $org_name;
        }
        if (!empty($org_country)) {
            $data['org_country'] = $org_country;
        }
        if (!empty($org_state)) {
            $data['org_state'] = $org_state;
        }
        if (!empty($org_district)) {
            $data['org_district'] = $org_district;
        }
        if (!empty($org_city)) {
            $data['org_city'] = $org_city;
        }
        if (!empty($org_logo)) {
            $data['org_logo'] = $org_logo;
        }
        if (!empty($org_city)) {
            $data['org_city'] = $org_city;
        }
        if (!empty($org_pincode)) {
            $data['org_pincode'] = $org_pincode;
        }
        if (!empty($org_address)) {
            $data['org_address'] = $org_address;
        }
        if (!empty($org_addedby)) {
            $data['org_addedby'] = $org_addedby;
        }

        if ($data == '') {
        } else {
            $data = $this->Organization_model->updatedata($org_id, $data);
            $given_data = $this->Organization_model->getdata($org_id);

            // print_r($given_data);die();

            if ($data) {
                $this->response([
                    'status' => true,
                    'message' => 'organization Data Updated Successfully.',
                    'data' => $given_data
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        
        $data = array();
        if (!empty($org_name)) {
            $data['org_name'] = $org_name;
        }
        if (!empty($org_country)) {
            $data['org_country'] = $org_country;
        }
        if (!empty($org_state)) {
            $data['org_state'] = $org_state;
        }
        if (!empty($org_district)) {
            $data['org_district'] = $org_district;
        }
        if (!empty($org_city)) {
            $data['org_city'] = $org_city;
        }
        if (!empty($org_logo)) {
            $data['org_logo'] = $org_logo;
        }
        if (!empty($org_city)) {
            $data['org_city'] = $org_city;
        }
        if (!empty($org_pincode)) {
            $data['org_pincode'] = $org_pincode;
        }
        if (!empty($org_address)) {
            $data['org_address'] = $org_address;
        }
        if (!empty($org_addedby)) {
            $data['org_addedby'] = $org_addedby;
        }

        if ($data == '') {
        } else {
            $data = $this->Organization_model->updatedata($org_id, $data);
            $given_data = $this->Organization_model->getdata($org_id);
        }

        if ($data) {
            $this->response([
                'status' => true,
                'message' => 'organization Data Updated Successfully.',
                'data' => $given_data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        // }
    }

    public function organization_delete()
    {
        $id = $this->delete('id');

        $data = $this->Organization_model->deletedata($id);

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
