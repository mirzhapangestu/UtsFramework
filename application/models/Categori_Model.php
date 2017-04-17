<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Categori_Model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataKategori()
		{
			$this->db->select("id,nama");
			$query = $this->db->get('kategori');
			return $query->result();
		}
		public function getDataBarang()
		{
			$this->db->select("id,namaBarang");
			$query = $this->db->get('barang');
			return $query->result();
		}

		public function getBarangByKategori($id)
		{
			$this->db->select("kategori.nama as nama, namaBarang,kode,DATE_FORMAT(tanggal_beli,'%d-%m-%Y') as tanggal_beli,foto,fk_kategori");
			$this->db->where('fk_kategori', $id);	
			$this->db->join('kategori', 'kategori.id  = barang.fk_kategori', 'left');	
			$query = $this->db->get('barang'); 
			return $query->result(); 
		}           
                                    
		public function insertKategori()
		{
			$object = array(
				'nama' => $this->input->post('nama'),
				);
			$this->db->insert('kategori',$object); 
		}

			public function insertBarang($id)
		{
			$object = array(
				'namaBarang' =>$this->input->post('namaBarang') ,
				'kode' =>$this->input->post('kode') ,
				'tanggal_beli' =>$this->input->post('tanggal_beli') ,
				'foto' => $this->upload->data('file_name') ,
				'fk_kategori' => $id 
				);
			$this->db->insert('barang',$object); 
		}

		public function getKategori($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('kategori',1);
			return $query->result();

		}

			public function getBarang($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('barang',1);
			return $query->result();

		}
		public function updateById($id)
		{
			$data = array(
				'nama' => $this->input->post('nama'),
				 );
			$this->db->where('id', $id);
			$this->db->update('kategori', $data);
		}

		public function updateByIdBarang($id)
		{
			$data = array(
				'nama' => $this->input->post('nama'),
				 );
			$this->db->where('id', $id);
			$this->db->update('kategori', $data);
		}

		public function deleteById($id) 
		{
			$this->db->where('id',$id);
			$this->db->delete('kategori');
		}

		public function deleteByIdBarang($id) 
		{
			$this->db->where('id',$id);
			$this->db->delete('kategori');
		}


}
	

/* End of file Categori_Model.php */
/* Location: ./application/models/Categori_Model.php */
?>