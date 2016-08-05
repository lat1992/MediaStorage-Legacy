<?php

require_once('Model.php');

class Folder extends Model {

	public function __construct() {
		parent::__construct('folder');
	}

	public function findAllFolders() {
		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolders: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewFolder($data) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_parent, id_organization)' .
			' VALUES ('. $id_parent . ', ' . $id_organization . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewFolder: ' . $this->_mysqli->error : '',
		);
	}

	public function updateFolderWithId($data, $folder_id) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', id_parent = ' . $id_parent . '' .
			' WHERE id = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateFolderWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findFolderById($folder_id) {
		$folder_id = $this->_mysqli->real_escape_string($folder_id);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findFolderById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteFolderById($folder_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteFolderById: ' . $this->_mysqli->error : '',
		);
	}
}