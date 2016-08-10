<?php

/*
** ALL CHECKS
*/

header( 'content-type: text/html; charset=utf-8' );

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once('translation/index.php');

if (isset($_SESSION['username_mediastorage']) && isset($_SESSION['role_mediastorage']) && isset($_GET['page'])) {
	$page = $_GET['page'];
}
else {
	$page = 'login';
}

/*
** CHECK ROUTES
*/

require_once('Route.php');

$route = new Route();
$controller = $route->getController($page);

if (!$controller) {
	echo 'NOT FOUND';
	return;
}
else {
	require_once($controller[1]);

	$controllerObject = new $controller[2];
	$action = $controller[3];
	$controllerObject->$action();
}