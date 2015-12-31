	<h1 align="center">Tambah Kategori</h1>

	<div id="body">
		<form name="tambah" method="post" action="<?php echo base_url();?>proses/tambah">
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
						<td><input type="submit" name="submit" value="Tambah"></td>
					</tr>
				</table>
		</form>
	</div>