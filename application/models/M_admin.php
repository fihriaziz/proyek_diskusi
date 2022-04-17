<?php 

class M_admin extends CI_Model
{
	function update_profile_admin($data, $id_admin){
		$this->db->set($data);
		$this->db->where('id_admin', $id_admin);
		$this->db->update('admin');
	}

	function cek_user($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('user');
		//ini sama seperti select * from user where username = '$username' and password='$password'

		if($query->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}

	function add_user($user){
		$this->db->insert('user', $user);
	}

	function add_dosen($dsn){
		$this->db->insert('dsn', $dsn);
	}

	function ambil_dsn($id_dosen){
		$this->db->where('id_dosen', $id_dosen);
		$query = $this->db->get('dsn');

		return $query;
	}

	function ambil_user($id_user){
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');

		return $query;
	}

	function update_user($id_user, $user){
		$this->db->set($user);
		$this->db->where('id_user', $id_user);
		$query = $this->db->update('user');

		return $query;
	}

	function update_dsn($id_dosen, $dsn){
		$this->db->set($dsn);
		$this->db->where('id_dosen', $id_dosen);
		$this->db->update('dsn');
	}

	function delete_dsn($id_dosen){
		if ($this->db->delete("dsn", "id_dosen = ".$id_dosen)) { 
            return true; 
        }
	}

	function delete_user($id_user){
		$query = $this->db->query('SELECT id_diskusi FRoM diskusi WHERE id_user = '.$id_user.'');
		// $id_diskusi = $query->result();
		foreach($query->result() as $r){
			$this->db->delete("komentar", "id_diskusi = ".$r->id_diskusi);
		}
		$this->db->delete("komentar", "id_user = ".$id_user);
		$this->db->delete("file", "id_user = ".$id_user);
		$this->db->delete("diskusi", "id_user = ".$id_user);
		$this->db->delete("user", "id_user = ".$id_user);
	}

	function add_mhs($mhs){
		$this->db->insert('mhs', $mhs);
	}

	function ambil_mhs($id_mhs){
		$this->db->where('id_mhs', $id_mhs);
		$query = $this->db->get('mhs');

		return $query;
	}

	function update_mhs($id_mhs, $mhs){
		$this->db->set($mhs);
		$this->db->where('id_mhs', $id_mhs);
		$this->db->update('mhs');
	}

	function delete_mhs($id_mhs){
		if ($this->db->delete("mhs", "id_mhs = ".$id_mhs)) { 
            return true; 
        }
	}

	function getDiskusi($id_diskusi){
		$this->db->where('id_diskusi', $id_diskusi);
		$query = $this->db->get('diskusi');

		return $query;
	}

	function getMhs($id_diskusi){
		$query = $this->db->query("SELECT m.* FROM mhs m, user u, diskusi d WHERE d.id_diskusi =".$id_diskusi." AND u.id_user = d.id_user AND m.id_user = u.id_user");

		return $query;
	}

	function getKomen($id_diskusi){
		$query = $this->db->query("SELECT m.*, k.* FROM mhs m, komentar k WHERE k.id_diskusi = ".$id_diskusi." AND m.id_user = k.id_user ORDER BY k.tgl_komentar ASC");

		return $query;
	}

	function delete_diskusi($id_diskusi){
		$this->db->where('id_diskusi', $id_diskusi);
		$this->db->delete('file');

		$this->db->where('id_diskusi', $id_diskusi);
		$this->db->delete('komentar');

		$this->db->where('id_diskusi', $id_diskusi);
		$this->db->delete('diskusi');
	}

	function delete_komen($id_komentar){
		$this->db->where('id_komentar', $id_komentar);
		$query = $this->db->delete('komentar');

		return $query;
	}

	function reportD(){
		$sql = $this->db->query('SELECT m.id_user, m.nama, d.judul, d.id_diskusi, r.tgl_report FROM mhs m, diskusi d, reportDiskusi r, user u WHERE u.id_user = r.id_user AND m.id_user = u.id_user AND d.id_diskusi = r.id_diskusi UNION SELECT m.id_user, m.nama, d.judul, d.id_diskusi, r.tgl_report FROM dsn m, diskusi d, reportDiskusi r, user u WHERE u.id_user = r.id_user AND m.id_user = u.id_user AND d.id_diskusi = r.id_diskusi ORDER BY  id_diskusi');
		return $sql;
	}

	function cekReportD($id_diskusi){
		$sql = $this->db->query('SELECT * FROM reportdiskusi WHERE id_diskusi = '.$id_diskusi.'');
		return $sql->num_rows();
	}

	function reportK(){
		$sql = $this->db->query('SELECT m.id_user, m.nama,k.id_komentar, k.isi_komentar, k.id_diskusi, r.tgl_report FROM mhs m, komentar k, reportKomentar r, user u WHERE u.id_user = r.id_user AND m.id_user = u.id_user AND k.id_komentar = r.id_komentar UNION SELECT m.id_user, m.nama, k.id_komentar, k.isi_komentar, k.id_diskusi, r.tgl_report FROM dsn m, komentar k, reportKomentar r, user u WHERE u.id_user = r.id_user AND m.id_user = u.id_user AND k.id_komentar = r.id_komentar ORDER BY  id_komentar');

		return $sql;
	}

	function cekReportK($id_komentar){
		$sql = $this->db->query('SELECT * FROM reportKomentar WHERE id_komentar = '.$id_komentar.'');
		return $sql->num_rows();
	}

}
?>