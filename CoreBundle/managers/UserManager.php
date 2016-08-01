<?php

require_once('/CoreBundle/models/User.php');

require_once('/CoreBundle/managers/LanguageManager.php');

class UserManager {

	private $_userModel;

	private $_languageManager;

	public function __construct() {
		$this->_userModel = new User();

		$this->_languageManager = new LanguageManager();
	}

	public function loginDb() {
		$result = $this->_userModel->findUserByUsernameAndPassword($_POST['username_mediastorage'], $_POST['password_mediastorage']);

		if ($result !== false) {
			$_SESSION['username_mediastorage'] = $result['username'];
			$_SESSION['role_mediastorage'] = $result['id_role'];
			$_SESSION['language_mediastorage'] = $this->_languageManager->getLanguageCodeByIdDb($result['id_language']);
	 		return true;
 		}

 		return false;
	}

	public function userCreateFormCheck() {
		$errors_user_create = array();

		if (strlen($_POST['username_mediastorage']) == 0) {
			$errors_user_create[] = EMPTY_USERNAME;
		}
		if (strlen($_POST['username_mediastorage']) > 20) {
			$errors_user_create[] = INVALID_USERNAME_TOO_LONG;
		}
		if (strlen($_POST['password_mediastorage']) == 0) {
			$errors_user_create[] = EMPTY_PASSWORD;
		}
		if (strcmp($_POST['password_mediastorage'], $_POST['password_mediastorage_bis']) != 0) {
			$errors_user_create[] = PASSWORD_NOT_MATCH;
		}

		return $errors_user_create;
	}

	public function userCreateDb() {
		$errors_user_create = array();

		if (!$this->_userModel->createNewUser($_POST['username_mediastorage'], $_POST['password_mediastorage'])) {
			$errors_user_create[] = USER_CREATION_DATABASE_ERROR;
		}

		return $errors_user_create;
	}

}