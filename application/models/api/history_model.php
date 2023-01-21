<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class History_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertdata($data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8)
    {
        $sql1 = $this->db->insert('history_visit', $data1);

        if (!empty($data2['C_id'])) {
            $this->db->insert('history_chief_complaints', $data2);
        }
        if (!empty($data3['C_id'])) {
            $this->db->insert('history_systemic_history', $data3);
        }
        if (!empty($data4['C_id'])) {
            $this->db->insert('history_drug_allergies', $data4);
        }
        if (!empty($data5['C_id'])) {
            $this->db->insert('history_contact_allergies', $data5);
        }
        if (!empty($data6['C_id'])) {
            $this->db->insert('history_food_allergies', $data6);
        }
        if (!empty($data7['C_id'])) {
            $this->db->insert('history_vital_signs', $data7);
        }
        if (!empty($data8['C_id'])) {
            $this->db->insert('history_anthropometry', $data8);
        }
        return $sql1 ? true : false;
    }

    public function updatedata($C_id, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8)
    {
        if (!empty($data1)) {
            $sql = $this->db->update('history_visit', $data1, array('C_id' => $C_id));
        }
        if (!empty($data2)) {
            $this->db->update('history_chief_complaints', $data2, array('C_id' => $C_id));
        }
        if (!empty($data3)) {
            $this->db->update('history_systemic_history', $data3, array('C_id' => $C_id));
        }
        if (!empty($data4)) {
            $this->db->update('history_drug_allergies', $data4, array('C_id' => $C_id));
        }
        if (!empty($data5)) {
            $this->db->update('history_contact_allergies', $data5, array('C_id' => $C_id));
        }
        if (!empty($data6)) {
            $this->db->update('history_food_allergies', $data6, array('C_id' => $C_id));
        }
        if (!empty($data7)) {
            $this->db->update('history_vital_signs', $data7, array('C_id' => $C_id));
        }
        if (!empty($data8)) {
            $this->db->update('history_anthropometry', $data8, array('C_id' => $C_id));
        }
        return $sql ? true : false;
    }

    public function getData($org_id)
    {
        $data = array();
        if (!empty($org_id)) {
            $data['history_visit'] = $this->db->select("history_visit.*,organization.*,patients.*")->from('history_visit')->join('organization', 'history_visit.org_id = organization.org_id')->join('patients', 'history_visit.pat_id = patients.pat_id')->where("history_visit.org_id = '$org_id'")->get()->result();

            $case_id = $this->db->select('C_id')->from('history_visit')->get()->result();

            $length = count($case_id);

            for ($i = 0; $i < $length; ++$i) {
                $c_id = $case_id[$i]->C_id;

                $data['history_visit'][$i]->history_chief_complaints = $this->db->select("*")->from('history_chief_complaints')->where("C_id = '$c_id'")->get()->row();

                $data['history_visit'][$i]->history_systemic_history = $this->db->select("*")->from('history_systemic_history')->where("C_id = '$c_id'")->get()->row();

                $data['history_visit'][$i]->history_drug_allergies = $this->db->select("*")->from('history_drug_allergies')->where("C_id = '$c_id'")->get()->row();

                $data['history_visit'][$i]->history_contact_allergies = $this->db->select("*")->from('history_contact_allergies')->where("C_id = '$c_id'")->get()->row();

                $data['history_visit'][$i]->history_vital_signs = $this->db->select("*")->from('history_vital_signs')->where("C_id = '$c_id'")->get()->row();

                $data['history_visit'][$i]->history_anthropometry = $this->db->select("*")->from('history_anthropometry')->where("C_id = '$c_id'")->get()->row();
            }
        }

        if (!empty($data['history_visit'])) {
            return $data;
        } else {
            return 'Data Not Found';
        }
    }

    public function deletedata($id)
    {
        $deleteData =
            $this->db->delete("history_visit", array('C_id' => $id));
        $this->db->delete("history_chief_complaints", array('C_id' => $id));
        $this->db->delete("history_systemic_history", array('C_id' => $id));
        $this->db->delete("history_drug_allergies", array('C_id' => $id));
        $this->db->delete("history_contact_allergies", array('C_id' => $id));
        $this->db->delete("history_food_allergies", array('C_id' => $id));
        $this->db->delete("history_vital_signs", array('C_id' => $id));
        $this->db->delete("history_anthropometry", array('C_id' => $id));

        $deleteData = $this->db->select('C_id')->from('history_visit')->where(array('C_id' => $id))->get()->row()->C_id ?? '';

        if ($deleteData) {
            return empty($deleteData) ? true : false;
        } else {
            return false;
        }
    }
}
