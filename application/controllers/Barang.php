<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function index($id)
	{
		$this->load->model('categori_model');		
		$data["barang_list"] = $this->categori_model->getBarangByKategori($id);
		$this->load->view('barang', $data);
	}

public function create($id)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('namaBarang','Nama', 'trim|required');
		//$this->form_validation->set_rules('nip', 'nip', 'trim|required|numeric');
		//$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|alpha_numeric');
		$this->load->model('categori_model');	

		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_barang_view');

		}else{
			$config['upload_path']		= './assets/uploads/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 10000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload' , $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' =>$this->upload->display_errors());
				$this->load->view('tambah_barang_view',$error);
			}
			else {
			$this->categori_model->insertBarang($id);
			$this->load->view('tambah_barang_sukses');
			}
		}
	}

	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('namaBarang', 'Nama', 'trim|required|alpha_numeric_spaces');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('categori_model');
		$data['barang']=$this->categori_model->getBarang($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view

			$this->load->view('update_barang_view',$data);

		}else{
			$this->categori_model->updateByIdBarang($id);
			$data["barang_list"] = $this->categori_model->getDataBarang();
			$this->load->view('barang',$data);

		}
	}
		public function delete($id,$id_barang)
 	{ 
 	 	$this->load->model('categori_model');
  		$this->categori_model->deleteByIdBarang($id);
 	 	redirect('barang/index/'.$id_barang);
	 }
}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */

 ?>
