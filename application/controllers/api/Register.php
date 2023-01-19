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
        $this->load->model('api/Registerpatient_model');
        $this->pat = "patients";
    }

    public function patients_get()
    {
        $data = $this->db->select('*')->from($this->pat)->get()->result();
        if (!empty($data)) {
            $this->response([
                'status' => true,
                'img_url' => 'https://www./Ashu/assets/uploads/patients/',
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => "Data Not Found",
            ], REST_Controller::HTTP_BAD_REQUEST);
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

        $years = $this->security->xss_clean($this->input->post("years"));
        $months = $this->security->xss_clean($this->input->post("months"));
        $days = $this->security->xss_clean($this->input->post("days"));

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
        $qr = $this->input->post("qr");
        $blood_grp = $this->security->xss_clean($this->input->post("blood_grp"));
        $maritail_status = $this->security->xss_clean($this->input->post("maritail_status"));
        $disabled = $this->security->xss_clean($this->input->post("disabled"));
        $emg_relation = $this->security->xss_clean($this->input->post("emg_relation"));
        $emg_name = $this->security->xss_clean($this->input->post("emg_name"));
        $emg_no = $this->security->xss_clean($this->input->post("emg_no"));


        $org_id = $this->security->xss_clean($this->input->post('org_id'));

        $patient_id = $this->db->select('pat_id')->from($this->pat)->order_by("$this->pat.id", 'DESC')->get()->row()->pat_id ?? '_0';


        if (!empty($patient_id)) {
            if (!empty($org_id)) {
                $pat_id =  explode('_', $patient_id)[1] + 1;
                $pat_id =  substr($first_name, 0, 3) . '-P_0' . $pat_id;
            } else {
                $this->response([
                    'status' => false,
                    'message' => "Organization not assigned",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        // print($pat_id);die();  


        if (!empty($_FILES['qr'])) {
            $fileName = $_FILES['qr']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/images/users/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('qr')) {
                echo $this->upload->display_errors();
                $qr = '';
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $path = $this->upload->data();
                $qr = $path['file_name'];
            }
        } else {
            $qr = '';
        }

        if (!empty($_FILES['img'])) {
            $fileName = $_FILES['img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/patients/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;
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
            'qr' => $qr ?? '',
            "blood_grp" => $blood_grp ?? '',
            "maritail_status" => $maritail_status ?? '',
            "disabled" => $disabled ?? '',
            "emg_relation" => $emg_relation ?? '',
            "emg_name" => $emg_name ?? '',
            "emg_no" => $emg_no ?? '',
            
            "org_id" => $org_id,
            "pat_id" => $pat_id,

            'created_at' => date('Y-m-d H:i:s'),
        );

        $insertData = $this->Registerpatient_model->insertdata($data);
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
        // $pat_id = $this->post('pat_id');

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
        $qr = $this->input->post("qr");
        $blood_grp = $this->security->xss_clean($this->input->post("blood_grp"));
        $maritail_status = $this->security->xss_clean($this->input->post("maritail_status"));
        $disabled = $this->security->xss_clean($this->input->post("disabled"));
        $emg_relation = $this->security->xss_clean($this->input->post("emg_relation"));
        $emg_name = $this->security->xss_clean($this->input->post("emg_name"));
        $emg_no = $this->security->xss_clean($this->input->post("emg_no"));

        $pat_id = $this->input->post('pat_id');

        if (!empty($_FILES['qr'])) {
            $fileName = $_FILES['qr']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/images/users/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('qr')) {
                echo $this->upload->display_errors();
                $qr = '';
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $path = $this->upload->data();
                $qr = $path['file_name'];
            }
        } else {
            $qr = '';
        }

        if (!empty($_FILES['img'])) {
            $fileName = $_FILES['img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/patients/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->overwrite = true;
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
        // $data = array(
        //     // "id" => $id,

        //     "first_name" => $first_name ?? '',
        //     "middle_name" => $middle_name ?? '',
        //     "last_name" => $last_name ?? '',
        //     "mobile_no" => $mobileNo ?? '',
        //     "secondarynumber" => $secondarynumber ?? '',
        //     "email" => $email ?? '',
        //     "gender" => $gender ?? '',
        //     "DOB" => $DOB ?? '',
        //     "language" => $language ?? '',
        //     "patienttype" => $patienttype ?? '',
        //     "address" => $address ?? '',
        //     "state" => $state ?? '',
        //     "city" => $city ?? '',
        //     "pincode" => $pincode ?? '',
        //     "occupation" => $occupation ?? '',
        //     "employeeid" => $employeeid ?? '',
        //     "medicalrecordno" => $medicalrecordno ?? '',
        //     "governmentid_type" => $governmentid_type ?? '',
        //     "governmentidno" => $governmentidno ?? '',

        //     "img" => $img ?? '',
        //     "blood_grp" => $blood_grp ?? '',
        //     "maritail_status" => $maritail_status ?? '',
        //     "disabled" => $disabled ?? '',
        //     "emg_relation" => $emg_relation ?? '',
        //     "emg_name" => $emg_name ?? '',
        //     "emg_no" => $emg_no ?? '',

        //     "pat_id" => $pat_id,
        // );
        
          $data = array();
        if (!empty($first_name)) {
            $data['first_name'] = $first_name;
        }
        if (!empty($middle_name)) {
            $data['middle_name'] = $middle_name;
        }
        if (!empty($last_name)) {
            $data['last_name'] = $last_name;
        }
        if (!empty($mobileNo)) {
            $data['mobile_no'] = $mobileNo;
        }
        if (!empty($secondarynumber)) {
            $data['secondarynumber'] = $secondarynumber;
        }
        if (!empty($email)) {
            $data['email'] = $email;
        }
        if (!empty($gender)) {
            $data['gender'] = $gender;
        }
        if (!empty($DOB)) {
            $data['DOB'] = $DOB;
        }
        if (!empty($language)) {
            $data['language'] = $language;
        }
        if (!empty($patienttype)) {
            $data['patienttype'] = $patienttype;
        }
        if (!empty($address)) {
            $data['address'] = $address;
        }
        if (!empty($state)) {
            $data['state'] = $state;
        }
        if (!empty($city)) {
            $data['city'] = $city;
        }
        if (!empty($pincode)) {
            $data['pincode'] = $pincode;
        }
        if (!empty($occupation)) {
            $data['occupation'] = $occupation;
        }
        if (!empty($employeeid)) {
            $data['employeeid'] = $employeeid;
        }
        if (!empty($medicalrecordno)) {
            $data['medicalrecordno'] = $medicalrecordno;
        }
        if (!empty($governmentid_type)) {
            $data['governmentid_type'] = $governmentid_type;
        }
        if (!empty($governmentidno)) {
            $data['governmentidno'] = $governmentidno;
        }
        if (!empty($img)) {
            $data['img'] = $img;
        }
        if (!empty($qr)) {
            $data['qr'] = $qr;
        }
        if (!empty($blood_grp)) {
            $data['blood_grp'] = $blood_grp;
        }
        if (!empty($maritail_status)) {
            $data['maritail_status'] = $maritail_status;
        }
        if (!empty($disabled)) {
            $data['disabled'] = $disabled;
        }
        if (!empty($emg_relation)) {
            $data['emg_relation'] = $emg_relation;
        }
        if (!empty($emg_name)) {
            $data['emg_name'] = $emg_name;
        }
        if (!empty($emg_no)) {
            $data['emg_no'] = $emg_no;
        }


        if ($data == '') {
        } else {
            $data = $this->Registerpatient_model->updatedata($pat_id ,$data);
            $given_data = $this->Registerpatient_model->getdata($pat_id);
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
        $id = $this->input->get('id');

        $data = $this->Registerpatient_model->deletedata($id);

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
