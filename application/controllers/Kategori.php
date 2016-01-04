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
	
	public function tabel() 
	{
		$no = 1;
		$js = 'return confirm("Apakah anda yakin akan menghapus?")';
		
		$data = $this->kategori->getAlldata();
		$this->table->set_heading('No','Nama Kategori', 'Deskripsi','Gambar','Action');
		
		foreach($data as $isi):
			$link = anchor(site_url('kategori/edit')."/".$isi['CategoryID'],"<button>Edit</button></a><br/>");
			$link .= anchor(site_url('kategori/proses/hapus')."/".$isi['CategoryID'],"<button onclick='".$js."'>Hapus</button></a>");
			
			if($isi['Picture']) {
				$thumb = str_replace(".","_thumb.",$isi['Picture']);
				$picture = "<a href='".site_url('kategori/gambar')."/".$isi['Picture']."'>";
				$picture .= "<img src='".base_url('uploads')."/".$thumb."' >";
				$picture .= "</a>";
			} else {
				$picture = "No Picture";
			}
			
			$this->table->add_row($no, $isi['CategoryName'], $isi['Description'], $picture, $link);
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
	
	public function proses($mode) 
	{
		if($mode=='tambah') {
			//proses tambah data ke database
			
			$this->upload();
			if(!$this->upload->do_upload('file')){
				//jika gagal upload
				echo $this->upload->display_errors();
				echo anchor(site_url("kategori/tambah"),'Kembali');
			} else {
				//jika berhasil upload
				$gambar = $this->upload->data('file_name');
				$error = $this->watermark($gambar);
				$error .= $this->resize($gambar);
				
				if(!$error) {
					//jika berhasil resize n watermark
					$this->kategori->input();
					redirect(base_url());
				} else {
					//jika gagal resize n watermark
					echo $error;
					echo anchor(site_url("kategori/tambah"),'kembali');
				}
			}
		}else if($mode=='edit') {
			//proses edit data pada database
			
			$this->upload();
			if($this->upload->do_upload('file')) {
				// jika upload gambar
				$gambar = $this->upload->data('file_name');
				$error = $this->watermark($gambar);
				$error .= $this->resize($gambar);
				if(!$error) {
					//jika berhasil resize n watermark
					$data['Picture'] = $gambar;
				} else {
					//jika gagal resize n watermark
					echo $error;
					echo anchor(site_url("kategori/tambah"),'kembali');
				}
			}
			
			$data['CategoryName'] = $this->input->post('nama');
			$data['Description'] = $this->input->post('des');
			
			$this->kategori->edit($data);
			redirect(base_url());
		}else if($mode=='hapus') {
			//proses edit data pada database
			$this->kategori->hapus($this->uri->segment(4));
			redirect(base_url());
		}
	}
	
	public function upload()
	{
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
		$this->upload->initialize($config);
	}
	
	public function gambar($picture)
	{
		$gambar['gambar'] = $picture;
		$this->load->view('header');
		$this->load->view('lihat_gambar',$gambar);
		$this->load->view('footer');
	}
	
	public function resize($gambar)
	{
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$gambar;
		$config['new_image'] = './uploads';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 100;
		$config['height'] = 100;
		
		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize())
		{
			return 'Gagal resize gambar<br/>'.$this->image_lib->display_errors();
		}
	}
	
	public function watermark($gambar)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$gambar;
		$config['new_image'] = './uploads';
		$config['wm_text'] = '12131282';
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './system/fonts/texb.ttf';
		$config['wm_font_size'] = '20';
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '20';

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark())
		{
			return 'Gagal watermark gambar<br/>'.$this->image_lib->display_errors();
		}
	}
}
