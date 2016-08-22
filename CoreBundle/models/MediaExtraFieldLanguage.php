<?php

require_once('Model.php');

class MediaExtraFieldLanguage extends Model {

	public function __construct() {
		parent::__construct('media_extra_field_language');
	}

	public function createNewMediaExtraFieldLanguage($id_field, $id_language, $text) {
		$data = array();

		$id_field = $this->_mysqli->real_escape_string($id_field);
		$id_language = $this->_mysqli->real_escape_string($id_language);
		$text = $this->_mysqli->real_escape_string($text);

		$data = $this->_mysqli->query('INSERT INTO '. $this->_table .' (id_field, id_language, data) VALUES ('. $id_field .', '. $id_language .', "'. $text .'");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaExtraFieldLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraFieldLanguagesByIdField($id_field) {
		$data = $this->_mysqli->query('SELECT * FROM '. $this->_table .' WHERE id_field = '. $id_field .';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraFieldLanguagesByIdField: ' . $this->_mysqli->error : '',
		);
	}

	public function updateOrInsertMediaExtraFieldLanguage($id_field, $id_language, $text) {
		$id_field = $this->_mysqli->real_escape_string($id_field);
		$id_language = $this->_mysqli->real_escape_string($id_language);
		$text = $this->_mysqli->real_escape_string($text);

		$data = $this->_mysqli->query('SELECT * FROM '. $this->_table .' WHERE id_field = '. $id_field .' AND id_language = '. $id_language .';');
		if ($data->num_rows()) {
			$data = $this->_mysqli->query('UPDATE '. $this->_table .' SET data = "'. $text .'" WHERE id_field = '. $id_field .' AND id_language = '. $id_language .';');
		}
		else {
			$data = $this->_mysqli->query('INSERT INTO '. $this->_table .' (id_field, id_language, data) VALUES ('. $id_field .', '. $id_language .', "'. $text .'");');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateOrInsertMediaExtraFieldLanguage: ' . $this->_mysqli->error : '',
		);
	}
}
