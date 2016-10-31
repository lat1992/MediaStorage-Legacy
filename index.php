<?php
/*
** Capital Vision Copyright 2016
** Contribute by Jean-Stephane and Mauhoi
*/

/*
** ALL CHECKS
*/

header( 'content-type: text/html; charset=utf-8' );

if (session_status() == PHP_SESSION_NONE) {
	session_name("MediaStorage");
	session_start();
}

require_once('RootBundle/ressources/permit/permit_defines.php');

require_once('translation/index.php');

$page = '';

if (isset($_GET['platform'])) {

	require_once('CoreBundle/managers/OrganizationManager.php');

	$organizationManager = new OrganizationManager();

	 $organizationManager->getOrganizationIdByReferenceDb($_GET['platform']);

	if (is_null($_SESSION['id_platform_organization']))
		$page = 'error';
}

if (isset($_GET['page']) && ((!strcmp($_GET['page'], 'post_production_workflow_api') || !strcmp($_GET['page'], 'end_production_workflow_api')) || (!strcmp($_GET['page'], 'post_production_workflow_master_api') || !strcmp($_GET['page'], 'end_production_workflow_master_api')))) {
	$page = $_GET['page'];
}
else if (isset($_SESSION['username_mediastorage']) && isset($_SESSION['role_mediastorage']) && isset($_GET['page']) && empty($page)) {
	$page = $_GET['page'];

	if ((isset($_SESSION['id_platform_organization'])) && (intval($_SESSION['id_platform_organization']) != intval($_SESSION['id_organization']))) {
		if (isset($_SESSION['permits'][PERMIT_ROOT]) && isset($_SESSION['id_platform_organization'])) {
			$_SESSION['id_organization'] = $_SESSION['id_platform_organization'];
			$_SESSION['id_group'] = $_SESSION['id_platform_group'];
		}
		else {
			session_unset();
			$page = 'login';
		}
	}
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