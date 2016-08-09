<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>MediaStorage</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="ClientBundle/ressources/libs/Slidebars/dist/slidebars.min.css">
		<link rel="stylesheet" href="ClientBundle/ressources/layout/css/menu.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	</head>

	<style>

	</style>

	<body>

		<?php require_once('ClientBundle/views/layout/menu.php'); ?>

			<nav canvas class>

				<div id="header_div">

					<div class="js-open-left-slidebar" >
						<span>&#9776; Menu</span>
					</div>

					<div id="header_title_div">
						<h1><?= (isset($title)) ? $title : 'Aucun titre' ?></h1>
					</div>

				</div>

			</nav>

			<div canvas="container" style="margin-top: 63px; padding-bottom: 63px; background-color: #f5f4f2">

