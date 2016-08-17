<?php

require_once('CoreBundle/managers/GroupManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/GroupLanguageManager.php');

class GroupController {

	private $_groupManager;

	private $_errorArray;
	private $_languageManager;
	private $_organizationManager;
	private $_groupLanguageManager;


	public function __construct() {
		$this->_groupManager = new GroupManager();
		$this->_languageManager = new LanguageManager();
		$this->_organizationManager = new OrganizationManager();
		$this->_groupLanguageManager = new GroupLanguageManager();

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

	public function listAction() {
		$groups = $this->_groupManager->getAllGroupsDb();

		$this->mergeErrorArray($groups);

		$table_header = array(
				'<th>' . ID . '</th>',
				'<th>' . REFERENCE . '</th>',
				'<th>' . NAME . '</th>',
				'<th>' . FILESERVER . '</th>',
				'<th>' . NB_ORGANIZATION . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($group = $groups['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $group['id'] . '</td>',
					'<td>' . $group['reference'] . '</td>',
					'<td>' . $group['name'] . '</td>',
					'<td>' . $group['fileserver'] . '</td>',
					'<td>' . $group['organization_count'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_group_root&group_id=' . $group['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_group_root&group_id=' . $group['id'] . '" class="button_a delete">' . DELETE . '</a></td>',
				);
			}

		}

		$title = GROUP_LIST_TITLE;

		include ('RootBundle/views/group/group_list.php');
	}

	public function createAction() {
		$group = array();

		if (isset($_POST['id_group_create_mediastorage']) && (strcmp($_POST['id_group_create_mediastorage'], '87463975') == 0)) {

			$group = $this->_groupManager->formatGroupArrayWithPostData();
			$organization = $this->_organizationManager->formatOrganizationArrayWithPostData();
			$return_value['error'] = $this->_groupManager->groupCreateFormCheck();
			$this->mergeErrorArray($return_value);
			$return_value['error'] = $this->_organizationManager->organizationCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {

				$return_value = $this->_groupManager->groupCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$_POST['id_group_mediastorage'] = $return_value['id'];
					$return_value = $this->_organizationManager->organizationCreateDb();
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$return_value = $this->_groupLanguageManager->groupLanguageMultipleCreateDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {
							$_SESSION['flash_message'] = ACTION_SUCCESS;
							header('Location:' . '?page=list_group_root');
							exit;
						}
					}
				}
			}
		}

		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($languages);

		$selected_group_language[] = $_SESSION['id_language_mediastorage'];

		$title = GROUP_CREATION_TITLE;

		include ('RootBundle/views/group/group_create.php');
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

						$return_value = $this->_groupLanguageManager->groupLanguageMultipleUpdateByGroupIdDb($_GET['group_id']);
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {
							$_SESSION['flash_message'] = ACTION_SUCCESS;
							header('Location:' . '?page=list_group_root');
							exit;
						}
					}
				}

			}
		}

		$languages = $this->_languageManager->getAllLanguagesDb();
		$selected_group_language_data = $this->_groupLanguageManager->getGroupLanguageByGroupIdDb($_GET['group_id']);

		$this->mergeErrorArray($languages);
		$this->mergeErrorArray($selected_group_language_data);

		$selected_group_language = array();

		if (count($this->_errorArray) == 0) {
			while ($selected_group_language_temp = $selected_group_language_data['data']->fetch_assoc()) {
				$selected_group_language[] = $selected_group_language_temp['id_language'];
			}
		}

		$title = GROUP_EDIT_TITLE;

		include ('RootBundle/views/group/group_create.php');
	}

	public function deleteAction() {
		// if (isset($_GET['group_id'])) {

		// 	$return_value = $this->_organizationManager->removeOrganizationByGroupIdDb();
		// 	$this->mergeErrorArray($return_value);

		// 	if (count($this->_errorArray) == 0) {

		// 		$return_value = $this->_groupLanguageManager->removeGroupLanguageByGroupIdDb($_GET['group_id']);
		// 		$this->mergeErrorArray($return_value);

		// 		if (count($this->_errorArray) == 0) {

		// 			$return_value = $this->_groupManager->removeGroupByIdDb($_GET['group_id']);
		// 			$this->mergeErrorArray($return_value);

		// 			header('Location:' . '?page=dashboard');
		// 		}
		// 	}
		// }
		// else {
		// 	$error_id_not_found['error'] = ID_NOT_FOUND;
		// 	$this->mergeErrorArray($error_id_not_found);
		// }

		$title = GROUP_DELETE_TITLE;

		include ('RootBundle/views/common/error.php');
	}
}