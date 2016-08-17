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

	public function findAllLanguagesByGroup($id_group) {
		$id_group = $this->_mysqli->real_escape_string($id_group);

		$data = $this->_mysqli->query('SELECT language.id, name, code ' .
			' FROM ' . $this->_table .
			' LEFT JOIN group_language ON group_language.id_language = language.id ' .
			' WHERE id_group = ' . $id_group .
			';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllLanguagesByGroup: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewLanguage($data) {
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);
		$code = $this->_mysqli->real_escape_string($data['code_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(name, code)' .
			' VALUES ("'. $name . '", "' . $code . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function updateLanguageWithId($data, $language_id) {
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);
		$code = $this->_mysqli->real_escape_string($data['code_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET code = "' . $code . '", name = "' . $name . '"' .
			' WHERE id = ' . $language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateLanguageWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteLanguageById($language_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteLanguageById: ' . $this->_mysqli->error : '',
		);
	}

}