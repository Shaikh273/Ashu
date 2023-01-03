<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class registerpatient_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertdata($data)
    // public function insertdata($data1, $data2)
    {
        $sql = $this->db->insert('patients', $data);

        return $sql ? true : false;
    }

    public function updatedata($id, $data)
    {
        $sql =   $this->db->update('patients', $data, array('id' => $id));

        return $sql ? true : false;
    }

    public function getData($id, $pat_id)
    {
        $data['Patient'] =
            $this->db->select("*")->from('patients')->where("id = '$id' OR pat_id = '$pat_id'")->get()->result();
        if (!empty($data['Patient'])) {
            return $data;
        } else {
            return 'Data Not Found';
        }
    }

    public function deletedata($id)
    {
        $deleteData =  $this->db->delete("patients", array('id' => $id));

        if ($deleteData) {
            return 'Data Deleted Successfully';
        } else {
            return 'Unable to Delete';
        }
    }
}
