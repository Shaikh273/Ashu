<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Appointments extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->app = "appointments";
        $this->staff = "staff";
        $this->history_visit = "history_visit";
        $this->pat = "patients";
        // $this->load->model('api/Users_model');
    }


    public function appointments_get()
    {
        $C_id = $this->input->get('C_id');

        $data = array();
        if (!empty($C_id)) {
            $data['appointments'] = $this->db->select("$this->staff.name AS staff,$this->app.*")->from($this->app)->join($this->staff, "$this->app.staff_id = $this->staff.u_id")->where("$this->app . C_id = '$C_id' xor $this->app . pat_id = '$C_id'")->get()->result_array();
        } else {
            $master = $this->db->select('DISTINCT(C_id)')->from($this->app)->get()->result();

            $length = count($master);

            for ($i = 0; $i < $length; ++$i) {
                $C_id = $master[$i]->C_id;

                $data[$i]['appointments'] = $this->db->select("$this->staff.name,$this->app.*")->from($this->app)->join($this->staff, "$this->app.staff_id = $this->staff.u_id")->where("C_id", $C_id)->get()->result_array();
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

    public function appointments_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $C_id = $this->security->xss_clean($this->input->post('C_id'));
        $staff_id = $this->security->xss_clean($this->input->post('staff_id'));
        $appointment_date = $this->security->xss_clean($this->input->post('appointment_date'));
        $appointment_time = $this->security->xss_clean($this->input->post('appointment_time'));

        $this->form_validation->set_rules('C_id', 'Cases ID', 'required', array(
            'required' => 'Case ID is Missing'
        ));
        $this->form_validation->set_rules('pat_id', 'Patient ID', 'required', array(
            'required' => 'Patient ID is Missing'
        ));
        $this->form_validation->set_rules('staff_id', 'Doctor ID', 'required', array(
            'required' => 'Doctor ID is Missing'
        ));

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());
            $this->response([
                "status" => false,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $case_exist = $this->db->select('C_id')->from($this->history_visit)->where('C_id', $C_id)->get()->row()->C_id ?? '';
            if (empty($case_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Case doesn't Exist",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';
            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't Exist",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $staff_exist = $this->db->select('u_id')->from($this->staff)->where(array('u_id' => $staff_id))->get()->row()->u_id ?? '';
            if (empty($staff_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Staff doesn't Exist",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $data = array(
                "pat_id" => $pat_id,
                "C_id" => $C_id,
                "staff_id" => $staff_id,
                "appointment_date" => $appointment_date,
                "appointment_time" => $appointment_time,
                "created_at" => date('Y-m-d H:i:s'),
            );

            if (!empty($data)) {
                $data1 = $this->db->insert($this->app, $data);

                if ($data1 == true) {
                    $this->response([
                        'status' => true,
                        'message' => 'Appointment Added Successfully.',
                        'data' => $data
                    ], REST_Controller::HTTP_OK);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unable to add Appointment.'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function appointments_update_post()
    {
        $id = $this->security->xss_clean($this->input->post('id'));
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $C_id = $this->security->xss_clean($this->input->post('C_id'));
        $staff_id = $this->security->xss_clean($this->input->post('staff_id'));
        $appointment_date = $this->security->xss_clean($this->input->post('appointment_date'));
        $appointment_time = $this->security->xss_clean($this->input->post('appointment_time'));

        $data = [];

        $appointments_exist = $this->db->select('id')->from($this->app)->where(array('id' => $id))->get()->row()->id ?? '';
        if (empty($appointments_exist)) {
            $this->response([
                'status' => false,
                'message' => "Appointments doesn't Exist",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        if (!empty($C_id)) {
            $case_exist = $this->db->select('C_id')->from($this->history_visit)->where('C_id', $C_id)->get()->row()->C_id ?? '';
            if (empty($case_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Case doesn't Exist",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        if (!empty($pat_id)) {
            $patient_exist = $this->db->select('pat_id')->from($this->pat)->where('pat_id', $pat_id)->get()->row()->pat_id ?? '';
            if (empty($patient_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Patient doesn't Exist",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        if (!empty($staff_id) && !empty($id)) {
            $staff_exist = $this->db->select('u_id')->from($this->staff)->where(array('u_id' => $staff_id))->get()->row()->u_id ?? '';
            if (empty($staff_exist)) {
                $this->response([
                    'status' => false,
                    'message' => "Staff doesn't Exist",
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
            $data['staff_id'] = $staff_id;
        }

        if (!empty($appointment_date) && !empty($id)) {
            $data['appointment_date'] = $appointment_date;
        }

        if (!empty($appointment_time) && !empty($id)) {
            $data['appointment_time'] = $appointment_time;
        }

        $update = $this->db->update($this->app, $data, array('id' => $id));

        if ($update) {
            $this->response([
                "status" => true,
                "message" => "Data Updated Successfully",
                "data" => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                "status" => false,
                "message" => "Internal Server Error"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function appointments_delete()
    {
        $id = $this->delete('id');
        $appointments_exist = $this->db->select('id')->from($this->app)->where(array('id' => $id))->get()->row()->id ?? '';
        if (empty($appointments_exist)) {
            $this->response([
                'status' => false,
                'message' => "Appointments doesn't Exist",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        $data = $this->db->delete($this->app, array('id' => $id));

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
}
