<?php

require_once('CoreBundle/managers/GroupManager.php');

class GroupController {

	private $_groupManager;

	private $_errorArray;

	public function __construct() {
		$this->_groupManager = new GroupManager();

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

	// public function listAction() {
	// 	$groups = $this->_groupManager->getAllGroupsDb();

	// 	$this->mergeErrorArray($groups);

	// 	include ('CoreBundle/views/group/group_list.php');
	// }

	public function createAction() {
		$group = array();

		if (isset($_POST['id_group_create_mediastorage']) && (strcmp($_POST['id_group_create_mediastorage'], '87463975') == 0)) {
			$group = $this->_groupManager->formatGroupArrayWithPostData();
			$return_value['error'] = $this->_groupManager->groupCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_groupManager->groupCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		include ('CoreBundle/views/group/group_create.php');
	}

	public function editAction() {
		$group_data = $this->_groupManager->getGroupByIdDb($_GET['group_id']);

		$this->mergeErrorArray($group_data);

		if (count($this->_errorArray) == 0) {

			while ($group_data_temp = $group_data['data']->fetch_assoc()) {
				$group = $group_data_temp;
			}

			if (isset($_POST['id_group_create_mediastorage']) && (strcmp($_POST['id_group_create_mediastorage'], '87463975') == 0)) {
				$return_value['error'] = $this->_groupManager->groupCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_groupManager->groupEditDb($group);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}
		}

		include ('CoreBundle/views/group/group_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['group_id'])) {

			$return_value = $this->_groupManager->removeGroupByIdDb($_GET['group_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}