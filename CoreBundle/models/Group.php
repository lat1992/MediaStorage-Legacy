<?php

require_once('Model.php');

class Group extends Model {

	public function __construct() {
		parent::__construct('group');
	}

	public function findAllGroups() {
		$data = $this->_mysqli->query('SELECT grp.id, grp.reference, grp.name, grp.fileserver, COUNT(distinct organization.id) AS organization_count' .
			' FROM `' . $this->_table . '` grp' .
			' LEFT JOIN organization ON grp.id = organization.id_group ' .
			' GROUP BY grp.id ' .
			';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllGroups: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewGroup($data) {
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);
		$fileserver = $this->_mysqli->real_escape_string($data['fileserver_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO `' . $this->_table . '`(reference, name, fileserver)' .
			' VALUES ("'. $reference . '", "' . $name . '","' . $fileserver . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewGroup: ' . $this->_mysqli->error : '',
		);
	}

	public function updateGroupWithId($data, $group_id) {
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$name = $this->_mysqli->real_escape_string($data['name_mediastorage']);
		$fileserver = $this->_mysqli->real_escape_string($data['fileserver_mediastorage']);

		$data = $this->_mysqli->query('UPDATE `' . $this->_table .
			'` SET fileserver = "' . $id_group . '", reference = "' . $reference . '", name="' . $name .
			'" WHERE id = ' . $group_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateGroupWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findGroupById($group_id) {
		$group_id = $this->_mysqli->real_escape_string($group_id);

		$data = $this->_mysqli->query('SELECT id, reference, name, fileserver' .
									' FROM `' . $this->_table .
									'` WHERE id = ' . $group_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findGroupById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteGroupById($group_id) {
		$group_id = $this->_mysqli->real_escape_string($group_id);

		$data = $this->_mysqli->query('DELETE FROM `' . $this->_table .
			'` WHERE id = ' . $group_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteGroupById: ' . $this->_mysqli->error : '',
		);
	}
}