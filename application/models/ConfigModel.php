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
				"start_page" => '/dashboard'
			);
			if ($this->db->update('users', $updateData, array("id" => $id))) {
				addFeeback(array('Gebruiker succesvol bijgewerkt'));
			}
			// Check for duplicate username
			
			//$query = $this->db->get_where('users', array("id <>" => $id, "username" => $data["username"]));
			//if ($data["password"] != "*************************") {
			//	$this->load->library('Auth');
			//	$user = $this->getUser($id);
			//	$hash = $this->auth->getPasswordHash($data["password"], $user);
			//	$this->db->update('users', array("password" => $hash) , array("id" => $id));
			//}
			
			return $id;
		}
		public function insertUser($data)
		{
			$this->load->library('Auth');
			$updateData = array(
				"name" => $data["name"],
				"email" => $data["email"],
				"date_created" =>  date('Y-m-d H:i:s'),
				"active" => 0, 
				"start_page" => '/dashboard'
			);
			if ($this->db->insert('users', $updateData)) {
				addFeeback(array('Gebruiker succesvol aangemaakt'));
			}
			
			$id =  $this->db->insert_id();
			
			$user = $this->getUser($id);
			$hash = $this->auth->getPasswordHash($data["password"], $user);
			$this->db->update('users', array("password" => $hash), array("id" => $id));
			return $id; 
		}


	}