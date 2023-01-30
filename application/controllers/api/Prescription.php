<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Prescription extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->pres = 'prescription';
        // $this->taper = 'taper';
        $this->instruction = 'instructions';
    }

    public function prescription_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $C_id = $this->security->xss_clean($this->input->post('C_id'));
        $staff_id = $this->security->xss_clean($this->input->post('staff_id'));
        $name = $this->security->xss_clean($this->input->post('medicine_name'));
        $type = $this->security->xss_clean($this->input->post('type'));
        $quantity = $this->security->xss_clean($this->input->post('quantity'));
        $frequency = $this->security->xss_clean($this->input->post('frequency'));
        $duration = $this->security->xss_clean($this->input->post('duration'));
        $duration_unit = $this->security->xss_clean($this->input->post('duration_unit'));
        // $taper_id = $this->security->xss_clean($this->input->post('taper_id'));
        $instruction = $this->security->xss_clean($this->input->post('instruction'));

        // $instruction_id = $this->security->xss_clean($this->input->post('instruction_id'));

        $this->form_validation->set_rules('C_id', 'Cases ID', 'required', array(
            'required' => 'Case ID is Missing'
        ));
        $this->form_validation->set_rules('pat_id', 'Patient ID', 'required', array(
            'required' => 'Patient ID is Missing'
        ));
        $this->form_validation->set_rules('staff_id', 'Doctor ID', 'required', array(
            'required' => 'Doctor ID is Missing'
        ));
        $this->form_validation->set_rules('instruction', 'Instruction', 'required', array(
            'required' => 'Please Provide Instructions for Medication'
        ));

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());
            $this->response([
                "status" => false,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = array(
                "pat_id" => $pat_id,
                "C_id" => $C_id,
                "staff_id" => $staff_id,
                "medicine_name" => $name ?? '',
                "type" => $type ?? '',
                "quantity" => $quantity ?? '',
                "frequency" => $frequency ?? '',
                "duration" => $duration ?? '',
                "duration_unit" => $duration_unit ?? '',
                // "taper_id" => $taper_id ?? '',
                "instruction" => $instruction,
                // "instruction_id" => $instruction_id ?? '',

                "created_at" => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data = $this->db->insert($this->pres, $data);

                if ($data == true) {
                    $this->response([
                        'status' => true,
                        'message' => 'Prescription Added Successfully.',
                    ], REST_Controller::HTTP_OK);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unable to add Prescription.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function labtest_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));

        $C_id = $this->security->xss_clean($this->input->post('C_id'));
        $staff_id = $this->security->xss_clean($this->input->post('staff_id'));
        $test = $this->security->xss_clean($this->input->post('test'));
        $description = $this->security->xss_clean($this->input->post('description'));

        $this->form_validation->set_rules('C_id', 'Cases ID', 'required', array(
            'required' => 'Case ID is Missing'
        ));
        $this->form_validation->set_rules('pat_id', 'Patient ID', 'required', array(
            'required' => 'Patient ID is Missing'
        ));
        $this->form_validation->set_rules('staff_id', 'Doctor ID', 'required', array(
            'required' => 'Doctor ID is Missing'
        ));

        if ($this->from_validation->run() == False) {
            $error = strip_tags(validation_errors());
            $this->response([
                "status" => False,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = array(
                "pat_id" => $pat_id,
                "C_id" => $C_id,
                "staff_id" => $staff_id,
                "test" => $test ?? '',
                "description" => $description ?? '',

                "created_at" => date('Y-m-d H:i:s'),
            );
        }
        if (!empty($data)) {
            $data = $this->db->insert($this->pres, $data);

            if ($data == true) {
                $this->response([
                    'status' => true,
                    'message' => 'Lab Test Added Successfully.',
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Unable to add Lab Test.'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function prescription_get()
    {
        $C_id = $this->input->get('C_id');

        $data = array();
        if (!empty($C_id)) {
            $data['Prescription'] = $this->db->select('*')->from($this->pres)->where("C_id", $C_id)->get()->result_array();

            $prescription = $this->db->select('id')->from($this->pres)->where("C_id", $C_id)->get()->result_array();

            $length = count($prescription);

            for ($i = 0; $i < $length; ++$i) {
                $p_id = $prescription[$i]['id'];

                // $data['Prescription'][$i]['Taper'] = $this->db->select("*")->from($this->taper)->where("prescription_id", $p_id)->get()->result_array();

                $data['Prescription'][$i]['instruction'] = $this->db->select("*")->from($this->instruction)->where("prescription_id", $p_id)->get()->result_array();
            }
        } else {
            $master = $this->db->select('DISTINCT(C_id)')->from($this->pres)->get()->result();

            $length = count($master);

            for ($i = 0; $i < $length; ++$i) {
                $C_id = $master[$i]->C_id;

                $data[$i]['Prescription'] = $this->db->select('*')->from($this->pres)->where("C_id", $C_id)->get()->result_array();

                $prescription = $this->db->select('id')->from($this->pres)->where("C_id", $C_id)->get()->result_array();

                $length1 = count($prescription);

                for ($j = 0; $j < $length1; ++$j) {
                    $p_id = $prescription[$j]['id'];

                    // $data[$i]['Prescription'][$j]['Taper'] = $this->db->select("*")->from($this->taper)->where("prescription_id", $p_id)->get()->result_array();

                    $data[$i]['Prescription'][$j]['instruction'] = $this->db->select("*")->from($this->instruction)->where("prescription_id", $p_id)->get()->result_array();
                }
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

    public function prescription_delete()
    {
        $id = $this->delete('id');

        $data = $this->db->delete($this->pres, array('id' => $id));
        // $this->db->delete($this->taper, array('prescription_id' => $id));
        $this->db->delete($this->instruction, array('prescription_id' => $id));

        if ($data) {
            $this->response([
                "status" => TRUE,
                "id" => $id,
                "message" => "Data Deleted"
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "status" => FALSE,
                "message" => "Unable to Delete Data"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    // public function taper_post()
    // {
    //     $medicine_name = $this->security->xss_clean($this->input->post('medicine_name'));
    //     $no_of_days = $this->security->xss_clean($this->input->post('no_of_days'));
    //     $start_date = $this->security->xss_clean($this->input->post('start_date'));
    //     $start_time = $this->security->xss_clean($this->input->post('start_time'));
    //     $end_time = $this->security->xss_clean($this->input->post('end_start'));
    //     $frequency = $this->security->xss_clean($this->input->post('frequency'));
    //     $frequency_unit = $this->security->xss_clean($this->input->post('frequency_unit'));
    //     $interval = $this->security->xss_clean($this->input->post('interval'));
    //     $interval_unit = $this->security->xss_clean($this->input->post('interval_unit'));

    //     $prescription_id = $this->security->xss_clean($this->input->post('prescription_id'));

    //     $this->form_validation->set_rules('prescription_id', 'Prescription ID', 'required', array(
    //         'required' => 'Prescription ID is Missing'
    //     ));

    //     $this->form_validation->set_rules('medicine_name', 'Medicine Name', 'required', array(
    //         'required' => 'Medicine Name is required'
    //     ));

    //     if ($this->form_validation->run() == false) {
    //         $error = strip_tags(validation_errors());
    //         $this->response([
    //             "status" => False,
    //             "mesage" => $error
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     } else {
    //         $data = array(
    //             "prescription_id" => $prescription_id,

    //             "medicine_name" => $medicine_name,
    //             "no_of_days" => $no_of_days,
    //             "start_date" => $start_date,
    //             "start_time" => $start_time,
    //             "end_time" => $end_time,
    //             "frequency" => $frequency,
    //             "frequency_unit" => $frequency_unit,
    //             "interval" => $interval,
    //             "interval_unit" => $interval_unit,

    //             "created_at" => date('Y-m-d H:i:s'),
    //         );

    //         if (!empty($data)) {
    //             $insert = $this->db->insert($this->taper, $data);

    //             if ($insert == True) {
    //                 $this->response([
    //                     "status" => TRUE,
    //                     "message" => "Taper Added Successfully",
    //                     "data" => $data,
    //                 ], REST_CONTROLLER::HTTP_OK);
    //             } else {
    //                 $this->response([
    //                     "status" => False,
    //                     "message" => "Unable to add Taper",
    //                 ], REST_Controller::HTTP_BAD_REQUEST);
    //             }
    //         }
    //     }
    // }

    // public function taper_update_post()
    // {
    //     $id = $this->security->xss_clean($this->input->post('id'));

    //     $medicine_name = $this->security->xss_clean($this->input->post('medicine_name'));
    //     $no_of_days = $this->security->xss_clean($this->input->post('no_of_days'));
    //     $start_date = $this->security->xss_clean($this->input->post('start_date'));
    //     $start_time = $this->security->xss_clean($this->input->post('start_time'));
    //     $end_time = $this->security->xss_clean($this->input->post('end_start'));
    //     $frequency = $this->security->xss_clean($this->input->post('frequency'));
    //     $frequency_unit = $this->security->xss_clean($this->input->post('frequency_unit'));
    //     $interval = $this->security->xss_clean($this->input->post('interval'));
    //     $interval_unit = $this->security->xss_clean($this->input->post('interval_unit'));

    //     $prescription_id = $this->security->xss_clean($this->input->post('prescription_id'));

    //     $data = array();
    //     if (!empty($medicine_name) && !empty($id)) {
    //         $data['medicine_name'] = $medicine_name;
    //     }
    //     if (!empty($no_of_days) && !empty($id)) {
    //         $data['no_of_days'] = $no_of_days;
    //     }
    //     if (!empty($start_date) && !empty($id)) {
    //         $data['start_date'] = $start_date;
    //     }
    //     if (!empty($start_time) && !empty($id)) {
    //         $data['start_time'] = $start_time;
    //     }
    //     if (!empty($end_time) && !empty($id)) {
    //         $data['end_time'] = $end_time;
    //     }
    //     if (!empty($frequency) && !empty($id)) {
    //         $data['frequency'] = $frequency;
    //     }
    //     if (!empty($frequency_unit) && !empty($id)) {
    //         $data['frequency_unit'] = $frequency_unit;
    //     }
    //     if (!empty($interval) && !empty($id)) {
    //         $data['interval'] = $interval;
    //     }
    //     if (!empty($interval_unit) && !empty($id)) {
    //         $data['interval_unit'] = $interval_unit;
    //     }
    //     if (!empty($prescription_id) && !empty($id)) {
    //         $data['prescription_id'] = $prescription_id;
    //     }

    //     $update = $this->db->update($this->taper, $data, array('id' => $id));

    //     if ($update) {
    //         $this->response([
    //             "status" => true,
    //             "message" => "Data Updated Successfully"
    //         ], REST_Controller::HTTP_OK);
    //     } else {
    //         $this->response([
    //             "status" => false,
    //             "message" => "Data Update Unsuccessful"
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }

    // public function instruction_post()
    // {
    //     $instruction = $this->security->xss_clean($this->input->post('instruction'));

    //     $prescription_id = $this->security->xss_clean($this->input->post('prescription_id'));

    //     $this->form_validation->set_rules('prescription_id', 'Prescription ID', 'required', array(
    //         'required' => 'Prescription ID is Missing'
    //     ));

    //     if ($this->form_validation->run() == false) {
    //         $error = strip_tags(validation_errors());
    //         $this->response([
    //             "status" => False,
    //             "mesage" => $error
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     } else {
    //         $data = array(
    //             "prescription_id" => $prescription_id,
    //             "instruction" => $instruction,

    //             "created_at" => date('Y-m-d H:i:s'),
    //         );

    //         if (!empty($data)) {
    //             $insert = $this->db->insert($this->instruction, $data);

    //             if ($insert == True) {
    //                 $this->response([
    //                     "status" => TRUE,
    //                     "message" => "Instruction Added Successfully",
    //                     "data" => $data,
    //                 ], REST_CONTROLLER::HTTP_OK);
    //             } else {
    //                 $this->response([
    //                     "status" => False,
    //                     "message" => "Unable to add Instructions",
    //                 ], REST_Controller::HTTP_BAD_REQUEST);
    //             }
    //         }
    //     }
    // }

    // public function instruction_update_post()
    // {
    //     $id = $this->security->xss_clean($this->input->post('id'));

    //     $instruction = $this->security->xss_clean($this->input->post('instruction'));

    //     $prescription_id = $this->security->xss_clean($this->input->post('prescription_id'));

    //     $data = array();
    //     if (!empty($instruction) && !empty($id)) {
    //         $data['instruction'] = $instruction;
    //     }
    //     if (!empty($prescription_id) && !empty($id)) {
    //         $data['prescription_id'] = $prescription_id;
    //     }

    //     $update = $this->db->update($this->instruction, $data, array('id' => $id));

    //     if ($update) {
    //         $this->response([
    //             "status" => true,
    //             "message" => "Data Updated Successfully"
    //         ], REST_Controller::HTTP_OK);
    //     } else {
    //         $this->response([
    //             "status" => false,
    //             "message" => "Data Update Unsuccessful"
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
}
