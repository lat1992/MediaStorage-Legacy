<?php

require_once('CoreBundle/models/Role.php');

class RoleManager {

	private $_roleModel;

	public function __construct() {
		$this->_roleModel = new Role();
	}

	public function getAllRolesDb() {
		return $this->_roleModel->findAllRoles();
	}
}