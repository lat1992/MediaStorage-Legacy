<?php

require_once('CoreBundle/managers/FolderLanguageManager.php');
require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class FolderLanguageController {

	private $_folderLanguageManager;
	private $_folderManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_folderLanguageManager = new FolderLanguageManager();
		$this->_folderManager = new FolderManager();
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
		$folder = array();

		if (isset($_POST['id_folder_language_create_mediastorage']) && (strcmp($_POST['id_folder_language_create_mediastorage'], '12646') == 0)) {
			$folder_language = $this->_folderLanguageManager->formatFolderLanguageArrayWithPostData();
			$return_value['error'] = $this->_folderLanguageManager->folderLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_folderLanguageManager->folderLanguageCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$folders = $this->_folderManager->getAllFoldersDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/folder/folder_language_create.php');
	}

	public function editAction() {
		$folder_language_data = $this->_folderLanguageManager->getFolderLanguageByIdDb($_GET['folder_language_id']);
		$folders = $this->_folderManager->getAllFoldersDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($folder_language_data);
		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($folder_language_data_temp = $folder_language_data['data']->fetch_assoc()) {
				$folder_language = $folder_language_data_temp;
			}

			if (isset($_POST['id_folder_language_create_mediastorage']) && (strcmp($_POST['id_folder_language_create_mediastorage'], '12646') == 0)) {
				$return_value['error'] = $this->_folderLanguageManager->folderLanguageCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_folderLanguageManager->folderLanguageEditDb($folder_language);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}
		}

		include ('CoreBundle/views/folder/folder_language_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['folder_language_id'])) {

			$return_value = $this->_folderLanguageManager->removeFolderLanguageByIdDb($_GET['folder_language_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}