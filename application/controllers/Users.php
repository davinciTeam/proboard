<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {

	public function __construct()
   	{
   		parent::__construct();
        $this->load->library('Auth');
		$this->load->model("ConfigModel", "config_model");
   	}
   	
	public function index()
	{
		$token = $this->input->cookie('token');
		try {
			$decodedToken = $this->auth->verifyToken($token);
			$response["users"] = $this->config_model->getUsers();
		} catch ( Exception $e ) {
			$response = $e->getMessage();
		}
		
		echo_json($response);
	}

	public function NewUserAction()
	{
		//$this->load->library('form_validation');
		// $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]',	
		// array('is_unique' => 'E-mail adres is al in gebruik','valid_email' => 'Voer een geldig email adres in','required' => 'Dit veld is verplicht'));
		// $this->form_validation->set_rules('username', 'Username', 'required',	
		// array('required' => 'Voer een gebruikersnaam in'));
		// $this->form_validation->set_rules('name', 'name', 'required',	
		// array('required' => 'Voer een naam in'));

		// if ($this->form_validation->run()) {
			$saveData = array(
				"name" =>  $this->input->post('name'),
				"username" => $this->input->post('username'),
				"email" => $this->input->post('email')
			);
			$this->config_model->insertUser($saveData);
		//}
	}

	public function edit($id)
	{
		//$this->load->library('form_validation');
		//$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]',	
		//array('is_unique' => 'E-mail adres is al in gebruik','valid_email' => 'Voer een geldig email adres in','required' => 'Dit veld is verplicht'));
		//$this->form_validation->set_rules('username', 'Username', 'required',	
		//array('required' => 'Voer een gebruikersnaam in'));
		//$this->form_validation->set_rules('name', 'name', 'required',	
		//array('required' => 'Voer een naam in'));
		
		//if ($this->form_validation->run()) {
			$saveData = array(
				"name" => $this->input->post('name'),
				"username" => $this->input->post('username'),
				"email" => $this->input->post('email')
			);

		//}
		var_dump($_POST);
		var_dump($_GET);
		var_dump($_REQUEST);
		//$newId = $this->config_model->updateUser($saveData, $id);
	}

	public function saveProfile()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if (!empty($this->input->post('profile_name'))) {
				$this->load->model("ConfigModel", "config_model");
				$this->config_model->saveProfile($this->input->post('profile_name'));
			}
		}
	}

	public function deleteUser($f_id = 0)
	{
		if ($f_id > 0) {
			$this->load->model("ConfigModel", "config_model");
			$this->config_model->deleteUser($f_id);
			header('Location: /Users/users');
		}
	}
}