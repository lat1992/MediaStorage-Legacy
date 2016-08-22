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

	<style>

	</style>

	<body>

		<?php require_once('ClientBundle/views/layout/menu.php'); ?>

		<?php require_once('AdminBundle/views/layout/menu.php'); ?>

			<nav canvas class>

				<div id="header_div">

					<div class="js-open-left-slidebar" >
						<span>&#9776; <span class="to_hide_mobile"><?= MENU ?></span></span>
					</div>

					<div class="js-open-right-slidebar" >
						<span><span class="to_hide_mobile"><?= ADMINISTRATOR ?></span> &#9776;</span>
					</div>

					<div id="header_title_div">
						<h1><?= (isset($title)) ? $title : 'Aucun titre' ?></h1>
					</div>

				</div>

			</nav>

			<div canvas="container">

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
