<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;
use Twilio\Rest\Client;

require_once "vendor/autoload.php";

class Register extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('api/Registerpatient_model');
        $this->load->model('api/Users_model', 'Users');
        $this->pat = "patients";
    }

    public function patients_get($pat_id = '')
    {
        $data = $this->db->select('*')->from($this->pat)->get()->result();
        if (!empty($pat_id)) {
            $data = $this->db->select('*')->from($this->pat)->where('pat_id', $pat_id)->get()->result();
        }
        if (!empty($data)) {
            $this->response([
                'status' => true,
                'profile_url' => 'https://softdigit.in/Ashu/assets/uploads/profile/',
                'img_url' => 'https://sotdigit.in/Ashu/assets/uploads/patients/',
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

        $this->form_validation->set_rules(
            "first_name",
            "First Name",
            "required",
            array(
                'required' => 'first_name should not be empty',
            )
        );

        $this->form_validation->set_rules(
            "last_name",
            "last Name",
            "required",
            array(
                'required' => 'last name should not be empty',
            )
        );

        $this->form_validation->set_rules(
            "mobileNo",
            "Mobile No",
            "required",
            array(
                'required' => 'Mobile No should not be empty',
            )
        );

        $this->form_validation->set_rules(
            "gender",
            "gender",
            "required",
            array(
                'required' => 'gender should not be empty',
            )
        );

        $this->form_validation->set_rules(
            "DOB",
            "DOB",
            "required",
            array(
                'required' => 'DOB should not be empty',
            )
        );

        $this->form_validation->set_rules(
            "governmentid_type",
            "governmentid_type",
            "required",
            array(
                'required' => 'governmentid_type should not be empty',
            )
        );

        $this->form_validation->set_rules(
            "governmentidno",
            "governmentidno",
            "required",
            array(
                'required' => 'governmentidno should not be empty',
            )
        );

        $this->form_validation->set_rules(
            "disabled",
            "disabled",
            "required",
            array(
                'required' => 'disabled should not be empty',
            )
        );

        // $this->form_validation->set_rules(
        //     "img",
        //     "img",
        //     "required",
        //     array(
        //         'required' => 'img should not be empty',
        //     )
        // );

        $this->form_validation->set_rules(
            "emg_no",
            "Emergency no",
            "required",
            array(
                'required' => 'Emergency no should not be empty',
            )
        );

        if ($this->form_validation->run() == false) {
            // very important query "LIFES SAVER"
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

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
        }
    }

    public function patientupdate_post()
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
        $profile = $this->security->xss_clean($this->input->post("profile"));

        $pat_id = $this->input->post('pat_id');

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

        if (!empty($_FILES['profile'])) {
            $fileName = $_FILES['profile']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/profile/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            $this->upload->overwrite = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('profile')) {
                $message1 = strip_tags($this->upload->display_errors());
            } else {
                $path = $this->upload->data();
                $profile = $path['file_name'];
            }
        } else {
            $message1 = '';
        }

        // $this->form_validation->set_rules(
        //     "first_name",
        //     "First Name",
        //     "required",
        //     array(
        //         'required' => 'first_name should not be empty',
        //     )
        // );

        // $this->form_validation->set_rules(
        //     "mobileNo",
        //     "Mobile No",
        //     "required",
        //     array(
        //         'required' => 'Mobile No should not be empty',
        //     )
        // );

        // $this->form_validation->set_rules(
        //     "profile",
        //     "Profile",
        //     "required",
        //     array(
        //         'required' => 'Profile is not send',
        //     )
        // );


        // if ($this->form_validation->run() == false) {

        //     // very important query "LIFES SAVER"
        //     $error = strip_tags(validation_errors());

        //     $this->response([
        //         "status" => False,
        //         "message" => $error,
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

        if (!empty($profile)) {
            $data['profile'] = $profile;
        }


        if ($data == '') {
        } else {
            $data = $this->Registerpatient_model->updatedata($pat_id, $data);
            $given_data = $this->Registerpatient_model->getdata($pat_id);
        }

        if ($data) {
            $this->response([
                'status' => !empty($message1) ? false : true,
                'message' => !empty($message1) ? $message1 : 'Patient Updated Successfully.',
                'data' => $given_data
            ], !empty($message1) ? REST_Controller::HTTP_INTERNAL_SERVER_ERROR : REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        // }
    }

    public function profile_post()
    {
        $pat_id = $this->post('pat_id');
        $profile = $this->security->xss_clean($this->input->post("profile"));

        $name = $this->db->select('first_name')->from('patients')->where('pat_id', $pat_id)->get()->row()->first_name ?? '';
        // $mobileNo = $this->db->select('mobile_no')->from('patients')->where('pat_id',$pat_id)->get()->row()->mobile_no ?? '';
        $email = $this->db->select('email')->from('patients')->where('pat_id', $pat_id)->get()->row()->email ?? '';

        if (!empty($_FILES['profile'])) {
            $fileName = $_FILES['profile']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/profile/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            $this->upload->overwrite = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('profile')) {
                $message1 = strip_tags($this->upload->display_errors());
            } else {
                $path = $this->upload->data();
                $profile = $path['file_name'];
            }
        } else {
            $message1 = '';
        }

        $data = array();
        // print_r($mobileNo);die();

        if (!empty($profile)) {
            $data['profile'] = $profile;

            // Here we are sending mail
            $url = 'https://softdigit.in/Ashu/assets/uploads/profile/' . '' . $profile;

            if (!empty($name) && !empty($email) && !empty($url)) {
                $this->Users->send_email($name, $email, $url);
            }

            if (!empty($mobileNo)) {
                // Here we are sending whatsapp
                $msg = "Click on this link to see Your Profile : \n$url";
                $this->load->config('twilio');
                $sid = $this->config->item('sid');
                $token = $this->config->item('token');
                $twilio_client = new Client($sid, $token);
                $phone = $this->config->item('phone');
                $whatsapp = $this->config->item('whatsapp');
                $twilio = $twilio_client->messages->create("whatsapp:{$mobileNo}", [
                    'from' => "whatsapp:$whatsapp",
                    'body' => $msg
                ]) ?? '';

                //Here we are sending sms
                $twilio_client->messages->create($mobileNo, [
                    'from' => $phone,
                    'body' => $msg
                ]); // ?? 'SMS failed due to '.$ex->getMessage();
                // $this->load->library('smsalert/Smsalertlib');
                // $this->smsalertlib->smssend($mobileNo, $msg);
            }
        }

        if ($data) {
            $data = $this->Registerpatient_model->updatedata($pat_id, $data);
            $this->response([
                'status' => !empty($message1) ? false : true,
                'message' => !empty($message1) ? $message1 : 'Patient Updated Successfully.',
            ], !empty($message1) ? REST_Controller::HTTP_INTERNAL_SERVER_ERROR : REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function profile1_post()
    {
        $pat_id = $this->post('pat_id');
        $profile = $this->security->xss_clean($this->input->post("profile"));

        $name = $this->db->select('first_name')->from('patients')->where('pat_id', $pat_id)->get()->row()->first_name ?? '';
        $mobileNo = $this->db->select('mobile_no')->from('patients')->where('pat_id', $pat_id)->get()->row()->mobile_no ?? '';
        $email = $this->db->select('email')->from('patients')->where('pat_id', $pat_id)->get()->row()->email ?? '';

        if (!empty($_FILES['profile'])) {
            $fileName = $_FILES['profile']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/profile/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
            $config['max_size']     = '1024000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            $this->upload->overwrite = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('profile')) {
                $message1 = strip_tags($this->upload->display_errors());
            } else {
                $path = $this->upload->data();
                $profile = $path['file_name'];
            }
        } else {
            $message1 = '';
        }

        $data = array();
        // print_r($mobileNo);die();

        if (!empty($profile)) {
            $data['profile'] = $profile;

            // Here we are sending mail
            $url = 'https://softdigit.in/Ashu/assets/uploads/profile/' . '' . $profile;

            if (!empty($name) && !empty($email) && !empty($url)) {
                $this->Users->send_email($name, $email, $url);
            }

            if (!empty($mobileNo)) {
                // Here we are sending whatsapp
                $msg = "Click on this link to see Your Profile : \n$url";
                $this->load->config('twilio');
                $sid = $this->config->item('sid');
                $token = $this->config->item('token');
                $twilio_client = new Client($sid, $token);
                $phone = $this->config->item('phone');
                $whatsapp = $this->config->item('whatsapp');
                $twilio = $twilio_client->messages->create("whatsapp:{$mobileNo}", [
                    'from' => "whatsapp:$whatsapp",
                    'body' => $msg
                ]) ?? '';

                //Here we are sending sms
                // $twilio_client->messages->create($mobileNo,[
                //     'from'=>$phone,
                //     'body'=>$msg
                // ]) ?? 'SMS failed due to '.$ex->getMessage();
                // $this->load->library('smsalert/Smsalertlib');
                // $this->smsalertlib->smssend($mobileNo, $msg);
            }
        }

        if ($data) {
            $data = $this->Registerpatient_model->updatedata($pat_id, $data);
            $this->response([
                'status' => !empty($message1) ? false : true,
                'message' => !empty($message1) ? $message1 : 'Patient Updated Successfully.',
            ], !empty($message1) ? REST_Controller::HTTP_INTERNAL_SERVER_ERROR : REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
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
