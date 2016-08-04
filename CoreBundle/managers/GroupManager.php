<?php

require_once('CoreBundle/models/Group.php');

class GroupManager {

	private $_groupModel;

	public function __construct() {
		$this->_groupModel = new Group();
	}

	public function getAllGroupsDb() {
		return $this->_groupModel->findAllGroups();
	}

	public function formatGroupArrayWithPostData() {
		$group = array();

		$group['reference'] = $_POST['reference_mediastorage'];
		$group['name'] = $_POST['name_mediastorage'];
		$group['fileserver'] = $_POST['fileserver_mediastorage'];

		return $group;
	}

	public function groupCreateFormCheck() {
		$error_group = array();

		if (strlen($_POST['reference_mediastorage']) == 0) {
			$error_group[] = EMPTY_REFERENCE;
		}
		if (strlen($_POST['reference_mediastorage']) > 30) {
			$error_group[] = INVALID_REFERENCE_TOO_LONG;
		}

		if (strlen($_POST['name_mediastorage']) == 0) {
			$error_group[] = EMPTY_NAME;
		}
		if (strlen($_POST['name_mediastorage']) > 30) {
			$error_group[] = INVALID_NAME_TOO_LONG;
		}

		if (strlen($_POST['fileserver_mediastorage']) == 0) {
			$error_group[] = EMPTY_NAME;
		}
		if (strlen($_POST['fileserver_mediastorage']) > 30) {
			$error_group[] = INVALID_NAME_TOO_LONG;
		}


		return $error_group;
	}

	public function groupCreateDb() {
		return $this->_groupModel->createNewGroup($_POST);
	}

	public function getGroupByIdDb($group_id) {
		return $this->_groupModel->findGroupById($group_id);
	}

	public function groupEditDb($group_data) {
		return $this->_groupModel->updateGroupWithId($_POST, $group_data['id']);
	}

	public function removeGroupByIdDb($group_id) {
		// $data = $this->_groupLanguageManager->deleteGroupLanguageByGroupId($group_id);
		// if (!empty($data['error']))
		// 	return $data;

		return $this->_groupModel->deleteGroupById($group_id);
	}
}