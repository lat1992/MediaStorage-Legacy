<?php

require_once('Model.php');

class RolePermit extends Model {

	public function __construct() {
		parent::__construct('role_permit');
	}

	public function createNewRolePermit($data) {
		$id_role = $this->_mysqli->real_escape_string($data['id_role_mediastorage']);
		$id_permit = $this->_mysqli->real_escape_string($data['id_permit_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_role, id_permit)' .
			' VALUES (' . $id_role . ', ' . $id_permit . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewRolePermit: ' . $this->_mysqli->error : '',
		);
	}

	public function updateRolePermitWithId($data, $role_permit_id) {
		$id_role = $this->_mysqli->real_escape_string($data['id_role_mediastorage']);
		$id_permit = $this->_mysqli->real_escape_string($data['id_permit_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_role = ' . $id_role . ', id_permit = ' . $id_permit.
			' WHERE id = ' . $role_permit_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateRolePermitWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findRolePermitById($role_permit_id) {
		$role_permit_id = $this->_mysqli->real_escape_string($role_permit_id);

		$data = $this->_mysqli->query('SELECT id, id_role, id_permit' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $role_permit_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findRolePermitById: ' . $this->_mysqli->error : '',
		);
	}

	public function findRolePermitByRoleId($role_id) {
		$role_id = $this->_mysqli->real_escape_string($role_id);

		$data = $this->_mysqli->query('SELECT id, id_role, id_permit' .
									' FROM ' . $this->_table .
									' WHERE id_role = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findRolePermitById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteRolePermitById($role_permit_id) {
		$role_permit_id = $this->_mysqli->real_escape_string($role_permit_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $role_permit_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteRolePermitById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteRolePermitByRoleId($role_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_role = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteRolePermitByRoleId: ' . $this->_mysqli->error : '',
		);
	}
}