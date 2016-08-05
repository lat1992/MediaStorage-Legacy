<?php

require_once('Model.php');

class MediaInfoExtraArray extends Model {

	public function __construct() {
		parent::__construct('media_info_extra_array');
	}

	public function findAllMediaInfoExtraArrays() {
		$data = $this->_mysqli->query('SELECT id, element, id_field ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaInfoExtraArrays: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaInfoExtraArray($data) {
		$element = $this->_mysqli->real_escape_string($data['element_mediastorage']);
		$id_media_info_extra_field = $this->_mysqli->real_escape_string($data['id_media_info_extra_field_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(element, id_field)' .
			' VALUES ("'. $element . '", ' . $id_media_info_extra_field . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaInfoExtraArray: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaInfoExtraArrayWithId($data, $media_info_extra_array_id) {
		$element = $this->_mysqli->real_escape_string($data['element_mediastorage']);
		$id_media_info_extra_field = $this->_mysqli->real_escape_string($data['id_media_info_extra_field_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_field = ' . $id_media_info_extra_field . ', element = "' . $element . '"' .
			' WHERE id = ' . $media_info_extra_array_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaInfoExtraArrayWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaInfoExtraArrayById($media_info_extra_array_id) {
		$media_info_extra_array_id = $this->_mysqli->real_escape_string($media_info_extra_array_id);

		$data = $this->_mysqli->query('SELECT id, element, id_field' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_info_extra_array_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaInfoExtraArrayById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaInfoExtraArrayById($media_info_extra_array_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_info_extra_array_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaInfoExtraArrayById: ' . $this->_mysqli->error : '',
		);
	}
}