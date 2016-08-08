<?php

require_once('Model.php');

class MediaType extends Model {

	public function __construct() {
		parent::__construct('media_type');
	}

	public function findAllMediaTypes() {
		$data = $this->_mysqli->query('SELECT id, type ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaTypes: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaType($data) {
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(type)' .
			' VALUES ("'. $type . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaType: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaTypeWithId($data, $media_type_id) {
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET type = "' . $type . '"' .
			' WHERE id = ' . $media_type_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaTypeWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaTypeById($media_type_id) {
		$media_type_id = $this->_mysqli->real_escape_string($media_type_id);

		$data = $this->_mysqli->query('SELECT id, type ' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_type_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaTypeById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaTypeById($media_type_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_type_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaTypeById: ' . $this->_mysqli->error : '',
		);
	}
}