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
    }

    public function history_post()
    {
        // $key = $this->input->post('key');
        // $result  = $this->Leave_model->getuserkey($key);
        // if ($result) {
        // if ($result->role == 'ROLL_NAME') {

        // PATIENT DATA
        // $id = $this->input->post('id');
        $C_id = $this->input->post('C_id');
        $pat_id = $this->input->post('pat_id');
        // $dt = strtotime($this->input->post('dt'));

        // VISIT HISTORY
        $visit_type = $this->input->post('visit_type');
        $comments = $this->input->post(' visit_comments');

        // VISIT HISTORY
        $data1 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'visit_type' => $visit_type ?? '',
            'comments' => $comments ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        // CHIEF COMPLAINTS
        $chief_complaint_type = $this->input->post('chief_complaint_type');
        $name = $this->input->post('name');
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
            'pat_id' => $pat_id,

            'chief_complaint_type' => $chief_complaint_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'options' => $options ?? '',
            'comments2' => $comments2 ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        // SYSTEMIC HISTORY
        $systemic_history_type = $this->input->post('systemic_history_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('systemic_comments');
        $comments2 = $this->input->post('systemic_history_comments');
        $family_history = $this->input->post('family_history');
        $medical_history = $this->input->post('medical_history');
        $special_status = $this->input->post('special_status');

        // SYSTEMIC HISTORY
        $data3 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'systemic_history_type' => $systemic_history_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',
            'family_history' => $family_history ?? '',
            'medical_history' => $medical_history ?? '',
            'special_status' => $special_status ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        //DRUG ALLERGIES
        $drug_allergies_type = $this->input->post('drug_allergies_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('drug_comments');
        $comments2 = $this->input->post('drug_allergies_comments');

        // DRUG ALLERGIES
        $data4 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'drug_allergies_type' => $drug_allergies_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        // CONATCT ALLERGIES
        $contact_allergies_type = $this->input->post('contact_allergies_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('contact_comments');
        $comments2 = $this->input->post('contact_allergies_comments');

        // CONTACT ALLERGIES
        $data5 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'contact_allergies_type' => $contact_allergies_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',

            'created_at' => date('Y-m-d H:i:s'),
        );


        // // FOOD ALLERGIES
        $food_allergies_type = $this->input->post('food_allergies_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('food_comments');
        $comments2 = $this->input->post('food_allergies_comments');
        $other = $this->input->post('other');

        // FOOD ALLERGIES
        $data6 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'food_allergies_type' => $food_allergies_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
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
            'pat_id' => $pat_id,

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
            'pat_id' => $pat_id,

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
                'data' => array(
                    "Visit History" => $data1,
                    "Chief Complaints" => $data2,
                    "Systemic History" => $data3,
                    "Drug Allergies" => $data4,
                    "Contact Allergies" => $data5,
                    "Food Allergies" => $data6,
                    "Vital Signs" => $data7,
                    "Anthropometry" => $data8
                )
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
        // $id = $this->input->get('id');
        $C_id = $this->input->get('C_id');
        $pat_id = $this->input->get('pat_id');
        if ($C_id && $pat_id) {
            $data = $this->history_model->getData($C_id, $pat_id);
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
                'data' => 'Check Patient ID And Appointment ID.'
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
        $data1 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'visit_type' => $visit_type ?? '',
            'comments' => $comments ?? '',
        );


        // CHIEF COMPLAINTS
        $chief_complaint_type = $this->input->post('chief_complaint_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('chief_comments');
        $options = $this->input->post('options');
        $comments2 = $this->input->post('chief_complaints_comments');

        // CHIEF COMPLAINTS
        $data2 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'chief_complaint_type' => $chief_complaint_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'options' => $options ?? '',
            'comments2' => $comments2 ?? '',

        );


        // SYSTEMIC HISTORY
        $systemic_history_type = $this->input->post('systemic_history_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('systemic_comments');
        $comments2 = $this->input->post('systemic_history_comments');
        $family_history = $this->input->post('family_history');
        $medical_history = $this->input->post('medical_history');
        $special_status = $this->input->post('special_status');

        // SYSTEMIC HISTORY
        $data3 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'systemic_history_type' => $systemic_history_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',
            'family_history' => $family_history ?? '',
            'medical_history' => $medical_history ?? '',
            'special_status' => $special_status ?? '',
        );


        //DRUG ALLERGIES
        $drug_allergies_type = $this->input->post('drug_allergies_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('drug_comments');
        $comments2 = $this->input->post('drug_allergies_comments');

        // DRUG ALLERGIES
        $data4 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'drug_allergies_type' => $drug_allergies_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',
        );


        // CONATCT ALLERGIES
        $contact_allergies_type = $this->input->post('contact_allergies_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('contact_comments');
        $comments2 = $this->input->post('contact_allergies_comments');

        // CONTACT ALLERGIES
        $data5 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'contact_allergies_type' => $contact_allergies_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',
        );


        // // FOOD ALLERGIES
        $food_allergies_type = $this->input->post('food_allergies_type');
        $name = $this->input->post('name');
        $duration = $this->input->post('duration');
        $duration_unit = $this->input->post('duration_unit');
        $comments1 = $this->input->post('food_comments');
        $comments2 = $this->input->post('food_allergies_comments');
        $other = $this->input->post('other');

        // FOOD ALLERGIES
        $data6 = array(
            // 'id' => $id,
            'C_id' => $C_id,
            'pat_id' => $pat_id,

            'food_allergies_type' => $food_allergies_type ?? '',
            'name' => $name ?? '',
            'duration' => $duration ?? '',
            'duration_unit' => $duration_unit ?? '',
            'comments1' => $comments1 ?? '',
            'comments2' => $comments2 ?? '',
            'other' => $other ?? '',
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
            'pat_id' => $pat_id,

            'temperature' => $temperature ?? '',
            'pulse' => $pulse ?? '',
            'blood_pressure' => $blood_pressure ?? '',
            'rr' => $rr ?? '',
            'spo2' => $spo2 ?? '',
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
            'pat_id' => $pat_id,

            'height' => $height ?? '',
            'weight' => $weight ?? '',
            'bmi' => $bmi ?? '',
            'comments' => $comments ?? '',
        );

        if ($data1 == '') {
        } else {
            $data = $this->history_model->updatedata(
                $id,
                $data1,
                $data2,
                $data3,
                $data4,
                $data5,
                $data6,
                $data7,
                $data8
            );
            $given_data = $this->history_model->getdata($C_id, $pat_id);
        }

        if ($data) {
            $this->response([
                'status' => true,
                'message' => 'History Updated Successfully.',
                'data' => $given_data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unsuccessful.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function history_delete()
    {
        $id = $this->delete('id');

        $data = $this->history_model->deletedata($id);

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