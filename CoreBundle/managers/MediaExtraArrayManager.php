<?php

require_once('CoreBundle/models/MediaExtraArray.php');

require_once('CoreBundle/managers/MediaExtraFieldManager.php');

class MediaExtraArrayManager {

	private $_mediaExtraArrayModel;

	private $_mediaExtraFieldManager;

	public function __construct() {
		$this->_mediaExtraArrayModel = new MediaExtraArray();

		$this->_mediaExtraFieldManager = new MediaExtraField();
	}

	public function getAllMediaExtraArraysDb() {
		return $this->_mediaExtraArrayModel->findAllMediaExtraArrays();
	}

	public function formatMediaExtraArrayArrayWithPostData() {
		$media_extra_array = array();

		$media_extra_array['element'] = $_POST['element_mediastorage'];
		$media_extra_array['id_media_extra_field'] = $_POST['id_media_extra_field_mediastorage'];

		return $media_extra_array;
	}

	public function media_extra_arrayCreateFormCheck() {
		$error_media_extra_array = array();

		if (strlen($_POST['element_mediastorage']) == 0) {
			$error_media_extra_array[] = EMPTY_ELEMENT;
		}
		if (strlen($_POST['element_mediastorage']) > 50) {
			$error_media_extra_array[] = INVALID_ELEMENT_TOO_LONG;
		}

		return $error_media_extra_array;
	}

	public function mediaExtraArrayCreateDb() {
		return $this->_mediaExtraArrayModel->createNewMediaExtraArray($_POST);
	}

	public function getMediaExtraArrayByIdDb($media_extra_array_id) {
		return $this->_mediaExtraArrayModel->findMediaExtraArrayById($media_extra_array_id);
	}

	public function mediaExtraArrayEditDb($media_extra_array_data) {
		return $this->_mediaExtraArrayModel->updateMediaExtraArrayWithId($_POST, $media_extra_array_data['id']);
	}

	public function removeMediaExtraArrayByIdDb($media_extra_array_id) {
		// $data = $this->_mediaExtraFieldManager->deleteMediaExtraFieldByMediaExtraArrayId($media_extra_array_id);
		// if (!empty($data['error']))
		// 	return $data;

		return $this->_mediaExtraArrayModel->deleteMediaExtraArrayById($media_extra_array_id);
	}
}