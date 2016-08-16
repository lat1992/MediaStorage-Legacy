<?php

require_once('CoreBundle/models/GroupLanguage.php');

class GroupLanguageManager {

	private $_groupLanguageModel;

	public function __construct() {
		$this->_groupLanguageModel = new GroupLanguage();
	}

	public function formatGroupLanguageArrayWithPostData() {
		$group = array();

		$group['id_group'] = $_POST['id_group_mediastorage'];
		$group['id_language'] = $_POST['id_language_mediastorage'];

		return $group;
	}

	public function groupLanguageCreateFormCheck() {
		$error_group_language = array();

		return $error_group_language;
	}

	public function groupLanguageCreateDb() {
		return $this->_groupLanguageModel->createNewGroupLanguage($_POST);
	}

	public function groupLanguageMultipleCreateDb() {

		foreach ($_POST['id_language_mediastorage'] as $id_language) {
			$data['id_language_mediastorage'] = $id_language;
			$data['id_group_mediastorage'] = $_POST['id_group_mediastorage'];

			$return_value = $this->_groupLanguageModel->createNewGroupLanguage($data);
			if (!empty($return_value['error']))
				return $return_value;
		}

		return $return_value;
	}

	public function groupLanguageEditDb($group_language_data) {
		return $this->_groupLanguageModel->updateGroupLanguageWithId($_POST, $group_language_data['id']);
	}

	public function getGroupLanguageByIdDb($group_language_id) {
		return $this->_groupLanguageModel->findGroupLanguageById($group_language_id);
	}

	public function getGroupLanguageByGroupIdDb($group_id) {
		return $this->_groupLanguageModel->findGroupLanguageByGroupId($group_id);
	}

	public function removeGroupLanguageByIdDb($group_language_id) {
		return $this->_groupLanguageModel->deleteGroupLanguageById($group_language_id);
	}

	public function removeGroupLanguageByGroupIdDb($group_id) {
		return $this->_groupLanguageModel->deleteGroupLanguageByGroupId($group_id);
	}

	public function groupLanguageMultipleUpdateByGroupIdDb($group_id) {
		$return_value = $this->_groupLanguageModel->deleteGroupLanguageByGroupId($group_id);
		if (!empty($return_value['error'])) {
			return $return_value;
		}

		$_POST['id_group_mediastorage'] = $group_id;

		return $this->groupLanguageMultipleCreateDb();
	}
}

