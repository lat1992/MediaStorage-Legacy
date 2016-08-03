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

<span><?= ROLE_LIST_TITLE ?></span>

<div>

<?php

	if ($roles) {
?>
		<table>
			<tr>
				<th>ID</th>
				<th>Role</th>
				<th>Data</th>
				<th>Name</th>
				<th>Code</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
<?php
			$saved_role = 0;
			while ($role = $roles['data']->fetch_assoc()) {

				if ($saved_role != $role['id']) {
					$saved_role = $role['id'];

					echo '<tr>' .
						'<th>' . $role['role'] . '</th>' .
						'<th></th>' .
						'<th></th>' .
						'<th></th>' .
						'<th></th>' .
						'<th><a href="?page=edit_role&role_id=' . $role['id'] . '">Edit</a></th>' .
						'<th><a href="?page=delete_role&role_id=' . $role['id'] . '">Delete</a></th>' .
						'</tr>';
				}
?>
				<tr>
<?php
					echo '<td>' . $role['id'] . '</td>';
					echo '<td>' . $role['role'] . '</td>';
					echo '<td>' . $role['data'] . '</td>';
					echo '<td>' . $role['name'] . '</td>';
					echo '<td>' . $role['code'] . '</td>';
					echo '<td><a href="?page=edit_role_language&role_language_id=' . $role['id_role_language'] . '">Edit</a></td>';
					echo '<td><a href="?page=delete_role_language&role_language_id=' . $role['id_role_language'] . '">Delete</a></td>';
?>
				</tr>
<?php
			}
?>
		</table>
<?php
	}
	else {
		echo USERS_NOT_FOUND;
	}

?>

</div>

<?php 

require_once('CoreBundle/views/layout/footer.php');

?>
