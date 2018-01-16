<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {

	public $id = 0;

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
		//$data = get_input_params();

		//$this->load->library('form_validation');
		//$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]');
		//$this->form_validation->set_rules('username', 'Username', 'required');
		//$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_data($data);

		//if ($this->form_validation->run()) {
			$saveData = array(
				"name" =>  $data['name'],
				"username" => $data['username'],
				"email" => $data['email']
			);
			$this->config_model->insertUser($saveData);
		//}
	}

	public function edit($id)
	{
		$this->id = $id;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_check');
		$this->form_validation->set_rules('name', 'name', 'required');
		
		$data = get_input_params();
		$this->form_validation->set_data($data);

		if ( $this->form_validation->run() ) {
			$saveData = array(
				"name" => $data['name'],
				"email" => $data['email']
			);			
			$this->config_model->updateUser($saveData, $id);
		
		}

		return false;
	}

	public function email_check($email)
	{
		return $this->config_model->emailValidation($email, $this->id);
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
	public function activateUser()
	{
        
		$data = array(
		'password' => $this->input->post('password'),
		'active' => 1
		);

		$this->config_model->setUserPassword($data, $this->input->post('activation_hash'));
	}
}