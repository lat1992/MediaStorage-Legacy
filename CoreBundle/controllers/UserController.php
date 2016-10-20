<?php

require_once('CoreBundle/managers/UserManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/OrganizationTextManager.php');
require_once('CoreBundle/managers/RoleManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');

class UserController {

	private $_userManager;
	private $_designManager;
	private $_organizationManager;
	private $_organizationTextManager;
	private $_roleManager;
	private $_languageManager;
	private $_toolboxManager;

	private $_errorArray;

	public function __construct() {
		 $this->_userManager = new UserManager();
		 $this->_designManager = new DesignManager();
		 $this->_organizationManager = new OrganizationManager();
		 $this->_organizationTextManager = new OrganizationTextManager();
		 $this->_roleManager = new RoleManager();
		 $this->_languageManager = new LanguageManager();
		 $this->_toolboxManager = new ToolBoxManager();

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
				header('Location:' . '?page=home');
			}
		}

		if(isset($_GET['platform'])) {
			$organization = $this->_organizationManager->getOrganizationWithReference($_GET['platform']);
			$this->mergeErrorArray($organization);
			if (count($this->_errorArray) == 0) {
				$result = $organization['data']->fetch_assoc();
				$_SESSION['id_platform_organization'] = $result['id'];
				if (isset($result['id_default_language']))
					$_SESSION['id_language_mediastorage'] = $result['id_default_language'];
			}
			if (isset($_SESSION['id_language_mediastorage'])) {
				$organization = $this->_organizationTextManager->getOrganizationTextWithId($_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage']);
				$this->mergeErrorArray($organization);
				if (count($this->_errorArray) == 0) {
					$text = $organization['data']->fetch_assoc();
				}
			}
		}
		else {
			header ('Location:' . 'http://www.capitalvision.fr');
		}

		if (isset($_SESSION['id_platform_organization'])) {
			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('ClientBundle/views/login/login.php');
	}

	public function logoutAction() {
		session_unset();
		header('Location:' . '?page=login');
	}

	public function forgotPassewordAction() {
		if(isset($_GET['platform'])) {
			$organization = $this->_organizationManager->getOrganizationWithReference($_GET['platform']);
			$this->mergeErrorArray($organization);
			if (count($this->_errorArray) == 0) {
				$result = $organization['data']->fetch_assoc();
				$_SESSION['id_platform_organization'] = $result['id'];
				if (isset($result['id_default_language']))
					$_SESSION['id_language_mediastorage'] = $result['id_default_language'];
			}
			if (isset($_SESSION['id_language_mediastorage'])) {
				$organization = $this->_organizationTextManager->getOrganizationTextWithId($_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage']);
				$this->mergeErrorArray($organization);
				if (count($this->_errorArray) == 0) {
					$text = $organization['data']->fetch_assoc();
				}
			}
		}
		if (isset($_SESSION['id_platform_organization'])) {
			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}
		if (isset($_GET['token'])) {
			if ((strcmp($_POST['id_login_mediastorage'], '98374') == 0)) {
				
			}
		}
		include('CoreBundle/views/user/user_forgot_password.php');
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

					$return_value = $this->_userManager->userEditDbAsAdmin($user);
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
