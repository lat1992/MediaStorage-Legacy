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
		$folder['description'] = $_POST['description_mediastorage'];

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

	public function folderLanguageEditAsAdminDb() {

		foreach ($_POST['data_mediastorage'] as $data) {
			$folder_data['id_folder_mediastorage'] = $_POST['id_folder_mediastorage'];
			$folder_data['id_language_mediastorage'] = $data['id_language'];
			$folder_data['data_mediastorage'] = $data['data'];
			$folder_data['description_mediastorage'] = $data['description'];

			$result = $this->getFolderLanguageByFolderIdAndLanguageIdDb($folder_data['id_folder_mediastorage'], $folder_data['id_language_mediastorage']);

			if (!empty($result['error']))
				return $result;

			if ($result['data']->num_rows != 0) {
				$row = $result['data']->fetch_assoc();
				$return_value = $this->_folderLanguageModel->updateFolderLanguageWithId($folder_data, $row['id']);

				if (!empty($return_value['error']))
					return $return_value;
			}
			else {
				$this->_folderLanguageModel->createNewFolderLanguage($folder_data);

				if (!empty($return_value['error']))
					return $return_value;
			}
		}
		return $return_value;
	}

	public function getFolderLanguageByIdDb($folder_language_id) {
		return $this->_folderLanguageModel->findFolderLanguageById($folder_language_id);
	}

	public function getFolderLanguageByFolderIdDb($folder_id) {
		return $this->_folderLanguageModel->findFolderLanguageByFolderId($folder_id);
	}

	public function getFolderLanguageByFolderIdAndLanguageIdDb($folder_id, $language_id) {
		return $this->_folderLanguageModel->findFolderLanguageByFolderIdAndLanguageId($folder_id, $language_id);
	}

	public function removeFolderLanguageByIdDb($folder_language_id) {
		return $this->_folderLanguageModel->deleteFolderLanguageById($folder_language_id);
	}

	public function removeFolderLanguageByFolderIdDb($folder_id) {
		return $this->_folderLanguageModel->deleteFolderLanguageByFolderId($folder_id);
	}
}

