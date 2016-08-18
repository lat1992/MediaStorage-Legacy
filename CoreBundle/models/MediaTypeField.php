<?php

require_once('Model.php');

class MediaTypeField extends Model {

	public function __construct() {
		parent::__construct('media_type_field');
	}

	public function findAllMediaTypeFields() {
		$data = $this->_mysqli->query('SELECT id, id_type, id_field ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaTypeFields: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaTypeField($data) {
		$id_type = $this->_mysqli->real_escape_string($data['id_type_mediastorage']);
		$id_field = $this->_mysqli->real_escape_string($data['id_media_extra_field_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_type, id_field)' .
			' VALUES ('. $id_type . ', ' . $id_field . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaTypeField: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaTypeFieldWithId($data, $role_id) {
		$id_type = $this->_mysqli->real_escape_string($data['id_type_mediastorage']);
		$id_field = $this->_mysqli->real_escape_string($data['id_media_extra_field_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_type = ' . $id_type . ', id_field = ' . $id_field . '' .
			' WHERE id = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaTypeFieldWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaTypeFieldById($role_id) {
		$role_id = $this->_mysqli->real_escape_string($role_id);

		$data = $this->_mysqli->query('SELECT id, id_type, id_field' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaTypeFieldById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaTypeFieldById($role_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaTypeFieldById: ' . $this->_mysqli->error : '',
		);
	}
}