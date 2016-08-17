<?php

require_once('CoreBundle/models/Media.php');

class MediaManager {

	private $_mediaModel;

	public function __construct() {
		$this->_mediaModel = new Media();
	}

	public function getAllMediasDb() {
		return $this->_mediaModel->findAllMedias();
	}

	public function formatMediaArrayWithPostData() {
		$media = array();

		$media['id_parent'] = $_POST['id_parent_mediastorage'];
		if (!isset($media['id_parent']))
			$media['id_parent'] = 'NULL';
		$media['id_organization'] = $_POST['id_organization_mediastorage'];
		$media['id_type'] = $_POST['id_type_mediastorage'];
		$media['reference'] = $_POST['reference_mediastorage'];
		$media['right_view'] = $_POST['right_view_mediastorage'];
		$media['right_download'] = $_POST['right_download_mediastorage'];

		return $media;
	}

	public function mediaCreateFormCheck() {
		$error_media = array();

		if (strlen($_POST['reference_mediastorage']) == 0) {
			$error_media[] = EMPTY_MEDIA_REFERENCE;
		}
		if (strlen($_POST['reference_mediastorage']) > 50) {
			$error_media[] = INVALID_MEDIA_REFERENCE_TOO_LONG;
		}

		return $error_media;
	}

	public function mediaCreateDb() {
		return $this->_mediaModel->createNewMedia($_POST);
	}

	public function getMediaByIdDb($media_id) {
		return $this->_mediaModel->findMediaByid($media_id);
	}

	public function mediaEditDb($media_data) {
		return $this->_mediaModel->updateMediaWithId($_POST, $media_data['id']);
	}

	public function removeMediaByIdDb($media_id) {
		//$data = $this->_mediaInfoManager->deleteMediaInfoByMediaId($media_id);
		if (!empty($data['error']))
			return $data;

		return $this->_mediaModel->deleteMediaById($media_id);
	}

	public function ajaxGetMediaByParentIdDb($parent_id) {
		return $this->_mediaModel->findAllMediaWithParentIdAndOrganization($parent_id, $_SESSION['id_organization']);
	}

	public function preFillProgramPostData() {

		$folder = null;
		foreach ($_POST['id_folder_mediastorage'] as $data_folder) {
			if ($data_folder)
				$folder = $data_folder;
		}

		$right_view = 0;
		if (isset($_POST['right_view_mediastorage']))
			$right_view = 1;

		$right_download = 0;
		if (isset($_POST['right_download_mediastorage']))
			$right_download = 1;

		$right_addtocart = 0;
		if (isset($_POST['right_addtocart_mediastorage']))
			$right_addtocart = 1;

		$reference = $this->getLastReferenceNumberByOrganizationDb();
		if (!empty($reference['error']))
			return $reference;

		$reference = $reference['data']->fetch_assoc();

		$_POST['reference_mediastorage'] = intval($reference['reference']) + 1;
		$_POST['right_view_mediastorage'] = $right_view;
		$_POST['id_folder_mediastorage'] = $folder;
		$_POST['id_type_mediastorage'] = 1;
		$_POST['id_organization_mediastorage'] = $_SESSION['id_organization'];
	}

	public function mediaProgramCreateFormCheck() {
		$errors = array();

		if (strlen($_POST['reference_client_mediastorage']) == 0) {
			$error_media[] = EMPTY_MEDIA_REFERENCE;
		}
		if (strlen($_POST['reference_client_mediastorage']) > 10) {
			$error_media[] = INVALID_MEDIA_REFERENCE_TOO_LONG;
		}
		if (!$_POST['id_parent_mediastorage']) {
			$error_folder[] = PARENT_FOLDER_EMPTY;
		}

		// MEDIAFILE

		if (strlen($_POST['filename_mediastorage']) == 0) {
			$error_media[] = EMPTY_FILENAME;
		}
		if (strlen($_POST['filename_mediastorage']) > 50) {
			$error_media[] = INVALID_FILENAME_TOO_LONG;
		}
		if (strlen($_POST['filepath_mediastorage']) == 0) {
			$error_media[] = EMPTY_FILEPATH;
		}
		if (strlen($_POST['filepath_mediastorage']) > 256) {
			$error_media[] = INVALID_FILEPATH_TOO_LONG;
		}

		return $errors;
	}

	public function getLastReferenceNumberByOrganizationDb() {
		return $this->_mediaModel->findLastRefenceNumberByOrganization($_SESSION['id_organization']);
	}
}