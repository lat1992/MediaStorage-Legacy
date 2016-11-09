<?php

require_once('CoreBundle/managers/UserManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/RoleManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');

class ProfilePageController {

	private $_errorArray;

	private $_userManager;
	private $_organizationManager;
	private $_roleManager;
	private $_languageManager;
	private $_toolboxManager;
	private $_designManager;

	public function __construct() {
		$this->_userManager = new UserManager();
		$this->_organizationManager = new OrganizationManager();
		$this->_roleManager = new RoleManager();
		$this->_languageManager = new LanguageManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();

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

	public function profileAction() {

		$user_data = $this->_userManager->getUserByIdDb($_SESSION['user_id_mediastorage']);
		$user_info_data = $this->_userManager->getUserInfoByIdDb($_SESSION['user_id_mediastorage']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$roles = $this->_roleManager->getAllRolesDb();
		$languages = $this->_languageManager->getAllLanguagesByGroupDb();

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
						$_SESSION['language_mediastorage'] = $this->_languageManager->getLanguageCodeByIdDb($_POST['id_language_mediastorage']);
						$_SESSION['id_language_mediastorage'] = $_POST['id_language_mediastorage'];

						$_SESSION['flash_message'] = ACTION_SUCCESS;
						header('Location:' . '?page=profile');
						exit;
					}
				}
			}

			$user = array_merge($user, $user_info);

		}

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title['title'] = PROFILE;

		include ('ClientBundle/views/profile/profile.php');
	}
}