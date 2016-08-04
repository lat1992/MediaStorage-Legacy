<?php

require_once('CoreBundle/managers/RoleManager.php');
require_once('CoreBundle/managers/PermitManager.php');
require_once('CoreBundle/managers/RolePermitManager.php');

class RolePermitController {

	private $_errorArray;

	private $_roleManager;
	private $_permitManager;
	private $_rolePermitManager;

	public function __construct() {
		$this->_errorArray = array();

		$this->_roleManager = new RoleManager();
		$this->_permitManager = new PermitManager();
		$this->_rolePermitManager = new RolePermitManager();
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

		if (isset($_POST['id_role_permit_create_mediastorage']) && (strcmp($_POST['id_role_permit_create_mediastorage'], '7645') == 0)) {
			$role_permit = $this->_rolePermitManager->formatRolePermitArrayWithPostData();
			$return_value['error'] = $this->_rolePermitManager->rolePermitCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_rolePermitManager->rolePermitCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$roles = $this->_roleManager->getAllRolesDb();
		$permits = $this->_permitManager->getAllPermitsDb();

		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($permits);

		include ('CoreBundle/views/role/role_permit_create.php');
	}

	public function editAction() {
		$role_permit_data = $this->_rolePermitManager->getRolePermitByIdDb($_GET['role_permit_id']);
		$roles = $this->_roleManager->getAllRolesDb();
		$permits = $this->_permitManager->getAllPermitsDb();

		$this->mergeErrorArray($role_permit_data);
		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($permits);

		while ($role_permit_data_temp = $role_permit_data['data']->fetch_assoc()) {
			$role_permit = $role_permit_data_temp;
		}

		if (isset($_POST['id_role_permit_create_mediastorage']) && (strcmp($_POST['id_role_permit_create_mediastorage'], '7645') == 0)) {
			$return_value['error'] = $this->_rolePermitManager->rolePermitCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_rolePermitManager->rolePermitEditDb($role_permit);
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}

		}

		include ('CoreBundle/views/role/role_permit_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['role_permit_id'])) {

			$return_value = $this->_rolePermitManager->removeRolePermitByIdDb($_GET['role_permit_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}