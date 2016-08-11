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

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(reference, name, id_group)' .
			' VALUES ("'. $reference . '", "' . $name . '",' . $id_group . ');'
		);

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

		$data = $this->_mysqli->query('SELECT id, reference, name, id_group' .
									' FROM ' . $this->_table .
									' WHERE reference = "' . $reference . '";'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findOrganizationById: ' . $this->_mysqli->error : '',
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
}