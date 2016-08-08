<?php

require_once('CoreBundle/managers/MediaInfoExtraManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/MediaInfoExtraArrayManager.php');
require_once('CoreBundle/managers/MediaInfoExtraFieldManager.php');

class MediaInfoExtraController {

	private $_mediaInfoExtraManager;
	private $_mediaInfoManager;
	private $_mediaInfoExtraArrayManager;
	private $_mediaInfoExtraFieldManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaInfoExtraManager = new MediaInfoExtraManager();
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_mediaInfoExtraArrayManager = new MediaInfoExtraArrayManager();
		$this->_mediaInfoExtraFieldManager = new MediaInfoExtraFieldManager();

		$this->_errorArray = array();
	}

	private function mergeErrorArray($errorArray) {
		if (!empty($errorArray['error'])) {
			if (!is_array($errorArray['error'])) {
				$data_array[] = $errorArray['error'];
			}
			else {
				$data_array = $errorArray['error'];
			}
			$this->_errorArray = array_merge ($this->_errorArray, $data_array);
		}
	}

	// public function listAction() {
	// 	$media_info_extras = $this->_mediaInfoExtraManager->getAllMediaInfoExtrasWithMediaInfoExtraLanguageAndLanguageDb();

	// 	$this->mergeErrorArray($media_info_extras);

	// 	include ('CoreBundle/views/media/media_info_extra_list.php');
	// }

	public function createAction() {
		$media_info_extra = array();

		if (isset($_POST['id_media_info_extra_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_create_mediastorage'], '984156') == 0)) {
			$media_info_extra = $this->_mediaInfoExtraManager->formatMediaInfoExtraArrayWithPostData();
			$return_value['error'] = $this->_mediaInfoExtraManager->MediaInfoExtraCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaInfoExtraManager->MediaInfoExtraCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$media_infos = $this->_mediaInfoManager->getAllMediaInfosDb();
		$media_info_extra_arrays = $this->_mediaInfoExtraArrayManager->getAllMediaInfoExtraArraysDb();
		$media_info_extra_fields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsDb();

		$this->mergeErrorArray($media_infos);
		$this->mergeErrorArray($media_info_extra_arrays);
		$this->mergeErrorArray($media_info_extra_fields);

		include ('CoreBundle/views/media/media_info_extra_create.php');
	}

	public function editAction() {
		$media_info_extra_data = $this->_mediaInfoExtraManager->getMediaInfoExtraByIdDb($_GET['media_info_extra_id']);
		$media_infos = $this->_mediaInfoManager->getAllMediaInfosDb();
		$media_info_extra_arrays = $this->_mediaInfoExtraArrayManager->getAllMediaInfoExtraArraysDb();
		$media_info_extra_fields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsDb();

		$this->mergeErrorArray($media_info_extra_data);
		$this->mergeErrorArray($media_infos);
		$this->mergeErrorArray($media_info_extra_arrays);
		$this->mergeErrorArray($media_info_extra_fields);

		if (count($this->_errorArray) == 0) {

			while ($media_info_extra_data_temp = $media_info_extra_data['data']->fetch_assoc()) {
				$media_info_extra = $media_info_extra_data_temp;
			}

			if (isset($_POST['id_media_info_extra_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaInfoExtraManager->MediaInfoExtraCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaInfoExtraManager->MediaInfoExtraEditDb($media_info_extra);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_info_extra_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_info_extra_id'])) {

			$return_value = $this->_mediaInfoExtraManager->removeMediaInfoExtraByIdDb($_GET['media_info_extra_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}