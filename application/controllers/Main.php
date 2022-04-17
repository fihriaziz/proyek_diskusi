<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('M_main');
	}

	public function index()
	{
		// $data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user ORDER BY d.tgl_post DESC");
		$data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user union SELECT m.nama, d.* FROM dsn m, diskusi d WHERE m.id_user = d.id_user ORDER BY tgl_post DESC LIMIT 4;");
		$this->load->view('menu', $data);
	}

	public function profile(){
		$id = $this->session->userdata('id_user');
		$data['diskusi'] = $this->M_main->ambil_jml_diskusi($id);
		$data['komen'] = $this->M_main->ambil_jml_komen($id);
		$data['data_user'] = $this->M_main->ambil_data_user($id);
		$data['data_dsn'] = $this->M_main->ambil_data_dsn($id);
		$this->load->model('M_login');
		$data['data_mhs'] = $this->M_login->ambil_data($id);
		$this->load->view('profile',$data);
	}

	public function diskusi(){
		$id_diskusi = $this->uri->segment('3');
		$data['diskusi'] = $this->M_main->getDiskusi($id_diskusi);
		if($data['diskusi']->row()->tambahan == "Y"){
			$this->db->where('id_diskusi', $id_diskusi);
			$lampiran = $this->db->get('file');
			$data['lampir'] = $lampiran->result();
		}
		$data['mhs'] = $this->M_main->getMhs($id_diskusi);
		//membuat pagination komen
		// $this->db->where('id_diskusi', $id_diskusi);
		// $jumlah_data = $this->db->get('komentar')->num_rows();
		// $this->load->library('pagination');
		// $config['base_url'] = base_url().'Main/diskusi/';
		// $config['total_rows'] = $jumlah_data;
		// $config['per_page'] = 10;
		// $this->pagination->initialize($config);
		$data['komen'] = $this->M_main->getKomen($id_diskusi);

		$this->load->view('diskusi', $data);
	}

	public function kirim_diskusi(){
        $id = $this->session->userdata('id_user');
		$data = array(
			'judul' => $this->input->post('judul'),
			'isi' => $this->input->post('isi'),
			'id_user' => $id
			);
		$judul = $data['judul'];
		$isi = $data['isi'];

		$this->load->model('Model_upload2');
		if($this->Model_upload2->upload_file()){
			$this->db->insert('diskusi', $data);
			$query = $this->db->query('SELECT id_diskusi FROM diskusi WHERE judul = "'.$judul.'" AND isi = "'.$isi.'" AND id_user = "'.$id.'"');
			$id_diskusi = $query->row()->id_diskusi;
			$filename = $this->upload->data('file_name');
			$jenis_file = $this->upload->data('is_image');
			$this->db->query('UPDATE diskusi SET tambahan = "Y" WHERE id_user = "'.$id.'" AND id_diskusi = "'.$id_diskusi.'"');
			$file = array(
				'nama_file' => $filename,
				'is_image' => $jenis_file,
				'tgl_post' => date('Y-m-d'),
				'id_user' => $id,
				'id_diskusi' => $id_diskusi
				);
			$this->db->insert('file', $file);

			redirect(base_url() . 'main');
		}else{
			$this->db->insert('diskusi', $data);
			redirect(base_url() . 'main');
		}
	}

	// public function kirim_komen(){
	// 	$data = array(
	// 		'isi_komentar' => $this->input->post('isi_komentar'),
	// 		'id_diskusi' => $this->input->post('id_diskusi'),
	// 		'id_user' => $this->input->post('id_user')
	// 		);
	// 	$id_diskusi = $data['id_diskusi'];
	// 	$isi_komentar = $data['isi_komentar'];
	// 	$id_user = $data['id_user'];

	// 	$this->M_main->insert_komen($data);

	// 	$this->load->model('Model_upload2');
	// 	if($this->Model_upload2->upload_komen()){
	// 		$query = $this->db->query('SELECT id_komentar FROM komentar WHERE isi_komentar = "'.$isi_komentar.'" AND id_diskusi = "'.$id_diskusi.'" AND id_user = "'.$id_user.'"');
	// 		$id_komentar = $query->row()->id_komentar;

	// 		$filename = $this->upload->data('file_name');
	// 		$jenis_file = $this->upload->data('is_image');
	// 		// $this->db->query('UPDATE komentar SET lampiran = "'.$filename.'", is_image = '.$jenis_file.' WHERE id_komentar = "'.$id_komentar.'"');		
			
	// 		$file = array(
	// 			'lampiran' => $filename,
	// 			'is_image' => $jenis_file 
	// 			);

	// 		$this->db->set($file);
	// 		$this->db->where('id_komentar', $id_komentar);
	// 		$this->db->update('komentar');
	// 	}

	// 	redirect(base_url() . 'Main/diskusi/' . $id_diskusi);
	// }

	public function kirim_komen(){
		$data = $this->input->post();
		$get_id = $this->M_main->insert_komen($data);
		$tag = '';

		$this->M_main->notifinsert($get_id);

		//ambil data user
		$get_user = $this->M_main->getuser($this->session->userdata('id_user'))->row();

		$this->load->model('Model_upload2');
		if($this->Model_upload2->upload_komen()){
			//$query = $this->db->query('SELECT id_komentar FROM komentar WHERE isi_komentar = "'.$isi_komentar.'" AND id_diskusi = "'.$id_diskusi.'" AND id_user = "'.$id_user.'"');

			$id_komentar = $get_id;

			$filename = $this->upload->data('file_name');
			$jenis_file = $this->upload->data('is_image');
			// $this->db->query('UPDATE komentar SET lampiran = "'.$filename.'", is_image = '.$jenis_file.' WHERE id_komentar = "'.$id_komentar.'"');		
			
			$file = array(
				'lampiran' => $filename,
				'is_image' => $jenis_file 
				);

			$this->db->set($file);
			$this->db->where('id_komentar', $id_komentar);
			$this->db->update('komentar');


			if($jenis_file == 0){
			$tag = '<li class="list-group-item">
					<p>Lampiran : <a href="'.base_url('Main/download_lampiran/'.$get_id).'">'.$filename.'</a></p>
					</li>';
			}else{
			$tag = '<li class="list-group-item">
					<img src="'.base_url('assets/file_komen/').$filename.'" style="width: 280px; height: 280px;">
					</li>';
			}
		}

		$response_saya = '<ul class="list-group">
						<li class="list-group-item">
							<div class="row">
							<div id="output"> </div>
								<div class="col-sm-1">
									<img src="'.base_url('./assets/profile/'.$get_user->foto).'" class="img-circle" style="width: 70px; height: 70px;">
								</div>
								<div class="col-sm-11">
										<div style="float: right;">
											<a href="'.base_url()."Main/hapus_komen/".$data['id_diskusi']."/".$get_id.'">Hapus</a>
										</div>
									<a href="'.base_url().'Main/profil_other/'.$data['id_user'].'"><h4>'.$get_user->nama.'</h4></a>
									<p>'.$data['isi_komentar'].'</p>
								</div>
							</div>
						</li>
						'.$tag.'
						<div style="float: right;">
							'.date('Y-m-d H:i:s').'
						</div>
					</ul><br>'; 

		$response_user = '<ul class="list-group">
						<li class="list-group-item">
							<div class="row">
							<div id="output"> </div>
								<div class="col-sm-1">
									<img src="'.base_url('./assets/profile/'.$get_user->foto).'" class="img-circle" style="width: 70px; height: 70px;">
								</div>
								<div class="col-sm-11">
									<div style="float: right;">
									<a href="'.base_url()."Main/report_komen/".$data['id_diskusi']."/".$get_id.'">Report</a>
									</div>
									<a href="'.base_url().'Main/profil_other/'.$data['id_user'].'"><h4>'.$get_user->nama.'</h4></a>
									<p>'.$data['isi_komentar'].'</p>
								</div>
							</div>
						</li>
						'.$tag.'
						<div style="float: right;">
							'.date('Y-m-d H:i:s').'
						</div>
					</ul><br>'; 

		$response_array = array(
			'id_diskusi' => md5($data['id_diskusi']*99),
			'id_user' => $data['id_user'], 
			'response_saya' => $response_saya,
			'response_user' => $response_user);
		echo json_encode($response_array);
	}

	public function hapus_komen(){
		$id_diskusi = $this->uri->segment('3');
		$id_komentar = $this->uri->segment('4');
		$this->M_main->delete_komen($id_komentar);
		// $data['komen'] = $this->M_main->getKomen($id_diskusi);
		// echo "<h3>Komentar</h3>";
		// foreach($data['komen']->result() as $k){
		// 	echo "<ul class='list-group'>";
		// 	echo "<li class='list-group-item'>";
		// 	echo "<div class='row'>";
		// 	echo "<div class='col-sm-1'>";
		// 	echo "<img src='".base_url('./assets/profile/'.$k->foto)."' class='img-circle' style='width: 70px; height: 70px;'>";
		// 	echo "</div>";
		// 	echo "<div class='col-sm-11'>";
		// 	$id_now = $this->session->userdata('id_user');
		// 	$id_komen = $k->id_user; 
		// 	if($id_komen == $id_now){
		// 		echo "<div style='float: right;'>";
		// 		// echo "<a href='".base_url()."Main/hapus_komen/".$k->id_diskusi."/".$k->id_komentar."' id='hapus'>Hapus</a>";
		// 		echo "<a href='#' id='hapus'>Hapus</a>";
		// 		echo "</div>";
		// 	}
		// 	echo "<a href='".base_url()."Main/profil_other/".$k->id_user."'><h4>".$k->nama."</h4></a>";
		// 	echo "<p>".$k->isi_komentar."</p>";
		// 	echo "</div>";
		// 	echo "</div>";
		// 	echo "</li>";
		// 	if($k->is_image == '0'){
		// 		echo "<li class='list-group-item'>";
		// 		echo "<p>Lampiran : <a href=".base_url('Main/download_lampiran/'.$k->id_komentar).">".$k->lampiran."</a></p>";
		// 		echo "</li>";
		// 	}elseif($k->is_image == '1'){
		// 		echo "<li class='list-group-item'>";
		// 		echo "<img src=".base_url('assets/file_komen/') .$k->lampiran." style='width: 280px; height: 280px;'>";
		// 		echo "</li>";
		// 	}
		// 	echo "<div style='float: right;'>";
		// 	echo $k->tgl_komentar;
		// 	echo "</div>";
		// 	echo "</ul><br>";
		// }
		redirect(base_url() . 'Main/diskusi/' . $id_diskusi);
	}

	public function diskusiku(){
		// $id_user = $this->session->userdata('id_user');
		$id_user = $this->uri->segment('3');
		$data['diskusi'] = $this->M_main->diskusiku($id_user);
		$this->load->view('diskusiku', $data);
	}

	public function hapus_diskusi(){
		$id_user = $this->uri->segment('3');
		$id_diskusi = $this->uri->segment('4');
		$this->M_main->delete_diskusi($id_diskusi);
		redirect(base_url() . 'Main/diskusiku/'.$id_user);
	}

	public function profil_other(){
		$id = $this->uri->segment('3');
		$data['diskusi'] = $this->M_main->ambil_jml_diskusi($id);
		$data['data_user'] = $this->M_main->ambil_data_user($id);
		$data['komen'] = $this->M_main->ambil_jml_komen($id);
		$data['data_mhs'] = $this->M_main->ambil_data($id);
		$data['data_dsn'] = $this->M_main->ambil_data_dsn($id);
		$this->load->view('profile',$data);
	}

	public function ganti_foto(){
		$this->load->model('Model_upload2');
		$this->Model_upload2->do_upload();
		redirect(base_url(). 'Main/profile');
	}

	public function download(){
		$id_file = $this->uri->segment('3');
		$this->load->helper('download');

		$file = $this->M_main->fileinfo($id_file);

		$path = './assets/files/'.$file->row()->nama_file;

		force_download($path, NULL);
	}

	public function download_lampiran(){
		$id_komentar = $this->uri->segment('3');
		$this->load->helper('download');

		$file = $this->M_main->info_lampiran($id_komentar);

		$path = './assets/file_komen/'.$file->row()->lampiran;

		force_download($path, NULL);
	}

	public function all_diskusi(){
		// $data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user ORDER BY d.tgl_post DESC");
		$data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user union SELECT m.nama, d.* FROM dsn m, diskusi d WHERE m.id_user = d.id_user ORDER BY tgl_post DESC;");
		$this->load->view('all_diskusi', $data);
	}

	public function urutan(){
		$urut = $this->input->post('urut');
		if($urut == 'terbaru'){
			redirect(base_url() . 'Main/all_diskusi');
		}elseif($urut == 'paling lama'){
			// $data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user ORDER BY d.tgl_post ASC");
			$data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user union SELECT m.nama, d.* FROM dsn m, diskusi d WHERE m.id_user = d.id_user ORDER BY tgl_post ASC;");
		$this->load->view('all_diskusi', $data);
		}
	}

	public function komen(){
		$data['komen'] = $this->M_main->getKomen($id_diskusi);
		// $this->load->view('komen');
	}

	//digunakan unutk mengganti username dan password
	public function ganti_userpass(){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('pass')
			);
		$id_user = $this->input->post('id_user');

		$this->M_main->update_userpass($data,$id_user);
		$this->session->set_flashdata('notif', 'Password Berhasil Diubah');
		redirect(base_url(). 'Main/profile');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url(). 'Login');
	}

	public function cari(){
		$keyword = $this->input->get('cari',TRUE);
		$data['diskusi'] = $this->M_main->cari($keyword);
		$this->session->set_flashdata('notif', '<h4>HASIL PENCARIAN <strong>"'.$keyword.'"</strong></h4>');
		$this->load->view('all_diskusi',$data);
	}

	public function load_komen(){
		$hitungkomenbaru = $_POST['hitungkomenbaru'];
		$sql = $this->db->query('SELECT * FROM komentar LIMIT $hitungkomenbaru');
		if($sql->num_rows() > 0){
			// while($row = mysqli_fetch_assoc($result)){
			// 	echo "<p>";
			// 	echo $row['author'];
			// 	echo "<br>";
			// 	echo $row['message'];
			// 	echo "<p>";
			// }
			foreach($sql->result() as $r){
				echo $r->nama;
			}
		}else{
			echo "Tidak Ada Komen";
		}
	}

	public function bukariki(){
		$this->load->view('testing');
	}

	public function testing(){
		$sql = $this->db->query('SELECT * FROM mhs WHERE id_mhs=1');
		$r = $sql->row();
		echo $r->nama;
	}

	public function komentest(){
		$id_diskusi = $this->uri->segment('3');
		$data['komen'] = $this->M_main->getKomen($id_diskusi);
		echo "<h3>Komentar</h3>";
		foreach($data['komen']->result() as $k){
			echo "<ul class='list-group'>";
			echo "<li class='list-group-item'>";
			echo "<div class='row'>";
			echo "<div class='col-sm-1'>";
			echo "<img src='".base_url('./assets/profile/'.$k->foto)."' class='img-circle' style='width: 70px; height: 70px;'>";
			echo "</div>";
			echo "<div class='col-sm-11'>";
			$id_now = $this->session->userdata('id_user');
			$id_komen = $k->id_user; 
			if($id_komen == $id_now){
				echo "<div style='float: right;'>";
				echo "<a href='".base_url()."Main/hapus_komen/".$k->id_diskusi."/".$k->id_komentar."' id='hapus'>Hapus</a>";
				echo "</div>";
			}else{
				echo "<div style='float: right;'>";
				echo "<a href='".base_url()."Main/report_komen/".$k->id_diskusi."/".$k->id_komentar."' id='report'>Report</a>";
				echo "</div>";
			}
			echo "<a href='".base_url()."Main/profil_other/".$k->id_user."'><h4>".$k->nama."</h4></a>";
			echo "<p>".$k->isi_komentar."</p>";
			echo "</div>";
			echo "</div>";
			echo "</li>";
			if($k->is_image == '0'){
				echo "<li class='list-group-item'>";
				echo "<p>Lampiran : <a href=".base_url('Main/download_lampiran/'.$k->id_komentar).">".$k->lampiran."</a></p>";
				echo "</li>";
			}elseif($k->is_image == '1'){
				echo "<li class='list-group-item'>";
				echo "<img src=".base_url('assets/file_komen/') .$k->lampiran." style='width: 280px; height: 280px;'>";
				echo "</li>";
			}
			echo "<div style='float: right;'>";
			echo $k->tgl_komentar;
			echo "</div>";
			echo "</ul><br>";
		}
		
	}

	public function ganti_email(){
		$data = array(
			'email' => $this->input->post('email')
			);
		$id_user = $this->input->post('id_user');
		$mhs = $this->db->query('SELECT * FROM mhs WHERE id_user = '.$id_user.'');
		if($mhs->num_rows() > 0){
			$this->db->set($data);
			$this->db->where('id_user', $id_user);
			$this->db->update('mhs');
			redirect(base_url().'Main/profile');
		}else{
			$this->db->set($data);
			$this->db->where('id_user', $id_user);
			$this->db->update('dsn');
			redirect(base_url().'Main/profile');
		}
	}

	// public function notif_count(){
	// 	$id_user = $this->session->userdata('id_user');
	// 	$cek = $this->db->query('SELECT * FROM notifikasi WHERE id_user = '.$id_user.' AND status=0');
	// 	$unRead = $cek->num_rows();
	// 	echo $unRead;
	// }

	public function notif_cek(){
		$id_user = $this->session->userdata('id_user');
		$cek = $this->db->query('SELECT * FROM notifikasi WHERE id_user = '.$id_user.' AND status=0');
		$unRead = $cek->num_rows();
		echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notification<span class="label label-pill label-danger" id="count">'.$unRead.'</span></a>';
		echo '<ul class="dropdown-menu list-group">';

		foreach($cek->result() as $c){
			$sql = $this->db->query('SELECT u.nama, u.foto, u.id_user, d.judul, d.id_diskusi, n.id_notifikasi, k.tgl_komentar, k.id_komentar, k.isi_komentar FROM mhs u, diskusi d, komentar k, notifikasi n WHERE k.id_komentar ='.$c->id_komentar.' AND u.id_user = k.id_user AND d.id_diskusi = k.id_diskusi union SELECT u.nama, u.foto, u.id_user, d.judul, d.id_diskusi, n.id_notifikasi, k.tgl_komentar, k.id_komentar, k.isi_komentar FROM dsn u, diskusi d, komentar k, notifikasi n WHERE k.id_komentar ='.$c->id_komentar.' AND u.id_user = k.id_user AND d.id_diskusi = k.id_diskusi');
			$notif = $sql->row();
			echo '<li class="list-group-item" style="padding-bottom: 30px;"><a href="'.base_url('Main/bukaNotif/'.$c->id_notifikasi.'/'.$notif->id_diskusi).'">'.$notif->nama.' Mengomentari Diskusi '.$notif->judul.'</a> <p style="float: Right;"><b>'.$notif->tgl_komentar.'</b></p></li>';
		}
		if($unRead == 0){
			echo '<li class="list-group-item">Tidak Ada Notifikasi</li>';
		}
		echo '</ul>';
	}

	public function bukaNotif(){
		$id_notifikasi = $this->uri->segment('3');
		$id_diskusi = $this->uri->segment('4');
		$data = array(
			'status' => 1
			);
		$this->db->set($data);
		$this->db->where('id_notifikasi', $id_notifikasi);
		$this->db->update('notifikasi');

		redirect(base_url().'Main/diskusi/'.$id_diskusi);

	}

	public function report_diskusi(){
		$id_diskusi = $this->uri->segment('3');
		$id_user = $this->session->userdata('id_user');
		if($this->M_main->cekReportD($id_diskusi, $id_user) == 0){
			$data = array(
				'id_diskusi' => $id_diskusi,
				'id_user' => $id_user
				);
			$this->db->insert('reportDiskusi', $data);	
			redirect(base_url(). 'Main/diskusi/'.$id_diskusi);
		}else{
			echo "<script>
			alert('Anda sudah pernah mereport diskusi ini');
			window.location.href='".base_url('Main/Diskusi/'.$id_diskusi)."';
			</script>";
		}
	}

	public function report_komen(){
		$id_diskusi = $this->uri->segment('3');
		$id_komentar = $this->uri->segment('4');
		$id_user = $this->session->userdata('id_user');
		if($this->M_main->cekReportK($id_komentar, $id_user) == 0){
			$data = array(
				'id_komentar' => $id_komentar,
				'id_user' => $id_user
				);
			$this->db->insert('reportKomentar', $data);	
			redirect(base_url(). 'Main/diskusi/'.$id_diskusi.'/'.$id_komentar);
		}else{
			echo "<script>
			alert('Anda sudah pernah mereport komentar ini');
			window.location.href='".base_url('Main/Diskusi/'.$id_diskusi).'/'.$id_komentar."';
			</script>";
		}		
	}

}