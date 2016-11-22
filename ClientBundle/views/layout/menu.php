<link rel="stylesheet" type="text/css" href="ClientBundle/ressources/search/css/menu.css" />

<div off-canvas="slidebar-1 left reveal" class="off-canvas">
	<ul>
	<?php
		echo '<li><div class= "logo" style="background-image: url(ClientBundle/ressources/organization/'. $_SESSION['id_organization'] .'/img/logo.png); background-size: contain;"><a class="logo_button" href="?page=home"></a></div></li>';
	?>
		<li><a class="logout_button" href="?page=logout"><?= LOGOUT ?></a>
		<a class="profile_button" href="?page=profile"><?= PROFILE ?></a></li>

		<li>
			<div class="search-box">
			    <form method="get">
			    	<div class="search-form">
			    		<input type="hidden" name="page" value="search">
			        	<input placeholder="<?= SEARCH . '...' ?>" type="text" id="keyword" name="keyword" onkeyup="ajaxRefreshLiveSearch(this.value)" autocomplete="off" value="<?php if (isset($_GET['keyword'])) echo $_GET['keyword']; ?>" />
			        	<input type="submit" value="&#x1f50d;" id="submitButton" />
			        </div>
			        <div style="clear:both"></div>
			    	<div class="live-search" id="livesearch"></div>
			    </form>
			</div>
		</li>

		<!-- <li><a href="?page=search"><?= SEARCH_MENU ?></a></li> -->
		<li><a href="?page=folder"><?= FOLDER_MENU ?></a></li>
		<li><a href="?page=program"><?= PROGRAM_MENU ?></a></li>
		<li><a href="?page=list_content"><?= CONTENT_MENU ?></a></li>
<?php
		if (isset($_SESSION['permits'][PERMIT_DOWNLOAD_CONTENT])) {
?>
			<li><a href="?page=cart"><?= CART ?></a></li>
<?php
		}
?>
		<!--<li><a href="?page=sharelist"><?= SHARELIST ?></a></li>-->
	</ul>
</div>

<script type="text/javascript" src="ClientBundle/ressources/search/js/main.js"></script>