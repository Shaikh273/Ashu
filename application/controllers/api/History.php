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
        $this->load->model('api/history_model');
        $this->history = 'history_visit';
    }

    public function history_post()
    {
        // $key = $this->input->post('key');
        // $result  = $this->Leave_model->getuserkey($key);
        // if ($result) {
        // if ($result->role == 'ROLL_NAME') {

        // PATIENT DATA
        // $id = $this->input->post('id');
        $org_id = $this->security->xss_clean($this->input->post('org_id'));
        $c_id = $this->db->select('C_id')->from($this->history)->order_by('id', 'DESC')->get()->row()->C_id ?? 'c_c_0';

        if (date('m') <= 3) {
            $year = date('Y') - 1;
            $next_year = date('Y');
        } else {
            $year = date('Y');
            $next_year = date('Y') + 1;
        }
        // print_r($c_id);die();
        $c_id =  explode('_', $c_id)[2] + 1;
        $C_id = "Case_{$year}-{$next_year}_0" . $c_id;

        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        // $dt = strtotime($this->input->post('dt'));

        // VISIT HISTORY
        $visit_type = $this->input->post('visit_type');
        $comments = $this->input->post('comments');

        // VISIT HISTORY
        $data1 = array(
            'pat_id' => $pat_id,
            'org_id' => $org_id,
            'C_id' => $C_id,
            'visit_type' => $visit_type ?? '',
            'comments' => $comments ?? '',
            'created_at' => date('Y-m-d H:i:s'),
        );
        // print_r($data1);die();

        // CHIEF COMPLAINTS
        $chief_complaint_type = $this->input->post('chief_complaint_type');
        $name1 = $this->input->post('chief_complaint_name');
        // $side = $this->input->post('side');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('chief_comments');
        $options = $this->input->post('options');
        $comments2 = $this->input->post('chief_complaints_comments');

        // CHIEF COMPLAINTS
        $data2 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'chief_complaint_type' => $chief_complaint_type ?? '',
            'name' => $name1 ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'options' => $options ?? '',
            'comments2' => $comments2 ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        // SYSTEMIC HISTORY
        $systemic_history_type = $this->input->post('systemic_history_type');
        $name2 = $this->input->post('systemic_history_name');
        $duration1 = $this->input->post('duration1');
        $duration_unit1 = $this->input->post('duration_unit1');
        $comments1 = $this->input->post('systemic_comments');
        $comments2 = $this->input->post('systemic_history_comments');
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
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',
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
        $comments1 = $this->input->post('drug_comments');
        $comments2 = $this->input->post('drug_allergies_comments');

        // DRUG ALLERGIES
        $data4 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'drug_allergies_type' => $drug_allergies_type ?? '',
            'name' => $name3 ?? '',
            'duration' => $duration2 ?? '',
            'duration_unit' => $duration_unit2 ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        // CONATCT ALLERGIES
        $contact_allergies_type = $this->input->post('contact_allergies_type');
        $name4 = $this->input->post('contact_allergies_name');
        $duration3 = $this->input->post('duration3');
        $duration_unit3 = $this->input->post('duration_unit3');
        $comments1 = $this->input->post('contact_comments');
        $comments2 = $this->input->post('contact_allergies_comments');

        // CONTACT ALLERGIES
        $data5 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'contact_allergies_type' => $contact_allergies_type ?? '',
            'name' => $name4 ?? '',
            'duration' => $duration3 ?? '',
            'duration_unit' => $duration_unit3 ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        // // FOOD ALLERGIES
        $food_allergies_type = $this->input->post('food_allergies_type');
        $name5 = $this->input->post('food_allergies_name');
        $duration4 = $this->input->post('duration4');
        $duration_unit4 = $this->input->post('duration_unit4');
        $comments1 = $this->input->post('food_comments');
        $comments2 = $this->input->post('food_allergies_comments');
        $other = $this->input->post('other');

        // FOOD ALLERGIES
        $data6 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'food_allergies_type' => $food_allergies_type ?? '',
            'name' => $name5 ?? '',
            'duration' => $duration4 ?? '',
            'duration_unit' => $duration_unit4 ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',
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
        $comments = $this->input->post('anthropometry_comments');

        // ANTHROPOMETRY HISTORY
        $data8 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'height' => $height ?? '',
            'weight' => $weight ?? '',
            'bmi' => $bmi ?? '',
            'comments' => $comments ?? '',
            'created_at' => date('Y-m-d H:i:s'),
        );


        // '$created_at' => date('Y-m-d H:i:s);
        // $this->form_validation->set_rules('comments1', 'Comment Type', 'trim|required');
        // $this->form_validation->set_rules('comments2', 'Comment Type', 'trim|required');
        // if ($this->form_validation->run() == FALSE) {
        //     $this->response([
        //         'status' => false,
        //         'message' => "Provide complete Remark type Description info to add."
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // } else {

        if ($data1 == '') {
        } else {
            $data = $this->history_model->insertdata(
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
                // 'data' => array(
                //     "Visit History" => $data1,
                //     "Chief Complaints" => $data2,
                //     "Systemic History" => $data3,
                //     "Drug Allergies" => $data4,
                //     "Contact Allergies" => $data5,
                //     "Food Allergies" => $data6,
                //     "Vital Signs" => $data7,
                //     "Anthropometry" => $data8
                // )
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        // } else {
        // $getadd = $this->Other_model->getadddata($emp_id, $month, $year);
        // if ($getadd == true) {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Allready Add Data Added.'
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // } else {
        //     // $insert = $this->Other_model->insertData($data);
        //     if ($insert == true) {
        //         $this->response([
        //             'status' => true,
        //             'message' => 'Remark Add Successfully.'
        //         ], REST_Controller::HTTP_OK);
        //     } else {
        //         $this->response([
        //             'status' => true,
        //             'message' => 'Remark Add Unsuccessfully.'
        //         ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        //     }
        // }
        // }
        // }
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'No direct access allowed'
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // }
        // } else {
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Data Not Founded.'
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // }
    }

    public function history_get()
    {
        $org_id = $this->input->get('org_id');
        // $C_id = $this->input->get('C_id');
        // $pat_id = $this->input->get('pat_id');
        $data = array();
        if (!empty($org_id)) {
            $data['history_visit'] =
            $this->db->select("history_visit.id AS ID,history_visit.visit_type,history_visit.created_at,history_visit.created_at,history_visit.updated_at,organization.*,patients.*")->from('history_visit')->join('organization', 'history_visit.org_id = organization.org_id')->join('patients', 'history_visit.pat_id = patients.pat_id')->where("history_visit.org_id = '$org_id'")->get()->result();

            $case_id = $this->db->select('C_id')->from('history_visit')->get()->result();
            $length = count($case_id);

            for ($i = 0; $i < $length; ++$i) {
                $c_id = $case_id[$i]->C_id;
                $data['history_visit'][$i]->history_chief_complaints = $this->db->select("*")->from('history_chief_complaints')->where("C_id = '$c_id'")->get()->result();
                $data['history_visit'][$i]->history_systemic_history = $this->db->select("*")->from('history_systemic_history')->where("C_id = '$c_id'")->get()->result();
                $data['history_visit'][$i]->history_drug_allergies = $this->db->select("*")->from('history_drug_allergies')->where("C_id = '$c_id'")->get()->result();
                $data['history_visit'][$i]->history_contact_allergies = $this->db->select("*")->from('history_contact_allergies')->where("C_id = '$c_id'")->get()->result();
                $data['history_visit'][$i]->history_vital_signs = $this->db->select("*")->from('history_vital_signs')->where("C_id = '$c_id'")->get()->result();
                $data['history_visit'][$i]->history_anthropometry = $this->db->select("*")->from('history_anthropometry')->where("C_id = '$c_id'")->get()->result();
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

        // VISIT HISTORY
        $visit_type = $this->input->post('visit_type');
        $comments = $this->input->post(' visit_comments');

        // VISIT HISTORY
        $data1 = array();
        if (!empty($visit_type)) {
            $data1['visit_type'] = $visit_type;
        }
        if (!empty($comments)) {
            $data1['comments'] = $comments;
        }


        // CHIEF COMPLAINTS
        $chief_complaint_type = $this->input->post('chief_complaint_type');
        $chief_complaint_name = $this->input->post('chief_complaint_name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('chief_comments');
        $options = $this->input->post('options');
        $comments2 = $this->input->post('chief_complaints_comments');

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
        if (!empty($comments1)) {
            $data2['comments1'] = $comments1;
        }
        if (!empty($comments2)) {
            $data2['comments2'] = $comments2;
        }
        
        // SYSTEMIC HISTORY
        $systemic_history_type = $this->input->post('systemic_history_type');
        $systemic_history_name = $this->input->post('systemic_history_name');
        $duration1 = $this->input->post('duration1');
        $duration_unit1 = $this->input->post('duration_unit1');
        $comments1 = $this->input->post('systemic_comments');
        $comments2 = $this->input->post('systemic_history_comments');
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
        if (!empty($comments1)) {
            $data3['comments1'] = $comments1;
        }
        if (!empty($comments2)) {
            $data3['comments2'] = $comments2;
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
        $comments1 = $this->input->post('drug_comments');
        $comments2 = $this->input->post('drug_allergies_comments');
        
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
        if (!empty($comments1)) {
            $data4['comments1'] = $comments1;
        }
        if (!empty($comments2)) {
            $data4['comments2'] = $comments2;
        }
        // 'drug_allergies_type' => $drug_allergies_type ?? '',
        // 'name' => $name ?? '',
        // 'duration' => $duration ?? '',
        // 'duration_unit' => $duration_unit ?? '',
        // 'comments1' => $comments1 ?? '',
        // 'comments2' => $comments2 ?? '',
        
        
        // CONATCT ALLERGIES
        $contact_allergies_type = $this->input->post('contact_allergies_type');
        $contact_allergies_name = $this->input->post('contact_allergies_name');
        $duration3 = $this->input->post('duration3');
        $duration_unit3 = $this->input->post('duration_unit3');
        $comments1 = $this->input->post('contact_comments');
        $comments2 = $this->input->post('contact_allergies_comments');
        
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
        if (!empty($comments1)) {
            $data5['comments1'] = $comments1;
        }
        if (!empty($comments2)) {
            $data5['comments2'] = $comments2;
        }
        // 'contact_allergies_type' => $contact_allergies_type ?? '',
        // 'name' => $name ?? '',
        // 'duration' => $duration ?? '',
        // 'duration_unit' => $duration_unit ?? '',
        // 'comments1' => $comments1 ?? '',
        // 'comments2' => $comments2 ?? '',
        
        
        // // FOOD ALLERGIES
        $food_allergies_type = $this->input->post('food_allergies_type');
        $name = $this->input->post('name');
        $duration4 = $this->input->post('duration4');
        $duration_unit4 = $this->input->post('duration_unit4');
        $comments1 = $this->input->post('food_comments');
        $comments2 = $this->input->post('food_allergies_comments');
        $other = $this->input->post('other');
        
        // FOOD ALLERGIES
        $data6 = array();
        // 'id' => $id,
        // 'C_id' => $C_id,
        // 'pat_id' => $pat_id,            
        // 'food_allergies_type' => $food_allergies_type ?? '',
        // 'name' => $name ?? '',
        // 'duration' => $duration ?? '',
        // 'duration_unit' => $duration_unit ?? '',
        // 'comments1' => $comments1 ?? '',
        // 'comments2' => $comments2 ?? '',
        // 'other' => $other ?? '',
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
        if (!empty($comments1)) {
            $data6['comments1'] = $comments1;
        }
        if (!empty($comments2)) {
            $data6['comments2'] = $comments2;
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
        $comments = $this->input->post('anthropometry_comments');
        
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
        if (!empty($comments)) {
            $data8['comments'] = $comments;
        }
        // 'height' => $height ?? '',
        // 'weight' => $weight ?? '',
        // 'bmi' => $bmi ?? '',
        // 'comments' => $comments ?? '',
        
        if (empty($data1)) {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $data = $this->history_model->updatedata(
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
            
            // print_r($C_id);die();           
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
        $data = $this->history_model->deletedata($case_id);

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
