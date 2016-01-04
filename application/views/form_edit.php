	<h1 align="center">Edit Kategori</h1>

	<div id="body">
		<form action="<?php echo site_url('kategori/proses/edit');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<table>
					<input type="hidden" name='id' value="<?php echo $CategoryID; ?>">
					<tr>
						<td><label for="nama">Nama kategori</label></td>
						<td><input type="text" id="input" name="nama" placeholder="" value="<?php echo $CategoryName; ?>"></td>
					</tr>
					<tr>
						<td><label for="des">Deskripsi</label>
						<td><textarea name="des" id="input" placeholder="" ><?php echo $Description; ?></textarea></td>
					</tr>
					<tr>
						<td><label for="nama">Picture</label></td>
						<td><input type="file" id="input" name="file" placeholder="" ></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Edit"></td>
					</tr>
				</table>
		</form>
	</div>