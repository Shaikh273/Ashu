<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class History extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api/History_model');
        $this->history = 'history_visit';
        $this->org = 'organization';
        $this->test_cases = 'test_cases';
        $this->staff = 'staff';
        $this->pat = 'patients';
    }

    public function cases_get()
    {
        $pat_id = $this->input->get('pat_id');
        $data = array();
        if (!empty($pat_id)) {
            $cases = $this->db->select("DISTINCT(C_id)")->from($this->history)->where("$this->history.pat_id = '$pat_id'")->get()->result_array();
            // print_r($cases);die();
            $length = count($cases);
            for ($j = 0; $j < $length; ++$j) {
                $c_id = $cases[$j]['C_id'];
                $data[$j]['cases'] = $this->db->select("
                    $this->history.id AS ID,
                    $this->history.c_id,
                    $this->history.problem,
                    $this->history.description,
                    $this->history.created_by,
                    $this->history.created_at,
                    $this->history.updated_at,
                ")->from($this->history)->where("$this->history.C_id = '$c_id'")->get()->row();
                $data[$j]['test_cases'] = $this->db->select("test_cases.id,test_cases.test_id,test_cases.title,test_cases.reading,test_cases.staff_id,test_cases.status")->from($this->test_cases)->join('tests', 'test_cases.test_id = tests.id')->where("C_id = '$c_id'")->get()->result_array();
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

    public function cases_post()
    {
        // PATIENT DATA
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $staff = $this->security->xss_clean($this->input->post('created_by'));

        // VISIT HISTORY
        $problem = $this->input->post('problem');
        $description = $this->input->post('description');


        $this->form_validation->set_rules(
            "created_by",
            "Staff ID",
            "required",
            array(
                'required' => 'Please provide Staff ID',
            )
        );
        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        $this->form_validation->set_rules(
            "problem",
            "Problem",
            "required",
            array(
                'required' => 'Please Specify the Problem First',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $created_by = $this->db->select('u_id')->from($this->staff)->where('u_id', $staff)->get()->row()->u_id ?? '';

            if (empty($created_by)) {
                $this->response([
                    'status' => false,
                    'message' => "Clinic Operator doesn't Exist, Please Contact Admin",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $c_id = $this->db->select('C_id')->from($this->history)->order_by('id', 'DESC')->get()->row()->C_id ?? 'c_c_0';

            if (date('m') <= 3) {
                $year = date('Y') - 1;
                $next_year = date('Y');
            } else {
                $year = date('Y');
                $next_year = date('Y') + 1;
            }

            $c_id =  explode('_', $c_id)[2] + 1;
            $C_id = "Case_{$year}-{$next_year}_0" . $c_id;



            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';
            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';

            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';
            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            // VISIT HISTORY
            $data1 = array(
                'pat_id' => $pat_id,
                'org_id' => $org_id,
                'C_id' => $C_id,
                'problem' => $problem,
                'created_by' => $created_by,
                'description' => $description ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            $data = $this->db->insert('history_visit', $data1);

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'History Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function opthalmichistory_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';
            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';

            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }


            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            // OPTHALMIC HISTORY
            $name = $this->input->post('opthalmic_history_name');
            $duration = $this->input->post('duration');
            $duration_unit = $this->input->post('duration_unit');
            $opthalmic_comments = $this->input->post('opthalmic_comments');
            $opthalmic_history_comments = $this->input->post('opthalmic_history_comments');

            // OPTHALMIC HISTORY
            $data = array(
                // 'id' => $id,
                'pat_id' => $pat_id,
                'name' => $name ?? '',
                'duration' => $duration ?? '',
                'duration_unit' => $duration_unit ?? '',
                'opthalmic_comments' => $opthalmic_comments ?? '',
                'opthalmic_history_comments' => $opthalmic_history_comments ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert('history_opthalmic_history', $data);
            }

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Opthalmic History Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function systemichistory_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';
            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';

            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }


            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            // SYSTEMIC HISTORY
            $name = $this->input->post('systemic_history_name');
            $duration = $this->input->post('duration');
            $duration_unit = $this->input->post('duration_unit');
            $systemic_comments = $this->input->post('systemic_comments');
            $systemic_history_comments = $this->input->post('systemic_history_comments');

            // SYSTEMIC HISTORY
            $data = array(
                // 'id' => $id,
                'pat_id' => $pat_id,
                'name' => $name ?? '',
                'duration' => $duration ?? '',
                'duration_unit' => $duration_unit ?? '',
                'systemic_comments' => $systemic_comments ?? '',
                'systemic_history_comments' => $systemic_history_comments ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert('history_systemic_history', $data);
            }

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Systemic History Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function medicalhistory_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';
            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';

            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }


            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            // Medical HISTORY
            $family_history = $this->input->post('family_history');
            $medical_history = $this->input->post('medical_history');

            // Medical HISTORY
            $data = array(
                // 'id' => $id,
                'pat_id' => $pat_id,
                'family_history' => $family_history ?? '',
                'medical_history' => $medical_history ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert('history_medical_history', $data);
            }

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Medical History Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function  paediatrichistory_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';
            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';

            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            // Paediatric HISTORY
            $nutrition_assess = $this->input->post('nutrition_assess');
            $nutrition_comments = $this->input->post('nutrition_comments');
            $immunization_asses = $this->input->post('immunization_asses');
            $immunization_comments = $this->input->post('immunization_comments');

            // Paediatric HISTORY
            $data = array(
                // 'id' => $id,
                'pat_id' => $pat_id,
                'nutrition_assess' => $nutrition_assess ?? '',
                'nutrition_comments' => $nutrition_comments ?? '',
                'immunization_asses' => $immunization_asses ?? '',
                'immunization_comments' => $immunization_comments ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert('history_paediatric_history', $data);
            }

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Paediatric History Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function drugallergies_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';
            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';

            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }


            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            //DRUG ALLERGIES
            $name3 = $this->input->post('drug_allergies_name');
            $duration = $this->input->post('duration');
            $duration_unit = $this->input->post('duration_unit');
            $drug_comments = $this->input->post('drug_comments');
            $drug_allergies_comments = $this->input->post('drug_allergies_comments');

            // DRUG ALLERGIES
            $data = array(
                // 'id' => $id,
                'pat_id' => $pat_id,
                'name' => $name3 ?? '',
                'duration' => $duration ?? '',
                'duration_unit' => $duration_unit ?? '',
                'drug_comments' => $drug_comments ?? '',
                'drug_allergies_comments' => $drug_allergies_comments ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert('history_drug_allergies', $data);
            }

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Drug Allergies Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function contactallergies_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';
            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';

            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }


            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            // CONATCT ALLERGIES
            $name = $this->input->post('contact_allergies_name');
            $duration = $this->input->post('duration');
            $duration_unit = $this->input->post('duration_unit');
            $contact_comments = $this->input->post('contact_comments');
            $contact_allergies_comments = $this->input->post('contact_allergies_comments');

            // CONTACT ALLERGIES
            $data = array(
                // 'id' => $id,
                'pat_id' => $pat_id,
                'name' => $name ?? '',
                'duration' => $duration ?? '',
                'duration_unit' => $duration_unit ?? '',
                'contact_comments' => $contact_comments ?? '',
                'contact_allergies_comments' => $contact_allergies_comments ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert('history_contact_allergies', $data);
            }

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Contact Allergies Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function foodallergies_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $this->form_validation->set_rules(
            "pat_id",
            "Patient ID",
            "required",
            array(
                'required' => 'Require Patient ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';
            $org_exist = $this->db->select('org_id')->from($this->org)->where('org_id', $org_id)->get()->row()->org_id ?? '';

            if (empty($org_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Organization doesn't exist, Please Check it First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }


            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't exist, Please Add them First",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            // // FOOD ALLERGIES
            $name5 = $this->input->post('food_allergies_name');
            $duration = $this->input->post('duration');
            $duration_unit = $this->input->post('duration_unit');
            $food_comments = $this->input->post('food_comments');
            $food_allergies_comments = $this->input->post('food_allergies_comments');
            $other_comments = $this->input->post('other_comments');

            // FOOD ALLERGIES
            $data = array(
                // 'id' => $id,
                'pat_id' => $pat_id,
                'name' => $name5 ?? '',
                'duration' => $duration ?? '',
                'duration_unit' => $duration_unit ?? '',
                'food_comments' => $food_comments ?? '',
                'food_allergies_comments' => $food_allergies_comments ?? '',
                'other_comments' => $other_comments ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert('history_food_allergies', $data);
            }

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Food Allergies Added Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function history_get()
    {
        $pat_id = $this->input->get('pat_id');

        $data = array();
        if (!empty($pat_id)) {
            $data['patients'] = $this->db->select("*")->from($this->pat)->where("pat_id = '$pat_id'")->get()->row(); //[$j][$this->history]
            $data['opthalmic_history'] = $this->db->select("*")->from('history_opthalmic_history')->where("pat_id = '$pat_id'")->get()->row() ?? [];
            $data['systemic_history'] = $this->db->select("*")->from('history_systemic_history')->where("pat_id = '$pat_id'")->get()->row() ?? [];
            $data['medical_history'] = $this->db->select("*")->from('history_medical_history')->where("pat_id = '$pat_id'")->get()->row() ?? [];
            $data['paediatric_history'] = $this->db->select("*")->from('history_paediatric_history')->where("pat_id = '$pat_id'")->get()->row() ?? [];
            $data['drug_allergies'] = $this->db->select("*")->from('history_drug_allergies')->where("pat_id = '$pat_id'")->get()->row() ?? [];
            $data['contact_allergies'] = $this->db->select("*")->from('history_contact_allergies')->where("pat_id = '$pat_id'")->get()->row() ?? [];
            $data['food_allergies'] = $this->db->select("*")->from('history_food_allergies')->where("pat_id = '$pat_id'")->get()->row() ?? [];
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

    public function historyupdate_post()
    {
        // PATIENT DATA
        // $id = $this->post('id');
        $pat_id = $this->input->post('pat_id');

        // $C_id = $this->input->post('C_id');
        // $staff = $this->security->xss_clean($this->input->post('created_by'));

        // $created_by = $this->db->select('u_id')->from($this->staff)->where('u_id', $staff)->get()->row()->u_id ?? '';

        // if (empty($created_by)) {
        //     $this->response([
        //         'status' => false,
        //         'message' => "Clinic Operator doesn't Exist, Please Contact Admin",
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // }

        // $C_id = $this->db->select('C_id')->from($this->history)->where('C_id', $C_id)->get()->row()->C_id ?? '';

        // if (empty($C_id)) {
        //     $this->response([
        //         'status' => false,
        //         'message' => "Case Not Found, Please create a New Case",
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // }

        // VISIT HISTORY
        // $problem = $this->input->post('problem');
        // $description = $this->input->post('description');

        // VISIT HISTORY
        // $data1 = array();
        // if (!empty($problem)) {
        //     $data1['problem'] = $problem;
        // }
        // if (!empty($description)) {
        //     $data1['description'] = $description;
        // }

        $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';

        if (empty($patient_exist)) {
            $this->response([
                'status' => false,
                'message' => "Patient doesn't Exist",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        // CHIEF COMPLAINTS
        $chief_complaint_type = $this->input->post('chief_complaint_type');
        $chief_complaint_name = $this->input->post('chief_complaint_name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments2 = $this->input->post('chief_comments');
        $options = $this->input->post('options');
        $comments3 = $this->input->post('chief_complaints_comments');

        // CHIEF COMPLAINTS
        $data2 = array();
        if (!empty($chief_complaint_type)) {
            $data2['chief_complaint_type'] = $chief_complaint_type;
        }
        if (!empty($chief_complaint_name)) {
            $data2['name'] = $chief_complaint_name;
        }
        if (!empty($duration)) {
            $data2['duration'] = $duration;
        }
        if (!empty($duration_unit)) {
            $data2['duration_unit'] = $duration_unit;
        }
        if (!empty($options)) {
            $data2['options'] = $options;
        }
        if (!empty($comments2)) {
            $data2['comments1'] = $comments2;
        }
        if (!empty($comments3)) {
            $data2['comments2'] = $comments3;
        }

        // SYSTEMIC HISTORY
        $systemic_history_type = $this->input->post('systemic_history_type');
        $systemic_history_name = $this->input->post('systemic_history_name');
        $duration1 = $this->input->post('duration1');
        $duration_unit1 = $this->input->post('duration_unit1');
        $comments4 = $this->input->post('systemic_comments');
        $comments5 = $this->input->post('systemic_history_comments');
        $family_history = $this->input->post('family_history');
        $medical_history = $this->input->post('medical_history');
        $special_status = $this->input->post('special_status');

        // SYSTEMIC HISTORY
        $data3 = array();
        if (!empty($systemic_history_type)) {
            $data3['systemic_history_type'] = $systemic_history_type;
        }
        if (!empty($systemic_history_name)) {
            $data3['name'] = $systemic_history_name;
        }
        if (!empty($duration1)) {
            $data3['duration'] = $duration1;
        }
        if (!empty($duration_unit1)) {
            $data3['duration_unit'] = $duration_unit1;
        }
        if (!empty($comments4)) {
            $data3['comments1'] = $comments4;
        }
        if (!empty($comments5)) {
            $data3['comments2'] = $comments5;
        }
        if (!empty($family_history)) {
            $data3['family_history'] = $family_history;
        }
        if (!empty($medical_history)) {
            $data3['medical_history'] = $medical_history;
        }
        if (!empty($special_status)) {
            $data3['special_status'] = $special_status;
        }

        //DRUG ALLERGIES
        $drug_allergies_type = $this->input->post('drug_allergies_type');
        $drug_allergies_name = $this->input->post('name');
        $duration2 = $this->input->post('duration2');
        $duration_unit2 = $this->input->post('duration_unit2');
        $comments6 = $this->input->post('drug_comments');
        $comments7 = $this->input->post('drug_allergies_comments');

        // DRUG ALLERGIES
        $data4 = array();
        if (!empty($drug_allergies_type)) {
            $data4['drug_allergies_type'] = $drug_allergies_type;
        }
        if (!empty($drug_allergies_name)) {
            $data4['name'] = $drug_allergies_name;
        }
        if (!empty($duration2)) {
            $data4['duration'] = $duration2;
        }
        if (!empty($duration_unit2)) {
            $data4['duration_unit'] = $duration_unit2;
        }
        if (!empty($comments6)) {
            $data4['comments1'] = $comments6;
        }
        if (!empty($comments7)) {
            $data4['comments2'] = $comments7;
        }

        // CONATCT ALLERGIES
        $contact_allergies_type = $this->input->post('contact_allergies_type');
        $contact_allergies_name = $this->input->post('contact_allergies_name');
        $duration3 = $this->input->post('duration3');
        $duration_unit3 = $this->input->post('duration_unit3');
        $comments8 = $this->input->post('contact_comments');
        $comments9 = $this->input->post('contact_allergies_comments');

        // CONTACT ALLERGIES
        $data5 = array();
        if (!empty($contact_allergies_type)) {
            $data5['contact_allergies_type'] = $contact_allergies_type;
        }
        if (!empty($contact_allergies_name)) {
            $data5['name'] = $contact_allergies_name;
        }
        if (!empty($duration3)) {
            $data5['duration'] = $duration3;
        }
        if (!empty($duration_unit3)) {
            $data5['duration_unit'] = $duration_unit3;
        }
        if (!empty($comments8)) {
            $data5['comments1'] = $comments8;
        }
        if (!empty($comments9)) {
            $data5['comments2'] = $comments9;
        }

        // // FOOD ALLERGIES
        $food_allergies_type = $this->input->post('food_allergies_type');
        $name = $this->input->post('name');
        $duration4 = $this->input->post('duration4');
        $duration_unit4 = $this->input->post('duration_unit4');
        $comments10 = $this->input->post('food_comments');
        $comments11 = $this->input->post('food_allergies_comments');
        $other = $this->input->post('other');

        // FOOD ALLERGIES
        $data6 = array();
        if (!empty($food_allergies_type)) {
            $data6['food_allergies_type'] = $food_allergies_type;
        }
        if (!empty($food_allergies_name)) {
            $data6['name'] = $food_allergies_name;
        }
        if (!empty($duration4)) {
            $data6['duration'] = $duration4;
        }
        if (!empty($duration_unit4)) {
            $data6['duration_unit'] = $duration_unit4;
        }
        if (!empty($comments10)) {
            $data6['comments1'] = $comments10;
        }
        if (!empty($comments11)) {
            $data6['comments2'] = $comments11;
        }

        // VITAL SIGNS
        $temperature = $this->input->post('temperature');
        $pulse = $this->input->post('pulse');
        $blood_pressure = $this->input->post('blood_pressure');
        $rr = $this->input->post('rr');
        $spo2 = $this->input->post('spo2');

        // VITAL SIGNS
        $data7 = array();
        if (!empty($temperature)) {
            $data7['temperature'] = $temperature;
        }
        if (!empty($pulse)) {
            $data7['pulse'] = $pulse;
        }
        if (!empty($blood_pressure)) {
            $data7['blood_pressure'] = $blood_pressure;
        }
        if (!empty($rr)) {
            $data7['rr'] = $rr;
        }
        if (!empty($spo2)) {
            $data7['spo2'] = $spo2;
        }

        // ANTHROPOMETRY HISTORY
        $height = $this->input->post('height');
        $weight = $this->input->post('weight');
        $bmi = $this->input->post('bmi');
        $comments12 = $this->input->post('anthropometry_comments');

        // ANTHROPOMETRY HISTORY
        $data8 = array();
        if (!empty($height)) {
            $data8['height'] = $height;
        }
        if (!empty($weight)) {
            $data8['weight'] = $weight;
        }
        if (!empty($bmi)) {
            $data8['bmi'] = $bmi;
        }
        if (!empty($comments12)) {
            $data8['comments'] = $comments12;
        }

        if (empty($data2) && empty($data3) && empty($data4) && empty($data5) && empty($data6) && empty($data7) && empty($data8)) {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $data = $this->History_model->updatedata(
                $pat_id,
                $data2,
                $data3,
                $data4,
                $data5,
                $data6,
                $data7,
                $data8
            );

            if ($data) {
                $this->response([
                    'status' => true,
                    'message' => 'History Updated Successfully.',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function cases_delete()
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


    // -----------------------------Test Cases------------------------------- //

    public function test_cases_post()
    {
        $C_id = $this->security->xss_clean($this->input->post('C_id'));
        // $problem =  $this->security->xss_clean($this->input->post('problem'));
        // $description =  $this->security->xss_clean($this->input->post('description'));
        $test_id =  $this->security->xss_clean($this->input->post('test_id'));
        $reading =  $this->security->xss_clean($this->input->post('reading'));

        $title =  $this->security->xss_clean($this->input->post('title'));
        $status =  $this->security->xss_clean($this->input->post('status'));

        $staff = $this->security->xss_clean($this->input->post('created_by'));

        $staff_id = $this->db->select('u_id')->from($this->staff)->where('u_id', $staff)->get()->row()->u_id ?? '';

        if (empty($staff_id)) {
            $this->response([
                'status' => false,
                'message' => "Clinic Operator doesn't Exist, Please Contact Admin",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        $C_id = $this->db->select('C_id')->from($this->history)->where('C_id', $C_id)->get()->row()->C_id ?? '';

        if (empty($C_id)) {
            $this->response([
                'status' => false,
                'message' => "Case Not Found, Please create a New Case",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        $this->form_validation->set_rules('C_id', 'Cases Id', 'required', array(
            'required' => 'Case Id is Missing'
        ));
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
                // 'problem' => $problem,
                // 'description' => $description,
                'test_id' => $test_id,
                'reading' => $reading,
                'staff_id' => $staff_id,
                'title' => $title,
                'status' => $status,
            );

            $insert = $this->db->insert($this->test_cases, $data);
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
        // $problem = $this->security->xss_clean($this->input->post('problem'));
        // $description = $this->security->xss_clean($this->input->post('description'));
        $test_id = $this->security->xss_clean($this->input->post('test_id'));
        $title =  $this->security->xss_clean($this->input->post('title'));
        $reading = $this->security->xss_clean($this->input->post('reading'));
        $staff_id = $this->security->xss_clean($this->input->post('staff_id'));
        $status = $this->security->xss_clean($this->input->post('status'));

        $data = array();
        if (!empty($problem) && !empty($id)) {
            $data['problem'] = $problem;
        }
        if (!empty($title) && !empty($id)) {
            $data['title'] = $title;
        }
        // if (!empty($description) && !empty($id)) {
        //     $data['description'] = $description;
        // }
        if (!empty($test_id) && !empty($id)) {
            $data['test_id'] = $test_id;
        }
        if (!empty($reading) && !empty($id)) {
            $data['reading'] = $reading;
        }
        if (!empty($staff_id) && !empty($id)) {
            $data['staff_id'] = $staff_id;
        }
        if (!empty($status) && !empty($id)) {
            $data['status'] = $status;
        }

        $update = $this->db->update($this->test_cases, $data, array('id' => $id));
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
}
