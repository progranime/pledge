<?php

class Template_model extends CI_Model {
	
	public function getDefinedTemplate () {
		$division 	= $this->input->get('division');
		$role 		= $this->input->get('role');
	
		return $this->db->get_where('tbl_template', array(
			'division' => $division,
			'role'	   => $role
		))->result();

	}

}