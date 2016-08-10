<?php

class Route {

	protected $_route;

	public function __construct() {
		$this->_route = array();

		$this->loadRoutes();
	}

	public function loadRoutes() {

		require_once('CoreBundle/routes/route.php');
		require_once('ClientBundle/routes/route.php');
		require_once('RootBundle/routes/route.php');
	}

	public function getController($page) {

		foreach ($this->_route as $key => $value) {
			if (strcmp($page, $value[0]) === 0)
				return ($this->_route[$key]);
		}

		return false;
	}
}