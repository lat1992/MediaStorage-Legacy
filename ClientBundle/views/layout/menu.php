<div off-canvas="slidebar-1 left reveal">
	<ul>
	<?php
		echo '<li><div class= "logo" style="background-image: url(ClientBundle/ressources/organization/'. $_SESSION['id_organization'] .'/img/logo.png); background-size: contain;"><a class="logo_button" href="?page=home"></a></div></li>';
	?>
		<li><a class="logout_button" href="?page=logout"><?= LOGOUT ?></a>
		<a class="profile_button" href="?page=profile"><?= PROFILE ?></a></li>
		<li><a href="?page=search"><?= SEARCH_MENU ?></a></li>
		<li><a href="?page=folder"><?= FOLDER_MENU ?></a></li>
		<li><a href="?page=program"><?= PROGRAM_MENU ?></a></li>
		<li><a href="?page=list_content"><?= CONTENT_MENU ?></a></li>
		<li><a href="?page=cart"><?= CART ?></a></li>
	</ul>
</div>