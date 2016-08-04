<?php

require_once('Model.php');

class Permit extends Model {

	public function __construct() {
		parent::__construct('permit');
	}

	public function findAllPermits() {
		$data = $this->_mysqli->query('SELECT id, permit FROM ' . $this->_table . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllPermits: ' . $this->_mysqli->error : '',
		);
	}
}