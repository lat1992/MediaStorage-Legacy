<?php

require_once('Model.php');

class Language extends Model {
	

	public function __construct() {
		parent::__construct('language');
	}

	public function findLanguageById($id) {
		return $this->_mysqli->query('SELECT id, name, code FROM ' . $this->_table . ' WHERE id = '. $id . ';');
	}

	public function findAllLanguages() {
		return $this->_mysqli->query('SELECT id, name, code FROM ' . $this->_table . ';');
	}
}