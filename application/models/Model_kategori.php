<?php
	class Model_kategori extends CI_Model {
		
		public function getAlldata() {
			$data = $this->db->get("categories");
			return $data->result_array();
		}
		
		public function getById($id) {
			$this->db->where('CategoryID',$id);
			$data = $this->db->get("categories");
			return $data->result_array();
		}
		
		public function input() {
			$data['CategoryID'] = $this->input->post('id');
			$data['CategoryName'] = $this->input->post('nama');
			$data['Description'] = $this->input->post('des');
			$data['Picture'] = $this->upload->data('file_name');
			
			$this->db->insert('categories',$data);
		}
		
		public function edit($data) {
			$id = $this->input->post('id');
			
			$this->db->where('CategoryID',$id);
			$this->db->update('categories',$data);
		}
		
		public function hapus($id) {
			$this->db->where('CategoryID',$id);
			$this->db->delete('categories');
		}
	}
?>