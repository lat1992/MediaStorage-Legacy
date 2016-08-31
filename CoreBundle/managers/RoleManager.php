<?php

require_once('CoreBundle/models/Role.php');

require_once('CoreBundle/managers/RoleLanguageManager.php');

class RoleManager {

	private $_roleModel;

	private $_roleLanguageManager;

	public function __construct() {
		$this->_roleModel = new Role();

		$this->_roleLanguageManager = new RoleLanguage();
	}

	public function getAllRolesWithRoleLanguageAndLanguageDb() {
		return $this->_roleModel->findAllRolesWithRoleLanguageAndLanguage();
	}

	public function formatSelectOrganizationWithPostData() {
		$role = array();

		$role['id_organization'] = $_POST['id_organization_mediastorage'];

		return $role;
	}

	public function getAllRolesWithOrganizationDb($id_organization) {
		return $this->_roleModel->findAllRolesWithOrganization($id_organization);
	}

	public function getAllRolesDb() {
		return $this->_roleModel->findAllRoles();
	}

	public function formatRoleArrayWithPostData() {
		$role = array();

		$role['role'] = $_POST['role_mediastorage'];
		$role['id_organization'] = $_POST['id_organization_mediastorage'];

		return $role;
	}

	public function roleCreateFormCheck() {
		$error_role = array();

		if (strlen($_POST['role_mediastorage']) == 0) {
			$error_role[] = EMPTY_ROLE;
		}
		if (strlen($_POST['role_mediastorage']) > 30) {
			$error_role[] = INVALID_ROLE_TOO_LONG;
		}

		return $error_role;
	}

	public function roleCreateDb() {
		return $this->_roleModel->createNewRole($_POST);
	}

	public function getRoleByIdDb($role_id) {
		return $this->_roleModel->findRoleById($role_id);
	}

	public function roleEditDb($role_data) {
		return $this->_roleModel->updateRoleWithId($_POST, $role_data['id']);
	}

	public function removeRoleByIdDb($role_id) {
		$data = $this->_roleLanguageManager->deleteRoleLanguageByRoleId($role_id);
		if (!empty($data['error']))
			return $data;

		return $this->_roleModel->deleteRoleById($role_id);
	}
}