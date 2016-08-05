<?php

require_once('CoreBundle/models/Folder.php');

class FolderManager {

	private $_folderModel;

	public function __construct() {
		$this->_folderModel = new Folder();
	}

	public function getAllFoldersWithFolderLanguageAndLanguageDb() {
		return $this->_folderModel->findAllFoldersWithFolderLanguageAndLanguage();
	}

	public function getAllFoldersDb() {
		return $this->_folderModel->findAllFolders();
	}

	public function formatFolderArrayWithPostData() {
		$folder = array();

		$folder['id_parent'] = $_POST['id_parent_mediastorage'];
		$folder['id_organization'] = $_POST['id_organization_mediastorage'];

		return $folder;
	}

	public function folderCreateFormCheck() {
		$error_folder = array();

		return $error_folder;
	}

	public function folderCreateDb() {
		return $this->_folderModel->createNewFolder($_POST);
	}

	public function getFolderByIdDb($folder_id) {
		return $this->_folderModel->findFolderById($folder_id);
	}

	public function folderEditDb($folder_data) {
		return $this->_folderModel->updateFolderWithId($_POST, $folder_data['id']);
	}

	public function removeFolderByIdDb($folder_id) {
		return $this->_folderModel->deleteFolderById($folder_id);
	}
}