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

		$group['reference'] = $_POST['reference_group_mediastorage'];
		$group['name'] = $_POST['name_group_mediastorage'];
		$group['fileserver'] = $_POST['fileserver_mediastorage'];

		return $group;
	}

	public function groupCreateFormCheck() {
		$error_group = array();

		if (strlen($_POST['reference_group_mediastorage']) == 0) {
			$error_group[] = EMPTY_REFERENCE;
		}
		if (strlen($_POST['reference_group_mediastorage']) > 30) {
			$error_group[] = INVALID_REFERENCE_TOO_LONG;
		}

		if (strlen($_POST['name_group_mediastorage']) == 0) {
			$error_group[] = EMPTY_NAME;
		}
		if (strlen($_POST['name_group_mediastorage']) > 30) {
			$error_group[] = INVALID_NAME_TOO_LONG;
		}

		if (strlen($_POST['fileserver_mediastorage']) == 0) {
			$error_group[] = EMPTY_FILESERVER;
		}
		if (strlen($_POST['fileserver_mediastorage']) > 20) {
			$error_group[] = INVALID_FILESERVER_TOO_LONG;
		}


		return $error_group;
	}

	public function groupCreateDb() {
		$return_value = $this->_groupModel->findGroupByReference($_POST['reference_group_mediastorage']);

		if ($return_value['data']->num_rows != 0) {
			return array(
				'data' => false,
				'error' => DUPLICATE_REFERENCE,
			);
		}
		if (!empty($return_value['error'])) {
			return $return_value;
		}

		return $this->_groupModel->createNewGroup($_POST);
	}

	public function getGroupByIdDb($group_id) {
		return $this->_groupModel->findGroupById($group_id);
	}

	public function groupEditDb($group_data) {

		if (strcmp($group_data['reference'], $_POST['reference_group_mediastorage']) != 0) {

			$return_value = $this->_groupModel->findGroupByReference($_POST['reference_group_mediastorage']);

			if ($return_value['data']->num_rows != 0) {
				return array(
					'data' => false,
					'error' => DUPLICATE_REFERENCE,
				);
			}
			if (!empty($return_value['error'])) {
				return $return_value;
			}
		}

		return $this->_groupModel->updateGroupWithId($_POST, $group_data['id']);
	}

	public function removeGroupByIdDb($group_id) {
		// $data = $this->_groupLanguageManager->deleteGroupLanguageByGroupId($group_id);
		// if (!empty($data['error']))
		// 	return $data;

		return $this->_groupModel->deleteGroupById($group_id);
	}
}