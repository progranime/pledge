<?php

class Jd_History_model extends CI_Model {

	public function __construct () {
		date_default_timezone_set('Asia/Manila');
	}

	public function getJdHistory ($id) {
		return $this->db->query("SELECT * FROM tbl_jd_history WHERE jd_id = $id ORDER BY action_datetime DESC")->result();
	}
	
	public function createJdHistory () {

		// get the last entry that is added, and get the information of it
		$lastEntry	= $this->db->order_by('id', 'desc')
							   ->limit(1)
							   ->get('tbl_job_description')
							   ->row();

		// then insert the retrieved data to tbl_jd_history table
		$this->db->insert('tbl_jd_history', array(
				'jd_id'				=> $lastEntry->id,
				'user'  			=> $lastEntry->user,
				'action' 			=> 'created',
				'action_datetime' 	=> date('Y-m-d G:i:s')
			)
		);

	}

	public function updateJdHistory ($id) {

		// get the data with this id
		$result	= $this->db->get_where('tbl_job_description', array(
			'id' => $id))->result()[0];

		// then insert the retrieved data to tbl_jd_history table
		$this->db->insert('tbl_jd_history', array(
			'jd_id'				=> $result->id,
			'user'				=> $result->user,
			'action'			=> 'updated',
			'action_datetime' 	=> date('Y-m-d G:i:s')
		));

	}

}