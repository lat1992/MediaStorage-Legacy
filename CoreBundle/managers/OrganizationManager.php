<?php

require_once('CoreBundle/models/Organization.php');

class OrganizationManager {

	private $_organizationModel;

	public function __construct() {
		$this->_organizationModel = new Organization();
	}

	public function getAllOrganizationsDb() {
		return $this->_organizationModel->findAllOrganizations();			
	}
}