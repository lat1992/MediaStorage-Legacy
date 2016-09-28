<table id="upload_list" class="upload_list">
	<tr>
		<th></th>
		<th><?= FILENAME ?></th>
		<th><?= RIGHT_DOWNLOAD ?></th>
		<th><?= RIGHT_PREVIEW ?></th>
	</tr>

<?php
	if (isset($media_files) && $media_files && $media_files['data'] && $media_files_linked['data']->num_rows != 0) {

		while ($media_file = $media_files['data']->fetch_assoc()) {
?>
			<tr>
				<td><input type="checkbox" name="media_file_mediastorage[<?= $media_file['id'] ?>] value="1" /></td>
				<td><?= $media_file['filename'] ?></td>
				<td><?= $media_file['right_download'] ?></td>
				<td><?= $media_file['right_preview'] ?></td>
			</tr>
<?php
		}
	}
	else {
?>
			<tr>
				<td colspan="4" class="text-center"><?= NO_DATA_AVAILABLE ?></td>
			</tr>
<?php
	}
?>

</table>