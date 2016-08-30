<?php

require_once('CoreBundle/models/Mail.php');

class MailManager {

	private $_mailModel;

	public function __construct() {
		$this->_mailModel = new Mail();
	}

	public function getAllMailsWithMailLanguageAndLanguageDb() {
		return $this->_mailModel->findAllMailsWithMailLanguageAndLanguage();
	}

	public function getAllMailsDb() {
		return $this->_mailModel->findAllMails();
	}

	public function formatSelectOrganizationWithPostData() {
		$mail = array();

		$mail['id_organization'] = $_POST['id_organization_mediastorage'];

		return $mail;
	}

	public function getAllMailsWithOrganizationDb($id_organization) {
		return $this->_mailModel->findAllMailsWithOrganization($id_organization);
	}

	public function formatMailArrayWithPostData() {
		$mail = array();

		$mail['email'] = $_POST['mail_mediastorage'];
		$mail['id_organization'] = $_POST['id_organization_mediastorage'];

		return $mail;
	}

	public function mailCreateFormCheck() {
		$error_mail = array();

		if (strlen($_POST['mail_mediastorage']) == 0) {
			$error_mail[] = EMPTY_EMAIL;
		}
		if (strlen($_POST['mail_mediastorage']) > 50) {
			$error_mail[] = INVALID_EMAIL_TOO_LONG;
		}

		return $error_mail;
	}

	public function mailCreateDb() {
		return $this->_mailModel->createNewMail($_POST);
	}

	public function getMailByIdDb($mail_id) {
		return $this->_mailModel->findMailById($mail_id);
	}

	public function mailEditDb($mail_data) {
		return $this->_mailModel->updateMailWithId($_POST, $mail_data['id']);
	}

	public function removeMailByIdDb($mail_id) {
		return $this->_mailModel->deleteMailById($mail_id);
	}
}