<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}

	public function showUser($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->get('users');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('users', array("username" => $id));
			return $query->row_array();
		}
	}

	public function findUser($key){

		$query = $this->db->query("SELECT * FROM users WHERE username LIKE '%$key%' OR password LIKE '%$key%' OR fullname LIKE '%$key%' OR role LIKE '%$key%'");
		return $query->result_array();
	}

	public function insertUser($username,$password,$fullname,$role){
		$data = array(
					"username" => $username,
					"password" => $password,
					"fullname" => $fullname,
					"role" => $role
					);
		$query = $this->db->insert('users', $data);
	}

	public function showUser2($id){
		$query = $this->db->get_where('users', array("username" => $id));
			return $query->row_array();
	}

	public function updateUser($username,$password,$fullname,$role){
		$data = array(
					"username" => $username,
					"password" => $password,
					"fullname" => $fullname,
					"role" => $role
					);
		$this->db->where('username',$username);
		$query = $this->db->update('users',$data);
	}

	public function delUser($id){
		$this->db->delete('users', array("username" => $id));
	}

}

?>