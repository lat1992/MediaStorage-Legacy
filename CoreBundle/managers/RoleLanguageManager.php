<?php

require_once('CoreBundle/models/RoleLanguage.php');

class RoleLanguageManager {

	private $_roleLanguageModel;

	public function __construct() {
		$this->_roleLanguageModel = new RoleLanguage();
	}

	public function formatRoleLanguageArrayWithPostData() {
		$role = array();

		$role['data'] = $_POST['data_mediastorage'];
		$role['id_role'] = $_POST['id_role_mediastorage'];
		$role['id_language'] = $_POST['id_language_mediastorage'];

		return $role;
	}

	public function roleLanguageCreateFormCheck() {
		$error_role_language = array();

		if (strlen($_POST['data_mediastorage']) == 0) {
			$error_role_language[] = EMPTY_DATA;
		}
		if (strlen($_POST['data_mediastorage']) > 100) {
			$error_role_language[] = INVALID_DATA_TOO_LONG;
		}

		return $error_role_language;
	}

	public function roleLanguageCreateDb() {
		return $this->_roleLanguageModel->createNewRoleLanguage($_POST);
	}

	public function roleLanguageEditDb($role_language_data) {
		return $this->_roleLanguageModel->updateRoleLanguageWithId($_POST, $role_language_data['id']);
	}

	public function getRoleLanguageByIdDb($role_language_id) {
		return $this->_roleLanguageModel->findRoleLanguageById($role_language_id);
	}

	public function removeRoleLanguageByIdDb($role_language_id) {
		return $this->_roleLanguageModel->deleteRoleLanguageById($role_language_id);
	}

	public function removeRoleLanguageByRoleIdDb($role_id) {
		return $this->_roleLanguageModel->deleteRoleLanguageByRoleId($role_id);
	}

	public function getRoleLanguageByRoleIdDb($role_id) {
		return $this->_roleLanguageModel->findRoleLanguageByRoleId($role_id);
	}
}

