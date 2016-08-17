<?php

require_once('Model.php');

class GroupLanguage extends Model {

	public function __construct() {
		parent::__construct('group_language');
	}

	public function createNewGroupLanguage($data) {
		$id_group = $this->_mysqli->real_escape_string($data['id_group_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_group, id_language)' .
			' VALUES (' . $id_group . ', ' . $id_language . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewGroupLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function updateGroupLanguageWithId($data, $group_language_id) {
		$id_group = $this->_mysqli->real_escape_string($data['id_group_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_group = ' . $id_group . ', id_language = ' . $id_language.
			' WHERE id = ' . $group_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateGroupLanguageWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findGroupLanguageById($group_language_id) {
		$group_language_id = $this->_mysqli->real_escape_string($group_language_id);

		$data = $this->_mysqli->query('SELECT id, id_group, id_language' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $group_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findGroupLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function findGroupLanguageByGroupId($group_id) {
		$group_id = $this->_mysqli->real_escape_string($group_id);

		$data = $this->_mysqli->query('SELECT id, id_group, id_language' .
									' FROM ' . $this->_table .
									' WHERE id_group = ' . $group_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findGroupLanguageByGroupId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteGroupLanguageById($group_language_id) {
		$group_language_id = $this->_mysqli->real_escape_string($group_language_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $group_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteGroupLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteGroupLanguageByGroupId($group_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_group = ' . $group_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteGroupLanguageByGroupId: ' . $this->_mysqli->error : '',
		);
	}

	public function findGroupLanguageByOrganizationId($organization_id) {
		$data = $this->_mysqli->query('SELECT language.id, language.name, language.code FROM `group_language` JOIN organization ON group_language.id_group = organization.id_group JOIN language ON language.id = group_language.id_language WHERE organization.id =' . $organization_id
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findGroupLanguageByOrganizationId: ' . $this->_mysqli->error : '',
		);
	}
}