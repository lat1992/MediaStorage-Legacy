<?php

require_once('Model.php');

class Organization extends Model {

	public function __construct() {
		parent::__construct('organization');
	}

	public function findAllOrganizations() {
		$data = $this->_mysqli->query('SELECT id, reference, name FROM ' . $this->_table . ';');
	
		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllOrganizations: ' . $this->_mysqli->error : '',
		);
	}
}