<?php

require_once('CoreBundle/models/RolePermit.php');

class RolePermitManager {

	private $_rolePermitModel;

	public function __construct() {
		$this->_rolePermitModel = new RolePermit();
	}

	public function formatRolePermitArrayWithPostData() {
		$role_permit = array();

		$role_permit['id_role'] = $_POST['id_role_mediastorage'];
		$role_permit['id_permit'] = $_POST['id_permit_mediastorage'];

		return $role_permit;
	}

	public function rolePermitCreateFormCheck() {
		$error_role_permit = array();

		return $error_role_permit;
	}

	public function rolePermitCreateDb() {
		return $this->_rolePermitModel->createNewRolePermit($_POST);
	}

	public function rolePermitEditDb($role_permit_data) {
		return $this->_rolePermitModel->updateRolePermitWithId($_POST, $role_permit_data['id']);
	}

	public function getRolePermitByIdDb($role_permit_id) {
		return $this->_rolePermitModel->findRolePermitById($role_permit_id);
	}

	public function removeRolePermitByIdDb($role_permit_id) {
		return $this->_rolePermitModel->deleteRolePermitById($role_permit_id);
	}

	public function removeRolePermitByRoleIdDb($role_id) {
		return $this->_rolePermitModel->deleteRolePermitByRoleId($role_id);
	}
}

