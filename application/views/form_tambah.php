	<h1 align="center">Tambah Kategori</h1>

	<div id="body">
		<form action="<?php echo site_url('kategori/proses/tambah');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<table>
					<input type="hidden" name='id' value="">
					<tr>
						<td><label for="nama">Nama kategori</label></td>
						<td><input type="text" id="input" name="nama" placeholder="" required="required"></td>
					</tr>
					<tr>
						<td><label for="des">Deskripsi</label>
						<td><textarea name="des" id="input" placeholder="" required="required"></textarea></td>
					</tr>
					<tr>
						<td><label for="nama">Picture</label></td>
						<td><input type="file" id="input" name="file" placeholder="" required="required"></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Tambah"></td>
					</tr>
				</table>
		</form>
	</div>