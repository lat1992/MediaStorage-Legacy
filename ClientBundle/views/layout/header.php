<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>MediaStorage</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="ClientBundle/ressources/libs/Slidebars-2.0.2/dev/slidebars.css">
		<link rel="stylesheet" href="ClientBundle/ressources/libs/Slidebars-2.0.2/dev/style.css">

	</head>

	<style>
	body {
		font-family: "Open Sans", "sans-serif";
	}

nav[canvas] {
  position: fixed;
  top: 0;
  width: 100%;
  background-color: red;
  height: 60px;
  /*line-height: 60px;*/
  /*font-size: 24px;*/
  /*font-weight: 100;*/
  text-align: center;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  color:black;
  z-index:2;
}
	</style>

	<body>

		<?php require_once('ClientBundle/views/layout/menu.php'); ?>

			<nav canvas class style="float: left">

				<div style="max-width: 900px;margin-left: auto;margin-right: auto;">

					<div class="js-open-left-slidebar" style="height: 100%; float: left; background-color: grey">
						&#9776; Menu
					</div>

				</div>

			</nav>

			<div canvas="container">

