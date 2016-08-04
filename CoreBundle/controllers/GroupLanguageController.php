<?php

require_once('CoreBundle/managers/GroupLanguageManager.php');
require_once('CoreBundle/managers/GroupManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class GroupLanguageController {

	private $_groupLanguageManager;
	private $_groupManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_groupLanguageManager = new GroupLanguageManager();
		$this->_groupManager = new GroupManager();
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

	public function createAction() {
		$group = array();

		if (isset($_POST['id_group_language_create_mediastorage']) && (strcmp($_POST['id_group_language_create_mediastorage'], '12646') == 0)) {
			$group_language = $this->_groupLanguageManager->formatGroupLanguageArrayWithPostData();
			$return_value['error'] = $this->_groupLanguageManager->groupLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_groupLanguageManager->groupLanguageCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$groups = $this->_groupManager->getAllGroupsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($groups);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/group/group_language_create.php');
	}

	public function editAction() {
		$group_language_data = $this->_groupLanguageManager->getGroupLanguageByIdDb($_GET['group_language_id']);
		$groups = $this->_groupManager->getAllGroupsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($group_language_data);
		$this->mergeErrorArray($groups);
		$this->mergeErrorArray($languages);

		while ($group_language_data_temp = $group_language_data['data']->fetch_assoc()) {
			$group_language = $group_language_data_temp;
		}

		if (isset($_POST['id_group_language_create_mediastorage']) && (strcmp($_POST['id_group_language_create_mediastorage'], '12646') == 0)) {
			$return_value['error'] = $this->_groupLanguageManager->groupLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_groupLanguageManager->groupLanguageEditDb($group_language);
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}

		}

		include ('CoreBundle/views/group/group_language_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['group_language_id'])) {

			$return_value = $this->_groupLanguageManager->removeGroupLanguageByIdDb($_GET['group_language_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}