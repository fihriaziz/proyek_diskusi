<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_admin');
	}

	public function index()
	{
		$this->load->view('Admin/login_admin');
	}

	public function validasi(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('M_loginAdmin');
			if($this->M_loginAdmin->cek_login($username, $password)){
				// $this->db->where('username', $username);
				// $this->db->where('password', $password);
				// $query = $this->db->get('user');
				$query = $this->db->query('SELECT * FROM admin WHERE username = "'.$username.'" AND password = "'.$password.'"');

				if($query->num_rows() > 0){
				    $row = $query->row();
				    $data = array(
				        'id_admin' 		=> $row->id_admin,
				        'nama' => $row->nama
				        );
				}
				$this->session->set_userdata($data);
				redirect(base_url() . 'Admin/Main');
			}else{	
				$this->session->set_flashdata('error', 'invalid Username and Password');
				redirect(base_url() . 'Admin');
			}
		}else{
			$this->load->view('login_admin');
		}
	}

	public function Main(){
		$data['admin'] = $this->db->get('admin');
		$this->load->view('Admin/dashboard', $data);
	}

	public function form_edit_profile(){
		$id_admin = $this->uri->segment('3');
		$this->db->where('id_admin', $id_admin);
		$query = $this->db->get('admin');
		$data['admin'] = $query->result();
		$this->load->view('Admin/ubah_profile', $data);
	}

	public function edit_profile(){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'no_tlp' => $this->input->post('no_tlp')
			);
		$id_admin = $this->input->post('id_admin');

		$this->M_admin->update_profile_admin($data, $id_admin);
		redirect(base_url() . 'Admin/Main');
	}

	public function user(){
		$wh = $this->uri->segment('3');
		if($wh == 1){
			$data['mhs'] = $this->db->get('mhs');
			$this->load->view('Admin/user_view', $data);	
		}else if($wh == 2){
			$data['dsn'] = $this->db->get('dsn');
			$this->load->view('Admin/dsn_view', $data);
		}
	}

	public function input_dsn_view(){
		$this->load->view('Admin/input_dsn');
	}

	public function input_dsn(){
		$user = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
		$username = $user['username'];
		$password = $user['password'];
		if($this->M_admin->cek_user($username,$password)){
			$this->M_admin->add_user($user);
			
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$query = $this->db->get('user');
			if($query->num_rows() > 0){
			    $row = $query->row();
			    $dsn = array(
			    	'id_user' => $row->id_user,
					'nip' => $this->input->post('nip'),
					'nama' => $this->input->post('nama'),
					'jk' => $this->input->post('jk'),
					'status' => $this->input->post('status'),
					'email' => $this->input->post('email'),
					'alamat' => $this->input->post('alamat')
					);
			    $this->M_admin->add_dosen($dsn);
			    $this->session->set_flashdata('info', 'Insert Berhasil Dilakukan');
			    redirect(base_url() . 'Admin/user/2');
			}else{
				$this->session->set_flashdata('error', 'Insert Gagal Dilakukan');
			    redirect(base_url() . 'Admin/user/2');
			}
		}else{
			$this->session->set_flashdata('error', 'Insert Gagal Dilakukan, User Ini Sudah Terdaftar');
			redirect(base_url() . 'Admin/user/2');
		}
	}

	public function update_dsn(){
		$id_user = $this->uri->segment('3');
		$id_dosen = $this->uri->segment('4');
		$data['dsn'] = $this->M_admin->ambil_dsn($id_dosen);
		$data['user'] = $this->M_admin->ambil_user($id_user);
		$this->load->view('Admin/update_dsn', $data);
	}

	public function update_dsn2(){
		$id_user = $this->input->post('id_user');
		$user = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
		if($this->M_admin->update_user($id_user, $user)){
			$id_dosen = $this->input->post('id_dosen');
			$dsn = array(
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'jk' => $this->input->post('jk'),
				'status' => $this->input->post('status'),
				'email' => $this->input->post('email'),
				'alamat' => $this->input->post('alamat')
				);
			$this->M_admin->update_dsn($id_dosen, $dsn);
			$this->session->set_flashdata('info', 'Update Berhasil Dilakukan');
			redirect(base_url() . 'Admin/user/2');
		}else{
			$this->session->set_flashdata('error', 'Update Gagal Dilakukan');
		    redirect(base_url() . 'Admin/user/2');
		}
	}

	public function delete_dsn(){
		$id_dosen = $this->uri->segment('4');
		if($this->M_admin->delete_dsn($id_dosen)){
			$id_user = $this->uri->segment('3');
			$this->M_admin->delete_user($id_user);
			$this->session->set_flashdata('info', 'Delete Berhasil Dilakukan');
			redirect(base_url() . 'Admin/user/2');
		}else{
			$this->session->set_flashdata('error', 'Delete Gagal Dilakukan');
			redirect(base_url() . 'Admin/user/2');
		}
	}

	public function input_mhs_view(){
		$this->load->view('Admin/input_mhs');
	}

	public function input_mhs(){
		$user = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
		$username = $user['username'];
		$password = $user['password'];
		if($this->M_admin->cek_user($username,$password)){
			$this->M_admin->add_user($user);
			
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$query = $this->db->get('user');
			if($query->num_rows() > 0){
			    $row = $query->row();
			    $mhs = array(
			    	'id_user' => $row->id_user,
					'nim' => $this->input->post('nim'),
					'nama' => $this->input->post('nama'),
					'jk' => $this->input->post('jk'),
					'status' => $this->input->post('status'),
					'prodi' => $this->input->post('prodi'),
					'semester' => $this->input->post('semester'),
					'email' => $this->input->post('email'),
					'alamat' => $this->input->post('alamat')
					);
			    $this->M_admin->add_mhs($mhs);
			    $this->session->set_flashdata('info', 'Insert Berhasil Dilakukan');
			    redirect(base_url() . 'Admin/user/1');
			}else{
				$this->session->set_flashdata('error', 'Insert Gagal Dilakukan');
			    redirect(base_url() . 'Admin/user/1');
			}
		}else{
			$this->session->set_flashdata('error', 'Insert Gagal Dilakukan, User Ini Sudah Terdaftar');
			redirect(base_url() . 'Admin/user/1');
		}
	}

	public function update_mhs(){
		$id_user = $this->uri->segment('3');
		$id_mhs = $this->uri->segment('4');
		$data['mhs'] = $this->M_admin->ambil_mhs($id_mhs);
		$data['user'] = $this->M_admin->ambil_user($id_user);
		$this->load->view('Admin/update_mhs', $data);
	}

	public function update_mhs2(){
		$id_user = $this->input->post('id_user');
		$user = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
		if($this->M_admin->update_user($id_user, $user)){
			$id_mhs = $this->input->post('id_mhs');
			$mhs = array(
				'nim' => $this->input->post('nim'),
				'nama' => $this->input->post('nama'),
				'jk' => $this->input->post('jk'),
				'status' => $this->input->post('status'),
				'prodi' => $this->input->post('prodi'),
				'semester' => $this->input->post('semester'),
				'email' => $this->input->post('email'),
				'alamat' => $this->input->post('alamat')
				);
			$this->M_admin->update_mhs($id_mhs, $mhs);
			$this->session->set_flashdata('info', 'Update Berhasil Dilakukan');
			redirect(base_url() . 'Admin/user/1');
		}else{
			$this->session->set_flashdata('error', 'Update Gagal Dilakukan');
		    redirect(base_url() . 'Admin/user/1');
		}
	}

	public function delete_mhs(){
		$id_mhs = $this->uri->segment('4');
		if($this->M_admin->delete_mhs($id_mhs)){
			$id_user = $this->uri->segment('3');
			$this->M_admin->delete_user($id_user);
			$this->session->set_flashdata('info', 'Delete Berhasil Dilakukan');
			redirect(base_url() . 'Admin/user/1');
		}else{
			$this->session->set_flashdata('error', 'Delete Gagal Dilakukan');
			redirect(base_url() . 'Admin/user/1');
		}
	}

	public function all_diskusi(){
		$data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user ORDER BY d.tgl_post DESC");
		$this->load->view('Admin/all_diskusi',$data);
	}

	public function urutan(){
		$urut = $this->input->post('urut');
		if($urut == 'terbaru'){
			redirect(base_url() . 'Admin/all_diskusi');
		}elseif($urut == 'paling lama'){
			$data['diskusi'] = $this->db->query("SELECT m.nama, d.* FROM mhs m, diskusi d WHERE m.id_user = d.id_user ORDER BY d.tgl_post ASC");
		$this->load->view('Admin/all_diskusi', $data);
		}
	}

	public function diskusi(){
		$id_diskusi = $this->uri->segment('3');
		$data['diskusi'] = $this->M_admin->getDiskusi($id_diskusi);
		if($data['diskusi']->row()->tambahan == "Y"){
			$this->db->where('id_diskusi', $id_diskusi);
			$lampiran = $this->db->get('file');
			$data['lampir'] = $lampiran->result();
		}
		$data['mhs'] = $this->M_admin->getMhs($id_diskusi);
		$data['komen'] = $this->M_admin->getKomen($id_diskusi);
		$this->load->view('Admin/diskusi', $data);
	}

	public function hapus_diskusi(){
		$id_diskusi = $this->uri->segment('3');
		$this->M_admin->delete_diskusi($id_diskusi);
		if($this->M_admin->cekReportD($id_diskusi) > 0){
			$this->db->where('id_diskusi', $id_diskusi);
			$this->db->delete('reportdiskusi');
		}
		$this->session->set_flashdata('info', 'Diskusi Berhasil Dihapus');
		redirect(base_url() . 'Admin/all_diskusi');
	}

	public function hapus_komen(){
		$id_diskusi = $this->uri->segment('3');
		$id_komentar = $this->uri->segment('4');
		$this->M_admin->delete_komen($id_komentar);
		if($this->M_admin->cekReportK($id_komentar) > 0){
			$this->db->where('id_komentar', $id_komentar);
			$this->db->delete('reportKomentar');
		}
		$this->session->set_flashdata('info', 'Komentar Berhasil Dihapus');
		redirect(base_url() . 'Admin/diskusi/' . $id_diskusi);
	}

	public function reportDiskusi_view(){
		$data['reportDiskusi'] = $this->M_admin->reportD();
		$this->load->view('Admin/reportDiskusi_view', $data);
	}

	public function reportKomentar_view(){
		$data['reportKomentar'] = $this->M_admin->reportK();
		$this->load->view('Admin/reportKomentar_view', $data);	
	}
}
