<?php

require_once('CoreBundle/managers/UserManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/RoleManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class UserController {

	private $_userManager;
	private $_organizationManager;
	private $_roleManager;

	private $_errorArray;

	public function __construct() {
		 $this->_userManager = new UserManager();
		 $this->_organizationManager = new OrganizationManager();
		 $this->_roleManager = new RoleManager();
		 $this->_languageManager = new LanguageManager();

		 $this->_errorArray = array();
	}

	private function mergeErrorArray($errorArray) {
		if (!empty($errorArray['error'])) {
			if (!is_array($errorArray['error'])) {
				$data_array[] = $errorArray['error'];
			}
			else {
				$data_array = $errorArray['error'];
			}
			$this->_errorArray = array_merge ($this->_errorArray, $data_array);
		}
	}

	public function loginAction() {
		if (isset($_POST['id_login_mediastorage']) && (strcmp($_POST['id_login_mediastorage'], '98374') == 0)) {

			$return_value = $this->_userManager->loginDb();
			$this->mergeErrorArray($return_value);

			if ($return_value['data']) {
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
		$user = array();

		if (isset($_POST['id_user_create_mediastorage']) && (strcmp($_POST['id_user_create_mediastorage'], '98475') == 0)) {
			$user = $this->_userManager->formatUserArrayWithPostData();
			$return_value['error'] = $this->_userManager->userCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {

				$return_value = $this->_userManager->userCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$roles = $this->_roleManager->getAllRolesDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/user/user_create.php');
	}

	public function listAction() {
		$users = $this->_userManager->getAllUsersDb();
		$organizations_data = $this->_organizationManager->getAllOrganizationsDb();
		$roles_data = $this->_roleManager->getAllRolesDb();

		$this->mergeErrorArray($users);
		$this->mergeErrorArray($organizations_data);
		$this->mergeErrorArray($roles_data);

		while ($organizations_data_temp = $organizations_data['data']->fetch_assoc()) {
			$organizations[] = $organizations_data_temp;
		}

		while ($roles_data_temp = $roles_data['data']->fetch_assoc()) {
			$roles[] = $roles_data_temp;
		}

		include ('CoreBundle/views/user/user_list.php');
	}

	public function editAction() {

		$user_data = $this->_userManager->getUserByIdDb($_GET['user_id']);
		$user_info_data = $this->_userManager->getUserInfoByIdDb($_GET['user_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$roles = $this->_roleManager->getAllRolesDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($user_data);
		$this->mergeErrorArray($user_info_data);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($user_data_temp = $user_data['data']->fetch_assoc()) {
				$user = $user_data_temp;
			}

			while ($user_info_data_temp = $user_info_data['data']->fetch_assoc()) {
				$user_info = $user_info_data_temp;
			}

			if (isset($_POST['id_user_create_mediastorage']) && (strcmp($_POST['id_user_create_mediastorage'], '98475') == 0)) {

				$return_value['error'] = $this->_userManager->userEditFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$return_value = $this->_userManager->userEditDb($user);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}
			}

			$user = array_merge($user, $user_info);

		}

		include ('CoreBundle/views/user/user_edit.php');
	}

	public function deleteAction() {

		if (isset($_GET['user_id'])) {

			$return_value = $this->_userManager->removeUserByIdDb($_GET['user_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}

	public function dashboardAction() {
		echo 'LOGGED IN WITH : ' . $_SESSION['username_mediastorage'] . '<br />';

		include ('CoreBundle/views/layout/menu.php');
	}

}
