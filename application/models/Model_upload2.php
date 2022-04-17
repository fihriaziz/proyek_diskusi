<?php 

class Model_upload2 extends CI_Model
{
	function do_upload(){
		$id = $this->session->userdata('id_user');
		$nama = $this->session->userdata('nama');
        $status = $this->session->userdata('status');
		$namafile = "foto_".$nama.".jpg";

		$config['upload_path']          = './assets/profile/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 262144;
        $config['file_name']			= $namafile;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $this->session->set_flashdata('error', 'format file tidak sesuai..');
			redirect(base_url().'Main/profile');
        }
        else
        {
        	$filename = $this->upload->data('file_name');
            if($status == 'mhs'){
                $this->db->query("UPDATE mhs SET foto = '".$filename."' WHERE id_user = '".$id."'");    
            }else if($status == 'dsn'){
                $this->db->query("UPDATE dsn SET foto = '".$filename."' WHERE id_user = '".$id."'");
            }
        }
	}

    function upload_file(){

        $config['upload_path']          = './assets/files/';
        $config['allowed_types']        = '*';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $this->session->set_flashdata('error', 'tidak melampirkan file atau ukuran file terlalu besar..');
            return false;
        }
        else
        {
            // $filename = $this->upload->data('file_name');
            // $this->db->query("UPDATE mhs SET foto = '".$filename."' WHERE id_user = '".$id."'");
            return true;
        }
    }

    function upload_komen(){
        $config['upload_path'] = './assets/file_komen/';
        $config['allowed_types'] = '*';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file_komen'))
        {
            return false;
        }
        else
        {
            // $filename = $this->upload->data('file_name');
            // $this->db->query("UPDATE mhs SET foto = '".$filename."' WHERE id_user = '".$id."'");
            return true;
        }
    }
}

?>