<?php

require_once('CoreBundle/models/Maillist.php');

class MaillistManager {

	private $_maillistModel;

	public function __construct() {
		$this->_maillistModel = new Maillist();
	}

	public function getAllMaillistsWithMaillistLanguageAndLanguageDb() {
		return $this->_maillistModel->findAllMaillistsWithMaillistLanguageAndLanguage();
	}

	public function getAllMaillistsDb() {
		return $this->_maillistModel->findAllMaillists();
	}

	public function formatMaillistArrayWithPostData() {
		$maillist = array();

		$maillist['email'] = $_POST['email_mediastorage'];
		$maillist['id_organization'] = $_POST['id_organization_mediastorage'];

		return $maillist;
	}

	public function maillistCreateFormCheck() {
		$error_maillist = array();

		if (strlen($_POST['email_mediastorage']) == 0) {
			$error_maillist[] = EMPTY_EMAIL;
		}
		if (strlen($_POST['email_mediastorage']) > 50) {
			$error_maillist[] = INVALID_EMAIL_TOO_LONG;
		}

		return $error_maillist;
	}

	public function maillistCreateDb() {
		return $this->_maillistModel->createNewMaillist($_POST);
	}

	public function getMaillistByIdDb($maillist_id) {
		return $this->_maillistModel->findMaillistById($maillist_id);
	}

	public function maillistEditDb($maillist_data) {
		return $this->_maillistModel->updateMaillistWithId($_POST, $maillist_data['id']);
	}

	public function removeMaillistByIdDb($maillist_id) {
		return $this->_maillistModel->deleteMaillistById($maillist_id);
	}
}