<?php

require_once('Model.php');

class Organization extends Model {

	public function __construct() {
		parent::__construct('organization');
	}

	public function findAllOrganizations() {
		$data = $this->_mysqli->query('SELECT organization.id, organization.reference, organization.name AS organization_name, `group`.name AS group_name FROM `' . $this->_table .
			'` JOIN `group` ON organization.id_group = `group`.id' .
			';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllOrganizations: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewOrganization($data) {
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);
		$id_group = $this->_mysqli->real_escape_string($data['id_group_mediastorage']);
		$id_default_language = $this->_mysqli->real_escape_string($data['id_default_language']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(reference, name, id_group, id_default_language)' .
			' VALUES ("'. $reference . '", "' . $name . '",' . $id_group . ', ' . $id_default_language . ');'
		);

		$id = $this->_mysqli->insert_id;
		mkdir('uploads/media_files/chunks/'.$id, 0755);
		mkdir('uploads/media_files/files/'.$id, 0755);
		mkdir('uploads/media_files/files/'.$id.'/tmp', 0755);
		mkdir('uploads/media_files/files/'.$id.'/tmp_to_move', 0755);
		mkdir('uploads/thumbnails/chunks/'.$id.'/contents', 0755);
		mkdir('uploads/thumbnails/chunks/'.$id.'/folders', 0755);
		mkdir('uploads/thumbnails/chunks/'.$id.'/programs', 0755);
		mkdir('uploads/thumbnails/files/'.$id.'/contents', 0755);
		mkdir('uploads/thumbnails/files/'.$id.'/folders', 0755);
		mkdir('uploads/thumbnails/files/'.$id.'/programs', 0755);
		mkdir('uploads/thumbnails/files/'.$id.'/contents/tmp', 0755);
		mkdir('uploads/thumbnails/files/'.$id.'/folders/tmp', 0755);
		mkdir('uploads/thumbnails/files/'.$id.'/programs/tmp', 0755);
		mkdir('files/'.$id, 0755);
		mkdir('files/'.$id.'/audios', 0755);
		mkdir('files/'.$id.'/audios/HR', 0755);
		mkdir('files/'.$id.'/audios/LR', 0755);
		mkdir('files/'.$id.'/documents', 0755);
		mkdir('files/'.$id.'/documents/PDF', 0755);
		mkdir('files/'.$id.'/images', 0755);
		mkdir('files/'.$id.'/images/HR', 0755);
		mkdir('files/'.$id.'/images/LR', 0755);
		mkdir('files/'.$id.'/others', 0755);
		mkdir('files/'.$id.'/videos', 0755);
		mkdir('files/'.$id.'/videos/HR', 0755);
		mkdir('files/'.$id.'/videos/LR', 0755);
		mkdir('archives/'.$id, 0755);
		mkdir('ClientBundle/ressources/organization/'.$id, 0755);
		mkdir('ClientBundle/ressources/organization/'.$id.'/img', 0755);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function updateOrganizationWithId($data, $organization_id) {
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);
		$id_group = $this->_mysqli->real_escape_string($data['id_group_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_group = ' . $id_group . ', reference = "' . $reference . '", name="' . $name .
			'" WHERE id = ' . $organization_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateOrganizationWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findOrganizationById($organization_id) {
		$organization_id = $this->_mysqli->real_escape_string($organization_id);

		$data = $this->_mysqli->query('SELECT id, reference, name, id_group' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $organization_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findOrganizationById: ' . $this->_mysqli->error : '',
		);
	}

	public function findOrganizationByReference($reference) {
		$reference = $this->_mysqli->real_escape_string($reference);

		$data = $this->_mysqli->query('SELECT id, id_default_language, reference, name, id_group' .
									' FROM ' . $this->_table .
									' WHERE reference = "' . $reference . '";'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findOrganizationByReference: ' . $this->_mysqli->error : '',
		);
	}

	public function updateLanguageToOneByLanguageIdDb($language_id) {
		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_default_language = 1 WHERE id_default_language = ' . $language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateLanguageToOneByLanguageIdDb: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteOrganizationById($organization_id) {
		$organization_id = $this->_mysqli->real_escape_string($organization_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $organization_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteOrganizationById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteOrganizationByGroupId($group_id) {
		$group_id = $this->_mysqli->real_escape_string($group_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_group = ' . $group_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteOrganizationByGroupId: ' . $this->_mysqli->error : '',
		);
	}

}