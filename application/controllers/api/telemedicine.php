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
    }

    // public function staff_profile_get()
    // {
    //     $u_id = $this->security->xss_clean($this->input->get('u_id'));
    //     $role_id = $this->db->select('role_id')->from($this->tele)->where("u_id = '$u_id'")->get()->row()->role_id ?? '';
    //     $role = $this->db->select('role')->from($this->role)->where("$this->role.id = '$role_id'")->get()->row()->role ?? '';
    //     $data = [];
    //     if (!empty($role)) {
    //         if ($role == 'Super Admin') {
    //             $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->tele)->join($this->role, "$this->tele.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
    //             $staff = $this->db->select('DISTINCT(u_id)')->from($this->tele)->join($this->role, "$this->tele.role_id = $this->role.id")->where("admin = '$u_id' AND $this->role.role = 'Admin'")->get()->result();
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
    //             $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->tele)->join($this->role, "$this->tele.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
    //             $org = $this->db->select('org_id')->from($this->org)->where("admin_id = '$u_id'")->get()->result();
    //             for ($j = 0; $j < count($org); ++$j) {
    //                 $org_id = $org[$j]->org_id;
    //                 $data['org'][$j] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
    //                 $data['org'][$j]->staff = $this->db->select('*')->from($this->tele)->where("org_id = '$org_id'")->get()->result();
    //             }
    //         } else {
    //             $org_id = $this->db->select('org_id')->from($this->tele)->where("u_id = '$u_id'")->get()->row()->org_id ?? '';

    //             $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->tele)->join($this->role, "$this->tele.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();

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
    // }

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
                'message' => 'Staff Registered Successfull',
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Internal Server Error',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function staff_update_post()
    {
        $name = $this->security->xss_clean($this->input->post('name'));
        $admin = $this->security->xss_clean($this->input->post('admin'));
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $gender = $this->security->xss_clean($this->input->post('gender'));
        $gender = $this->security->xss_clean($this->input->post('gender'));
        $d_o_b = $this->security->xss_clean($this->input->post('d_o_b'));
        $age = $this->security->xss_clean($this->input->post('age'));
        $address = $this->security->xss_clean($this->input->post('address'));
        $mobile_no = $this->security->xss_clean($this->input->post('mobile_no'));
        $img = $this->security->xss_clean($this->input->post('img'));
        $qualification = $this->security->xss_clean($this->input->post('qualification'));
        $speciality = $this->security->xss_clean($this->input->post('speciality'));
        $id_proof = $this->security->xss_clean($this->input->post('id_proof'));
        $id_img = $this->security->xss_clean($this->input->post('id_img'));
        $join_date = $this->security->xss_clean($this->input->post('join_date'));
        $role_id = $this->security->xss_clean($this->input->post('role_id'));
        $status = $this->security->xss_clean($this->input->post('status'));

        $data = [
            'name' => $name ?? '',
            'u_id' => $u_id ?? '',
            'admin' => $admin ?? '',
            'email' => $email ?? '',
            'password' => hash('sha1', $password) ?? '',
            'gender' => $gender ?? '',
            'd_o_b' => $d_o_b ?? '',
            'age' => $age ?? '',
            'address' => $address ?? '',
            'mobile_no' => $mobile_no ?? '',
            'img' => $img ?? '',
            'qualification' => $qualification ?? '',
            'speciality' => $speciality ?? '',
            'id_proof' => $id_proof ?? '',
            'id_img' => $id_img ?? '',
            'join_date' => $join_date ?? '',
            'role_id' => $role_id ?? '',
            'status' => $status ?? '',
        ];


        $result = $this->db->insert($this->tele, $data);
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Staff Registered Successfull',
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Internal Server Error',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
