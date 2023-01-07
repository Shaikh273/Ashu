<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class organization_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertdata($data)
    {
        $sql = $this->db->insert('organization', $data);

        return $sql ? true : false;
    }

    public function updatedata($org_id, $data)
    {
        $sql =   $this->db->update('organization', $data, array('org_id' => $org_id));

        return $sql ? true : false;
    }

    public function getData($org_id)
    {
        $data['Patient'] =
            $this->db->select("*")->from('organization')->where("org_id = '$org_id'")->get()->result();
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
