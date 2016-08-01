<?php

require_once('/CoreBundle/managers/UserManager.php');

class UserController {

	public $_userManager;

	public function __construct() {
		 $this->_userManager = new UserManager();
	}

	public function loginAction() {
		if (isset($_POST['id_login_mediastorage']) && (strcmp($_POST['id_login_mediastorage'], '98374') == 0)) {
			if ($this->_userManager->loginDb()) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/user/login.php');
	}

	public function logoutAction() {
		session_unset();

		header('Location:' . '?page=login');
	}

	public function createAction() {
		if (isset($_POST['id_user_create_mediastorage']) && (strcmp($_POST['id_user_create_mediastorage'], '98475') == 0)) {
			$errors_user_create = $this->_userManager->userCreateFormCheck();
			
			if (count($errors_user_create) == 0) {

				$errors_user_create = $this->_userManager->userCreateDb();

				if (count($errors_user_create) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		include ('CoreBundle/views/user/user_create.php');
	}

	public function dashboardAction() {
		echo 'LOGGED IN WITH : ' . $_SESSION['username_mediastorage'] . '<br /><a href="?page=logout">' . LOGOUT . '</a><br />
<a href="?page=create">' . USER_CREATION_TITLE . '</a>';
	}

}
