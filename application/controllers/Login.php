<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

	public function __construct() 
	{
		// header('Access-Control-Allow-Origin: *');
  //   	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    	parent::__construct();

	}

	public function index_post()
	{
		echo_json('test');
	}

	public function logout()
	{
		$this->load->library('Auth');
		$this->auth->doLogout();
		header('Location: /dashboard');
	}

	/*public function install()
	{
		$this->load->library('Auth');
		$this->auth->installSystem();
		header('Location: /login');
	}*/

}
