<?php

require_once('CoreBundle/models/OrganizationText.php');

class OrganizationTextManager {

	private $_organizationTextModel;

	public function __construct() {
		$this->_organizationTextModel = new OrganizationText();
	}

	public function getOrganizationTextWithId($id_organization, $language_id) {
		return $this->_organizationTextModel->findOrganizationTextById($id_organization, $language_id);
	}
}