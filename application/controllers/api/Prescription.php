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
    }

    public function prescription_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $C_id = $this->security->xss_clean($this->input->post('C_id'));
        $name = $this->security->xss_clean($this->input->post('name'));
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
                "name" => $name ?? '',
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

            $data['Prescription'] = $this->db->select("*")->from($this->pres)->where("C_id = '$C_id' XOR pat_id = '$C_id'")->get()->result() ?? [];

            // $patients = $this->db->select("DISTINCT(pat_id)")->from('history_visit')->where("history_visit.org_id = '$org_id' XOR history_visit.C_id = '$org_id' XOR history_visit.pat_id = '$org_id'")->get()->result();


            // $length = count($patients);
            // for ($j = 0; $j < $length; ++$j) {
            //     $pat_id = $patients[$j]->pat_id;
            //     $data['patients'][$j]['patient'] = $this->db->select("patients.*")->from('patients')->where('pat_id', $pat_id)->get()->row();
            //     $case_id = $this->db->select("DISTINCT(C_id)")->from('history_visit')->where("history_visit.org_id = '$org_id' XOR history_visit.C_id = '$org_id' XOR history_visit.pat_id = '$org_id'")->get()->result();
            //     $length1 = count($case_id);
            //     $data2 = array();
            //     for ($i = 0; $i < $length1; ++$i) {
            //         $c_id = $case_id[$i]->C_id;
            //         $data2[$i]['visit'] =
            //             $this->db->select("
            //             history_visit.id AS ID,
            //             history_visit.c_id,
            //             history_visit.visit_type,
            //             history_visit.created_by,
            //             history_visit.created_at,
            //             history_visit.updated_at,
            //         ")->from('history_visit')->where("history_visit.C_id = '$c_id'")->get()->result();

            //         $data2[$i]['chief_complaints'] = $this->db->select("*")->from('history_chief_complaints')->where("C_id = '$c_id'")->get()->result();
            //         $data2[$i]['systemic_history'] = $this->db->select("*")->from('history_systemic_history')->where("C_id = '$c_id'")->get()->result();
            //         $data2[$i]['drug_allergies'] = $this->db->select("*")->from('history_drug_allergies')->where("C_id = '$c_id'")->get()->result();
            //         $data2[$i]['contact_allergies'] = $this->db->select("*")->from('history_contact_allergies')->where("C_id = '$c_id'")->get()->result();
            //         $data2[$i]['vital_signs'] = $this->db->select("*")->from('history_vital_signs')->where("C_id = '$c_id'")->get()->result();
            //         $data2[$i]['anthropometry'] = $this->db->select("*")->from('history_anthropometry')->where("C_id = '$c_id'")->get()->result();
            //         $data2[$i]['test_cases'] = $this->db->select("test_cases.id,test_cases.problem,test_cases.description,test_cases.reading,test_cases.doctor_id,test_cases.status")->from('test_cases')->join('tests', 'test_cases.test_id = tests.id')->where("C_id = '$c_id'")->get()->result();
            //     }
            //     $data['patients'][$j]['history_visit'] = $data2;
            // }
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
