<?php

require_once('Model.php');

class FolderMedia extends Model {

	public function __construct() {
		parent::__construct('folder_media');
	}

	public function findAllFolderMedias() {
		$data = $this->_mysqli->query('SELECT id, id_folder, id_media ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolderMedias: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewFolderMedia($data) {
		$id_folder = $this->_mysqli->real_escape_string($data['id_folder_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_folder, id_media)' .
			' VALUES ('. $id_folder . ', ' . $id_media . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewFolderMedia: ' . $this->_mysqli->error : '',
		);
	}

	public function updateFolderMediaWithId($data, $folder_media_id) {
		$id_folder = $this->_mysqli->real_escape_string($data['id_folder_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_folder = ' . $id_folder . ', id_media = ' . $id_media .
			' WHERE id = ' . $folder_media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateFolderMediaWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findFolderMediaById($folder_media_id) {
		$folder_media_id = $this->_mysqli->real_escape_string($folder_media_id);

		$data = $this->_mysqli->query('SELECT id, id_folder, id_media' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $folder_media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findFolderMediaById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteFolderMediaById($folder_media_id) {
		$folder_media_id = $this->_mysqli->real_escape_string($folder_media_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $folder_media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteFolderMediaById: ' . $this->_mysqli->error : '',
		);
	}
}