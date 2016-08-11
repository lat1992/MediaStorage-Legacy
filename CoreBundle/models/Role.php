<?php

require_once('Model.php');

class Role extends Model {

	public function __construct() {
		parent::__construct('role');
	}

	public function findAllRolesWithRoleLanguageAndLanguage() {
		$data = $this->_mysqli->query('SELECT role.id, role.role, role_language.data, language.name, language.code, role_language.id AS id_role_language' .
			' FROM ' . $this->_table .
			' LEFT JOIN role_language ON role.id = role_language.id_role' .
			' LEFT JOIN language ON role_language.id_language = language.id'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllRoles: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllRoles() {
		$data = $this->_mysqli->query('SELECT role.id, role, id_organization, organization.name, COUNT(role_permit.id) AS permit_count ' .
			' FROM ' . $this->_table .
			' LEFT JOIN role_permit ON role.id = role_permit.id_role' .
			' LEFT JOIN organization on role.id_organization = organization.id ' .
			' GROUP BY role.id '
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllRoles: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewRole($data) {
		$role = $this->_mysqli->real_escape_string($data['role_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(role, id_organization)' .
			' VALUES ("'. $role . '", ' . $id_organization . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewRole: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id,
		);
	}

	public function updateRoleWithId($data, $role_id) {
		$role = $this->_mysqli->real_escape_string($data['role_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', role = "' . $role . '"' .
			' WHERE id = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateRoleWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findRoleById($role_id) {
		$role_id = $this->_mysqli->real_escape_string($role_id);

		$data = $this->_mysqli->query('SELECT role.id, role, id_organization, data, id_language' .
									' FROM ' . $this->_table .
									' LEFT JOIN role_language ON role.id = role_language.id_role' .
									' WHERE role.id = ' . $role_id .
									' GROUP BY role.id ' .
									' LIMIT 1 ' .
									';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findRoleById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteRoleById($role_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteRoleById: ' . $this->_mysqli->error : '',
		);
	}
}