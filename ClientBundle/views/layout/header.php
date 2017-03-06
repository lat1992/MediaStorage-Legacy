<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>MediaStorage</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="ClientBundle/ressources/libs/Slidebars/dist/slidebars.min.css">
		<link rel="stylesheet" href="CoreBundle/ressources/layout/css/main.css">
		<link rel="stylesheet" href="CoreBundle/ressources/layout/css/menu.css">
		<link rel="stylesheet" href="CoreBundle/ressources/layout/css/customizable.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	</head>

	<body>

		<?php require_once('ClientBundle/views/layout/menu.php'); ?>

		<?php require_once('AdminBundle/views/layout/menu.php'); ?>
		
			<nav canvas class="nav_canvas">

				<div id="header_div">

					<div class="js-open-left-slidebar" >
						<span>&#9776; <span class="to_hide_mobile"><?= MENU ?></span></span>
					</div>

<?php
			if (file_exists('ClientBundle/ressources/organization/'.$_SESSION['id_platform_organization'].'/img/logo.png')) {
?>
				<div class="to_hide_mobile" style="max-height: 30px; width: 100%; "><a href="?page=home"><img style="display: inline-block; float:left; margin: -10px auto auto 15px; max-height: 50px" src="ClientBundle/ressources/organization/<?= $_SESSION['id_platform_organization'] ?>/img/logo.png" /></a></div>
<?php
			}
?>

<?php
					if (isset($_SESSION['permits'][PERMIT_CREATE_CONTENT]) || isset($_SESSION['permits'][PERMIT_EDIT_CONTENT]) || isset($_SESSION['permits'][PERMIT_DELETE_CONTENT]) || isset($_SESSION['permits'][PERMIT_EDIT_CONTENT]) || isset($_SESSION['permits'][PERMIT_ROOT])) {
?>
						<div class="js-open-right-slidebar" >
							<span><span class="to_hide_mobile"><?= ADMINISTRATOR ?></span> &#9776;</span>
						</div>
<?php
					}
?>
					<div id="header_title_div">
						<h1><?= (isset($title['title'])) ? $title['title'] : NO_TITLE ?></h1>
					</div>

				</div>

			</nav>

			<div canvas="container" class="div_canvas">

			<style>

				#breadcrumb {
					padding: 10px;
				}
				#breadcrumb, #breadcrumb a {
					background-color: #efefef;
					color: black;
				}

			</style>
<?php
			if (isset($title['breadcrumb'])) {
?>
				<div id="breadcrumb">
					<?= (isset($title['breadcrumb'])) ? $title['breadcrumb'] : '' ?>
				</div>
<?php
			}
?>


			<!--
<?php /*
			if (file_exists('ClientBundle/ressources/organization/'.$_SESSION['id_platform_organization'].'/img/logo.png')) {
?>
				<div style="max-height: 60px; width: 100%; "><a href="?page=home"><img style="display: block; margin: 0 auto; max-height: 60px" src="ClientBundle/ressources/organization/<?= $_SESSION['id_platform_organization'] ?>/img/logo.png" /></a></div>
<?php
			}
*/ ?>
			-->


<?php
				if (!empty($this->_errorArray)) {
?>
					<div class="error_div">
<?php
					foreach ($this->_errorArray as $error) {
						echo '<span>' . $error . '</span><br />';
					}
?>
					</div>
<?php
				}

				if (isset($_SESSION['flash_message'])) {
?>
					<div class="success_div" style="background-color: green; width: 100%">
<?php
						echo '<span>' . $_SESSION['flash_message'] . '</span><br />';
						unset($_SESSION['flash_message']);
?>
					</div>
<?php
				}
?>
