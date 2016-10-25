<?php

require_once('Model.php');

class TagLanguage extends Model {

	public function __construct() {
		parent::__construct('tag_language');
	}

	public function createNewTagLanguage($data) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_tag = $this->_mysqli->real_escape_string($data['id_tag_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(data, id_tag, id_language)' .
			' VALUES ("'. $data_media . '", ' . $id_tag . ', ' . $id_language . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewTagLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function updateTagLanguageWithId($data, $tag_language_id) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_tag = $this->_mysqli->real_escape_string($data['id_tag_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_tag = ' . $id_tag . ', data = "' . $data_media . '", id_language = ' . $id_language.
			' WHERE id = ' . $tag_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateTagLanguageWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findTagLanguageById($tag_language_id) {
		$tag_language_id = $this->_mysqli->real_escape_string($tag_language_id);

		$data = $this->_mysqli->query('SELECT id, data, id_tag, id_language' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $tag_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findTagLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteTagLanguageById($tag_language_id) {
		$tag_language_id = $this->_mysqli->real_escape_string($tag_language_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_language = ' . $tag_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteTagLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteTagLanguageByTagId($tag_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_tag = ' . $tag_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteTagLanguageByTagId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllTagsByIdLanguage($id_language) {
		$id_language = $this->_mysqli->real_escape_string($id_language);

		$data = $this->_mysqli->query('SELECT data FROM tag_language');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllTagsByIdLanguage: ' . $this->_mysqli->error : '',
		);

	}
}