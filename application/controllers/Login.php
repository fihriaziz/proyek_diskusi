<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('login3');
	}

	function validasi(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('M_login');
			if($this->M_login->cek_login($username, $password)){
				// $this->db->where('username', $username);
				// $this->db->where('password', $password);
				// $query = $this->db->get('user');
				$query = $this->db->query('SELECT u.*, m.* FROM user u, mhs m WHERE u.username = "'.$username.'" AND u.password = "'.$password.'" AND m.id_user = u.id_user');

				if($query->num_rows() > 0){
				    $row = $query->row();
				    $data = array(
				        'id_user' 		=> $row->id_user,
				        'id_mhs' => $row->id_mhs,
				        'nama' => $row->nama,
				        'status' =>'mhs'
				        );
				}else{
					$query = $this->db->query('SELECT u.*, d.* FROM user u, dsn d WHERE u.username = "'.$username.'" AND u.password = "'.$password.'" AND d.id_user = u.id_user');
					if($query->num_rows() > 0){
				    $row = $query->row();
				    $data = array(
				        'id_user' 		=> $row->id_user,
				        'id_dsn' => $row->id_dosen,
				        'nama' => $row->nama,
				        'status' => 'dsn'
				        );
				}
				}
				$this->session->set_userdata($data);
				redirect(base_url() . 'Main');
			}else{	
				$this->session->set_flashdata('error', 'invalid Username and Password');
				redirect(base_url() . 'Login');
			}
		}else{
			$this->load->view('login3');
		}
	}
}
