<table id="upload_list" class="upload_list">
	<tr>
		<th></th>
		<th><?= FILENAME ?></th>
		<th><?= RIGHT_DOWNLOAD ?></th>
		<th><?= RIGHT_PREVIEW ?></th>
		<th></th>
	</tr>

<?php
	// if (isset($media_files) && $media_files && $media_files['data'] && $media_files['data']->num_rows != 0) {
	if (count($media_files)) {

		// while ($media_file = $media_files['data']->fetch_assoc()) {
		foreach($media_files as $key => $media_file) {
?>
<?php /*
			<tr>
				<td><input type="checkbox" name="media_file_mediastorage[<?= $media_file['id'] ?>] value="1" /></td>
				<td><?= $media_file['filename'] ?></td>
				<td><?= $media_file['right_download'] ?></td>
				<td><?= $media_file['right_preview'] ?></td>
			</tr>
*/?>
			<tr>
				<td><input type="checkbox" name="media_file_mediastorage[<?= $key ?>][name]" value="<?= $media_file ?>" /></td>
				<td><?= $media_file ?></td>
				<td><input type="hidden" name="media_file_mediastorage[<?= $key ?>][right_download]" checked value="0" /><input type="checkbox" name="media_file_mediastorage[<?= $key ?>][right_download]" checked value="1" /></td>
				<td><input type="hidden" name="media_file_mediastorage[<?= $key ?>][right_preview]" checked value="0" /><input type="checkbox" name="media_file_mediastorage[<?= $key ?>][right_preview]" checked value="1" /></td>
				<td><a href="#"><?= QUALIFY ?></a></td>
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