<?php
	class ConfigModel extends CI_Model  {

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
			$query = $this->db->get_where('users', array("active" => 1));
			return $query->result();
		}

		public function updateUser($data, $id)
		{
			// Save general user info (name, email, profile_id, division_id, startpage)

			$updateData = array(
				"name" => $data["name"],
				"email" => $data["email"],
			);
			if ($this->db->update('users', $updateData, array("id" => $id))) {
				addFeeback(array('Gebruiker succesvol bijgewerkt'));
			}
			
			return $id;
		}
		public function insertUser($data)
		{
			$this->load->library('Auth');

			$hash = md5(uniqid());

			while ($this->getUserByActivationHash($hash)) {
				$hash = md5(uniqid());
			}
			
			$updateData = array(
				"name" => $data["name"],
				"email" => $data["email"],
				"date_created" =>  date('Y-m-d H:i:s'),
				"active" => 0, 
				"activation_hash" => $hash
			);

			if ($this->db->insert('users', $updateData)) {
				addFeeback(array('Gebruiker succesvol aangemaakt'));
			}
			
			$this->load->library('Emails');
			$this->emails->register($updateData["name"], $updateData["email"], $updateData["activation_hash"]);

			return $id; 
		}

		public function getUserByActivationHash($hash)
		{
			return $this->db->from("users")->where("activation_hash", $hash)->get()->row();
		}

		public function setUserPassword($data, $hash) {
			$user = $this->getUserByActivationHash($hash);
			if (!$user) {
				addFeeback('Er is een onbekende fout opgetreden', 'negative');
				return false;
			}

			$hash = $this->auth->getPasswordHash($data["password"], $user);

			if ($this->db->update('users', array("password" => $hash, "active" => 1) , array("id" => $user->id))) {
				addFeeback(array('U kunt nu inloggen'));
			}

			return true;
		}
	}