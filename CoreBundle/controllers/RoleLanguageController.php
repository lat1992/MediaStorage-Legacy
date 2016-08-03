<?php

require_once('CoreBundle/managers/RoleLanguageManager.php');
require_once('CoreBundle/managers/RoleManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class RoleLanguageController {

	private $_roleLanguageManager;
	private $_roleManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_roleLanguageManager = new RoleLanguageManager();
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

	public function createAction() {
		$role = array();

		if (isset($_POST['id_role_language_create_mediastorage']) && (strcmp($_POST['id_role_language_create_mediastorage'], '12646') == 0)) {
			$role = $this->_roleLanguageManager->formatRoleLanguageArrayWithPostData();
			$return_value['error'] = $this->_roleLanguageManager->roleLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_roleLanguageManager->roleLanguageCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$roles = $this->_roleManager->getAllRolesDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/role/role_language_create.php');
	}

	public function editAction() {
		$role_language_data = $this->_roleLanguageManager->getRoleLanguageByIdDb($_GET['role_language_id']);
		$roles = $this->_roleManager->getAllRolesDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($role_language_data);
		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($languages);

		while ($role_language_data_temp = $role_language_data['data']->fetch_assoc()) {
			$role_language = $role_language_data_temp;
		}

		if (isset($_POST['id_role_language_create_mediastorage']) && (strcmp($_POST['id_role_language_create_mediastorage'], '12646') == 0)) {
			$return_value['error'] = $this->_roleLanguageManager->roleLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_roleLanguageManager->roleLanguageEditDb($role_language);
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}

		}

		include ('CoreBundle/views/role/role_language_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['role_language_id'])) {

			$return_value = $this->_roleLanguageManager->removeRoleLanguageByIdDb($_GET['role_language_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		header('Location:' . '?page=dashboard');
	}
}