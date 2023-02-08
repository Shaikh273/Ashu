<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Bills extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->bills = 'bills';
        // $this->pat = 'patients';
        $this->staff = 'staff';
        $this->test = 'test_cases';
        $this->tele = 'telemedicine';
    }

    public function bill_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $C_id =  $this->security->xss_clean($this->input->post('C_id'));
        $tele_id = $this->security->xss_clean($this->input->post('tele_id'));
        $doc_id = $this->security->xss_clean($this->input->post('doc_id'));
        $amount = $this->security->xss_clean($this->input->post('amount'));
        $payment_method = $this->security->xss_clean($this->input->post('payment_method'));
        $status = $this->security->xss_clean($this->input->post('status'));

        $this->form_validation->set_rules('pat_id', 'Patient ID', 'required', array(
            'required' => 'Patient ID is Missing'
        ));
        $this->form_validation->set_rules('C_id', 'Case ID', 'required', array(
            'required' => 'Case ID is Missing'
        ));
        $this->form_validation->set_rules('tele_id', 'Telemedicine ID', 'required', array(
            'required' => 'Telemedicine ID is Missing'
        ));
        $this->form_validation->set_rules('doc_id', 'Doctor ID', 'required', array(
            'required' => 'Doctor ID is Missing'
        ));
        $this->form_validation->set_rules('amount', 'Amount', 'required', array(
            'required' => 'Please Insert Amount'
        ));
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'required', array(
            'required' => 'Please Select a Payment Method'
        ));

        if ($this->form_validation->run() == False) {
            $error = strip_tags(validation_errors());

            $this->response([
                "status" => false,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = array(
                'pat_id' => $pat_id,
                'C_id' => $C_id,
                'tele_id' => $tele_id,
                'doc_id' => $doc_id,
                'amount' => $amount,
                'payment_method' => $payment_method,
                'status' => $status,

                'created_at' => date('Y-m-d H:i:s'),
            );

            $insert = $this->db->insert($this->bills, $data);

            if ($insert) {
                $this->response([
                    'status' => True,
                    'message' => 'Bill Created Successfully',
                    'data' => $data,
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Unsuccessful',
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function bill_get()
    {
        $pat_id = $this->input->get('pat_id');

        $data = array();
        if (!empty($pat_id)) {
            $data['Bills'] = $this->db->select('id AS ID')->from($this->bills)->where('pat_id', $pat_id)->get()->result();

            $patient = $this->db->select('*')->from($this->bills)->where('pat_id', $pat_id)->get()->result();

            $length = count($patient);

            for ($i = 0; $i < $length; ++$i) {
                $pat_id = $patient[$i]->pat_id;
                $doc_id = $patient[$i]->doc_id;
                $C_id = $patient[$i]->C_id;
                $tele_id = $patient[$i]->tele_id;

                $data['Bills'][$i]->Bill = $this->db->select('*')->from($this->bills)->where("pat_id = '$pat_id' && C_id = '$C_id'")->get()->result();

                $data['Bills'][$i]->Doctor = $this->db->select('name,speciality')->from($this->staff)->where("u_id", $doc_id)->get()->result();

                $data['Bills'][$i]->Case = $this->db->select('*')->from($this->test)->where("C_id", $C_id)->get()->result();

                $data['Bills'][$i]->telemedicine = $this->db->select('*')->from($this->tele)->where("tele_id", $tele_id)->get()->result();
            }
        } else {
            $master = $this->db->select('DISTINCT(pat_id)')->from($this->bills)->order_by("pat_id  ASC")->get()->result();

            $length = count($master);

            for ($i = 0; $i < $length; ++$i) {
                $pat_id = $master[$i]->pat_id;

                // $data['Bills'][$i] = $this->db->select('pat_id,C_id,tele_id,doc_id,amount,payment_method,created_at')->from($this->bills)->where("pat_id", $pat_id)->get()->result();

                $data['Bills'][$i] = $this->db->select('id AS ID')->from($this->bills)->where('pat_id', $pat_id)->get()->result();

                $patient = $this->db->select('*')->from($this->bills)->where('pat_id', $pat_id)->get()->result();

                for ($j = 0; $j < count($patient); ++$j) {
                    $pat_id = $patient[$j]->pat_id;
                    $C_id = $patient[$j]->C_id;
                    $doc_id = $patient[$j]->doc_id;
                    $tele_id = $patient[$j]->tele_id;

                    $data['Bills'][$i][$j]->Bill = $this->db->select('*')->from($this->bills)->where("pat_id = '$pat_id' && C_id = '$C_id'")->get()->result();

                    $data['Bills'][$i][$j]->Doctor = $this->db->select('name,speciality')->from($this->staff)->where("u_id", $doc_id)->get()->result();

                    $data['Bills'][$i][$j]->Case = $this->db->select('*')->from($this->test)->where("C_id", $C_id)->get()->result();

                    $data['Bills'][$i][$j]->telemedicine = $this->db->select('*')->from($this->tele)->where("tele_id", $tele_id)->get()->result();
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
}
