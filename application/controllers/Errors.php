<?php

class Errors extends CI_Controller {

	public function index () {
		// show this 404 message if the user enter invalid controller
		return $this->load->view('errors/index');
	}

}