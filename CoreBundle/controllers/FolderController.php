<?php

require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');

class FolderController {

	private $_folderManager;
	private $_organizationManager;

	private $_errorArray;

	public function __construct() {
		$this->_folderManager = new FolderManager();
		$this->_organizationManager = new OrganizationManager();

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
		$folders = $this->_folderManager->getAllFoldersWithFolderLanguageAndLanguageDb();

		$this->mergeErrorArray($folders);

		include ('CoreBundle/views/folder/folder_list.php');
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
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$folders = $this->_folderManager->getAllFoldersDb();

		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($folders);

		include ('CoreBundle/views/folder/folder_create.php');
	}

	public function editAction() {
		$folder_data = $this->_folderManager->getFolderByIdDb($_GET['folder_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$folders = $this->_folderManager->getAllFoldersDb();

		$this->mergeErrorArray($folder_data);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($folders);

		if (count($this->_errorArray) == 0) {

			while ($folder_data_temp = $folder_data['data']->fetch_assoc()) {
				$folder = $folder_data_temp;
			}

			if (isset($_POST['id_folder_create_mediastorage']) && (strcmp($_POST['id_folder_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_folderManager->folderCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_folderManager->folderEditDb($folder);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/folder/folder_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['folder_id'])) {

			$return_value = $this->_folderManager->removeFolderByIdDb($_GET['folder_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}