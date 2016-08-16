<?php

require_once('CoreBundle/models/FolderLanguage.php');

class FolderLanguageManager {

	private $_folderLanguageModel;

	public function __construct() {
		$this->_folderLanguageModel = new FolderLanguage();
	}

	public function formatFolderLanguageArrayWithPostData() {
		$folder = array();

		$folder['data'] = $_POST['data_mediastorage'];
		$folder['id_folder'] = $_POST['id_folder_mediastorage'];
		$folder['id_language'] = $_POST['id_language_mediastorage'];

		return $folder;
	}

	public function folderLanguageCreateFormCheck() {
		$error_folder_language = array();

		if (strlen($_POST['data_mediastorage']) == 0) {
			$error_folder_language[] = EMPTY_DATA;
		}
		if (strlen($_POST['data_mediastorage']) > 100) {
			$error_folder_language[] = INVALID_DATA_TOO_LONG;
		}

		return $error_folder_language;
	}

	public function folderLanguageCreateDb() {
		return $this->_folderLanguageModel->createNewFolderLanguage($_POST);
	}

	public function folderLanguageCreateAsAdminDb() {

		foreach ($_POST['data_mediastorage'] as $value) {
			$data['data_mediastorage'] = $value['data'];
			$data['id_language_mediastorage'] = $value['id_language'];
			$data['id_folder_mediastorage'] = $_POST['id_folder_mediastorage'];

			$return_value = $this->_folderLanguageModel->createNewFolderLanguage($data);

			if (!empty($return_value['error']))
				return $return_value;

		}

		return $return_value;
	}

	public function folderLanguageEditDb($folder_language_data) {
		return $this->_folderLanguageModel->updateFolderLanguageWithId($_POST, $folder_language_data['id']);
	}

	public function getFolderLanguageByIdDb($folder_language_id) {
		return $this->_folderLanguageModel->findFolderLanguageById($folder_language_id);
	}

	public function removeFolderLanguageByIdDb($folder_language_id) {
		return $this->_folderLanguageModel->deleteFolderLanguageById($folder_language_id);
	}

	public function removeFolderLanguageByFolderIdDb($folder_id) {
		return $this->_folderLanguageModel->deleteFolderLanguageByFolderId($folder_id);
	}
}

