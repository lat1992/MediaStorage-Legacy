<table class="upload_list">
	<tr>
		<th><?= FILENAME ?></th>
		<th><?= RIGHT_DOWNLOAD ?></th>
		<th><?= RIGHT_PREVIEW ?></th>
	</tr>

<?php
	if (isset($_POST['media_file_mediastorage'])) {
		foreach ($_POST['media_file_mediastorage'] as $key => $media_file) {
?>
			<tr>
				<td><?= $media_file['name'] ?></td>
				<td><?= (intval($media_file['right_download']) == 1) ? YES : NO ?></td>
				<td><?= (intval($media_file['right_preview']) == 1) ? YES : NO ?></td>
			</tr>
<?php
		}
	}
	else {
?>
			<tr>
				<td colspan="3" class="text-center"><?= NO_DATA_AVAILABLE ?></td>
			</tr>
<?php
	}
?>

</table>