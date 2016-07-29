<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$settings = parse_ini_file('config.ini.php', true);

require_once('route.php');

$route = new Route();
$controller = $route->getController('login');

if (!$controller) {
	echo 'NOT FOUND';
	return;
}
else {
	require_once($controller[1]);

	$controllerObject = new $controller[2];
	$controllerObject->$controller[3]();
}