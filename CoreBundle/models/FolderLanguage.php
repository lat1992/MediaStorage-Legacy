<?php

require_once('Model.php');

class FolderLanguage extends Model {

	public function __construct() {
		parent::__construct('folder_language');
	}

	public function createNewFolderLanguage($data) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_folder = $this->_mysqli->real_escape_string($data['id_folder_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$description = $this->_mysqli->real_escape_string($data['description_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(data, id_folder, id_language, description)' .
			' VALUES ("'. $data_media . '", ' . $id_folder . ', ' . $id_language . ', "' . $description . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewFolderLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function updateFolderLanguageWithId($data, $folder_language_id) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_folder = $this->_mysqli->real_escape_string($data['id_folder_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$description = $this->_mysqli->real_escape_string($data['description_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_folder = ' . $id_folder . ', data = "' . $data_media . '", id_language = ' . $id_language . ', description = "' . $description . '"' .
			' WHERE id = ' . $folder_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateFolderLanguageWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findFolderLanguageById($folder_language_id) {
		$folder_language_id = $this->_mysqli->real_escape_string($folder_language_id);

		$data = $this->_mysqli->query('SELECT id, data, id_folder, id_language' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $folder_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findFolderLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function findFolderLanguageByFolderId($folder_id) {
		$folder_id = $this->_mysqli->real_escape_string($folder_id);

		$data = $this->_mysqli->query('SELECT id, data, id_folder, id_language, description' .
									' FROM ' . $this->_table .
									' WHERE id_folder = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findFolderLanguageByFolderId: ' . $this->_mysqli->error : '',
		);
	}

	public function findFolderLanguageByFolderIdAndLanguageId($folder_id, $language_id) {
		$folder_id = $this->_mysqli->real_escape_string($folder_id);
		$language_id = $this->_mysqli->real_escape_string($language_id);

		$data = $this->_mysqli->query('SELECT id, data, id_folder, id_language' .
									' FROM ' . $this->_table .
									' WHERE id_folder = ' . $folder_id . ' AND id_language = ' . $language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findFolderLanguageByFolderIdAndLanguageId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteFolderLanguageById($folder_language_id) {
		$folder_language_id = $this->_mysqli->real_escape_string($folder_language_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $folder_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteFolderLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteFolderLanguageByFolderId($folder_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_folder = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteFolderLanguageByFolderId: ' . $this->_mysqli->error : '',
		);
	}
}