<?php

class Division extends Ci_Controller {

	public function __construct () {
		parent::__construct();

		// avoiding unauthorized user to access the controller / views 
		if (!$this->session->has_userdata('username')) {
			$this->session->set_userdata(array(
				"access_link" => "http://" .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
			));

			// redirect to the login page
			redirect('login');
		} else {
			$this->userPermissionToPage();
		}

	}

	/* Views */

	public function index () {

		// put here all the data you want to pass in view
		$data = array(
			'divisions' => $this->getDivisionsSequence()
		);

		// loading the view
		return $this->load->view('division/index', $data);

	}

	public function dashboard () {
		$subDivision 		= $this->uri->segment(4) == "" ? "" : "/" . $this->uri->segment(4);
		$division 			= $this->uri->segment(3);
		$divisionAndSub 	= $this->uri->segment(3) .  $subDivision;
		
		// put here all the data you want to pass in view
		$data = array(
			'division' 			=> $division,
			'divisions' 		=> $this->Jd_model->getDivisionsDataByRole($division, $subDivision),
			'subDivision' 		=> $subDivision,
			'divisionAndSub' 	=> $divisionAndSub,
			'permission'		=> $this->getPermission(),
			'divisionsLabel'	=> $this->getDivisionsLabel()
		);

		// loading the view
		return $this->load->view('division/dashboard', $data);
	}

	public function view () {
		$id 			= $this->uri->segment(3);
		$division 		= $this->uri->segment(4);
		$subDivision 	= $this->uri->segment(5) == "" ? "" : "/" . $this->uri->segment(5);
		$divisionAndSub = $division . $subDivision;
		$method 		= $this->uri->segment(2);

		$results = $this->Jd_model->getJdData($id);

		// put here all the data you want to pass in view
		$data = array(
			'id' 	 			=> $results[0]->id,
			'division' 	 		=> $results[0]->division,
			'jdData' 			=> $results,
			'divisionAndSub'	=> $divisionAndSub,
			'jdHistory'			=> $this->Jd_History_model->getJdHistory($id),
			'permission'		=> $this->getPermission(),
			'divisionsLabel'	=> $this->getDivisionsLabel(),
			'method'			=> $method
		);

		// loading the view
		return $this->load->view('division/view', $data);
	
	}

	public function create () {

		$subDivision 	= $this->uri->segment(4) == "" ? "" : "/" . $this->uri->segment(4);
		$division 		= $this->uri->segment(3);
		$divisionAndSub = $division . $subDivision;
		$method 		= $this->uri->segment(2);


		// put here all the data you want to pass in view
		$data = array(
			'division' 			=> $division,
			'roles' 			=> $this->getRoles(),
			'countries' 		=> $this->getCountries(),
			'divisionAndSub' 	=> $divisionAndSub,
			'divisions'			=> $this->getDivisionsSequence(),
			'divisionsLabel'	=> $this->getDivisionsLabel(),
			'method'			=> $method
		);

		// loading the view
		return $this->load->view('division/create', $data);

	}

	public function update () {
		$id 				= $this->uri->segment(3);
		$subDivision 		= $this->uri->segment(5) == "" ? "" : "/" . $this->uri->segment(5);
		$division			= $this->uri->segment(4);
		$divisionAndSub 	= $division . $subDivision;
		$method 			= $this->uri->segment(2);

		// put here all the data you want to pass in view
		$data = array(
			'id' => $id,
			'division' 			=> $division,
			'jdData' 			=> $this->Jd_model->getJdData($id),
			'roles'  			=> $this->getRoles(),
			'countries'	 		=> $this->getCountries(),
			'divisions'	 		=> $this->getDivisionsSequence(),
			'divisionAndSub'	=> $divisionAndSub,
			'divisionsLabel'	=> $this->getDivisionsLabel(),
			'method'			=> $method
		);

		// loading the view
		return $this->load->view('division/update', $data);
	}

	public function duplicate () {
		$id 				= $this->uri->segment(3);
		$division			= $this->uri->segment(4);
		$subDivision 		= $this->uri->segment(5) == "" ? "" : "/" . $this->uri->segment(5);
		$divisionAndSub 	= $division . $subDivision;
		$method 			= $this->uri->segment(2);

		// put here all the data you want to pass in view
		$data = array(
			'id' 				=> $id,
			'division' 			=> $division,
			'jdData' 			=> $this->Jd_model->getJdData($id),
			'roles'  			=> $this->getRoles(),
			'countries'	 		=> $this->getCountries(),
			'divisions'	 		=> $this->getDivisionsSequence(),
			'divisionAndSub'	=> $divisionAndSub,
			'divisionsLabel'	=> $this->getDivisionsLabel(),
			'method'			=> $method
		);

		// loading the view
		return $this->load->view('division/duplicate', $data);
	}

	/* Views */

	/* Functions */

	public function createJd () {
		$division = $this->uri->segment(3);
		$subDivision = $this->uri->segment(4) == "" ? "" : "/" . $this->uri->segment(4);
		$divisionAndSub = $division . $subDivision;

		// calling the query in this model
		$this->Jd_model->createJd();
		// create a jd history or logs
		$this->Jd_History_model->createJdHistory();

		// passing some data to show the flash message
		$this->session->set_flashdata(array(
			"status" 	=> "is-active",
			"message" 	=> "Successfully Added"
		));

		// redirecting the to this view
		redirect('division/dashboard/' . $divisionAndSub);
	}

	public function deleteJd () {
		$previousUrl	= $_SERVER['HTTP_REFERER'];
		$division 		= $this->uri->segment(4);

		$this->session->set_flashdata(array(
			"status" 	=> "is-active danger",
			"message" 	=> "Successfully Deleted"
		));
		
		// calling the query in this model
		$this->Jd_model->deleteJd();

		// redirecting the to this view
		redirect($previousUrl);
	}

	public function updateJd () {
		$id 				= $this->uri->segment(3);
		$division 			= $this->uri->segment(4);
		$subDivision 		= $this->uri->segment(5) == "" ? "" : "/" . $this->uri->segment(5);
		$divisionAndSub 	= $division . $subDivision;

		$this->session->set_flashdata(array(
			"status" 	=> "is-active",
			"message" 	=> "Successfully Updated"
		));
		
		// calling the query in this model
		$this->Jd_model->updateJd($id);

		// update a jd history or logs
		$this->Jd_History_model->updateJdHistory($id);

		// redirecting the to this view
		redirect('division/view/' . $id . "/" . $divisionAndSub);
	}

	public function duplicateJd () {
		$id 			= $this->uri->segment(3);
		$division 		= $this->uri->segment(4);
		$subDivision 	= $this->uri->segment(5) == "" ? "" : "/" . $this->uri->segment(5);
		$divisionSub 	= $division . $subDivision;

		$this->session->set_flashdata(array(
			"status" 	=> "is-active",
			"message" 	=> "Successfully Duplicated"
		));

		// calling the query in this model
		$this->Jd_model->createJd();

		// redirecting the to this view
		redirect('division/dashboard/' . $divisionSub);
	}

	/* Functions */


	/* Getters */
	
	public function decodeJson ($data) {
		return json_decode($data);
	}

	public function getDivisionsSequence () {
		return array('Heart', 'Friends', 'Care', 'Broad', 'Inno', 'Exce', 'Hype', 'Trea', 'Manu', 'Brand', 'Oper', 'Npi', 'Proc', 'Qual', 'Supp');
	}

	public function getDivisionsLabel () {
		// use this to get the other name of the division
		return array(
			'heart' 	=> '(HR)',
			'friends' 	=> '(Sales)',
			'care' 		=> '(Service)',
			'broad' 	=> '(Broadcasting, Collaboration)',
			'inno' 		=> '(Innovation, R&D)',
			'exce' 		=> '(Excellence, IT/IS)',
			'hype' 		=> '(Hypermedia)',
			'trea' 		=> '(Finance)',
			'manu' 		=> '(Manufacturing)',
			'brand' 	=> '(Brand)',
			'oper' 		=> '(Operations)',
			'npi' 		=> '(New Product Introduction)',
			'proc' 		=> '(Procurement)',
			'qual' 		=> '(Quality)',
			'supp' 		=> '(Supply Chain)'
		);
	}

	public function getRoles () {
		return array('Leader', 'Contributor');
	}

	public function getCountries () {

		return array(
			"All Locations", "Canada, Victoria", "China, Shenzhen", "China, Zhongshan",	"Denmark, Risskov",
			"Germany, Willich",	"Japan, Tokyo",	"Philippines, Manila", "Scotland, North Lanarkshire",
			"Singapore", "Sweden, Kungsbacka", "UK, Kidderminster", "UK, Manchester",
			"USA, Las Vegas", "USA, Los Angeles"
		);

	}

	public function getDefinedTemplate () {
		print_r(json_encode($this->Template_model->getDefinedTemplate()));
	}

	public function getUserTemplate () {
		print_r(json_encode($this->Jd_model->getUserTemplate()));
	}

	public function getPermission () {
		return $this->Permission_model->getPermissions()[0];
	}

	public function userPermissionToPage () {
		// key 	 = the column name of the permission
		// value = the method to call the view
		$controllerMethodArray = array(
			'view_permission' 		=> 'view',
			'create_permission' 	=> 'create', 
			'update_permission' 	=> 'update', 
			'duplicate_permission' 	=> 'duplicate'
		);

		// get the method used to call the view
		$controllerMethod 	= $this->uri->segment(2);

		// check if the method want to access is existing
		if (in_array($controllerMethod, $controllerMethodArray)) {

			// geting the permission name or the column name
			$permission 		= array_search($controllerMethod, $controllerMethodArray);
			// check what the value of the permission want to access
			// possible values are 0 or 1
			$userPermission 	= $this->getPermission()->$permission;

			// if the permission is 0 redirect it to the 404 page 
			// because it is not accessible due to its user role
			if (!$userPermission) {
				redirect('errors/index');
			}

		}

	}

	/* Getters */
}