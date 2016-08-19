<?php

require_once('Model.php');

class MediaExtraFieldLanguage extends Model {

	public function __construct() {
		parent::__construct('media_extra_field_language');
	}

	public function createNewMediaExtraFieldLanguage($id_field, $key, $value) {
		$data = array();

		$id_field = $this->_mysqli->real_escape_string($id_field);
		$key = $this->_mysqli->real_escape_string($key);
		$text = $this->_mysqli->real_escape_string($value);

		$data = $this->_mysqli->query('INSERT INTO '. $this->_table .' (id_field, id_language, data) VALUES ('. $id_field .', '. $key .', "'. $text .'");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaExtraFieldLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraFieldLanguagesByIdField($id_field) {
		$data = array();
		$data = $this->_mysqli->query();

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraFieldLanguagesByIdField: ' . $this->_mysqli->error : '',
		);
	}
}
