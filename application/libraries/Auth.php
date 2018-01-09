<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Get the jwt class.
use Firebase\JWT\JWT;

class Auth {

	public function __construct() {
		

		// Get the config key's
		$CI =& get_instance();
		$this->_key = $CI->config->item('encryption_key');
		$this->jwt_key = base64_decode($CI->config->item('jwt_key'));
		$this->jwt_algorithm = $CI->config->item('jwt_algorithm');
		$this->timeBeforeExpire = $CI->config->item('jwt_expire');
	}

	private $_key = "";					// Password encryption key.
	private $jwt_key = ""; 				// JWT secret.
	private $jwt_algorithm = ""; 		// JWT algorithm.
	private $timeBeforeExpire = 0;		// Amount of time before the JWT expires.
	

	private function getPasswordHash($f_password, $f_user)
	{
		// Create a var with an empty string.
		$f_hash = "";
		// If the user object is given.
		if (is_object($f_user)) {
			// Hash using the password and the time of the user created
			$f_hash = sha1($this->_key . $f_password . $f_user->date_created . strrev($this->_key));
		}
		return $f_hash;
	}

	public function loginWithUsernameAndPassword($username, $password) {
		// Load the user model
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->model('ConfigModel', 'config_model');
		$CI->load->config('config');
		// Get the user data from the database.
		$user = $CI->config_model->getUserByUsername($username);
		// If the user model returned an user.
		if(is_object($user)) {
			// Get the password hash.
			$hash = $this->getPasswordHash($password, $user);
			// If the password hash is the same as the user password hash.
			if($hash == $user->password) {
				$tokenId 	= base64_encode(mcrypt_create_iv(32)); // Create an unique identifier
				$issuedAt	= time();
				$notBefore	= $issuedAt + 1; // Adding 1 second before it can be used.
				$expire		= $notBefore + $this->timeBeforeExpire; // amount of time before expirering.

				// $serverName = $CI->config->get('serverName'); // !!!!!IMPORTANT 

				// Create an array with all the user data necessary.

				$data = [
	                'userId'   => $user->id,
	                'userName' => $username,
                ];
                // Create the token as an array
                $token = [
                    'iat'  => $issuedAt,         // Issued at: time when the token was generated
                    'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
                    // 'iss'  => $serverName,       // Issuer
                    'nbf'  => $notBefore,        // Not before
                    'exp'  => $expire,           // Expire
                    'data' => $data              // Data related to the signer user
                ];

				// Get the secret key defined in the constructor function.

				$secretKey = $this->jwt_key;

				// Get the algorithm defined in the constructor function.

				$algorithm = $this->jwt_algorithm;

				// Encode the array to a JWT string.

				$jwt = JWT::encode(
					$token,		// Data to be encoded in the JWT.
					$secretKey,	// The signing key.
					$algorithm	// Algorithm used to sign the token.
				);

				$unencodedArray = ['jwt' => $jwt];
				// Encode to json and return the JWT.
				return $unencodedArray; // !!!!!!IMPORTANT

			// If the password hash is not the same as the user password hash.
			} else {
				// Return error: 401 wrong password.
				throw new Exception('Username and password do not match');
			}
		// If the user model does not return an user.
		} else {
			// Return error: 404 no user found.
			throw new Exception('Username does not exist');
		}
	}
	public function verifyToken($token) {
		// Check if there is a token given
		if ($token) {

			// Get the secret key defined in the constructor function.
			$secretKey = $this->jwt_key;

			// Get the algorithm defined in the constructor function.
			$algorithm = $this->jwt_algorithm;

			try{
				$decodedToken = JWT::decode($token, $secretKey, array($algorithm));

				return $decodedToken;
			} catch(\Exception $e) {
				throw $e;
			}
		} else {
			throw new Exception('No token given');
		}
	}
}