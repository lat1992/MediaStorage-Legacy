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
		$id_language = $this->_mysqli->real_escape_string($data['id_language']);
		$id_order = $this->_mysqli->real_escape_string($data['id_order']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(element, id_field, id_language, id_order)' .
			' VALUES ("'. $element . '", ' . $id_media_extra_field . ',' . $id_language . ', ' . $id_order . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaExtraArray: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaExtraArrayWithId($data, $media_extra_array_id) {
		$element = $this->_mysqli->real_escape_string($data['element_mediastorage']);
		$id_media_extra_field = $this->_mysqli->real_escape_string($data['id_media_extra_field_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language']);
		$id_order = $this->_mysqli->real_escape_string($data['id_order']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_field = ' . $id_media_extra_field . ', element = "' . $element . '", id_language = ' . $id_language . ', id_order=' . $id_order .
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

	public function deleteMediaExtraArrayByFieldId($field_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_field = ' . $field_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaExtraArrayByFieldId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaExtraArrayByLanguageId($language_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_language = ' . $language_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaExtraArrayByLanguageId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaExtraArrayByIdFieldAndIdOrder($id_field, $id_order) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_field = ' . $id_field . ' AND id_order = ' . $id_order . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaExtraArrayByIdFieldAndIdOrder: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraArrayByIdField($id_field) {
		$id_field = $this->_mysqli->real_escape_string($id_field);

		$data = $this->_mysqli->query('SELECT id, element, id_field, id_language, id_order' .
									' FROM ' . $this->_table .
									' WHERE id_field = ' . $id_field . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraArrayByIdField: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraArrayByIdFieldAndIdLanguageAndIdOrder($id_field, $id_language, $id_order) {
		$id_field = $this->_mysqli->real_escape_string($id_field);
		$id_language = $this->_mysqli->real_escape_string($id_language);
		$id_order = $this->_mysqli->real_escape_string($id_order);

		$data = $this->_mysqli->query('SELECT id, element, id_field, id_language, id_order' .
									' FROM ' . $this->_table .
									' WHERE id_field = ' . $id_field . ' AND id_language = ' . $id_language . ' AND id_order = ' . $id_order . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraArrayByIdFieldAndIdLanguageAndIdOrder: ' . $this->_mysqli->error : '',
		);
	}
}