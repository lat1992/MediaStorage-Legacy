<?php

require_once('Model.php');

class Role extends Model {

	public function __construct() {
		parent::__construct('role');
	}

	public function findAllRoles() {
		return $this->_mysqli->query('SELECT id, role FROM ' . $this->_table . ';');
	}
}