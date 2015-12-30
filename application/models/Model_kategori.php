<?php
	class Model_kategori extends CI_Model {
		
		public function getAlldata() {
			$data = $this->db->get("categories");
			return $data->result();
		}
	}
?>