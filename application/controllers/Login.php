<?php

class Login extends CI_Controller {

	public function index () {
		return $this->load->view('login/index');
	}

	public function sampleLogin () {

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$data = array(
			"name"		=> "jeremy",
			"username" 	=> "jeremy.espinosa",
			"logged_in" => true,
			"role"		=> "admin"
		);

		$this->session->set_userdata($data);

		redirect('/division');

	}

	public function authentication () {

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$url = "http://10.124.8.92:8080/dbusinesscard/rest/user/card";

		$email2 = $email;
		$password2 = $password;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "8080",
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\n\t\"name\":\"" . $email . "\",\n\t\"pwd\":\"" . $password . "\"\n}",
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		$result = trim($response);

		// echo $result;

		if ($err || $result == FALSE || empty($result)) {
			// ERROR CURL
			echo $error_response;
		} else {

			$login_details = json_decode($result);
			$email = $login_details -> { 'email' };
			$id = $login_details -> { 'id' };
			$name = $login_details -> { 'name' };

			if(!(empty($email) || empty($id))) {
				$data = array(
					"name"		=> $name,
					"username" 	=> $id,
					"logged_in" => true,
					"role"		=> $this->getRole($email2)
				);
				$this->session->set_userdata($data);
				if (!$this->session->userdata("access_link")) {
					redirect('/division');
				} else {
					redirect($this->session->userdata("access_link"));
				}
				// redirect('/department');
				
			} else {

				echo "<script>alert('Please try again');</script>";
				redirect('/login');
				
			}

		}

	}

	public function autoLogin () {

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$url = "http://10.124.8.92:8080/dbusinesscard/rest/user/card";

		$email2 = $email;
		$password2 = $password;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "8080",
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\n\t\"name\":\"" . $email . "\",\n\t\"pwd\":\"" . $password . "\"\n}",
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		$result = trim($response);

		// echo $result;

		if ($err || $result == FALSE || empty($result)) {
			// ERROR CURL
			echo $error_response;
		} else {

			$login_details = json_decode($result);
			$email = $login_details -> { 'email' };
			$id = $login_details -> { 'id' };
			$name = $login_details -> { 'name' };

			if(!(empty($email) || empty($id))) {
				$data = array(
					"name"		=> $name,
					"username" 	=> $id,
					"logged_in" => true,
					"role"		=> $this->getRole($email2)
				);
				$this->session->set_userdata($data);
				echo "success";
			} else {
				echo "error";
			}

		}

	}

	public function logout() {
		// $this->session->unset_userdata("username");
		$this->session->sess_destroy();
		redirect('/login');	
	}

	public function getName($username) {
		$name = explode(".", $username);
		return $name[0];
	}

	public function getRole ($email) {

		$admin = array("jen.tan", "uli", "ULI", "uli.behringer", "mat.barba", "jeremy.espinosa", "jessie.biros", "kevin.saquing");

		if (in_array($email, $admin)) return "admin";
		
		return "normal";

	}



}