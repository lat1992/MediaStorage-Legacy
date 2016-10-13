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
		$media_info['id_media'] = $_POST['id_media_mediastorage'];
		$media_info['id_language'] = $_POST['id_language_mediastorage'];

		return $media_info;
	}

	public function mediaInfoCreateFormCheck() {
		$error_media_info = array();

		return $error_media_info;
	}

	public function mediaInfoCreateDb() {
		$created_date = date('Y-m-d H:i:s');
		$modified_date = date('Y-m-d H:i:s');

		$_POST['created_date_mediastorage'] = $created_date;
		$_POST['modified_date_mediastorage'] = $modified_date;

		return $this->_mediaInfoModel->createNewMediaInfo($_POST);
	}

	public function mediaInfoEditDb($media_info_data) {
		return $this->_mediaInfoModel->updateMediaInfoWithId($_POST, $media_info_data['id']);
	}

	public function getMediaInfoByIdDb($media_info_id) {
		return $this->_mediaInfoModel->findMediaInfoById($media_info_id);
	}

	public function removeMediaInfoByIdDb($media_info_id) {
		return $this->_mediaInfoModel->deleteMediaInfoById($media_info_id);
	}

	public function removeMediaInfoByMediaIdDb($media_id) {
		return $this->_mediaInfoModel->deleteMediaInfoByMediaId($media_id);
	}

	public function removeMediaInfoByLanguageIdDb($language_id) {
		return $this->_mediaInfoModel->deleteMediaInfoByLanguageId($language_id);
	}

	public function CreateMultipleMediaInfoDb() {
		$post_save = $_POST;

		foreach ($post_save['title_mediastorage'] as $key => $value) {

			$_POST['title_mediastorage'] = $post_save['title_mediastorage'][$key];
			$_POST['subtitle_mediastorage'] = $post_save['subtitle_mediastorage'][$key];
			$_POST['description_mediastorage'] = $post_save['description_mediastorage'][$key];
			$_POST['id_language_mediastorage'] = $key;

			$return_value = $this->getMediaInfoByMediaIdAndLanguageIdDb($_POST['id_media_mediastorage'], $key);

			if (!empty($return_value['error'])) {
				return $return_value;
			}

			if ($return_value['data']->num_rows == 0) {

				$return_value = $this->mediaInfoCreateDb();

				if (!empty($return_value['error'])) {
					return $return_value;
				}
			}

			else {
				$media_info = $return_value['data']->fetch_assoc();

				$return_value = $this->mediaInfoEditDb($media_info);

				if (!empty($return_value['error'])) {
					return $return_value;
				}
			}
		}

		$_POST = $post_save;

		return NULL;
	}

	public function getMediaInfoByMediaIdAndLanguageIdDb($id_media, $id_language) {
		return $this->_mediaInfoModel->findMediaInfoByMediaIdAndLanguageId($id_media, $id_language);
	}

	public function getMediaInfoByMediaIdDb($id_media) {
		return $this->_mediaInfoModel->findMediaInfoByMediaId($id_media);
	}

	public function getArrayWithIdLanguageKey($array_data) {
		$return_array = array();

		foreach ($array_data as $row) {
			$return_array[$row['id_language']] = $row;
		}

		return $return_array;
	}

	public function formatMediaInfoDataWithPostData() {
		$return_array = array();

		foreach ($_POST['title_mediastorage'] as $key => $value) {
			$return_array[$key]['title'] = $_POST['title_mediastorage'][$key];
			$return_array[$key]['subtitle'] = $_POST['subtitle_mediastorage'][$key];
			$return_array[$key]['description'] = $_POST['description_mediastorage'][$key];
		}

		return $return_array;
	}
}

