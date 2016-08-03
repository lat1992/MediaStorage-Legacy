<?php

require_once('CoreBundle/managers/RoleManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class RoleController {

	private $_roleManager;
	private $_organizationManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_roleManager = new RoleManager();
		$this->_organizationManager = new OrganizationManager();
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

	public function listAction() {
		$roles = $this->_roleManager->getAllRolesWithRoleLanguageAndLanguageDb();

		$this->mergeErrorArray($roles);

		include ('CoreBundle/views/role/role_list.php');
	}

	public function createAction() {
		$role = array();

		if (isset($_POST['id_role_create_mediastorage']) && (strcmp($_POST['id_role_create_mediastorage'], '984156') == 0)) {
			$role = $this->_roleManager->formatRoleArrayWithPostData();
			$return_value['error'] = $this->_roleManager->roleCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_roleManager->roleCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$this->mergeErrorArray($organizations);

		include ('CoreBundle/views/role/role_create.php');
	}

	public function editAction() {
		$role_data = $this->_roleManager->getRoleByIdDb($_GET['role_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($role_data);
		$this->mergeErrorArray($organizations);

		while ($role_data_temp = $role_data['data']->fetch_assoc()) {
			$role = $role_data_temp;
		}

		if (isset($_POST['id_role_create_mediastorage']) && (strcmp($_POST['id_role_create_mediastorage'], '984156') == 0)) {
			$return_value['error'] = $this->_roleManager->roleCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_roleManager->roleEditDb($role);
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}

		}

		include ('CoreBundle/views/role/role_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['role_id'])) {

			$return_value = $this->_roleManager->removeRoleByIdDb($_GET['role_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		header('Location:' . '?page=dashboard');
	}
}