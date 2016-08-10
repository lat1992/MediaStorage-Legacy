<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>MediaStorage</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="ClientBundle/ressources/libs/Slidebars/dist/slidebars.min.css">
		<link rel="stylesheet" href="RootBundle/ressources/layout/css/menu.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	</head>

	<style>

	</style>

	<body>

		<?php require_once('RootBundle/views/layout/menu.php'); ?>

			<nav canvas class>

				<div id="header_div">

					<div class="js-open-left-slidebar" >
						<span>&#9776; <?= MENU ?></span>
					</div>

					<div id="header_title_div">
						<h1><?= (isset($title)) ? $title : 'Aucun titre' ?></h1>
					</div>

				</div>

			</nav>

			<div canvas="container" style="margin-top: 63px; padding-bottom: 63px; background-color: #f5f4f2">

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
						echo $_SESSION['flash_message'];
						unset($_SESSION['flash_message']);
?>
					</div>
<?php
				}
?>
