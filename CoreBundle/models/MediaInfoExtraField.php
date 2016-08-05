<?php

require_once('Model.php');

class MediaInfoExtraField extends Model {

	public function __construct() {
		parent::__construct('media_info_extra_field');
	}
	public function findAllMediaInfoExtraFields() {
		$data = $this->_mysqli->query('SELECT id, id_organization, id_language, type, name ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaInfoExtraFields: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaInfoExtraField($data) {
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_organization, id_language, type, name)' .
			' VALUES ('. $id_organization . ', ' . $id_language . ', "' . $type . '", "' . $name . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaInfoExtraField: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaInfoExtraFieldWithId($data, $media_info_extra_field_id) {
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', id_language = ' . $id_language . ', type = "' . $type . '", name = "' . $name .
			'" WHERE id = ' . $media_info_extra_field_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaInfoExtraFieldWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaInfoExtraFieldById($media_info_extra_field_id) {
		$media_info_extra_field_id = $this->_mysqli->real_escape_string($media_info_extra_field_id);

		$data = $this->_mysqli->query('SELECT id, id_organization, id_language, type, name ' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_info_extra_field_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaInfoExtraFieldById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaInfoExtraFieldById($media_info_extra_field_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_info_extra_field_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaInfoExtraFieldById: ' . $this->_mysqli->error : '',
		);
	}

	public function findEnumOfType() {
		 $data = $this->_mysqli->query('SHOW COLUMNS' .
		 	' FROM ' . $this->_table .
			' LIKE "type"'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findEnumOfType: ' . $this->_mysqli->error : ''
		);
	}
}