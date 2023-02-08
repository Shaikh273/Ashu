<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staffregister_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    // 															

    function register()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            // 'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'gender' => $this->input->post('gender'),
            'DOB' => $this->input->post('DOB'),
            'age' => $this->input->post('age'),
            'address' => $this->input->post('address'),
            'mobile_no' => $this->input->post('mobile_no'),
            'img' => $this->input->post('img'),
            'qualification' => $this->input->post('qualification'),
            'speciality' => $this->input->post('speciality'),
            'ID_proof' => $this->input->post('ID_proof'),
            'ID_img' => $this->input->post('ID_img'),
            'joined_at' => $this->input->post('joined_at'),
            'role_id' => $this->input->post('role_id'),
            // 'status' => $this->input->post('status'),
            'status' => '1',
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('staff', $data);
    }

    function getDoctorData()
    {
        $this->db->select('*')->from('staff')->where("role_id = 4")->order_by('joined_at', "ASC");
        $this->db->join('role', 'staff.role_id=role.id');
        $query = $this->db->get()->result();
        return $query;
    }

    public function getrole()
    {
        $role = $this->db->select('*')->from('role')->get()->result();
        return $role;
    }

    function getData($id)
    {
        $query = $this->db->query('SELECT * FROM staff WHERE `id` =>' . $id);
        return $query->row();
    }

    function staffdelete($id)
    {
        $this->db->delete('staff', $id);
    }
}
