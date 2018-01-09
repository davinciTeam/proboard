<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends REST_Controller {

	public function __construct(string $config = 'rest') {
    	parent::__construct($config);
		$this->load->library('auth');
	}

	public function index_post() {
		$data = $this->post();
		try {
			$jwt = $this->auth->loginWithUsernameAndPassword($data['login_string'], $data['login_pass']);
			$response = $jwt;
			$httpStatusCode = 201;
		} catch(Exception $e) {
			$response = [
				'message' => $e->getMessage()
			];
			$httpStatusCode = 403;
		}

		$this->set_response($response, $httpStatusCode);
	} 

	public function verifyJWT() {
		$data = $this->input->post('JWT');
		try {
			$decodedToken = $this->auth->verifyToken($data);
			$response = TRUE;
		} catch ( Exception $e ) {
			$response = $e->getMessage();
		}
		echo_json($response);
	}

	// public function logout()
	// {
	// 	$this->load->library('Auth');
	// 	$this->auth->doLogout();
	// 	header('Location: /dashboard');
	// }

	/*public function install()
	{
		$this->load->library('Auth');
		$this->auth->installSystem();
		header('Location: /login');
	}*/

}
