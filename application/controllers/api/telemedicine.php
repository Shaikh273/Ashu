<?php

if (!defined('BASEPATH')) exit('No Direct Scripts access are Allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class telemedicine extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tele = 'telemedicine';
        $this->pat = 'patients';
        $this->staff = 'staff';
        $this->role = 'role';
        $this->history_visit = 'history_visit';
    }

    public function telemedicine_get()
    {
        $case_id = $this->security->xss_clean($this->input->get('case_id'));
        $data = $this->db->select('*')->from($this->tele)->where('case_id', $case_id)->get()->result_array();
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

    public function telemedicine1_get()
    {
        $tele_id = $this->security->xss_clean($this->input->get('tele_id'));

        // $tele = $this->db->select('*')->from($this->tele)->where("tele_id = '$tele_id'")->get()->row()->tele ?? '';
        $data = array();
        $pat_id = $this->db->select('pat_id')->from($this->tele)->where("tele_id= '$tele_id'")->get()->row()->pat_id ?? '';

        $org_id = $this->db->select('org_id')->from($this->pat)->where("pat_id = '$pat_id'")->get()->row()->org_id ?? '';

        if (!empty($org_id)) {
            $data['visit_history'] =
                $this->db->select("history_visit.id AS ID ")
                ->from('history_visit')->where("history_visit.org_id = '$org_id'  XOR history_visit.C_id = '$org_id' XOR history_visit.pat_id = '$org_id'")->get()->result();


            $case_id = $this->db->select('C_id,pat_id')->from('history_visit')->where("history_visit.org_id = '$org_id' XOR history_visit.C_id = '$org_id' XOR history_visit.pat_id = '$org_id'")->get()->result();
            $length = count($case_id);

            for ($i = 0; $i < $length; ++$i) {
                $pat_id = $case_id[$i]->pat_id;
                $c_id = $case_id[$i]->C_id;
                
                $data['visit_history'][$i]->organization = $this->db->select("organization.*")->from('organization')->where('org_id', $org_id)->get()->row() ?? [];
                $data['visit_history'][$i]->patient_data = $this->db->select("patients.*")->from('patients')->where('pat_id', $pat_id)->get()->row();
                $data['visit_history'][$i]->visit =
                    $this->db->select("
                    history_visit.id AS ID,
                    history_visit.c_id,
                    history_visit.visit_type,
                    history_visit.created_by,
                    history_visit.created_at,
                    history_visit.updated_at,
                ")->from('history_visit')->where("history_visit.org_id = '$c_id'  XOR history_visit.C_id = '$c_id' XOR history_visit.pat_id = '$c_id'")->get()->result();

                $data['visit_history'][$i]->chief_complaints = $this->db->select("*")->from('history_chief_complaints')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->systemic_history = $this->db->select("*")->from('history_systemic_history')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->drug_allergies = $this->db->select("*")->from('history_drug_allergies')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->contact_allergies = $this->db->select("*")->from('history_contact_allergies')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->vital_signs = $this->db->select("*")->from('history_vital_signs')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->anthropometry = $this->db->select("*")->from('history_anthropometry')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->test_cases = $this->db->select("test_cases.id,test_cases.problem,test_cases.description,test_cases.reading,test_cases.doctor_id,test_cases.status")->from('test_cases')->join('tests', 'test_cases.test_id = tests.id')->where("C_id = '$c_id'")->get()->result();
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
        } else {
            $this->response([
                'status' => false,
                'message' => 'Telemedicine Not Found',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function telemedicine_post()
    {
        $case_id = $this->security->xss_clean($this->input->post('case_id'));
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $doc_id = $this->security->xss_clean($this->input->post('doc_id'));
        $start_time = $this->security->xss_clean($this->input->post('start_time'));
        $end_time = $this->security->xss_clean($this->input->post('end_time'));
        $status = $this->security->xss_clean($this->input->post('status'));

        $case_exist = $this->db->select('C_id')->from($this->history_visit)->where('C_id', $case_id)->get()->row()->C_id ?? '';
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

        $doctor_exist = $this->db->select('u_id')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where(array('u_id' => $doc_id, "$this->role.role" => 'Doctor'))->get()->row()->u_id ?? '';
        if (empty($doctor_exist)) {
            $this->response([
                'status' => false,
                'message' => "Doctor doesn't Exist",
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        // $tele_id = $this->security->xss_clean($this->input->post('tele_id'));

        $tele_id = $this->db->select('tele_id')->from($this->tele)->order_by('id', 'DESC')->get()->row()->tele_id ?? 'tele_0';

        if (date('m') <= 3) {
            $year = date('Y') - 1;
            // $next_year = date('Y');
        } else {
            $year = date('Y');
            // $next_year = date('Y') + 1;
        }
        // print_r($tele_id);
        // die();

        $tele_id =  explode('_', $tele_id)[1] + 1;
        $tele_id = "Tele{$year}_0" . $tele_id;

        // print_r($tele_id);die();

        $t1 = new DateTime($start_time);
        $t2 = new DateTime($end_time);
        $duration = $t1->diff($t2);
        $total_time =  $duration->format('%h') . " Hours " . $duration->format('%i') . " Minutes";
        // print_r($end_time . ' ' . $start_time);
        // die();
        $data = [
            "tele_id" => $tele_id,
            "pat_id" => $pat_id,
            "doc_id" => $doc_id,
            "start_time" => $start_time,
            "end_time" => $end_time,
            "duration" => $total_time,
            "status" => $status,
            "created_at" => date('Y-m-d H:i:s'),
        ];


        $result = $this->db->insert($this->tele, $data);
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Telemdeicine Added',
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Internal Server Error',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
