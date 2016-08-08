<?php

require_once('Model.php');

class MediaInfoExtra extends Model {

	public function __construct() {
		parent::__construct('media_info_extra');
	}

	public function findAllMediaInfoExtras() {
		$data = $this->_mysqli->query('SELECT id, data, id_info, id_field, id_array ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaInfoExtras: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaInfoExtra($data) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_media_info = $this->_mysqli->real_escape_string($data['id_media_info_mediastorage']);
		$id_media_info_extra_array = $this->_mysqli->real_escape_string($data['id_media_info_extra_array_mediastorage']);
		$id_media_info_extra_field = $this->_mysqli->real_escape_string($data['id_media_info_extra_field_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(data, id_info, id_array, id_field)' .
			' VALUES ("'. $data_media . '", ' . $id_media_info . ', ' . $id_media_info_extra_array . ', ' . $id_media_info_extra_field . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaInfoExtra: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaInfoExtraWithId($data, $media_info_extra_id) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_media_info = $this->_mysqli->real_escape_string($data['id_media_info_mediastorage']);
		$id_media_info_extra_array = $this->_mysqli->real_escape_string($data['id_media_info_extra_array_mediastorage']);
		$id_media_info_extra_field = $this->_mysqli->real_escape_string($data['id_media_info_extra_field_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_info = ' . $id_media_info . ', data = "' . $data_media . '", id_array = ' . $id_media_info_extra_array . ', id_field = ' . $id_media_info_extra_field .
			' WHERE id = ' . $media_info_extra_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaInfoExtraWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaInfoExtraById($media_info_extra_id) {
		$media_info_extra_id = $this->_mysqli->real_escape_string($media_info_extra_id);

		$data = $this->_mysqli->query('SELECT id, data, id_info, id_field, id_array' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_info_extra_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaInfoExtraById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaInfoExtraById($media_info_extra_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_info_extra_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaInfoExtraById: ' . $this->_mysqli->error : '',
		);
	}
}