<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
	public function __construct()
   	{
   		parent::__construct();
        $this->load->library('Auth');
     	$this->auth->check('1');
        $this->load->library('session');
        $this->load->helper('form');
   	}
   	
	public function index()
	{
		redirect('Users/users');
	}

	public function users()
	{
		$this->load->model("ConfigModel", "config_model");
		/* Users overview */
		$users = $this->config_model->getUsers();
		$users_data = array(
			"users" => $users,
			"deleted" => !empty($this->input->get('deleted')) ? 1 : 0
		);
		render('config/users_overview', $users_data);
	}

	public function editUser($id = null)
	{
		$this->load->model("ConfigModel", "config_model");

		$data['user_data'] = $this->config_model->getUser($id);

		if (!$data['user_data']) {
			show_404();
		}

		render('config/user_edit', $data);
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
		$this->form_validation->set_rules('email', 'email', 'required|is_unique[users.email]',	
		array('is_unique' => 'E-mail adres is al in gebruik'));

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
		$this->load->model("ConfigModel", "config_model");
		
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

	public function newToken()
	{
		header('Content-type:application/json');
		echo json_encode(array('new_token' => $this->security->get_csrf_hash()));
	}
}