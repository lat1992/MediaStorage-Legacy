<?php

require_once('Model.php');

class MediaExtraArray extends Model {

	public function __construct() {
		parent::__construct('media_extra_array');
	}

	public function findAllMediaExtraArrays() {
		$data = $this->_mysqli->query('SELECT id, element, id_field ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaExtraArrays: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaExtraArray($data) {
		$element = $this->_mysqli->real_escape_string($data['element_mediastorage']);
		$id_media_extra_field = $this->_mysqli->real_escape_string($data['id_media_extra_field_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(element, id_field)' .
			' VALUES ("'. $element . '", ' . $id_media_extra_field . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaExtraArray: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaExtraArrayWithId($data, $media_extra_array_id) {
		$element = $this->_mysqli->real_escape_string($data['element_mediastorage']);
		$id_media_extra_field = $this->_mysqli->real_escape_string($data['id_media_extra_field_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_field = ' . $id_media_extra_field . ', element = "' . $element . '"' .
			' WHERE id = ' . $media_extra_array_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaExtraArrayWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraArrayById($media_extra_array_id) {
		$media_extra_array_id = $this->_mysqli->real_escape_string($media_extra_array_id);

		$data = $this->_mysqli->query('SELECT id, element, id_field' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_extra_array_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraArrayById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaExtraArrayById($media_extra_array_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_extra_array_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaExtraArrayById: ' . $this->_mysqli->error : '',
		);
	}
}