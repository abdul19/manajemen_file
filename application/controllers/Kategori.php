<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$tabel['tampil'] = $this->tabel();
		$this->load->view('view_kategori',$tabel);
		$this->load->view('footer');
	}
	
	public function tabel() {
		$no = 1;
		$js = 'return confirm("Apakah anda yakin akan menghapus?")';
		$data = $this->kategori->getAlldata();
		$this->table->set_heading('No','Nama Kategori', 'Deskripsi','Gambar','Action');
		foreach($data as $isi):
			$link = "<a href='".base_url()."edit/".$isi['CategoryID']."'><button>Edit</button></a><br>";
			$link .= "<a href='".base_url()."proses/hapus/".$isi['CategoryID']."' ><button onclick='".$js."'>Hapus</button></a>";
			$this->table->add_row($no, $isi['CategoryName'], $isi['Description'], $isi['Picture'], $link);
			$no++;
		endforeach;
		$template = array('table_open' => '<table border="1" id="tabel" cellpadding="4" cellspacing="0">');
		$this->table->set_template($template);
		
		return $this->table->generate();
	}
	
	public function tambah()
	{
		$this->load->view('header');
		$this->load->view('form_tambah');
		$this->load->view('footer');
	}
	
	public function edit($id)
	{
		$data = $this->kategori->getById($id);
		$isi['CategoryID'] = $data[0]['CategoryID'];
		$isi['CategoryName'] = $data[0]['CategoryName'];
		$isi['Description'] = $data[0]['Description'];
		$this->load->view('header');
		$this->load->view('form_edit',$isi);
		$this->load->view('footer');
	}
	
	public function proses($mode) {
		if($mode=='tambah') {
			$this->kategori->input();
			redirect('../');
		}else if($mode=='edit') {
			$this->kategori->edit();
			redirect('../');
		}else if($mode=='hapus') {
			$this->kategori->hapus($this->uri->segment(4));
			redirect('../');
		}
	}
}
