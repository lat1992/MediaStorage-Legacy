<?php

require_once('CoreBundle/models/MediaExtra.php');

class MediaExtraManager {

	private $_mediaExtraModel;

	public function __construct() {
		$this->_mediaExtraModel = new MediaExtra();
	}

	public function getAllMediaExtrasDb() {
		return $this->_mediaExtraModel->findAllMediaExtras();
	}

	public function formatMediaExtraArrayWithPostData() {
		$media_extra = array();

		$media_extra['data'] = $_POST['data_mediastorage'];
		$media_extra['id_info'] = $_POST['id_media_info_mediastorage'];
		$media_extra['id_array'] = $_POST['id_media_extra_array_mediastorage'];
		$media_extra['id_field'] = $_POST['id_media_extra_field_mediastorage'];

		return $media_extra;
	}

	public function mediaExtraCreateFormCheck() {
		$error_media_extra = array();

		return $error_media_extra;
	}

	public function mediaExtraCreateDb() {
		return $this->_mediaExtraModel->createNewMediaExtra($_POST);
	}

	public function getMediaExtraByIdDb($media_extra_id) {
		return $this->_mediaExtraModel->findMediaExtraById($media_extra_id);
	}

	public function mediaExtraEditDb($media_extra_data) {
		return $this->_mediaExtraModel->updateMediaExtraWithId($_POST, $media_extra_data['id']);
	}

	public function removeMediaExtraByIdDb($media_extra_id) {
		return $this->_mediaExtraModel->deleteMediaExtraById($media_extra_id);
	}

	public function CreateMultipleMediaExtraDb() {
		$post_save = $_POST;

		foreach ($post_save['media_extra_mediastorage'] as $id_field => $value) {

			$_POST['id_language_mediastorage'] = 'NULL';
			$_POST['id_media_extra_field_mediastorage'] = $id_field;

			if (isset($value['language'])) {

				foreach ($value['language'] as $language => $value2) {

					$_POST['id_language_mediastorage'] = $language;
					$_POST['data_mediastorage'] = $value2['data'];
					$_POST['id_media_extra_array_mediastorage'] = $value2['id_array'];

					$return_value = $this->mediaExtraCreateDb();

					if (!empty($return_value['error'])) {
						return $return_value;
					}
				}
			}
			elseif (isset($value['multiple'])) {

				foreach ($value['multiple'] as $value2) {

					$_POST['data_mediastorage'] = $value2['data'];
					$_POST['id_media_extra_array_mediastorage'] = $value2['id_array'];

					$return_value = $this->mediaExtraCreateDb();

					if (!empty($return_value['error'])) {
						return $return_value;
					}
				}
			}
			else {
				$_POST['data_mediastorage'] = $value['data'];
				$_POST['id_media_extra_array_mediastorage'] = $value['id_array'];

				$return_value = $this->mediaExtraCreateDb();

				if (!empty($return_value['error'])) {
					return $return_value;
				}
			}
		}
		return NULL;
	}
}