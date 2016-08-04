<?php

require_once('Model.php');

class Sharelist extends Model {

	public function __construct() {
		parent::__construct('sharelist');
	}

	public function findAllSharelists() {
		$data = $this->_mysqli->query('SELECT id, id_user, reference ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllSharelists: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewSharelist($data) {
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$id_user = $this->_mysqli->real_escape_string($data['id_user_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(reference, id_user)' .
			' VALUES ("'. $reference . '", ' . $id_user . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewSharelist: ' . $this->_mysqli->error : '',
		);
	}

	public function updateSharelistWithId($data, $sharelist_id) {
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$id_user = $this->_mysqli->real_escape_string($data['id_user_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_user = ' . $id_user . ', reference = "' . $reference . '"' .
			' WHERE id = ' . $sharelist_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateSharelistWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findSharelistById($sharelist_id) {
		$sharelist_id = $this->_mysqli->real_escape_string($sharelist_id);

		$data = $this->_mysqli->query('SELECT id, reference, id_user' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $sharelist_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findSharelistById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteSharelistById($sharelist_id) {
		$sharelist_id = $this->_mysqli->real_escape_string($sharelist_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $sharelist_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteSharelistById: ' . $this->_mysqli->error : '',
		);
	}
}