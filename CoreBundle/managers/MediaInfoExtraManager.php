<?php

require_once('CoreBundle/models/MediaInfoExtra.php');

class MediaInfoExtraManager {

	private $_mediaInfoExtraModel;

	public function __construct() {
		$this->_mediaInfoExtraModel = new MediaInfoExtra();
	}

	public function getAllMediaInfoExtrasDb() {
		return $this->_mediaInfoExtraModel->findAllMediaInfoExtras();
	}

	public function formatMediaInfoExtraArrayWithPostData() {
		$media_info_extra = array();

		$media_info_extra['data'] = $_POST['data_mediastorage'];
		$media_info_extra['id_info'] = $_POST['id_media_info_mediastorage'];
		$media_info_extra['id_array'] = $_POST['id_media_info_extra_array_mediastorage'];
		$media_info_extra['id_field'] = $_POST['id_media_info_extra_field_mediastorage'];

		return $media_info_extra;
	}

	public function mediaInfoExtraCreateFormCheck() {
		$error_media_info_extra = array();

		return $error_media_info_extra;
	}

	public function mediaInfoExtraCreateDb() {
		return $this->_mediaInfoExtraModel->createNewMediaInfoExtra($_POST);
	}

	public function getMediaInfoExtraByIdDb($media_info_extra_id) {
		return $this->_mediaInfoExtraModel->findMediaInfoExtraById($media_info_extra_id);
	}

	public function mediaInfoExtraEditDb($media_info_extra_data) {
		return $this->_mediaInfoExtraModel->updateMediaInfoExtraWithId($_POST, $media_info_extra_data['id']);
	}

	public function removeMediaInfoExtraByIdDb($media_info_extra_id) {
		return $this->_mediaInfoExtraModel->deleteMediaInfoExtraById($media_info_extra_id);
	}
}