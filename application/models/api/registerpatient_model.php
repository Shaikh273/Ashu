<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registerpatient_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertdata($data)
    {
        $sql = $this->db->insert('patients', $data);

        return $sql ? true : false;
    }

    public function updatedata($pat_id, $data)
    {
        $sql =   $this->db->update('patients', $data, array('pat_id' => $pat_id));

        return $sql ? true : false;
    }

    public function getData($pat_id)
    {
        $data['Patient'] =
            $this->db->select("*")->from('patients')->where("pat_id = '$pat_id'")->get()->result();
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
