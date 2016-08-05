<?php

require_once('CoreBundle/models/FolderMedia.php');

class FolderMediaManager {

	private $_folderMediaModel;

	public function __construct() {
		$this->_folderMediaModel = new FolderMedia();
	}

	public function getAllFolderMediasDb() {
		return $this->_folderMediaModel->findAllFolderMedias();
	}

	public function formatFolderMediaArrayWithPostData() {
		$folder_media = array();

		$folder_media['id_folder'] = $_POST['id_folder_mediastorage'];
		$folder_media['id_media'] = $_POST['id_media_mediastorage'];

		return $folder_media;
	}

	public function folderMediaCreateFormCheck() {
		$error_folder_media = array();

		return $error_folder_media;
	}

	public function folderMediaCreateDb() {
		return $this->_folderMediaModel->createNewFolderMedia($_POST);
	}

	public function getFolderMediaByIdDb($folder_media_id) {
		return $this->_folderMediaModel->findFolderMediaById($folder_media_id);
	}

	public function folderMediaEditDb($folder_media_data) {
		return $this->_folderMediaModel->updateFolderMediaWithId($_POST, $folder_media_data['id']);
	}

	public function removeFolderMediaByIdDb($folder_media_id) {
		return $this->_folderMediaModel->deleteFolderMediaById($folder_media_id);
	}
}