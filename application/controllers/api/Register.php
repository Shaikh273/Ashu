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
        $this->pat = "Patients";
    }

    public function patient_get()
    {
        $u_id = $this->security->xss_clean($this->input->get('u_id'));
        $role_id = $this->db->select('role_id')->from($this->staff)->where("u_id = '$u_id'")->get()->row()->role_id ?? '';
        $role = $this->db->select('role')->from($this->role)->where("$this->role.id = '$role_id'")->get()->row()->role ?? '';
        $data = [];
        if (!empty($role)) {
            if ($role == 'Super Admin') {
                $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
                $staff = $this->db->select('DISTINCT(u_id)')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("admin = '$u_id' AND $this->role.role = 'Admin'")->get()->result();
                if (count($staff) > 0) {
                    for ($i = 0; $i < count($staff); ++$i) {
                        $staff_id = $staff[$i]->u_id;
                        $data['admin'][$i] = $this->db->select('*')->from($this->staff)->where("admin = '$u_id' AND u_id = '$staff_id'")->get()->row();
                        // print_r($data['staff']);
                        $org = $this->db->select('org_id')->from($this->org)->where("admin_id = '$staff_id'")->get()->result();
                        for ($j = 0; $j < count($org); ++$j) {
                            $org_id = $org[$j]->org_id;
                            $data['admin'][$i]->org[$j] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
                            $data['admin'][$i]->org[$j]->staff = $this->db->select('*')->from($this->staff)->where("org_id = '$org_id'")->get()->result();
                        }
                    }
                }
            } else if ($role == 'Admin') {
                $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
                $org = $this->db->select('org_id')->from($this->org)->where("admin_id = '$u_id'")->get()->result();
                for ($j = 0; $j < count($org); ++$j) {
                    $org_id = $org[$j]->org_id;
                    $data['org'][$j] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
                    $data['org'][$j]->staff = $this->db->select('*')->from($this->staff)->where("org_id = '$org_id'")->get()->result();
                }
            } else {
                $org_id = $this->db->select('org_id')->from($this->staff)->where("u_id = '$u_id'")->get()->row()->org_id ?? '';

                $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();

                $data['org'] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
            }
            $this->response([
                'status' => true,
                'data' => $data,
            ], REST_Controller::HTTP_OK);
            // $data['organization'] = $this->db->select('*')->from($this->org)->;
        } else {
            $this->response([
                'status' => false,
                'message' => 'Role is not Assigned',
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
            
            "org_id" => $org_id,
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
            $data = $this->registerpatient_model->updatedata($id, $data);
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
