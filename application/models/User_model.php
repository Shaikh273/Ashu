<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	// 															

	function Create()
	{
		$data = array(
			'firstname' => $this->input->post('firstname'),
			'middlename' => $this->input->post('middlename'),
			'last_name' => $this->input->post('last_name'),
			'mobilenumber' => $this->input->post('mobilenumber'),
			'secondarynumber' => $this->input->post('secondarynumber'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'dob' => $this->input->post('dob'),
			'year' => $this->input->post('year'),
			'months' => $this->input->post('months'),
			'language' => $this->input->post('language'),
			'patienttype' => $this->input->post('patienttype'),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'pincode' => $this->input->post('pincode'),
			'occupation' => $this->input->post('occupation'),
			'employeeid' => $this->input->post('employeeid'),
			'medicalrecordno' => $this->input->post('medicalrecordno'),
			'governmentid' => $this->input->post('governmentid'),
			'governmentidno' => $this->input->post('governmentidno'),
			'blood_grp' => $this->input->post('blood_grp'),
			'maritail_status' => $this->input->post('maritail_status'),
			'one_eyed' => $this->input->post('one_eyed'),
			'emg_relation' => $this->input->post('emg_relation'),
			'emg_name' => $this->input->post('emg_name'),
			'emg_number' => $this->input->post('emg_number'),
			// 'opthalmic_type' => $this->input->post('opthalmic_type'),
			'opthalmic_comment' => $this->input->post('opthalmic_comment'),
			// 'systemic_type' => $this->input->post('systemic_type'),
			'systemic_comment' => $this->input->post('systemic_comment'),
			'medical_history' => $this->input->post('medical_history'),
			'family_history' => $this->input->post('family_history'),
			// 'paedairic_type' => $this->input->post('paedairic_type'),
			'paedairic_comment' => $this->input->post('paedairic_comment'),
			// 'immunization_type' => $this->input->post('immunization_type'),
			'immunization_comment' => $this->input->post('immunization_comment'),
			// 'drug_type' => $this->input->post('drug_type'),
			'drug_comment' => $this->input->post('drug_comment'),
			// 'contact_type' => $this->input->post('contact_type'),
			'contact_comment' => $this->input->post('contact_comment'),
			// 'food_type' => $this->input->post('food_type'),
			'food_comment' => $this->input->post('food_comment'),
			'other_comment' => $this->input->post('other_comment'),
			'appointment_type' => $this->input->post('appointment_type'),
			'appointment_date' => $this->input->post('appointment_date'),
			'appointment_time' => $this->input->post('appointment_time'),
			'location' => $this->input->post('location'),
			'consultant' => $this->input->post('consultant'),
			'appointment_t' => $this->input->post('appointment_t'),
			'appointment_category' => $this->input->post('appointment_category'),
			// 'appointmenttype' => $this->input->post('appointmenttype'),
			// 'appointment_start_time' => $this->input->post('appointment_start_time'),
			// 'appointment_start_time' => $this->input->post('appointment_start_time'),
			// 'location' => $this->input->post('location'),
			// 'consultant' => $this->input->post('consultant'),
			// 'appointmentcategory' => $this->input->post('appointmentcategory'),
			'created_at' => date('Y-m-d H:i:s'),
		);
		$this->db->insert('patients', $data);
	}

	// function appoit() {
	//     $data = array (
	// 				'appointmenttype' => $this->input->post('appointmenttype'),
	// 				'appointment_start_time' => $this->input->post('appointment_start_time'),
	// 				'appointment_start_time' => $this->input->post('appointment_start_time'),
	// 				'location' => $this->input->post('location'),
	// 				'consultant' => $this->input->post('consultant'),
	// 				'appointmentcategory' => $this->input->post('appointmentcategory'),
	//                 'created_at' => date('Y-m-d H:i:s'),
	//     );
	//     $this->db->insert('appoit', $data);
	// }


	// function getAllData() {
	//     $query = $this->db->query('SELECT * FROM appoit');
	//     return $query->result();
	// }

	function getData($id)
	{
		$query = $this->db->query('SELECT * FROM appoit WHERE `id` =' . $id);
		return $query->row();
	}


	function checkPassword1($password, $email)
	{

		$query = $this->db->query("SELECT * FROM admin WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	function checkPassword2($password, $email)
	{

		$query = $this->db->query("SELECT * FROM doctor WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	function checkPassword3($password, $email)
	{

		$query = $this->db->query("SELECT * FROM laboratorist WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	function checkPassword4($password, $email)
	{

		$query = $this->db->query("SELECT * FROM nurse WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	function checkPassword5($password, $email)
	{

		$query = $this->db->query("SELECT * FROM optometrists WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	function checkPassword6($password, $email)
	{
		$query = $this->db->query("SELECT * FROM patient WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	function checkPassword7($password, $email)
	{
		$query = $this->db->query("SELECT * FROM pharmacist WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
	function checkPassword8($password, $email)
	{
		$query = $this->db->query("SELECT * FROM accountant WHERE password='$password' AND email='$email'");
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
}
