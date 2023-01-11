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
    }

    public function telemedicine_get()
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
                // print_r($pat_id);die();
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
                ")
                    // ->from('history_visit')->join('organization', 'history_visit.org_id = organization.org_id')->join('patients', 'history_visit.pat_id = patients.pat_id')->where("history_visit.org_id = '$org_id'  XOR history_visit.C_id = '$org_id' XOR history_visit.pat_id = '$org_id'")->get()->result();
                    ->from('history_visit')->where("history_visit.org_id = '$c_id'  XOR history_visit.C_id = '$c_id' XOR history_visit.pat_id = '$c_id'")->get()->result();

                $data['visit_history'][$i]->chief_complaints = $this->db->select("*")->from('history_chief_complaints')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->systemic_history = $this->db->select("*")->from('history_systemic_history')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->drug_allergies = $this->db->select("*")->from('history_drug_allergies')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->contact_allergies = $this->db->select("*")->from('history_contact_allergies')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->vital_signs = $this->db->select("*")->from('history_vital_signs')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->anthropometry = $this->db->select("*")->from('history_anthropometry')->where("C_id = '$c_id'")->get()->result();
                $data['visit_history'][$i]->test_cases = $this->db->select("test_cases.id,test_cases.problem,test_cases.description,test_cases.reading,test_cases.doctor_id,test_cases.status")->from('test_cases')->join('tests', 'test_cases.test_id = tests.id')->where("C_id = '$c_id'")->get()->result();
            }
            // print_r($data);die();


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
        //     $role = $this->db->select('role')->from($this->role)->where("$this->role.id = '$tele_id'")->get()->row()->role ?? '';
        //     $data = [];
        //     if (!empty($role)) {
        //         if ($role == 'Super Admin') {
        //             $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->tele)->join($this->role, "$this->tele.tele_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
        //             $staff = $this->db->select('DISTINCT(u_id)')->from($this->tele)->join($this->role, "$this->tele.tele_id = $this->role.id")->where("admin = '$u_id' AND $this->role.role = 'Admin'")->get()->result();
        //             if (count($staff) > 0) {
        //                 for ($i = 0; $i < count($staff); ++$i) {
        //                     $staff_id = $staff[$i]->u_id;
        //                     $data['admin'][$i] = $this->db->select('*')->from($this->tele)->where("admin = '$u_id' AND u_id = '$staff_id'")->get()->row();
        //                     // print_r($data['staff']);
        //                     $org = $this->db->select('org_id')->from($this->org)->where("admin_id = '$staff_id'")->get()->result();
        //                     for ($j = 0; $j < count($org); ++$j) {
        //                         $org_id = $org[$j]->org_id;
        //                         $data['admin'][$i]->org[$j] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
        //                         $data['admin'][$i]->org[$j]->staff = $this->db->select('*')->from($this->tele)->where("org_id = '$org_id'")->get()->result();
        //                     }
        //                 }
        //             }
        //         } else if ($role == 'Admin') {
        //             $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->tele)->join($this->role, "$this->tele.tele_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
        //             $org = $this->db->select('org_id')->from($this->org)->where("admin_id = '$u_id'")->get()->result();
        //             for ($j = 0; $j < count($org); ++$j) {
        //                 $org_id = $org[$j]->org_id;
        //                 $data['org'][$j] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
        //                 $data['org'][$j]->staff = $this->db->select('*')->from($this->tele)->where("org_id = '$org_id'")->get()->result();
        //             }
        //         } else {
        //             $org_id = $this->db->select('org_id')->from($this->tele)->where("u_id = '$u_id'")->get()->row()->org_id ?? '';

        //             $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->tele)->join($this->role, "$this->tele.tele_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();

        //             $data['org'] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
        //         }
        //         $this->response([
        //             'status' => true,
        //             'data' => $data,
        //         ], REST_Controller::HTTP_OK);
        //         // $data['organization'] = $this->db->select('*')->from($this->org)->;
        //     } else {
        //         $this->response([
        //             'status' => false,
        //             'message' => 'Role is not Assigned',
        //         ], REST_Controller::HTTP_BAD_REQUEST);
        //     }
    }

    public function telemedicine_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $doc_id = $this->security->xss_clean($this->input->post('doc_id'));
        $start_time = $this->security->xss_clean($this->input->post('start_time'));
        $end_time = $this->security->xss_clean($this->input->post('end_time'));
        $status = $this->security->xss_clean($this->input->post('status'));


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
