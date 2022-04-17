<?php 

class Model_upload extends CI_Model
{
	var $gallery_path;

	function __construct(){
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../assets/profile');
	}

	function do_upload(){
		$id = $this->session->userdata('id_user');
		$filename=$id .'.jpg';
		$config = array(
			'allowed_types' => 'jpg|jpeg|png',
			'upload_path' => $this->gallery_path,
			'file_name' => $filename
			);

		$path = './assets/profile/'.$filename;
		$path2 = './assets/profile/'.$id.'1.jpg';
		// unlink($path);
		
		$this->load->library('upload', $config);
		// $this->upload->do_upload();

		
		// $this->db->query("UPDATE mhs SET foto = '".$filename."' WHERE id_user = '".$id."'");

		if(! $this->upload->do_upload()){
			$this->session->set_flashdata('error', 'format file tidak sesuai..');
			redirect(base_url().'Main/profile');
		}else{
			unlink($path);
			unlink($path2);

			$this->upload->do_upload();
			$this->db->query("UPDATE mhs SET foto = '".$filename."' WHERE id_user = '".$id."'");
		}
	}

	function upload_file(){
		$config = array(
			'allowed_types' => 'jpg|jpeg|png|doc|ppt|pptx|pdf|rar',
			'upload_path' => './assets/files',
			'file_name' => $filename
			);
	}
}

?>