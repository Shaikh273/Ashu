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
    }

    /*
     * Get rows from the users table
     */
    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->userTbl);

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
            // print_r('AAAAAAAAAAAAAA');die();
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('u_id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
            // print_r('BBBBBBBBBBBB');die();
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

            // print_r('ccccccccc');die();
        }

        //return fetched data
        return $result;
    }

    /*
     * Insert user data
     */
    public function insert($data)
    {
        //add created and modified date if not exists
        if (!array_key_exists("created", $data)) {
            $data['created'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("modified", $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }

        //insert user data to users table
        $insert = $this->db->insert($this->userTbl, $data);

        //return the status
        return $insert ? $this->db->insert_id() : false;
    }

    /*
     * Update user data
     */
    public function update($data, $id)
    {
        // die('test');
        //add modified date if not exists
        if (!array_key_exists('modified', $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }
        // print_r($data);die();
        //update user data in users table

        $update = $this->db->update($this->userTbl, $data, array('id' => $id));
        //$this->userTbl
        //return the status
        return $update ? true : false;
    }

    /*
     * Delete user data
     */
    public function delete($id)
    {
        //update user from users table
        $delete = $this->db->delete('users', array('id' => $id));
        //return the status
        return $delete ? true : false;
    }
    public function GetBasic($id)
    {
        $sql = "SELECT * FROM `users`WHERE `u_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    public function getuserkey($data)
    {
        $this->db->select('u_id,role,appr_id');
        $this->db->from('users');
        $this->db->where('u_id', $data);
        $query = $this->db->get();
        return $query->row();
    }
    public function emselect()
    {
        $sql = "SELECT * FROM `users` WHERE `status`='1'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function emselectByID($emid)
    {
        $sql = "SELECT * FROM `users`
          WHERE `u_id`='$emid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
}
