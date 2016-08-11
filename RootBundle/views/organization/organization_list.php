<?php

require_once('RootBundle/views/layout/header.php');

?>

<div id="container">

	<div class="add">
		<a href="?page=create_organization_root"><?= ORGANIZATION_CREATION_TITLE ?></a>
	</div>

	<table cellspacing="0">
		<tr>
			<th><?= REFERENCE ?></th>
			<th><?= NAME ?></th>
			<th><?= GROUP ?></th>
			<th></th>
			<th></th>
		</tr>
<?php

		if (!$organizations['error']) {

			while ($organization = $organizations['data']->fetch_assoc()) {
?>
			<tr>
				<td><?= $organization['reference'] ?></td>
				<td><?= $organization['organization_name'] ?></td>
				<td><?= $organization['group_name'] ?></td>
				<td class="button_td" ><a href="?page=edit_organization_root&organization_id=<?= $organization['id'] ?>" class="button_a edit"><?= EDIT ?></a></td>
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
