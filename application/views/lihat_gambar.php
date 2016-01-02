	<h1 align="center"><?php echo $gambar;?></h1>

	<div id="body">
	<img src="<?php echo base_url('uploads').'/'.$gambar;?>">
	<br/>
	<?php echo anchor(base_url(),'<button>Kembali</button>');?>
	</div>