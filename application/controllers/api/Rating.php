<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Rating extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function ratings_post()
    {
        $pat_id = $this->security->xss_clean($this->input->post('pat_id'));
        $doc_id = $this->security->xss_clean($this->input->post('doc_id'));
        $rating = $this->security->xss_clean($this->input->post('rating'));

        $this->form_validation->set_rules('doc_id', 'Doctor ID', 'required', array(
            'required' => 'Doctor is Empty'
        ));
        $this->form_validation->set_rules('pat_id', 'Patient ID', 'required', array(
            'required' => 'Patient is Empty'
        ));

        if ($this->form_validation->run() == false) {
            $error = strip_tags(validation_errors());
            $this->response([
                "status" => false,
                "message" => $error,
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $id = $this->db->select('id')->from('ratings')->where("doc_id = '$doc_id' AND pat_id = '$pat_id'")->get()->row()->id ?? 0;
            if (!empty($id)) {
                $data = array();
                if (!empty($doc_id)) {
                    $data['doc_id'] = $doc_id;
                }
                if (!empty($pat_id)) {
                    $data['pat_id'] = $pat_id;
                }
                if (!empty($rating)) {
                    $data['rating'] = $rating;
                }

                $insert = $this->db->update('ratings', $data, array('id' => $id));
            } else {
                $data = array(
                    'doc_id' => $doc_id,
                    'pat_id' => $pat_id,
                    'rating' => $rating,
                );

                $insert = $this->db->insert('ratings', $data);
            }

            if ($insert) {
                if (!empty($doc_id)) {
                    $ratings = $this->db->select('SUM(ratings.rating) AS rating')->from('ratings')->join('staff', 'ratings.doc_id = staff.u_id')->join('role', 'staff.role_id = role.id')->where("doc_id = '$doc_id' AND role.role = 'Doctor'")->get()->row()->rating ?? 0;
                    $total_ratings = $this->db->select('id')->from('ratings')->where("doc_id = '$doc_id'")->get()->num_rows();
                    $final = number_format($ratings / ($total_ratings ?: 1), 1);
                    // print_r($final);die();
                    $update_ratings = $this->db->update('staff', array('rating' => $final), array('u_id' => $doc_id));
                }

                $this->response([
                    "status" => true,
                    "message" => 'Ratings Given Successfully',
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    "status" => false,
                    "message" => 'Internel Server Error',
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}
