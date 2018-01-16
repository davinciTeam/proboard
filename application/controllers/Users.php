<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
	public function __construct()
   	{
   		parent::__construct();
        $this->load->library('Auth');
   	}
   	
	public function index()
	{
		$token = $this->input->cookie('token');
		try {
			$decodedToken = $this->auth->verifyToken($token);

			$this->load->model("ConfigModel", "config_model");
			/* Users overview */
			$users = $this->config_model->getUsers();
			$response = array(
				"users" => $users
			);
		} catch ( Exception $e ) {
			$response = $e->getMessage();
		}
		
		// render('config/users_overview', $users_data);
		echo_json($response);
	}

	public function users()
	{
		$this->load->model("ConfigModel", "config_model");
		/* Users overview */
		$users = $this->config_model->getUsers();
		$users_data = array(
			"users" => $users
			
		);
		// render('config/users_overview', $users_data);
		echo_json($users_data);
	}

	public function editUser($id = null)
	{
		if (empty($id)) {
			redirect('users');
		}
		$this->load->model("ConfigModel", "config_model");

		$data['user_data'] = $this->config_model->getUser($id);

		if (!$data['user_data']) {
			show_404();
		}

		// render('config/user_edit', $data);
	}

	public function NewUser()
	{
		$this->load->model("ConfigModel", "config_model");

		render('config/user_new');
	}

	public function NewUserAction()
	{
		$this->load->library('form_validation');
		$this->load->model("ConfigModel", "config_model");
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]',	
		array('is_unique' => 'E-mail adres is al in gebruik','valid_email' => 'Voer een geldig email adres in','required' => 'Dit veld is verplicht'));
		$this->form_validation->set_rules('username', 'Username', 'required',	
		array('required' => 'Voer een gebruikersnaam in'));
		$this->form_validation->set_rules('name', 'name', 'required',	
		array('required' => 'Voer een naam in'));

		if ($this->form_validation->run()) {

			$saveData = array(
				"name" => $this->input->post('name'),
				"username" => $this->input->post('username'),
				"email" => $this->input->post('email'),
			);
			$this->config_model->insertUser($saveData);
		}

		redirect('Users/users');
	}

	public function editUserAction()
	{
		$this->load->library('form_validation');
		$this->load->model("ConfigModel", "config_model");
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]',	
		array('is_unique' => 'E-mail adres is al in gebruik','valid_email' => 'Voer een geldig email adres in','required' => 'Dit veld is verplicht'));
		$this->form_validation->set_rules('username', 'Username', 'required',	
		array('required' => 'Voer een gebruikersnaam in'));
		$this->form_validation->set_rules('name', 'name', 'required',	
		array('required' => 'Voer een naam in'));
		
		$saveData = array(
			"name" => $this->input->post('name'),
			"username" => $this->input->post('username'),
			"email" => $this->input->post('email')
		);

		$newId = $this->config_model->updateUser($saveData, $this->input->post('id'));
		redirect('/Users/editUser/' . $newId);
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