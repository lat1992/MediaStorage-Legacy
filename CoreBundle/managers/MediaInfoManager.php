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
		if (!empty($_POST['handover_date_mediastorage'])) {
			$temp = new DateTime($_POST['handover_date_mediastorage']);
			$handover_date = $temp->format('Y-m-d H:i:s');
			$_POST['handover_date_mediastorage'] = $handover_date;
		}

		$created_date = date('Y-m-d H:i:s');
		$modified_date = date('Y-m-d H:i:s');

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

	public function CreateMultipleMediaInfoDb() {
		$post_save = $_POST;

		foreach ($post_save['title_mediastorage'] as $key => $value) {

			$_POST['title_mediastorage'] = $post_save['title_mediastorage'][$key];
			$_POST['subtitle_mediastorage'] = $post_save['subtitle_mediastorage'][$key];
			$_POST['description_mediastorage'] = $post_save['description_mediastorage'][$key];
			$_POST['episode_number_mediastorage'] = $post_save['episode_number_mediastorage'][$key];
			$_POST['image_version_mediastorage'] = $post_save['image_version_mediastorage'][$key];
			$_POST['sound_version_mediastorage'] = $post_save['sound_version_mediastorage'][$key];
			$_POST['handover_date_mediastorage'] = $post_save['handover_date_mediastorage'][$key];
			$_POST['id_language_mediastorage'] = $key;

			$return_value = $this->mediaInfoCreateDb();

			if (!empty($return_value['error'])) {
				return $return_value;
			}
		}

		return NULL;
	}
}

