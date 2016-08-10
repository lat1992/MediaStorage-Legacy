<?php

require_once('RootBundle/views/layout/header.php');

?>

<!-- <link rel="stylesheet" href="RootBundle/ressources/folder/css/folder.css">

<script src="RootBundle/ressources/folder/js/folder.js"></script> -->

<div id="container">

	<div class="add">
		<a href="?page=create_group_root"><?= GROUP_CREATION_TITLE ?></a>
	</div>

	<table cellspacing="0">
		<tr>
			<th><?= REFERENCE ?></th>
			<th><?= NAME ?></th>
			<th><?= FILESERVER ?></th>
			<th><?= NB_ORGANIZATION ?></th>
			<th></th>
			<th></th>
		</tr>
<?php

		if (!$groups['error']) {

			while ($group = $groups['data']->fetch_assoc()) {
?>
			<tr>
				<td><?= $group['reference'] ?></td>
				<td><?= $group['name'] ?></td>
				<td><?= $group['fileserver'] ?></td>
				<td><?= $group['organization_count'] ?></td>
				<td class="button_td" ><a href="#" class="button_a edit"><?= EDIT ?></a></td>
				<td class="button_td" ><a href="#" class="button_a delete"><?= DELETE ?></a></td>
			</tr>
<?php
			}

		}

?>
	</table>

</div>

<?php

require_once('RootBundle/views/layout/footer.php');

?>
