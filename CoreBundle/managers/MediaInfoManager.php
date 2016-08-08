<?php

require_once('CoreBundle/models/MediaInfo.php');

class MediaInfoManager {

	private $_mediaInfoModel;

	public function __construct() {
		$this->_mediaInfoModel = new MediaInfo();
	}

	public function getAllMediaInfosDb() {
		return $this->_mediaInfoModel->findAllMediaInfos();
	}

	public function formatMediaInfoArrayWithPostData() {
		$media_info = array();

		$media_info['title'] = $_POST['title_mediastorage'];
		$media_info['subtitle'] = $_POST['subtitle_mediastorage'];
		$media_info['description'] = $_POST['description_mediastorage'];
		$media_info['episode_number'] = $_POST['episode_number_mediastorage'];
		$media_info['image_version'] = $_POST['image_version_mediastorage'];
		$media_info['sound_version'] = $_POST['sound_version_mediastorage'];
		$media_info['handover_date'] = $_POST['handover_date_mediastorage'];
		$media_info['id_media'] = $_POST['id_media_mediastorage'];
		$media_info['id_language'] = $_POST['id_language_mediastorage'];

		return $media_info;
	}

	public function mediaInfoCreateFormCheck() {
		$error_media_info = array();

		if (strlen($_POST['episode_number_mediastorage']) > 30) {
			$error_media_info[] = INVALID_EPISODE_NUMBER_TOO_LONG;
		}
		if (strlen($_POST['image_version_mediastorage']) > 20) {
			$error_media_info[] = INVALID_IMAGE_VERSION_DATA_TOO_LONG;
		}
		if (strlen($_POST['sound_version_mediastorage']) > 20) {
			$error_media_info[] = INVALID_SOUND_VERSION_DATA_TOO_LONG;
		}

		return $error_media_info;
	}

	public function mediaInfoCreateDb() {
		$temp = new DateTime($_POST['handover_date_mediastorage']);
		$handover_date = $temp->format('Y-m-d H:i:s');
		$created_date = date('Y-m-d H:i:s');
		$modified_date = date('Y-m-d H:i:s');

		$_POST['handover_date_mediastorage'] = $handover_date;
		$_POST['created_date_mediastorage'] = $created_date;
		$_POST['modified_date_mediastorage'] = $modified_date;

		return $this->_mediaInfoModel->createNewMediaInfo($_POST);
	}

	public function mediaInfoEditDb($media_info_data) {
		$temp = new DateTime($_POST['handover_date_mediastorage']);
		$handover_date = $temp->format('Y-m-d H:i:s');
		$created_date = date('Y-m-d H:i:s');
		$modified_date = date('Y-m-d H:i:s');

		$_POST['handover_date_mediastorage'] = $handover_date;
		$_POST['created_date_mediastorage'] = $created_date;
		$_POST['modified_date_mediastorage'] = $modified_date;

		return $this->_mediaInfoModel->updateMediaInfoWithId($_POST, $media_info_data['id']);
	}

	public function getMediaInfoByIdDb($media_info_id) {
		return $this->_mediaInfoModel->findMediaInfoById($media_info_id);
	}

	public function removeMediaInfoByIdDb($media_info_id) {
		return $this->_mediaInfoModel->deleteMediaInfoById($media_info_id);
	}

	public function removeMediaInfoByTagIdDb($media_id) {
		return $this->_mediaInfoModel->deleteMediaInfoByTagId($media_id);
	}
}

