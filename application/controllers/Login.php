<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	    $this->load->library('session');	
	    $this->load->helper('form');
	}

	public function index()
	{
		if (!empty($this->session->user_id)) {
			header('location: ' . $this->session->start_page);
		}
		
		$this->load->view('login', array("error" => $this->session->error));	
		$this->session->error = array();
	}


	public function loginAction()
	{
		$this->load->library('Auth');
		$this->auth->doLogin($this->input->post('login_string'), $this->input->post('login_pass'));

	}

	public function logout()
	{
		$this->load->library('Auth');
		$this->auth->doLogout();
	}

	/*public function install()
	{
		$this->load->library('Auth');
		$this->auth->installSystem();
		header('Location: /login');
	}*/

}
