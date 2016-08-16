<?php

require_once('Model.php');

class RoleLanguage extends Model {

	public function __construct() {
		parent::__construct('role_language');
	}

	public function createNewRoleLanguage($data) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_role = $this->_mysqli->real_escape_string($data['id_role_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(data, id_role, id_language)' .
			' VALUES ("'. $data_media . '", ' . $id_role . ', ' . $id_language . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewRoleLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function updateRoleLanguageWithId($data, $role_language_id) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_role = $this->_mysqli->real_escape_string($data['id_role_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_role = ' . $id_role . ', data = "' . $data_media . '", id_language = ' . $id_language.
			' WHERE id = ' . $role_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateRoleLanguageWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findRoleLanguageById($role_language_id) {
		$role_language_id = $this->_mysqli->real_escape_string($role_language_id);

		$data = $this->_mysqli->query('SELECT id, data, id_role, id_language' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $role_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findRoleLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function findRoleLanguageByRoleId($role_id) {
		$role_id = $this->_mysqli->real_escape_string($role_id);

		$data = $this->_mysqli->query('SELECT id, data, id_role, id_language' .
									' FROM ' . $this->_table .
									' WHERE id_role = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findRoleLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteRoleLanguageById($role_language_id) {
		$role_language_id = $this->_mysqli->real_escape_string($role_language_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $role_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteRoleLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteRoleLanguageByRoleId($role_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_role = ' . $role_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteRoleLanguageByRoleId: ' . $this->_mysqli->error : '',
		);
	}
}