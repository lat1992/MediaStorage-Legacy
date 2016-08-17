<?php

require_once('Model.php');

class MediaExtraField extends Model {

	public function __construct() {
		parent::__construct('media_extra_field');
	}
	public function findAllMediaExtraFields() {
		$data = $this->_mysqli->query('SELECT id, id_organization, id_language, type, name ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaExtraFields: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaExtraField($data) {
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_organization, id_language, type, name)' .
			' VALUES ('. $id_organization . ', ' . $id_language . ', "' . $type . '", "' . $name . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaExtraField: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaExtraFieldWithId($data, $media_extra_field_id) {
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', id_language = ' . $id_language . ', type = "' . $type . '", name = "' . $name .
			'" WHERE id = ' . $media_extra_field_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaExtraFieldWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaExtraFieldById($media_extra_field_id) {
		$media_extra_field_id = $this->_mysqli->real_escape_string($media_extra_field_id);

		$data = $this->_mysqli->query('SELECT id, id_organization, id_language, type, name ' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_extra_field_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraFieldById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaExtraFieldById($media_extra_field_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_extra_field_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaExtraFieldById: ' . $this->_mysqli->error : '',
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

	public function findAllMediaExtraFieldByOrganizationAndType($type, $id_organization) {
		$type = $this->_mysqli->real_escape_string($type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT type, media_extra_field_language.data, media_extra_field_language.id_language, element, media_extra_field.id, media_extra_array.id as id_element' .
									' FROM ' . $this->_table .
									' LEFT JOIN media_type_field ON media_type_field.id_field = media_extra_field.id ' .
									' LEFT JOIN media_extra_field_language ON media_extra_field_language.id_field = media_extra_field.id ' .
									' LEFT JOIN media_extra_array ON media_extra_array.id_field = media_extra_field.id ' .
									' WHERE media_type_field.id_type = ' . $type . ' AND id_organization = ' . $id_organization . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraFieldById: ' . $this->_mysqli->error : '',
		);
	}
}