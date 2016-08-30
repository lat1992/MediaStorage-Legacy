<?php

require_once('Model.php');

class Mail extends Model {

	public function __construct() {
		parent::__construct('mail');
	}

	public function findAllMails() {
		$data = $this->_mysqli->query('SELECT mail.id, mail.email, mail.id_organization, organization.name AS organization_name' .
			' FROM ' . $this->_table .
			' JOIN `organization` ON mail.id_organization = organization.id' .
			';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMails: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllMailsWithOrganization($id_organization) {
		$data = $this->_mysqli->query('SELECT mail.id, mail.email, mail.id_organization, organization.name AS organization_name' .
			' FROM ' . $this->_table .
			' JOIN `organization` ON mail.id_organization = organization.id' .
			' WHERE mail.id_organization = '. $id_organization .
			';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMails: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMail($data) {
		$email = $this->_mysqli->real_escape_string($data['mail_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(email, id_organization)' .
			' VALUES ("'. $email . '", ' . $id_organization . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMail: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMailWithId($data, $mail_id) {
		$email = $this->_mysqli->real_escape_string($data['mail_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', email = "' . $email . '"' .
			' WHERE id = ' . $mail_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMailWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMailById($mail_id) {
		$mail_id = $this->_mysqli->real_escape_string($mail_id);

		$data = $this->_mysqli->query('SELECT id, email, id_organization' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $mail_id . ';'
		);
		$tmp = $data->fetch_assoc();
		$data->data_seek(0);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMailById: ' . $this->_mysqli->error : '',
			'id_organization' => $tmp['id_organization'],
		);
	}

	public function deleteMailById($mail_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $mail_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMailById: ' . $this->_mysqli->error : '',
		);
	}
}