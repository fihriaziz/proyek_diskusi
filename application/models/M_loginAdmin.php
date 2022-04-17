<?php 

class M_loginAdmin extends CI_Model
{
	function cek_login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('admin');
		//ini sama seperti select * from user where username = '$username' and password='$password'

		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function ambil_data($id){
		$this->db->where('id_admin', $id);
		$query = $this->db->get('admin');

		//select * from mhs
		return $query;
	}
}
?>