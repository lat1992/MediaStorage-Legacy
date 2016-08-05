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
}