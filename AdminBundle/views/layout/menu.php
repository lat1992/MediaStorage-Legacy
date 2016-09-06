<div off-canvas="slidebar-2 right reveal">
	<ul>

		<li class="admin_information"><?= ADMIN_INFORMATION ?></li>
<?php
		if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
			<li><a href="?page=dashboard_admin"><?= DASHBOARD ?></a></li>
			<li><a href="?page=list_folder_admin"><?= FOLDER ?></a></li>
<?php
		}

		if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
			<li><a href="?page=list_program_admin"><?= PROGRAM ?></a></li>
			<li><a href="?page=list_content_admin"><?= CONTENT ?></a></li>
<?php
		}

		if (isset($_SESSION['permits'][PERMIT_ROOT])) {
?>
			<li><br/></li>
			<li><a class="root_button" href="?page=dashboard_root"><?= ROOT ?></a></li>
<?php
		}
?>

 	</ul>
</div>