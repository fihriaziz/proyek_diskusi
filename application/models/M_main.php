<?php 

class M_main extends CI_Model
{
	function ambil_jml_diskusi($id){
		$this->db->where('id_user', $id);
		$query = $this->db->get('diskusi');
		$total = $query->num_rows();

		return $total;
	}

	function ambil_jml_komen($id){
		$this->db->where('id_user', $id);
		$query = $this->db->get('komentar');
		$total = $query->num_rows();

		return $total;
	}

	function getDiskusi($id_diskusi){
		$this->db->where('id_diskusi', $id_diskusi);
		$query = $this->db->get('diskusi');

		return $query;
	}

	function getMhs($id_diskusi){
		$query = $this->db->query("SELECT m.* FROM mhs m, user u, diskusi d WHERE d.id_diskusi =".$id_diskusi." AND u.id_user = d.id_user AND m.id_user = u.id_user");
		if($query->num_rows() > 0){
			return $query;
		}else{
			$query2 = $this->db->query("SELECT m.* FROM dsn m, user u, diskusi d WHERE d.id_diskusi =".$id_diskusi." AND u.id_user = d.id_user AND m.id_user = u.id_user");
			return $query2;
		}
	}

	function getKomen($id_diskusi){
		// $query = $this->db->query("SELECT m.*, k.* FROM mhs m, komentar k WHERE k.id_diskusi = ".$id_diskusi." AND m.id_user = k.id_user ORDER BY k.tgl_komentar ASC");
		$query = $this->db->query("SELECT m.id_user, m.nama, m.foto, k.* FROM mhs m, komentar k WHERE k.id_diskusi = ".$id_diskusi." AND m.id_user = k.id_user union SELECT m.id_user, m.nama, m.foto, k.* FROM dsn m, komentar k WHERE k.id_diskusi = ".$id_diskusi." AND m.id_user = k.id_user ORDER BY tgl_komentar ASC");

		return $query;
	}

	// function insert_komen($data){
	// 	$this->db->insert('komentar', $data);
	// }

	function insert_komen($data){
		$new = array(
			'id_user' => $data['id_user'],
			'id_diskusi' => $data['id_diskusi'],
			'isi_komentar' => $data['isi_komentar']);
		$this->db->insert('komentar', $new);
		return $this->db->insert_id();
	}

	function delete_komen($id_komentar){
		$this->db->where('id_komentar', $id_komentar);
		$this->db->delete('komentar');

		$this->db->query('DELETE from notifikasi where id_komentar='.$id_komentar.'');
	}

	function diskusiku($id_user){
		$this->db->where('id_user', $id_user);
		$this->db->order_by('tgl_post', 'DESC');
		$query = $this->db->get('diskusi');

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

	function ambil_data($id){
		$this->db->where('id_user', $id);
		$query = $this->db->get('mhs');

		//select * from mhs
		return $query;
	}

	function fileinfo($id_file){
		$this->db->where('id_file', $id_file);
		$query = $this->db->get('file');

		return $query;
	}

	function info_lampiran($id_komentar){
		$this->db->where('id_komentar', $id_komentar);
		$query = $this->db->get('komentar');

		return $query;
	}

	function update_userpass($data,$id_user){
		$this->db->set($data);
		$this->db->where('id_user', $id_user);
		$this->db->update('user');
	}

	function ambil_data_user($id){
		$this->db->where('id_user', $id);
		$query = $this->db->get('user');

		return $query;
	}

	function ambil_data_dsn($id){
		$this->db->where('id_user', $id);
		$query = $this->db->get('dsn');

		return $query;
	}

	function getUser($id){
		$query = $this->db->get_where('mhs', array('id_user' => $id));
		if($query->num_rows() > 0){
			return $query;
		}else{
			$query2 = $this->db->get_where('dsn', array('id_user' => $id));
			return $query2;
		}
	}

	public function cari($keyword){
		// $this->db->like('isi',$keyword)->or_like('judul',$keyword);
		// $this->db->select('diskusi.*,mhs.id_mhs,mhs.nama,dsn.id_dosen,dsn.nama');
		// $this->db->from('diskusi');
		// $this->db->join('mhs','mhs.id_user = diskusi.id_user','left');
		$data = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user AND (d.judul LIKE '".$keyword."%' OR d.isi LIKE '".$keyword."%') union SELECT m.nama, d.* FROM dsn m, diskusi d WHERE m.id_user=d.id_user AND (d.judul LIKE '".$keyword."%' OR d.isi LIKE '".$keyword."%') ORDER BY tgl_post DESC;");
		// $data = $this->db->get();
		return $data;
	}

	function notifinsert($get_id){
		$sql = $this->db->query('SELECT * FROM komentar WHERE id_komentar = '.$get_id.'');
		$row = $sql->row();
		$id_diskusi = $row->id_diskusi;
		$id_user = $row->id_user;

		// $notif1 = $this->db->query('SELECT id_user from diskusi where id_diskusi = '.$id_diskusi.' AND id_user != '.$id_user.'');
		// if($notif1->num_rows() > 0){
		// 	$data1 = array(
		// 		'id_diskusi' => $id_diskusi,
		// 		'id_komentar' => $get_id,
		// 		'id_user' => $notif1->row()->id_user
		// 		);
		// 	$this->db->insert('notifikasi', $data1);
		// }

		// $i = $this->db->query('SELECT id_user FROM diskusi WHERE id_diskusi='.$id_diskusi.'');
		// $user1 = $i->row();

		// $notif2 = $this->db->query('SELECT distinct id_user from komentar where id_diskusi = '.$id_diskusi.' AND id_user != '.$id_user.'');
		// $notif2 = $this->db->query('SELECT distinct k.id_user FROM komentar k, diskusi d WHERE k.id_diskusi = '.$id_diskusi.' AND k.id_user != '.$id_user.' AND k.id_user != d.id_user');
		$notif = $this->db->query('SELECT id_user from diskusi where id_diskusi = '.$id_diskusi.' and id_user != '.$id_user.' union SELECT distinct id_user from komentar where id_diskusi = '.$id_diskusi.' and id_user != '.$id_user.'');
		if($notif->num_rows() > 0){
			$jml = $notif->num_rows();
			for ($i=0; $i < $jml ; $i++) { 
				$data['id_user'] = $notif->row($i)->id_user;
				$data2 = array(
					'id_diskusi' => $id_diskusi,
					'id_komentar' => $get_id,
					'id_user' => $data['id_user'],
					'status' => 0
					);
				$this->db->insert('notifikasi', $data2);
			}
		}

	}

	function cekReportD($id_diskusi, $id_user){
		$query = $this->db->query('SELECT * FROM reportDiskusi WHERE id_diskusi = '.$id_diskusi.' AND id_user = '.$id_user.'');
		return $query->num_rows();
	}

	function cekReportK($id_komentar, $id_user){
		$query = $this->db->query('SELECT * FROM reportKomentar WHERE id_komentar = '.$id_komentar.' AND id_user = '.$id_user.'');
		return $query->num_rows();
	}
}
?>