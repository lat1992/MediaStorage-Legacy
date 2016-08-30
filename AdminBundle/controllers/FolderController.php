<?php

require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/FolderLanguageManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class FolderController {

	private $_folderManager;
	private $_folderLanguageManager;
	private $_organizationManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_folderManager = new FolderManager();
		$this->_folderLanguageManager = new FolderLanguageManager();
		$this->_organizationManager = new OrganizationManager();
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

	public function listAction() {
		$folders = $this->_folderManager->getAllFoldersDb();

		$this->mergeErrorArray($folders);

		$table_header = array(
				'<th>' . NAME . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($folder = $folders['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $folder['translate'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_folder_admin&folder_id=' . $folder['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_folder_admin&folder_id=' . $folder['id'] . '" class="button_a delete">' . DELETE . '</a></td>',
				);
			}

		}

		$title = FOLDER_LIST_TITLE;

		include ('AdminBundle/views/folder/folder_list.php');
	}

	public function createAction() {
		$folder = array();

		if (isset($_POST['id_folder_create_mediastorage']) && (strcmp($_POST['id_folder_create_mediastorage'], '984156') == 0)) {

			$folder = $this->_folderManager->formatFolderArrayWithPostData();
			$return_value['error'] = $this->_folderManager->folderCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_folderManager->folderCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$_POST['id_folder_mediastorage'] = $return_value['id'];
					$return_value = $this->_folderLanguageManager->folderLanguageCreateAsAdminDb();
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						$_SESSION['flash_message'] = ACTION_SUCCESS;
						header('Location:' . '?page=create_folder_admin');
						exit;
					}
				}
			}
		}

		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$languages = $this->_languageManager->getAllLanguagesByGroupDb();

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($languages);

		include ('AdminBundle/views/folder/folder_create.php');
	}

	public function editAction() {
		$folder_data = $this->_folderManager->getFolderByIdDb($_GET['folder_id']);
		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$languages = $this->_languageManager->getAllLanguagesByGroupDb();
		$folder_language_data = $this->_folderLanguageManager->getFolderLanguageByFolderIdDb($_GET['folder_id']);

		$this->mergeErrorArray($folder_data);
		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($languages);
		$this->mergeErrorArray($folder_language_data);

		if (count($this->_errorArray) == 0) {

			while ($folder_data_temp = $folder_data['data']->fetch_assoc()) {
				$folder = $folder_data_temp;
			}

			while ($folder_language_data_temp = $folder_language_data['data']->fetch_assoc()) {
				$folder_language[$folder_language_data_temp['id_language']] = $folder_language_data_temp;
			}

			if (isset($_POST['id_folder_create_mediastorage']) && (strcmp($_POST['id_folder_create_mediastorage'], '984156') == 0)) {

				$this->_folderManager->formatFolderArrayWithPostData();
				$return_value['error'] = $this->_folderManager->folderEditFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					if (!$_POST['id_parent_mediastorage']) {
						$_POST['id_parent_mediastorage'] = $folder['id_parent'];
					}
					$return_value = $this->_folderManager->folderEditAsAdminDb($folder);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$_POST['id_folder_mediastorage'] = $_GET['folder_id'];
						$return_value = $this->_folderLanguageManager->folderLanguageEditAsAdminDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {
							$_SESSION['flash_message'] = ACTION_SUCCESS;
							header('Location:' . '?page=list_folder_admin');
							exit;
						}
					}
				}

			}

		}

		include ('AdminBundle/views/folder/folder_create.php');
	}

	// public function deleteAction() {
	// 	if (isset($_GET['folder_id'])) {

	// 		$return_value = $this->_folderManager->removeFolderByIdDb($_GET['folder_id']);
	// 		$this->mergeErrorArray($return_value);

	// 		if (count($this->_errorArray) == 0) {
	// 			header('Location:' . '?page=dashboard');
	// 		}
	// 	}

	// 	include ('CoreBundle/views/common/error.php');
	// }

	public function ajaxGetFolderByParentIdAction() {
		if (!$_GET['folder_id']) {
			echo '';
			return;
		}

		$folder_data = $this->_folderManager->ajaxGetFolderByParentIdDb($_GET['folder_id']);
		$this->mergeErrorArray($folder_data);

		if (count($this->_errorArray) == 0) {

			$folder = array();

			while ($folder_data_temp = $folder_data['data']->fetch_assoc()) {
				$folder[] = $folder_data_temp;
			}

			if ($folder)
				echo json_encode($folder);
		}

		echo '';
		return;
	}
}