<?php

require_once('Model.php');

class MediaExtra extends Model {

	public function __construct() {
		parent::__construct('media_extra');
	}

	public function findAllMediaExtras() {
		$data = $this->_mysqli->query('SELECT id, data, id_info, id_field, id_array ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaExtras: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaExtra($data) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$id_media_extra_array = $this->_mysqli->real_escape_string($data['id_media_extra_array_mediastorage']);
		$id_media_extra_field = $this->_mysqli->real_escape_string($data['id_media_extra_field_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(data, id_media, id_array, id_field, id_language)' .
			' VALUES ("'. $data_media . '", ' . $id_media . ', ' . $id_media_extra_array . ', ' . $id_media_extra_field . ', ' . $id_language . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaExtra: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaExtraWithId($data, $media_extra_id) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$id_media_extra_array = $this->_mysqli->real_escape_string($data['id_media_extra_array_mediastorage']);
		$id_media_extra_field = $this->_mysqli->real_escape_string($data['id_media_extra_field_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_media = ' . $id_media . ', data = "' . $data_media . '", id_array = ' . $id_media_extra_array . ', id_field = ' . $id_media_extra_field .
			' WHERE id = ' . $media_extra_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaExtraWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraById($media_extra_id) {
		$media_extra_id = $this->_mysqli->real_escape_string($media_extra_id);

		$data = $this->_mysqli->query('SELECT id, data, id_info, id_field, id_array' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_extra_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraById: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraByMediaIdAndFieldIdAndIdLanguage($id_media, $id_field, $id_language) {
		$id_media = $this->_mysqli->real_escape_string($id_media);
		$id_field = $this->_mysqli->real_escape_string($id_field);
		$id_language = $this->_mysqli->real_escape_string($id_language);

		$data = $this->_mysqli->query('SELECT id, data, id_media, id_field, id_array, id_language' .
									' FROM ' . $this->_table .
									' WHERE id_media = ' . $id_media . ' AND id_field = ' . $id_field . ' AND id_language = ' . $id_language . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaExtraById($media_extra_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_extra_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaExtraById: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraByMediaId($id_media) {
		$id_media = $this->_mysqli->real_escape_string($id_media);

		$data = $this->_mysqli->query('SELECT media_extra.id, data, id_media, id_field, id_array, id_language, type ' .
									' FROM ' . $this->_table .
									' LEFT JOIN media_extra_field ON id_field = media_extra_field.id' .
									' WHERE id_media = ' . $id_media . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraByMediaId: ' . $this->_mysqli->error : '',
		);
	}
}