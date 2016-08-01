<?php

require_once('/CoreBundle/models/User.php');

class UserManager {

	private $_userModel;

	public function __construct() {
		$this->_userModel = new User();
	}

	public function loginDb() {
		$result = $this->_userModel->findUserByUsernameAndPassword($_POST['username_mediastorage'], $_POST['password_mediastorage']);

		if ($result->num_rows == 1) {
			while ($row = $result->fetch_assoc()) {
				$_SESSION['username_mediastorage'] = $row['username'];
				$_SESSION['role_mediastorage'] = 'TEMP';				
			}

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