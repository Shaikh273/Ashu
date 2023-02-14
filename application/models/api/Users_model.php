<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        // Load the database library
        $this->load->database();

        $this->userTbl = 'staff';
        $this->org = 'admin_org';
        $this->role = 'role';
        $this->pat = 'patients';
    }

    public function send_email($name = '', $email = '', $profile = '')
    {
        // print_r($name);die();
        $otp = rand(10000, 99999);
        $this->load->library('email');
        $config = array(
            'protocal' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_timeout' => 30,
            'smtp_port' => 465,
            'smtp_user' => 'maanagebusiness@gmail.com',
            'smtp_pass' => 'Maanagebusiness@123',
            'mail_type' => 'html',
            'newline' => "\r\n",
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");
        $this->email->from('maanagebusiness@gmail.com', 'Maanage Business');
        $this->email->to($email);
        $this->email->subject("{$name}, This is your Profile from Ashu Hospital");
        $this->email->message("Click on this link to see Your Profile : \n$profile");
        if ($this->email->send()) {
            return true;
            // $this->response([
            //     'status' => TRUE,
            //     'otp' => $otp,
            //     'message' => 'OTP Send Successfully',
            // ], REST_Controller::HTTP_OK);
        } else {
            $message = strip_tags($this->email->print_debugger());
            return $message;
            // $this->response(["status"=>false,"message"=>$message], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /*
     * Get rows from the users table
     */
    function getRows($params = array())
    {
        // print_r($params);die();
        $this->db->select('*');
        $this->db->from($this->userTbl);

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('u_id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            //set start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $this->db->count_all_results();
            } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->row_array() : false;
            } else {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : false;
            }
        }

        $is_admin = $this->db->select('u_id')->from($this->userTbl)->where(['email' => $params['conditions']['email'], 'password' => $params['conditions']['password'], 'role_id' => 2])->get()->row()->u_id ?? '';

        $role_id = $this->db->select('role_id')->from($this->userTbl)->where(['email' => $params['conditions']['email'], 'password' => $params['conditions']['password']])->get()->row()->role_id ?? '';


        if (!empty($role_id)) {

            $result['role_id'] = $this->db->select('role,id')->from($this->role)->where(['id' => $role_id])->get()->row();
        }

        if (!empty($is_admin)) {

            $result['org_id'] = $this->db->select('org_id')->from($this->org)->where(['admin_id' => $is_admin])->get()->row()->org_id ?? '';
        }

        //return fetched data
        return $result;
    }

    function getno_Rows($params = array())
    {
        // print_r($params);die();
        $this->db->select('*');
        $this->db->from($this->userTbl);

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('u_id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            //set start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $this->db->count_all_results();
            } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->row_array() : false;
            } else {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : false;
            }
        }

        $is_admin = $this->db->select('u_id')->from($this->userTbl)->where(['mobile' => $params['conditions']['mobile_no'],  'role_id' => 2])->get()->row()->u_id ?? '';

        $role_id = $this->db->select('role_id')->from($this->userTbl)->where(['mobile' => $params['conditions']['mobile_no'],])->get()->row()->role_id ?? '';


        if (!empty($role_id)) {

            $result['role_id'] = $this->db->select('role,id')->from($this->role)->where(['id' => $role_id])->get()->row();
        }

        if (!empty($is_admin)) {

            $result['org_id'] = $this->db->select('org_id')->from($this->org)->where(['admin_id' => $is_admin])->get()->row()->org_id ?? '';
        }


        //return fetched data
        return $result;
    }

    function get_pat_no_Rows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->pat);

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('u_id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            //set start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $this->db->count_all_results();
            } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->row_array() : false;
            } else {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : false;
            }
        }

        //return fetched data
        return $result;
    }
}
