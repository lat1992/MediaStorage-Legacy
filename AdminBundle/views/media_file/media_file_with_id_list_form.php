<table class="upload_list">
	<tr>
		<th><?= FILENAME ?></th>
		<th><?= RIGHT_DOWNLOAD ?></th>
		<th><?= RIGHT_PREVIEW ?></th>
	</tr>

<?php
	if (isset($media_files_linked) && $media_files_linked && $media_files_linked['data']) {

		while ($media_file = $media_files_linked['data']->fetch_assoc()) {
?>
			<tr>
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
				<td colspan="3" class="text-center"><?= NO_DATA_AVAILABLE ?></td>
			</tr>
<?php
	}
?>

</table>