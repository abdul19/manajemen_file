<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$data = $this->kategori->getAlldata();
		$this->table->set_heading('No','Nama Kategori', 'Deskripsi','Gambar');
		$tabel['tampil'] = $this->table->generate($data);
		$this->load->view('view_kategori',$tabel);
		$this->load->view('footer');
	}
}
