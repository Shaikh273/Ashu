<?php

if (!defined('BASEPATH')) exit('No Direct Scripts access are Allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Staff extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api/Staffregister_model', 'staff');
        $this->role = 'role';
        $this->staff = 'staff';
        $this->org = 'admin_org';
        $this->organization = 'organization';
    }

    public function staff_profile_get()
    {
        $u_id = $this->security->xss_clean($this->input->get('u_id'));
        $role_id = $this->db->select('role_id')->from($this->staff)->where("u_id = '$u_id'")->get()->row()->role_id ?? '';
        $role = $this->db->select('role')->from($this->role)->where("$this->role.id = '$role_id'")->get()->row()->role ?? '';
        $data = [];
        if (!empty($role)) {
            if ($role == 'Super Admin') {
                $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
                $staff = $this->db->select('DISTINCT(u_id)')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("admin = '$u_id' AND $this->role.role = 'Admin'")->get()->result();
                if (count($staff) > 0) {
                    for ($i = 0; $i < count($staff); ++$i) {
                        $staff_id = $staff[$i]->u_id;
                        $data['admin'][$i] = $this->db->select('*')->from($this->staff)->where("admin = '$u_id' AND u_id = '$staff_id'")->get()->row();
                        // print_r($data['staff']);
                        $org = $this->db->select('org_id')->from($this->org)->where("admin_id = '$staff_id'")->get()->result();
                        for ($j = 0; $j < count($org); ++$j) {
                            $org_id = $org[$j]->org_id;
                            $data['admin'][$i]->org[$j] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
                            $data['admin'][$i]->org[$j]->staff = $this->db->select('*')->from($this->staff)->where("org_id = '$org_id'")->get()->result();
                        }
                    }
                }
            } else if ($role == 'Admin') {
                $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();
                $org = $this->db->select('org_id')->from($this->org)->where("admin_id = '$u_id'")->get()->result();
                for ($j = 0; $j < count($org); ++$j) {
                    $org_id = $org[$j]->org_id;
                    $data['org'][$j] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
                    $data['org'][$j]->staff = $this->db->select('*')->from($this->staff)->where("org_id = '$org_id'")->get()->result();
                }
            } else {
                $org_id = $this->db->select('org_id')->from($this->staff)->where("u_id = '$u_id'")->get()->row()->org_id ?? '';

                $data['user_data'] = $this->db->select("*,$this->role.role")->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("u_id = '$u_id'")->get()->row();

                $data['org'] = $this->db->select('*')->from($this->organization)->where("org_id = '$org_id'")->get()->row();
            }
            $this->response([
                'status' => true,
                'staff_img' => 'https://www./Ashu/assets/uploads/staff/',
                'staff_proof_img' => 'https://www./Ashu/assets/uploads/staff/',
                'data' => $data,
            ], REST_Controller::HTTP_OK);
            // $data['organization'] = $this->db->select('*')->from($this->org)->;
        } else {
            $this->response([
                'status' => false,
                'message' => 'Role is not Assigned',
            ], REST_Controller::HTTP_BAD_REQUEST);
            // $data = $this->db->select('*')->from($this->staff)->order_by("u_id ASC")->get()->result() ?? '';

            // if (!empty($data)) {
            //     $this->response([
            //         'status' => true,
            //         'img_url' => 'https://www./Ashu/assets/uploads/patients/',
            //         'data' => $data,
            //     ], REST_Controller::HTTP_OK);
            // } else {
            //     $this->response([
            //         'status' => false,
            //         'message' => "Data Not Found",
            //     ], REST_Controller::HTTP_BAD_REQUEST);
            // }
        }
    }

    public function staff_register_post()
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
        $org_id = $this->security->xss_clean($this->input->post('org_id'));
        $status = $this->security->xss_clean($this->input->post('status'));

        //----------------------Getting Role-------------------//

        $role = $this->db->select('role')->from($this->role)->where('id', $role_id)->get()->row()->role ?? '';
        if (!empty($role)) {
            $super_id = $this->db->select('u_id')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("$this->role.role = 'Super Admin'")->order_by("$this->staff.id", 'DESC')->get()->row()->u_id ?? '_0';


            $super_name = $this->db->select('name')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("$this->role.role = 'Super Admin'")->order_by("$this->staff.id", 'DESC')->get()->row()->name ?? '';

            // print_r($super_name);die();
            $user_id = $this->db->select('u_id')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("$this->role.role = '$role' AND admin = '$admin'")->order_by("$this->staff.id", 'DESC')->get()->row()->u_id ?? '_0';
            $user_id = !empty($user_id) ? $user_id : '_0';

            $admin_id = $this->db->select('u_id')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("$this->role.role = '$role' AND admin = '$admin'")->order_by("$this->staff.id", 'DESC')->get()->row()->u_id ?? '_0';

            $admin_name = $this->db->select('name')->from($this->staff)->join($this->role, "$this->staff.role_id = $this->role.id")->where("$this->role.role = 'Admin' AND u_id = '$admin'")->order_by("$this->staff.id", 'DESC')->get()->row()->name ?? '';


            // print($admin_name);die();
            if ($role == 'Super Admin') {
                $u_id =  explode('_', $super_id)[1] + 1;
                $u_id =  substr($name, 0, 3) . '-S_0' . $u_id;
            }
            if ($role == 'Admin') {
                if (!empty($super_name) && !empty($admin)) {
                    $u_id =  explode('_', $user_id)[1] + 1;
                    $u_id =  substr($name, 0, 3) . '-' . substr($super_name, 0, 3) . "-A_0" . $u_id;
                    // print_r($u_id);die();

                } else {
                    $this->response([
                        'status' => false,
                        'message' => "Please First Add Super Admin then Add $role",
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            if ($role == 'Doctor') {
                if (!empty($org_id)) {
                    if (!empty($admin_name) && !empty($admin)) {
                        $u_id =  explode('_', $user_id)[1] + 1;
                        $u_id =   substr($name, 0, 3) . '-' .  substr($admin_name, 0, 3) . "-D_0" . $u_id;
                    } else {
                        $this->response([
                            'status' => false,
                            'message' => "Please First Add Admin then Add $role",
                        ], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response([
                        'status' => false,
                        'message' => "Organization not assigned",
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            if ($role == 'Clinic Operator') {
                if (!empty($org_id)) {
                    if (!empty($admin_name) && !empty($admin)) {
                        $u_id = explode('_', $user_id)[1] + 1;
                        $u_id =  substr($name, 0, 3) . '-' . substr($admin_name, 0, 3) . "-C_0" . $u_id;
                    } else {
                        $this->response([
                            'status' => false,
                            'message' => "Please First Add Admin then Add $role",
                        ], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response([
                        'status' => false,
                        'message' => "organization Organization not assigned",
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }

            if (!empty($_FILES['img'])) {
                $fileName = $_FILES['img']['name'];

                $config['file_name'] = $fileName;
                $config['upload_path'] = './assets/uploads/staff/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
                $config['max_size']     = '10024';
                $config['max_width'] = '6000';
                $config['max_height'] = '6000';
                $config['remove_spaces'] = FALSE;
                
                $this->load->library('upload', $config);

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('img')) {
                    $message2 = strip_tags($this->upload->display_errors());
                } else {
                    $path = $this->upload->data();
                    $img = $path['file_name'];
                }
            } else {
                $message1 = '';
            }

            if (!empty($_FILES['id_img'])) {
                $fileName = $_FILES['id_img']['name'];

                $config['file_name'] = $fileName;
                $config['upload_path'] = './assets/uploads/staff/staff_proof/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
                $config['max_size']     = '10024';
                $config['max_width'] = '6000';
                $config['max_height'] = '6000';
                $config['remove_spaces'] = FALSE;
    
                $this->load->library('upload', $config);

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('id_img')) {
                    $message2 = strip_tags($this->upload->display_errors());
                } else {
                    $path = $this->upload->data();
                    $id_img = $path['file_name'];
                }
            } else {
                $message2 = '';
            }

            $data = [
                'name' => $name ?? '',
                'u_id' => $u_id ?? '',
                'org_id' => $org_id ?? '',
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

            // print_r($data);die();

            $result = $this->db->insert($this->staff, $data);
            if ($result) {
                $this->response([
                    'status' => !empty($message1) || !empty($message2) ? false : true,
                    'message' => !empty($message1) || !empty($message2) ? "{$message1}\n{$message2}" : 'Staff Registered Successfull',
                ], empty($message1) || empty($message2)  ? REST_Controller::HTTP_OK : REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Internal Server Error',
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Role is not Assigned',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function staff_update_post()
    {
        $u_id = $this->security->xss_clean($this->input->post('u_id'));
        $name = $this->security->xss_clean($this->input->post('name'));
        $admin = $this->security->xss_clean($this->input->post('admin'));
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
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
        $org_id = $this->security->xss_clean($this->input->post('org_id'));
        $status = $this->security->xss_clean($this->input->post('status'));

        if (!empty($_FILES['img'])) {
            $fileName = $_FILES['img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/staff/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
            $config['max_size']     = '10024';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;
            $config['overwrite'] = true;

            $this->load->library('img', $config);
            $this->upload->overwrite = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')) {
                $message1 = strip_tags($this->upload->display_errors());
            } else {
                $path = $this->upload->data();
                $img = $path['file_name'];
            }
        } else {
            $message1 = '';
        }

        if (!empty($_FILES['id_img'])) {
            $fileName = $_FILES['id_img']['name'];

            $config['file_name'] = $fileName;
            $config['upload_path'] = './assets/uploads/staff/staff_proof/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|docx|doc';
            $config['max_size']     = '10024';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['remove_spaces'] = FALSE;
            $config['overwrite'] = true;

            $this->load->library('id_img', $config);
            $this->upload->overwrite = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('id_img')) {
                $message2 = strip_tags($this->upload->display_errors());
            } else {
                $path = $this->upload->data();
                $id_img = $path['file_name'];
            }
        } else {
            $message2 = '';
        }

        $data = [];
        if (!empty($name)) {
            $data['name'] = $name;
        }
        if (!empty($admin)) {
            $data['admin'] = $admin;
        }
        if (!empty($email)) {
            $data['email'] = $email;
        }
        if (!empty($password)) {
            $data['password'] = hash('sha1', $password);
        }
        if (!empty($gender)) {
            $data['gender'] = $gender;
        }
        if (!empty($d_o_b)) {
            $data['d_o_b'] = $d_o_b;
        }
        if (!empty($age)) {
            $data['age'] = $age;
        }
        if (!empty($address)) {
            $data['address'] = $address;
        }
        if (!empty($mobile_no)) {
            $data['mobile_no'] = $mobile_no;
        }
        if (!empty($img)) {
            $data['img'] = $img;
        }
        if (!empty($qualification)) {
            $data['qualification'] = $qualification;
        }
        if (!empty($speciality)) {
            $data['speciality'] = $speciality;
        }
        if (!empty($id_proof)) {
            $data['id_proof'] = $id_proof;
        }
        if (!empty($id_img)) {
            $data['id_img'] = $id_img;
        }
        if (!empty($join_date)) {
            $data['join_date'] = $join_date;
        }
        if (!empty($role_id)) {
            $data['role_id'] = $role_id;
        }
        if (!empty($status)) {
            // print_r($status);die();
            if ($status == 'Approved') {
                $admin_id = $this->db->select('admin')->from($this->staff)->where('u_id', $u_id)->get()->row()->admin ?? '';
                if (!empty($admin) && $admin == $admin_id) {
                    $data['status'] = $status;
                } else {
                    $this->response([
                        'status' => false,
                        'message' => "You Cannot Approve this Employee \nYou aren't Selected by him/her at the time of registration",
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            } else if ($status == 'Pending') {
                $data['status'] = $status;
            }
        }

        // print_r($data);die();

        $result = $this->db->update($this->staff, $data, array('u_id' => $u_id));
        if ($result) {
            $this->response([
                'status' => !empty($message1) || !empty($message2) ? false : true,
                'message' => !empty($message1) || !empty($message2) ? "{$message1}\n{$message2}" :
                    'Profile Updated Successfull',
            ], empty($message1) || empty($message2)  ? REST_Controller::HTTP_OK : REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Internal Server Error',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
