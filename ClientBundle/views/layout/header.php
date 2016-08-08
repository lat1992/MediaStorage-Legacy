<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>MediaStorage</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="ClientBundle/ressources/libs/Slidebars/dev/slidebars.css">
		<link rel="stylesheet" href="ClientBundle/ressources/libs/Slidebars/dev/style.css">

	</head>

	<style>
	body {
		font-family: "Open Sans", "sans-serif";
	}

/*
::-webkit-scrollbar {
    width: 15px;
}


::-webkit-scrollbar-thumb {
    /*background: rgba(0,0,0,0.3);
    background: #FED500;
    border: 1px solid rgba(0, 0, 0, 0.1);;
}
::-webkit-scrollbar-thumb:window-inactive {
	/*background: rgba(0,0,0,0.4);
	background: #FED500;
}
*/
nav[canvas] {
  position: fixed;
  top: 0;
  width: 100%;
  padding-bottom: 13px;
  background-color: white;
  /*line-height: 60px;*/
  /*font-size: 24px;*/
  /*font-weight: 100;*/
  text-align: center;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  color:black;
  z-index:2;
}

[off-canvas] {
	background-color: #262626;
	padding: 0px;
}
	</style>

	<body>

		<?php require_once('ClientBundle/views/layout/menu.php'); ?>

			<nav canvas class style="float: left; background-color: #FED500">

				<div style="margin-left: auto;margin-right: auto;overflow: hidden;">

					<div class="js-open-left-slidebar" style="padding: 5px; float: left; font-family: 'QuickSand';margin-top: 15px;margin-left: 15px;font-weight: bold;">
						&#9776; Menu
					</div>

					<div style="margin: 0 auto; padding-top: 13px; font-family: 'QuickSand'; font-weight: 900;font-size: 23pt; overflow: hidden">
						Titre trop long 
					</div>

				</div>

			</nav>

			<div canvas="container">

