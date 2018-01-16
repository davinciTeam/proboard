<?php
	class ConfigModel extends CI_Model  {

		public function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
	        //Get database class availeble
	    }

		public function getUserByUsername($username)
		{
			$query = $this->db->get_where('users', array("username" => $username, "active" => 1));
			if($query->num_rows() != 0){
				return $query->row();
			} else {
				return false;
			}
		}

		public function getUser($id)
		{
			return $this->db->get_where("users", array("active" => 1, "id" => $id))->result();
		}

		public function deleteUser($id)
		{
			if ($id > 0) {
				$this->db->update('users', array("active" => 0), array("id" => $id));
			}
		}

		public function getUsers()
		{
			$this->db->order_by('name', 'ASC');
			$query = $this->db->get_where('users');
			return $query->result();
		}

		public function updateUser($data, $id)
		{
			// Save general user info (name, email, profile_id, division_id, startpage)

			$updateData = array(
				"name" => $data["name"],
				"email" => $data["email"]
			);
			if ($this->db->update('users', $updateData, array("id" => $id))) {
				return true;
			}
			
			return false;
		}
		public function insertUser($data)
		{
			$this->load->library('Auth');

			$hash = md5(uniqid());

			while ($this->getUserByActivationHash($hash)) {
				$hash = md5(uniqid());
			}
			
			$updateData = array(
				"username" => $data["username"],
				"name" => $data["name"],
				"email" => $data["email"],
				"date_created" =>  date('Y-m-d H:i:s'),
				"active" => 0, 
				"activation_hash" => $hash
			);

			if ($this->db->insert('users', $updateData)) {

			}
			$this->db->insert('users', $updateData);	
			$this->load->library('Emails');
			$this->emails->register($updateData["name"], $updateData["email"], $updateData["activation_hash"]);

			// return $id; 
		}

		public function getUserByActivationHash($hash)
		{
			return $this->db->from("users")->where("activation_hash", $hash)->get()->row();
		}

		public function setUserPassword($data, $hash) {
			$user = $this->getUserByActivationHash($hash);
			if (!$user) {
				return false;
			}

			$hash = $this->auth->getPasswordHash($data["password"], $user);

			if ($this->db->update('users', array("password" => $hash, "active" => 1) , array("id" => $user->id))) {
				//TODO:log the user in 
				//$this->load->library('Auth');
				//$this->auth->doLogin($user->username, $data["password"]);
			}

			return true;
		}

		public function emailValidation($email, $id) 
	    {
	    	return !(bool)$this->db->get_where("users", array("id <>" => $id, 'email' => $email))->result();
	    }
	}