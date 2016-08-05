<?php 

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<!-- @DELETE -->

<style>
	table, td, tr {
		border: 1px solid black;
	}
</style>

<!--  -->

<span><?= MEDIA_LIST_TITLE ?></span>

<div>

<?php

	if ($media) {
?>
		<table>
			<tr>
				<th>ID</th>
				<th>ID Parent</th>
				<th>Type</th>
				<th>ID organization</th>
			</tr>
<?php
			$saved_media = 0;
			while ($media = $media['data']->fetch_assoc()) {

				if ($saved_media != $media['id']) {
					$saved_media = $media['id'];

					echo '<tr>' .
						'<th>' . $media['media'] . '</th>' .
						'<th></th>' .
						'<th></th>' .
						'<th></th>' .
						'<th></th>' .
						'<th><a href="?page=edit_media&media_id=' . $media['id'] . '">Edit</a></th>' .
						'<th><a href="?page=delete_media&media_id=' . $media['id'] . '">Delete</a></th>' .
						'</tr>';
				}
?>
				<tr>
<?php
					echo '<td>' . $media['id'] . '</td>';
					echo '<td>' . $media['id_parent'] . '</td>';
					echo '<td>' . $media['type'] . '</td>';
					echo '<td>' . $media['id_organization'] . '</td>';
					echo '<td><a href="?page=edit_media_info&media_info_id=' . $media['id_media_info'] . '">Edit</a></td>';
					echo '<td><a href="?page=delete_media_info&media_info_id=' . $media['id_media_info'] . '">Delete</a></td>';
?>
				</tr>
<?php
			}
?>
		</table>
<?php
	}
	else {
		echo MEDIAS_NOT_FOUND;
	}

?>

</div>

<?php 

require_once('CoreBundle/views/layout/footer.php');

?>
