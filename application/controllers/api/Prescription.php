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
        $this->taper = 'taper';
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
        $taper_id = $this->security->xss_clean($this->input->post('taper_id'));
        $instruction_id = $this->security->xss_clean($this->input->post('instruction_id'));

        $this->form_validation->set_rules('C_id', 'Cases Id', 'required', array(
            'required' => 'Case Id is Missing'
        ));
        $this->form_validation->set_rules('pat_id', 'Patient Id', 'required', array(
            'required' => 'Patient Id is Missing'
        ));
        $this->form_validation->set_rules('staff_id', 'Doctor Id', 'required', array(
            'required' => 'Doctor Id is Missing'
        ));

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());
            $this->response([
                "status" => false,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = array(
                "pat_id" => $pat_id ?? '',
                "C_id" => $C_id ?? '',
                "staff_id" => $staff_id ?? '',
                "medicine_name" => $name ?? '',
                "type" => $type ?? '',
                "quantity" => $quantity ?? '',
                "frequency" => $frequency ?? '',
                "duration" => $duration ?? '',
                "duration_unit" => $duration_unit ?? '',
                "taper_id" => $taper_id ?? '',
                "instruction_id" => $instruction_id ?? '',

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
                    'message' => 'Unsuccessful.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
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
                $data['Prescription'][$i]['Taper'] = $this->db->select("*")->from($this->taper)->where("prescription_id", $p_id)->get()->result_array();
            }
        } else {
            $master = $this->db->select('DISTINCT(C_id)')->from($this->pres)->get()->result();
            $length = count($master);


            for ($i = 0; $i < $length; ++$i) {

                $C_id = $master[$i]->C_id;

                $data[$i]['Prescription'] = $this->db->select('*')->from($this->pres)->where("C_id", $C_id)->get()->result_array();
                $prescription = $this->db->select('id')->from($this->pres)->where("C_id", $C_id)->get()->result_array();
                $length = count($prescription);
                for ($j = 0; $j < $length; ++$j) {
                    $p_id = $prescription[$j]['id'];
                    $data[$i]['Prescription'][$j]['Taper'] = $this->db->select("*")->from($this->taper)->where("prescription_id", $p_id)->get()->result_array();
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
    }

    public function taper_post()
    {
        $medicine_name = $this->security->xss_clean($this->input->post('medicine_name'));
        $no_of_days = $this->security->xss_clean($this->input->post('no_of_days'));
        $start_date = $this->security->xss_clean($this->input->post('start_date'));
        $start_time = $this->security->xss_clean($this->input->post('start_time'));
        $end_time = $this->security->xss_clean($this->input->post('end_start'));
        $frequency = $this->security->xss_clean($this->input->post('frequency'));
        $frequency_unit = $this->security->xss_clean($this->input->post('frequency_unit'));
        $interval = $this->security->xss_clean($this->input->post('interval'));
        $interval_unit = $this->security->xss_clean($this->input->post('interval_unit'));

        $C_id = $this->security->xss_clean($this->input->post('C_id'));

        $this->form_validation->set_rules('C_id', 'Cases Id', 'required', array(
            'required' => 'Case Id is Missing'
        ));

        $this->form_validation->set_rules('medicine_name', 'Medicine Name', 'required', array(
            'required' => 'Medicine Name is required'
        ));

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());
            $this->response([
                "status" => False,
                "mesage" => $error
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = array(
                "C_id" => $C_id,

                "medicine_name" => $medicine_name,
                "no_of_days" => $no_of_days,
                "start_date" => $start_date,
                "start_time" => $start_time,
                "end_time" => $end_time,
                "frequency" => $frequency,
                "frequency_unit" => $frequency_unit,
                "interval" => $interval,
                "interval_unit" => $interval_unit,

                "created_at" => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $insert = $this->db->insert($this->taper, $data);

                if ($insert == True) {
                    $this->response([
                        "status" => TRUE,
                        "message" => "Taper Added Successfully",
                        "data" => $data,
                    ], REST_CONTROLLER::HTTP_OK);
                } else {
                    $this->response([
                        "status" => False,
                        "message" => "Some Error Occured",
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }
    }

    public function taper_get()
    {
        $C_id = $this->input->get('C_id');

        $data = array();
        if (!empty($C_id)) {

            $data['Prescription'] = $this->db->select("*")->from($this->pres)->where("C_id = '$C_id' XOR pat_id = '$C_id'")->get()->result() ?? [];
        } else {
            $this->response([
                'status' => True,
                'message' => 'Prescription Not Found',
            ], REST_Controller::HTTP_NOT_FOUND);
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
}
