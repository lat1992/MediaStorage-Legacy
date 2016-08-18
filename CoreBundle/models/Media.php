<?php

require_once('Model.php');

class Media extends Model {

	public function __construct() {
		parent::__construct('media');
	}

	public function findAllMedias() {
		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization FROM ' . $this->_table . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMedias: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMedia($data) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_folder = $this->_mysqli->real_escape_string($data['id_folder_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_type = $this->_mysqli->real_escape_string($data['id_type_mediastorage']);
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$reference_client = $this->_mysqli->real_escape_string($data['reference_client_mediastorage']);
		$right_view = $this->_mysqli->real_escape_string($data['right_view_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_parent, id_folder, id_organization, id_type, reference, reference_client, right_view)' .
			' VALUES (' . $id_parent . ', ' . $id_folder . ', ' . $id_organization . ', ' . $id_type .', "' . $reference . '", "' . $reference_client . '", ' . $right_view . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMedia: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id
		);
	}

	public function updateMediaWithId($data, $media_id) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_type = $this->_mysqli->real_escape_string($data['id_type_mediastorage']);
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$right_view = $this->_mysqli->real_escape_string($data['right_view_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_parent = ' . $id_parent . ', id_organization = ' . $id_organization . ', id_type = ' . $id_type . ', reference = "' . $reference . '", right_view = ' . $right_view . ', right_download = ' . $right_download .
			' WHERE id = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaById($media_id) {
		$media_id = $this->_mysqli->real_escape_string($media_id);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization, id_type, reference, right_view ' .
			' FROM ' . $this->_table .
			' WHERE id = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaById($media_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaById:' . $this->_mysqli->error : '',
		);
	}

	public function findLastRefenceNumberByOrganization($id_organization) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT MAX(reference) AS reference FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findLastRefenceNumberByOrganization:' . $this->_mysqli->error : '',
		);
	}
}