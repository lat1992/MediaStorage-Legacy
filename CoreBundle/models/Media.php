<?php

require_once('Model.php');

class Media extends Model {

	public function __construct() {
		parent::__construct('media');
	}

	public function findAllMedias() {
		$data = $this->_mysqli->query('SELECT id, id_parent, type, id_organization FROM ' . $this->_table . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMedias: ' . $this->_mysqli->error : '',
		);
	}
}