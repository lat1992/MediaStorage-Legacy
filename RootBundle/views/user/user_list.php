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

<span><?= USER_LIST_TITLE ?></span>

<div>

<?php

	if ($users) {
?>
		<table>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Organization</th>
				<th>Role</th>
				<th>Email</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
<?php
			while ($user = $users['data']->fetch_assoc()) {
?>
				<tr>
<?php
					echo '<td>' . $user['id'] . '</td>';
					echo '<td>' . $user['username'] . '</td>';
					echo '<td>' . $user['organization_name'] . '</td>';
					echo '<td>' . $user['role_role'] . '</td>';
					echo '<td>' . $user['email'] . '</td>';
					echo '<td><a href="?page=edit_user&user_id=' . $user['id'] . '">Edit</a></td>';
					echo '<td><a href="?page=delete_user&user_id=' . $user['id'] . '">Delete</a></td>';
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
