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

	public function findAllMediaExtraFieldsWithOrganization($id_organization) {
		$data = $this->_mysqli->query('SELECT media_extra_field.id, media_extra_field.type, media_extra_field.id_organization, media_extra_field_language.data AS name' .
			' FROM ' . $this->_table .
			' JOIN `media_extra_field_language` ON media_extra_field.id = media_extra_field_language.id_field' .
			' WHERE id_language = ' . $_SESSION['id_language_mediastorage'] . ' AND id_organization = ' . $id_organization
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaExtraFieldsWithOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaExtraField($data) {
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);
		$mandatory = $this->_mysqli->real_escape_string($data['mandatory_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_organization, type, mandatory) VALUES (' . $id_organization . ', "' . $type . '", ' . $mandatory . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaExtraField: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id,
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
		$data = $this->_mysqli->query('SELECT id, id_organization, type, mandatory ' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_extra_field_id . ';'
		);
		$tmp = $data->fetch_assoc();


		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaExtraFieldById: ' . $this->_mysqli->error : '',
			'id_organization' => $tmp['id_organization'],
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
}