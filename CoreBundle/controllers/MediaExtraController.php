<?php

require_once('CoreBundle/managers/MediaExtraManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/MediaExtraArrayManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');

class MediaExtraController {

	private $_mediaExtraManager;
	private $_mediaInfoManager;
	private $_mediaExtraArrayManager;
	private $_mediaExtraFieldManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaExtraManager = new MediaExtraManager();
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_mediaExtraArrayManager = new MediaExtraArrayManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();

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
	// 	$media_extras = $this->_mediaExtraManager->getAllMediaExtrasWithMediaExtraLanguageAndLanguageDb();

	// 	$this->mergeErrorArray($media_extras);

	// 	include ('CoreBundle/views/media/media_extra_list.php');
	// }

	public function createAction() {
		$media_extra = array();

		if (isset($_POST['id_media_extra_create_mediastorage']) && (strcmp($_POST['id_media_extra_create_mediastorage'], '984156') == 0)) {
			$media_extra = $this->_mediaExtraManager->formatMediaExtraArrayWithPostData();
			$return_value['error'] = $this->_mediaExtraManager->MediaExtraCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaExtraManager->MediaExtraCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$media_infos = $this->_mediaInfoManager->getAllMediaInfosDb();
		$media_extra_arrays = $this->_mediaExtraArrayManager->getAllMediaExtraArraysDb();
		$media_extra_fields = $this->_mediaExtraFieldManager->getAllMediaExtraFieldsDb();

		$this->mergeErrorArray($media_infos);
		$this->mergeErrorArray($media_extra_arrays);
		$this->mergeErrorArray($media_extra_fields);

		include ('CoreBundle/views/media/media_extra_create.php');
	}

	public function editAction() {
		$media_extra_data = $this->_mediaExtraManager->getMediaExtraByIdDb($_GET['media_extra_id']);
		$media_infos = $this->_mediaInfoManager->getAllMediaInfosDb();
		$media_extra_arrays = $this->_mediaExtraArrayManager->getAllMediaExtraArraysDb();
		$media_extra_fields = $this->_mediaExtraFieldManager->getAllMediaExtraFieldsDb();

		$this->mergeErrorArray($media_extra_data);
		$this->mergeErrorArray($media_infos);
		$this->mergeErrorArray($media_extra_arrays);
		$this->mergeErrorArray($media_extra_fields);

		if (count($this->_errorArray) == 0) {

			while ($media_extra_data_temp = $media_extra_data['data']->fetch_assoc()) {
				$media_extra = $media_extra_data_temp;
			}

			if (isset($_POST['id_media_extra_create_mediastorage']) && (strcmp($_POST['id_media_extra_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaExtraManager->MediaExtraCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaExtraManager->MediaExtraEditDb($media_extra);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_extra_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_extra_id'])) {

			$return_value = $this->_mediaExtraManager->removeMediaExtraByIdDb($_GET['media_extra_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}