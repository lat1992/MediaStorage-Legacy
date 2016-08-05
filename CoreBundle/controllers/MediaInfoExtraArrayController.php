<?php

require_once('CoreBundle/managers/MediaInfoExtraArrayManager.php');
require_once('CoreBundle/managers/MediaInfoExtraFieldManager.php');

class MediaInfoExtraArrayController {

	private $_mediaInfoExtraArrayManager;
	private $_mediaInfoExtraFieldManager;

	private $_errorArray;

	public function __construct() {
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

	public function listAction() {
		$media_info_extra_arrays = $this->_mediaInfoExtraArrayManager->getAllMediaInfoExtraArraysWithMediaInfoExtraArrayLanguageAndLanguageDb();

		$this->mergeErrorArray($media_info_extra_arrays);

		include ('CoreBundle/views/media/media_info_extra_array_list.php');
	}

	public function createAction() {
		$media_info_extra_array = array();

		if (isset($_POST['id_media_info_extra_array_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_array_create_mediastorage'], '984156') == 0)) {
			$media_info_extra_array = $this->_mediaInfoExtraArrayManager->formatMediaInfoExtraArrayArrayWithPostData();
			$return_value['error'] = $this->_mediaInfoExtraArrayManager->media_info_extra_arrayCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaInfoExtraArrayManager->mediaInfoExtraArrayCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$media_info_extra_fields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsDb();
		$this->mergeErrorArray($media_info_extra_fields);

		include ('CoreBundle/views/media/media_info_extra_array_create.php');
	}

	public function editAction() {
		$media_info_extra_array_data = $this->_mediaInfoExtraArrayManager->getMediaInfoExtraArrayByIdDb($_GET['media_info_extra_array_id']);
		$media_info_extra_fields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsDb();

		$this->mergeErrorArray($media_info_extra_array_data);
		$this->mergeErrorArray($media_info_extra_fields);

		if (count($this->_errorArray) == 0) {

			while ($media_info_extra_array_data_temp = $media_info_extra_array_data['data']->fetch_assoc()) {
				$media_info_extra_array = $media_info_extra_array_data_temp;
			}

			if (isset($_POST['id_media_info_extra_array_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_array_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaInfoExtraArrayManager->media_info_extra_arrayCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaInfoExtraArrayManager->mediaInfoExtraArrayEditDb($media_info_extra_array);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_info_extra_array_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_info_extra_array_id'])) {

			$return_value = $this->_mediaInfoExtraArrayManager->removeMediaInfoExtraArrayByIdDb($_GET['media_info_extra_array_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}