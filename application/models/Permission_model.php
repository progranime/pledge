<?php

class Permission_model extends Ci_Model {

	public function getPermissions () {
		$userRole = $this->session->userdata('role');

		return $this->db->get_where('tbl_permission', array(
			'user_role' => $userRole
		))->result();
	}


}