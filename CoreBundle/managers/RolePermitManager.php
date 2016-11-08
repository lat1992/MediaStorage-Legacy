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

	public function rolePermitMultipleCreateDb() {
		if (isset($_POST['id_permit_mediastorage']) && !is_array($_POST['id_permit_mediastorage']) && $_POST['id_permit_mediastorage'])
			$_POST['id_permit_mediastorage'][] = $_POST['id_permit_mediastorage'];
		foreach ($_POST['id_permit_mediastorage'] as $id_permit) {
			$data['id_permit_mediastorage'] = $id_permit;
			$data['id_role_mediastorage'] = $_POST['id_role_mediastorage'];

			$return_value = $this->_rolePermitModel->createNewRolePermit($data);
			if (!empty($return_value['error']))
				return $return_value;
		}

		return $return_value;
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

	public function rolePermitMultipleUpdateByRoleIdDb($role_id) {
		$return_value = $this->_rolePermitModel->deleteRolePermitByRoleId($role_id);
		if (!empty($return_value['error'])) {
			return $return_value;
		}

		$_POST['id_role_mediastorage'] = $role_id;

		return $this->rolePermitMultipleCreateDb();
	}

	public function getRolePermitByRoleIdDb($role_id) {
		return $this->_rolePermitModel->findRolePermitByRoleId($role_id);
	}
}

