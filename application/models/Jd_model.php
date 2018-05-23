<?php

class Jd_model extends CI_Model {


	public function __construct () {

		date_default_timezone_set('Asia/Manila');

	}

	public function getDivisionsDataByRole ($division, $subDivision) {

		return array(
			'leader' => $this->db->get_where('tbl_job_description', array(
				'division' 		=> $division,
				'role' 	   		=> 'leader',
				'is_delete' 	=> 0))->result(),
			'contributor' => $this->db->get_where('tbl_job_description', array(
				'division' 		=> $division,
				'role' 	   		=> 'contributor',
				'is_delete' 	=> 0))->result()
			);

	}

	public function getJdData ($id) {
		return $this->db->get_where('tbl_job_description', array("id" => $id))->result();
	}

	public function getUserTemplate () {
		$id = $this->input->get('id');

		return $this->db->get_where('tbl_job_description', array('id' => $id))->result();
	}

	public function createJd () {
		$role 				= $this->input->post('role');
		$division 			= $this->input->post('division');
		// $sub_division		= count(explode("-", $division)) > 1 ? explode("-", $division)[1] : "";
		$sub_division		= $this->input->post('sub_division');
		$external_job_title = $this->input->post('external_job_title');
		$internal_job_title = $this->input->post('internal_job_title');
		$primary_service 	= $this->input->post('primary_service');
		$secondary_service 	= $this->input->post('secondary_service');
		$specialization 	= $this->input->post('specialization');
		$location 			= $this->input->post('location');

		$promises 			= $this->input->post('promises[]');
		$deliveries 		= $this->input->post('deliveries[]');
		$rewards 			= $this->input->post('rewards[]');

		$promises_status 	= $this->input->post('promises_status[]');
		$deliveries_status 	= $this->input->post('deliveries_status[]');
		$rewards_status 	= $this->input->post('rewards_status[]');

		$promises_template_count 	= $this->countTemplate(strtolower($role), "promises_statement");
		$promises_items				= $this->convertArrayToJSON($promises, $promises_status, $promises_template_count);

		$deliveries_template_count 	= $this->countTemplate(strtolower($role), "deliveries_statement");
		$deliveries_items			= $this->convertArrayToJSON($deliveries, $deliveries_status, $deliveries_template_count);

		$rewards_template_count 	= $this->countTemplate(strtolower($role), "rewards_statement");
		$rewards_items				= $this->convertArrayToJSON($rewards, $rewards_status, $rewards_template_count);

		$this->db->insert("tbl_job_description", array(
			"external_job_title" 	=> $external_job_title,
			"secondary_service" 	=> $secondary_service,
			"internal_job_title" 	=> $internal_job_title,
			"primary_service" 		=> $primary_service,
			"location" 				=> $location,
			"specialization"		=> $specialization,
			"promises_statement" 	=> json_encode($promises_items),
			"deliveries_statement" 	=> json_encode($deliveries_items),
			"rewards_statement" 	=> json_encode($rewards_items),
			"division" 				=> explode("-", $division)[0],
			"sub_division" 			=> $sub_division,
			"role" 					=> $role,
			"user"					=> "jeremy.espinosa"
		));

	}

	public function deleteJd () {
		$id = $this->uri->segment(3);
		
		$this->db->where("id", $id);
		// deleting to the table
		// $this->db->delete("tbl_job_description");
		// just hiding it to the table by chaging the is_deleted column value
		$this->db->update("tbl_job_description", array(
			'is_delete' => 1
		));
	}

	public function updateJd ($id) {
		$role 				= $this->input->post('role');
		$division 			= $this->input->post('division');
		// $sub_division		= count(explode("-", $division)) > 1 ? explode("-", $division)[1] : "";
		$sub_division		= $this->input->post('sub_division');
		$external_job_title = $this->input->post('external_job_title');
		$internal_job_title = $this->input->post('internal_job_title');
		$primary_service 	= $this->input->post('primary_service');
		$secondary_service 	= $this->input->post('secondary_service');
		$specialization 	= $this->input->post('specialization');
		$location 			= $this->input->post('location');

		$promises 			= $this->input->post('promises[]');
		$deliveries 		= $this->input->post('deliveries[]');
		$rewards 			= $this->input->post('rewards[]');

		$promises_status 	= $this->input->post('promises_status[]');
		$deliveries_status 	= $this->input->post('deliveries_status[]');
		$rewards_status 	= $this->input->post('rewards_status[]');

		$promises_template_count 	= $this->countTemplate(strtolower($role), "promises_statement");
		$promises_items				= $this->convertArrayToJSON($promises, $promises_status, $promises_template_count);

		$deliveries_template_count 	= $this->countTemplate(strtolower($role), "deliveries_statement");
		$deliveries_items			= $this->convertArrayToJSON($deliveries, $deliveries_status, $deliveries_template_count);

		$rewards_template_count 	= $this->countTemplate(strtolower($role), "rewards_statement");
		$rewards_items				= $this->convertArrayToJSON($rewards, $rewards_status, $rewards_template_count);

		$this->db->where("id", $id);
		$this->db->update("tbl_job_description", array(
			"external_job_title" 	=> $external_job_title,
			"secondary_service" 	=> $secondary_service,
			"internal_job_title" 	=> $internal_job_title,
			"primary_service" 		=> $primary_service,
			"location" 				=> $location,
			"specialization"		=> $specialization,
			"promises_statement" 	=> json_encode($promises_items),
			"deliveries_statement" 	=> json_encode($deliveries_items),
			"rewards_statement" 	=> json_encode($rewards_items),
			"division" 				=> explode("-", $division)[0],
			"sub_division" 			=> $sub_division,
			"role" 					=> $role,
			"user"					=> "jeremy.espinosa"
		));

	}

	public function convertArrayToJSON($array, $status, $templateCount = null) {
		if ($array === NULL) { return false; };

		$jsonGlobalItem = array();
		
		foreach ($array as $key => $value) {
			
			$status[$key] = preg_replace('/\s+/', '', $status[$key]);
			$template = "";

			if ($key < $templateCount) {
				$template = "true";
			}

			$data = array(
				'item'       	=> 	$value,
				'status'       	=> 	$status[$key],
				'template'		=> 	$template
			);

			array_push($jsonGlobalItem, $data);
		};

		$globalObject = new stdClass();
		$globalObject->items = $jsonGlobalItem;

		return $globalObject;
	}

	public function countTemplate($role, $column){
		$query = $this->db->get_where('tbl_template', array("role" => $role))->result();
		$x = json_decode($query[0]->$column);
		
		return count($x->items);
	}
	
}