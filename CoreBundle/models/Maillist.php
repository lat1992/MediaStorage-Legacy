<?php

require_once('Model.php');

class Maillist extends Model {

	public function __construct() {
		parent::__construct('maillist');
	}

	public function findAllMaillists() {
		$data = $this->_mysqli->query('SELECT id, email, id_organization ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMaillists: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMaillist($data) {
		$email = $this->_mysqli->real_escape_string($data['email_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(email, id_organization)' .
			' VALUES ("'. $email . '", ' . $id_organization . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMaillist: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMaillistWithId($data, $maillist_id) {
		$email = $this->_mysqli->real_escape_string($data['email_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', email = "' . $email . '"' .
			' WHERE id = ' . $maillist_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMaillistWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMaillistById($maillist_id) {
		$maillist_id = $this->_mysqli->real_escape_string($maillist_id);

		$data = $this->_mysqli->query('SELECT id, email, id_organization' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $maillist_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMaillistById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMaillistById($maillist_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $maillist_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMaillistById: ' . $this->_mysqli->error : '',
		);
	}
}