<?php

require_once('Model.php');

class Organization extends Model {

	public function __construct() {
		parent::__construct('organization');
	}

	public function findAllOrganizations() {
		return $this->_mysqli->query('SELECT id, reference, name FROM ' . $this->_table . ';');
	}
}