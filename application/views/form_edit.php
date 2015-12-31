	<h1 align="center">Edit Kategori</h1>

	<div id="body">
		<form name="tambah" method="post" action="<?php echo base_url();?>proses/edit">
				<table>
					<input type="hidden" name='id' value="<?php echo $CategoryID; ?>">
					<tr>
						<td><label for="nama">Nama kategori</label></td>
						<td><input type="text" id="input" name="nama" placeholder="" required="required" value="<?php echo $CategoryName; ?>"></td>
					</tr>
					<tr>
						<td><label for="des">Deskripsi</label>
						<td><textarea name="des" id="input" placeholder="" required="required"><?php echo $Description; ?></textarea></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Edit"></td>
					</tr>
				</table>
		</form>
	</div>