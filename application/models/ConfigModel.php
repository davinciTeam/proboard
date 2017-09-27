<?php
	class ConfigModel extends CI_Model  {


		public function getUserByUsername($f_username){
			$query = $this->db->get_where('users', array("username" => $f_username, "active" => 1));
			if($query->num_rows() != 0){
				return $query->row();
			} else {
				return false;
			}
		}

		public function getUser($f_id){
			$query = $this->db->get_where("users", array("active" => 1, "id" => $f_id));
			return $query->row();
		}

		public function deleteUser($f_id){
			if ($f_id > 0) {
				$this->db->update('users', array("active" => 0), array("id" => $f_id));
			}
		}

		public function getUsers(){
			$this->db->order_by('name', 'ASC');
			$query = $this->db->get_where('users', array("active" => 1));
			return $query->result();
		}

		public function updateUser($data, $f_id)
		{
			// Save general user info (name, email, profile_id, division_id, startpage)

			$updateData = array(
				"name" => $data["name"],
				"email" => $data["email"],
				"start_page" => !empty($data["start_page"]) ?  $data["start_page"] : '/dashboard'
			);
			$this->db->update('users', $updateData, array("id" => $f_id));
			// Check for duplicate username
			$query = $this->db->get_where('users', array("id <>" => $f_id, "username" => $data["username"]));
			if ($query->num_rows() == 0) {
				$this->db->update('users', array("username" => $data["username"]), array("id" => $f_id));
			} else {
				return "DUPLICATE USERNAME";
			}
			if ($data["password"] != "*************************") {
				$this->load->library('Auth');
				$user = $this->getUser($f_id);
				$hash = $this->auth->getPasswordHash($data["password"], $user);
				$this->db->update('users', array("password" => $hash) , array("id" => $f_id));
			}
			
			return $f_id;
		}
		public function insertUser($data)
		{
			$this->load->library('Auth');
			$updateData = array(
				"name" => $data["name"],
				"email" => $data["email"],
				"date_created" =>  date('Y-m-d H:i:s'),
				"active" => 1, 
				"start_page" => !empty($data["start_page"]) ?  $data["start_page"] : '/dashboard'
			);
			$this->db->insert('users', $updateData);
			$f_id =  $this->db->insert_id();
			$query = $this->db->get_where('users', array("id <>" => $f_id, "username" => $data["username"]));
			if($query->num_rows() == 0){
				$this->db->update('users', array("username" => $data["username"]), array("id" => $f_id));
			} else {
				return "DUPLICATE USERNAME";
			}
			$user = $this->getUser($f_id);
			$hash = $this->auth->getPasswordHash($data["password"], $user);
			$this->db->update('users', array("password" => $hash), array("id" => $f_id));
			return $f_id; 
		}


	}