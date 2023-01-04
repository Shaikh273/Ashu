<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class clinic_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertdata($data)
    // public function insertdata($data1, $data2)
    {
        $sql = $this->db->insert('organization', $data);

        return $sql ? true : false;
    }

    public function updatedata($id, $data)
    {
        $sql =   $this->db->update('organization', $data, array('id' => $id));

        return $sql ? true : false;
    }

    public function getData($id, $org_id)
    {
        $data['Patient'] =
            $this->db->select("*")->from('organization')->where("id = '$id' OR org_id = '$org_id'")->get()->result();
        if (!empty($data['Patient'])) {
            return $data;
        } else {
            return 'Data Not Found';
        }
    }

    public function deletedata($id)
    {
        $deleteData =  $this->db->delete("organization", array('id' => $id));

        if ($deleteData) {
            return 'Data Deleted Successfully';
        } else {
            return 'Unable to Delete';
        }
    }
}
