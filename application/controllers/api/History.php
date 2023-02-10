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
    }

    public function history_post()
    {
        // $key = $this->input->post('key');
        // $result  = $this->Leave_model->getuserkey($key);
        // if ($result) {
        // if ($result->role == 'ROLL_NAME') {

        // PATIENT DATA
        $staff = $this->security->xss_clean($this->input->post('created_by'));

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

        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        // VISIT HISTORY
        $problem = $this->input->post('problem');
        $description = $this->input->post('description');

        $org_id = $this->db->select('org_id')->from('patients')->where("pat_id", $pat_id)->get()->row()->org_id ?? '';

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

        $this->form_validation->set_rules(
            "created_by",
            "Staff ID",
            "required",
            array(
                'required' => 'Please provide Staff ID',
            )
        );

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

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

            // CHIEF COMPLAINTS
            $chief_complaint_type = $this->input->post('chief_complaint_type');
            $name1 = $this->input->post('chief_complaint_name');
            // $side = $this->input->post('side');
            $duration = $this->input->post('duration');
            $duration_unit = $this->input->post('duration_unit');
            $comments2 = $this->input->post('chief_comments');
            $options = $this->input->post('options');
            $comments3 = $this->input->post('chief_complaints_comments');

            // CHIEF COMPLAINTS
            $data2 = array(
                // 'id' => $id,
                'C_id' => $C_id,
                'chief_complaint_type' => $chief_complaint_type ?? '',
                'name' => $name1 ?? '',
                'duration' => $duration ?? '',
                'duration_unit' => $duration_unit ?? '',
                'comments1' => $comments2 ?? '',
                'options' => $options ?? '',
                'comments2' => $comment3 ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );


            // SYSTEMIC HISTORY
            $systemic_history_type = $this->input->post('systemic_history_type');
            $name2 = $this->input->post('systemic_history_name');
            $duration1 = $this->input->post('duration1');
            $duration_unit1 = $this->input->post('duration_unit1');
            $comments4 = $this->input->post('systemic_comments');
            $comments5 = $this->input->post('systemic_history_comments');
            $family_history = $this->input->post('family_history');
            $medical_history = $this->input->post('medical_history');
            $special_status = $this->input->post('special_status');

            // SYSTEMIC HISTORY
            $data3 = array(
                // 'id' => $id,
                'C_id' => $C_id,
                'systemic_history_type' => $systemic_history_type ?? '',
                'name' => $name2 ?? '',
                'duration' => $duration1 ?? '',
                'duration_unit' => $duration_unit1 ?? '',
                'comments1' => $comments4 ?? '',
                'comments2' => $comments5 ?? '',
                'family_history' => $family_history ?? '',
                'medical_history' => $medical_history ?? '',
                'special_status' => $special_status ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );


            //DRUG ALLERGIES
            $drug_allergies_type = $this->input->post('drug_allergies_type');
            $name3 = $this->input->post('drug_allergies_name');
            $duration2 = $this->input->post('duration2');
            $duration_unit2 = $this->input->post('duration_unit2');
            $comments6 = $this->input->post('drug_comments');
            $comments7 = $this->input->post('drug_allergies_comments');

            // DRUG ALLERGIES
            $data4 = array(
                // 'id' => $id,
                'C_id' => $C_id,
                'drug_allergies_type' => $drug_allergies_type ?? '',
                'name' => $name3 ?? '',
                'duration' => $duration2 ?? '',
                'duration_unit' => $duration_unit2 ?? '',
                'comments1' => $comments6 ?? '',
                'comments2' => $comments7 ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );


            // CONATCT ALLERGIES
            $contact_allergies_type = $this->input->post('contact_allergies_type');
            $name4 = $this->input->post('contact_allergies_name');
            $duration3 = $this->input->post('duration3');
            $duration_unit3 = $this->input->post('duration_unit3');
            $comments8 = $this->input->post('contact_comments');
            $comments9 = $this->input->post('contact_allergies_comments');

            // CONTACT ALLERGIES
            $data5 = array(
                // 'id' => $id,
                'C_id' => $C_id,
                'contact_allergies_type' => $contact_allergies_type ?? '',
                'name' => $name4 ?? '',
                'duration' => $duration3 ?? '',
                'duration_unit' => $duration_unit3 ?? '',
                'comments1' => $comments8 ?? '',
                'comments2' => $comments9 ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );


            // // FOOD ALLERGIES
            $food_allergies_type = $this->input->post('food_allergies_type');
            $name5 = $this->input->post('food_allergies_name');
            $duration4 = $this->input->post('duration4');
            $duration_unit4 = $this->input->post('duration_unit4');
            $comments10 = $this->input->post('food_comments');
            $comments11 = $this->input->post('food_allergies_comments');
            $other = $this->input->post('other');

            // FOOD ALLERGIES
            $data6 = array(
                // 'id' => $id,
                'C_id' => $C_id,
                'food_allergies_type' => $food_allergies_type ?? '',
                'name' => $name5 ?? '',
                'duration' => $duration4 ?? '',
                'duration_unit' => $duration_unit4 ?? '',
                'comments1' => $comments10 ?? '',
                'comments2' => $comments11 ?? '',
                'other' => $other ?? '',

                'created_at' => date('Y-m-d H:i:s'),
            );


            // VITAL SIGNS
            $temperature = $this->input->post('temperature');
            $pulse = $this->input->post('pulse');
            $blood_pressure = $this->input->post('blood_pressure');
            $rr = $this->input->post('rr');
            $spo2 = $this->input->post('spo2');

            // VITAL SIGNS
            $data7 = array(
                // 'id' => $id,
                'C_id' => $C_id,
                'temperature' => $temperature ?? '',
                'pulse' => $pulse ?? '',
                'blood_pressure' => $blood_pressure ?? '',
                'rr' => $rr ?? '',
                'spo2' => $spo2 ?? '',
                'created_at' => date('Y-m-d H:i:s'),
            );


            // ANTHROPOMETRY HISTORY
            $height = $this->input->post('height');
            $weight = $this->input->post('weight');
            $bmi = $this->input->post('bmi');
            $comments12 = $this->input->post('anthropometry_comments');

            // ANTHROPOMETRY HISTORY
            $data8 = array(
                // 'id' => $id,
                'C_id' => $C_id,
                'height' => $height ?? '',
                'weight' => $weight ?? '',
                'bmi' => $bmi ?? '',
                'comments' => $comments12 ?? '',
                'created_at' => date('Y-m-d H:i:s'),
            );

            if ($data1 == '') {
            } else {
                $data = $this->History_model->insertdata(
                    $data1,
                    $data2,
                    $data3,
                    $data4,
                    $data5,
                    $data6,
                    $data7,
                    $data8
                );
            }

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


    public function history_get()
    {
        $org_id = $this->input->get('org_id');

        $data = array();
        if (!empty($org_id)) {
            $organization = $this->db->select('org_id')->from($this->history)->where("$this->history.org_id = '$org_id' XOR $this->history.C_id = '$org_id' XOR $this->history.pat_id = '$org_id'")->get()->row()->org_id ?? '';

            $data['organization'] = $this->db->select("$this->org.*")->from($this->org)->where('org_id', $organization)->get()->row() ?? [];

            $patients = $this->db->select("DISTINCT(pat_id)")->from($this->history)->where("$this->history.org_id = '$org_id' XOR $this->history.C_id = '$org_id' XOR $this->history.pat_id = '$org_id'")->get()->result();

            $is_cases = $this->db->select('C_id')->from($this->history)->where("C_id = '$org_id'")->get()->num_rows();

            $length = count($patients);
            for ($j = 0; $j < $length; ++$j) {
                $pat_id = $patients[$j]->pat_id;
                $data['patients'][$j]['patient'] = $this->db->select("patients.*")->from('patients')->where('pat_id', $pat_id)->get()->row();
                if ($is_cases > 0) {
                    $case_id = $this->db->select("DISTINCT(C_id)")->from($this->history)->where("$this->history.org_id = '$org_id' XOR $this->history.C_id = '$org_id' XOR $this->history.pat_id = '$org_id'")->get()->result();
                } else {
                    $case_id = $this->db->select("DISTINCT(C_id)")->from($this->history)->where("pat_id = '$pat_id'")->get()->result();
                }
                $length1 = count($case_id);
                $data2 = array();
                for ($i = 0; $i < $length1; ++$i) {
                    $c_id = $case_id[$i]->C_id;
                    $data2[$i]['visit'] =
                        $this->db->select("
                        $this->history.id AS ID,
                        $this->history.c_id,
                        $this->history.problem,
                        $this->history.description,
                        $this->history.created_by,
                        $this->history.created_at,
                        $this->history.updated_at,
                    ")->from($this->history)->where("$this->history.C_id = '$c_id'")->get()->result();

                    $data2[$i]['chief_complaints'] = $this->db->select("*")->from('history_chief_complaints')->where("C_id = '$c_id'")->get()->result();
                    $data2[$i]['systemic_history'] = $this->db->select("*")->from('history_systemic_history')->where("C_id = '$c_id'")->get()->result();
                    $data2[$i]['drug_allergies'] = $this->db->select("*")->from('history_drug_allergies')->where("C_id = '$c_id'")->get()->result();
                    $data2[$i]['contact_allergies'] = $this->db->select("*")->from('history_contact_allergies')->where("C_id = '$c_id'")->get()->result();
                    $data2[$i]['vital_signs'] = $this->db->select("*")->from('history_vital_signs')->where("C_id = '$c_id'")->get()->result();
                    $data2[$i]['anthropometry'] = $this->db->select("*")->from('history_anthropometry')->where("C_id = '$c_id'")->get()->result();
                    $data2[$i]['test_cases'] = $this->db->select("test_cases.id,test_cases.test_id,test_cases.title,test_cases.reading,test_cases.staff_id,test_cases.status")->from($this->test_cases)->join('tests', 'test_cases.test_id = tests.id')->where("C_id = '$c_id'")->get()->result();
                }
                $data['patients'][$j][$this->history] = $data2;
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

    public function historyupdate_post()
    {
        // PATIENT DATA
        $id = $this->post('id');
        $C_id = $this->input->post('C_id');
        $pat_id = $this->input->post('pat_id');

        $staff = $this->security->xss_clean($this->input->post('created_by'));

        $created_by = $this->db->select('u_id')->from($this->staff)->where('u_id', $staff)->get()->row()->u_id ?? '';

        if (empty($created_by)) {
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

        // VISIT HISTORY
        $problem = $this->input->post('problem');
        $description = $this->input->post('description');

        // VISIT HISTORY
        $data1 = array();
        if (!empty($problem)) {
            $data1['problem'] = $problem;
        }
        if (!empty($description)) {
            $data1['description'] = $description;
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

        if (empty($data1)) {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $data = $this->History_model->updatedata(
                $C_id,
                $data1,
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

    public function history_delete()
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
