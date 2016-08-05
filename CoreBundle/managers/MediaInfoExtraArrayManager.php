<?php

require_once('CoreBundle/models/MediaInfoExtraArray.php');

require_once('CoreBundle/managers/MediaInfoExtraFieldManager.php');

class MediaInfoExtraArrayManager {

	private $_mediaInfoExtraArrayModel;

	private $_mediaInfoExtraFieldManager;

	public function __construct() {
		$this->_mediaInfoExtraArrayModel = new MediaInfoExtraArray();

		$this->_mediaInfoExtraFieldManager = new MediaInfoExtraField();
	}

	public function getAllMediaInfoExtraArraysDb() {
		return $this->_mediaInfoExtraArrayModel->findAllMediaInfoExtraArrays();
	}

	public function formatMediaInfoExtraArrayArrayWithPostData() {
		$media_info_extra_array = array();

		$media_info_extra_array['element'] = $_POST['element_mediastorage'];
		$media_info_extra_array['id_media_info_extra_field'] = $_POST['id_media_info_extra_field_mediastorage'];

		return $media_info_extra_array;
	}

	public function media_info_extra_arrayCreateFormCheck() {
		$error_media_info_extra_array = array();

		if (strlen($_POST['element_mediastorage']) == 0) {
			$error_media_info_extra_array[] = EMPTY_ELEMENT;
		}
		if (strlen($_POST['element_mediastorage']) > 50) {
			$error_media_info_extra_array[] = INVALID_ELEMENT_TOO_LONG;
		}

		return $error_media_info_extra_array;
	}

	public function mediaInfoExtraArrayCreateDb() {
		return $this->_mediaInfoExtraArrayModel->createNewMediaInfoExtraArray($_POST);
	}

	public function getMediaInfoExtraArrayByIdDb($media_info_extra_array_id) {
		return $this->_mediaInfoExtraArrayModel->findMediaInfoExtraArrayById($media_info_extra_array_id);
	}

	public function mediaInfoExtraArrayEditDb($media_info_extra_array_data) {
		return $this->_mediaInfoExtraArrayModel->updateMediaInfoExtraArrayWithId($_POST, $media_info_extra_array_data['id']);
	}

	public function removeMediaInfoExtraArrayByIdDb($media_info_extra_array_id) {
		// $data = $this->_mediaInfoExtraFieldManager->deleteMediaInfoExtraFieldByMediaInfoExtraArrayId($media_info_extra_array_id);
		// if (!empty($data['error']))
		// 	return $data;

		return $this->_mediaInfoExtraArrayModel->deleteMediaInfoExtraArrayById($media_info_extra_array_id);
	}
}