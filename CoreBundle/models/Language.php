<?php

require_once('Model.php');

class Language extends Model {

	public function __construct() {
		parent::__construct('language');
	}

	public function findLanguageById($id) {
		$data = $this->_mysqli->query('SELECT id, name, code FROM ' . $this->_table . ' WHERE id = '. $id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllLanguages() {
		$data = $this->_mysqli->query('SELECT id, name, code FROM ' . $this->_table . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllLanguages: ' . $this->_mysqli->error : '',
		);
	}
}