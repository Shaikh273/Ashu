<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class history_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertdata($data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8)
    {
        $sql =   $this->db->trans_Start();
        // $this->db->insert('history_opthalmic_history', $data1);
        $this->db->insert('history_visit', $data1);
        $this->db->insert('history_chief_complaints', $data2);
        $this->db->insert('history_systemic_history', $data3);
        $this->db->insert('history_drug_allergies', $data4);
        $this->db->insert('history_contact_allergies', $data5);
        $this->db->insert('history_food_allergies', $data6);
        $this->db->insert('history_vital_signs', $data7);
        $this->db->insert('history_anthropometry', $data8);
        $this->db->trans_Complete();

        return $sql ? true : false;
    }

    public function updatedata($id, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8)
    {
        $sql =   $this->db->trans_Start();
        // $this->db->insert('history_opthalmic_history', $data1);

        $this->db->update('history_visit', $data1, array('id' => $id));
        $this->db->update('history_chief_complaints', $data2, array('id' => $id));
        $this->db->update('history_systemic_history', $data3, array('id' => $id));
        $this->db->update('history_drug_allergies', $data4, array('id' => $id));
        $this->db->update('history_contact_allergies', $data5, array('id' => $id));
        $this->db->update('history_food_allergies', $data6, array('id' => $id));
        $this->db->update('history_vital_signs', $data7, array('id' => $id));
        $this->db->update('history_anthropometry', $data8, array('id' => $id));
        $this->db->trans_Complete();

        return $sql ? true : false;
    }

    public function getData($C_id, $pat_id)
    {
        $data = array();
        $data['history_visit'] =
            $this->db->select("*")->from('history_visit')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();

        $data['history_chief_complaints'] =
            $this->db->select("*")->from('history_chief_complaints')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();

        $data['history_systemic_history'] =
            $this->db->select("*")->from('history_systemic_history')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();

        $data['history_drug_allergies'] =
            $this->db->select("*")->from('history_drug_allergies')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();

        $data['history_contact_allergies'] =
            $this->db->select("*")->from('history_contact_allergies')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();

        $data['history_food_allergies'] =
            $this->db->select("*")->from('history_food_allergies')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();

        $data['history_vital_signs'] =
            $this->db->select("*")->from('history_vital_signs')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();

        $data['history_anthropometry'] =
            $this->db->select("*")->from('history_anthropometry')->where("pat_id = '$pat_id' AND C_id = '$C_id'")->get()->result();


        if (!empty($data['history_visit'])) {
            return $data;
        } else {
            return 'Data Not Found';
        }
    }

    public function deletedata($id)
    {
        $deleteData =
            $this->db->delete("history_visit", array('id' => $id));
        $this->db->delete("history_chief_complaints", array('id' => $id));
        $this->db->delete("history_systemic_history", array('id' => $id));
        $this->db->delete("history_drug_allergies", array('id' => $id));
        $this->db->delete("history_contact_allergies", array('id' => $id));
        $this->db->delete("history_food_allergies", array('id' => $id));
        $this->db->delete("history_vital_signs", array('id' => $id));
        $this->db->delete("history_anthropometry", array('id' => $id));

        if ($deleteData) {
            return $deleteData ? true : false;
        } else {
            return 'Unable to Delete';
        }
    }
}
