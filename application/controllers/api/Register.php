<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Register extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api/registerpatient_model');
    }

    public function patient_get()
    {
        $id = $this->input->get('id');
        $pat_id = $this->input->get('pat_id');

        if ($id || $pat_id) {
            $data = $this->registerpatient_model->getData($id, $pat_id);
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
                'data' => 'Check Patient ID or Appointment ID.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function patient_post()
    {
        $first_name = $this->security->xss_clean($this->input->post("first_name"));
        $middle_name = $this->security->xss_clean($this->input->post("middle_name"));
        $last_name = $this->security->xss_clean($this->input->post("last_name"));
        $mobileNo = $this->security->xss_clean($this->input->post("mobileNo"));
        $secondarynumber = $this->security->xss_clean($this->input->post("secondarynumber"));
        $email = $this->security->xss_clean($this->input->post("email"));
        $gender = $this->security->xss_clean($this->input->post("gender"));
        $DOB = $this->security->xss_clean($this->input->post("DOB"));
        $language = $this->security->xss_clean($this->input->post("language"));
        $patienttype = $this->security->xss_clean($this->input->post("patienttype"));
        $address = $this->security->xss_clean($this->input->post("address"));
        $state = $this->security->xss_clean($this->input->post("state"));
        $city = $this->security->xss_clean($this->input->post("city"));
        $pincode = $this->security->xss_clean($this->input->post("pincode"));
        $occupation = $this->security->xss_clean($this->input->post("occupation"));
        $employeeid = $this->security->xss_clean($this->input->post("employeeid"));
        $medicalrecordno = $this->security->xss_clean($this->input->post("medicalrecordno"));
        $governmentid_type = $this->security->xss_clean($this->input->post("governmentid_type"));
        $governmentidno = $this->security->xss_clean($this->input->post("governmentidno"));


        $img = $this->input->post("img");
        $blood_grp = $this->security->xss_clean($this->input->post("blood_grp"));
        $maritail_status = $this->security->xss_clean($this->input->post("maritail_status"));
        $disabled = $this->security->xss_clean($this->input->post("disabled"));
        $emg_relation = $this->security->xss_clean($this->input->post("emg_relation"));
        $emg_name = $this->security->xss_clean($this->input->post("emg_name"));
        $emg_no = $this->security->xss_clean($this->input->post("emg_no"));

        $pat_id = $this->input->post('pat_id');

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
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $path = $this->upload->data();
                $img = $path['file_name'];
            }
        } else {
            $img = '';
        }

        // $this->form_validation->set_rules(
        //     "mobileNo",
        //     "Mobile No",
        //     "required|numeric|is_unique[patients.mobile_no]|min_length[10]|max_length[15]",
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
            $data = array(
                "first_name" => $first_name ?? '',
                "middle_name" => $middle_name ?? '',
                "last_name" => $last_name ?? '',
                "mobile_no" => $mobileNo ?? '',
                "secondarynumber" => $secondarynumber ?? '',
                "email" => $email ?? '',
                "gender" => $gender ?? '',
                "DOB" => $DOB ?? '',
                "language" => $language ?? '',
                "patienttype" => $patienttype ?? '',
                "address" => $address ?? '',
                "state" => $state ?? '',
                "city" => $city ?? '',
                "pincode" => $pincode ?? '',
                "occupation" => $occupation ?? '',
                "employeeid" => $employeeid ?? '',
                "medicalrecordno" => $medicalrecordno ?? '',
                "governmentid_type" => $governmentid_type ?? '',
                "governmentidno" => $governmentidno ?? '',

                "img" => $img ?? '',
                "blood_grp" => $blood_grp ?? '',
                "maritail_status" => $maritail_status ?? '',
                "disabled" => $disabled ?? '',
                "emg_relation" => $emg_relation ?? '',
                "emg_name" => $emg_name ?? '',
                "emg_no" => $emg_no ?? '',

                "pat_id" => $pat_id,

                'created_at' => date('Y-m-d H:i:s'),
            );

            $insertData = $this->registerpatient_model->insertdata($data);
            if ($insertData) {
                $this->response([
                    'status' => TRUE,
                    'message' => "You've Registered Successfully",
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "status" => False,
                    "Message" => "Registration Failed"
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        // }
    }

    public function patientupdate_post()
    {
        $id = $this->post('id');

        $first_name = $this->security->xss_clean($this->input->post("first_name"));
        $middle_name = $this->security->xss_clean($this->input->post("middle_name"));
        $last_name = $this->security->xss_clean($this->input->post("last_name"));
        $mobileNo = $this->security->xss_clean($this->input->post("mobileNo"));
        $secondarynumber = $this->security->xss_clean($this->input->post("secondarynumber"));
        $email = $this->security->xss_clean($this->input->post("email"));
        $gender = $this->security->xss_clean($this->input->post("gender"));
        $DOB = $this->security->xss_clean($this->input->post("DOB"));
        $language = $this->security->xss_clean($this->input->post("language"));
        $patienttype = $this->security->xss_clean($this->input->post("patienttype"));
        $address = $this->security->xss_clean($this->input->post("address"));
        $state = $this->security->xss_clean($this->input->post("state"));
        $city = $this->security->xss_clean($this->input->post("city"));
        $pincode = $this->security->xss_clean($this->input->post("pincode"));
        $occupation = $this->security->xss_clean($this->input->post("occupation"));
        $employeeid = $this->security->xss_clean($this->input->post("employeeid"));
        $medicalrecordno = $this->security->xss_clean($this->input->post("medicalrecordno"));
        $governmentid_type = $this->security->xss_clean($this->input->post("governmentid_type"));
        $governmentidno = $this->security->xss_clean($this->input->post("governmentidno"));


        $img = $this->input->post("img");
        $blood_grp = $this->security->xss_clean($this->input->post("blood_grp"));
        $maritail_status = $this->security->xss_clean($this->input->post("maritail_status"));
        $disabled = $this->security->xss_clean($this->input->post("disabled"));
        $emg_relation = $this->security->xss_clean($this->input->post("emg_relation"));
        $emg_name = $this->security->xss_clean($this->input->post("emg_name"));
        $emg_no = $this->security->xss_clean($this->input->post("emg_no"));

        $pat_id = $this->input->post('pat_id');

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
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $path = $this->upload->data();
                $img = $path['file_name'];
            }
        } else {
            $img = '';
        }

        // $this->form_validation->set_rules(
        //     "mobileNo",
        //     "Mobile No",
        //     "required|numeric|is_unique[patients.mobile_no]|min_length[10]|max_length[15]",
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
            $data = array(
                "id" => $id,

                "first_name" => $first_name ?? '',
                "middle_name" => $middle_name ?? '',
                "last_name" => $last_name ?? '',
                "mobile_no" => $mobileNo ?? '',
                "secondarynumber" => $secondarynumber ?? '',
                "email" => $email ?? '',
                "gender" => $gender ?? '',
                "DOB" => $DOB ?? '',
                "language" => $language ?? '',
                "patienttype" => $patienttype ?? '',
                "address" => $address ?? '',
                "state" => $state ?? '',
                "city" => $city ?? '',
                "pincode" => $pincode ?? '',
                "occupation" => $occupation ?? '',
                "employeeid" => $employeeid ?? '',
                "medicalrecordno" => $medicalrecordno ?? '',
                "governmentid_type" => $governmentid_type ?? '',
                "governmentidno" => $governmentidno ?? '',

                "img" => $img ?? '',
                "blood_grp" => $blood_grp ?? '',
                "maritail_status" => $maritail_status ?? '',
                "disabled" => $disabled ?? '',
                "emg_relation" => $emg_relation ?? '',
                "emg_name" => $emg_name ?? '',
                "emg_no" => $emg_no ?? '',

                "pat_id" => $pat_id,
            );

            if ($data == '') {
            } else {
                $data = $this->registerpatient_model->updatedata($id,$data);
                $given_data = $this->registerpatient_model->getdata($id, $pat_id);
            }

            if ($data) {
                $this->response([
                    'status' => true,
                    'message' => 'Patient Updated Successfully.',
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

    public function patient_delete()
    {
        $id = $this->delete('id');

        $data = $this->registerpatient_model->deletedata($id);

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
