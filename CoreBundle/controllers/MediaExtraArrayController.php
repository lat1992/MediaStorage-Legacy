<?php

require_once('CoreBundle/managers/MediaExtraArrayManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');

class MediaExtraArrayController {

	private $_mediaExtraArrayManager;
	private $_mediaExtraFieldManager;

	private $_errorArray;

	public function __construct() {
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

	public function listAction() {
		$media_extra_arrays = $this->_mediaExtraArrayManager->getAllMediaExtraArraysWithMediaExtraArrayLanguageAndLanguageDb();

		$this->mergeErrorArray($media_extra_arrays);

		include ('CoreBundle/views/media/media_extra_array_list.php');
	}

	public function createAction() {
		$media_extra_array = array();

		if (isset($_POST['id_media_extra_array_create_mediastorage']) && (strcmp($_POST['id_media_extra_array_create_mediastorage'], '984156') == 0)) {
			$media_extra_array = $this->_mediaExtraArrayManager->formatMediaExtraArrayArrayWithPostData();
			$return_value['error'] = $this->_mediaExtraArrayManager->media_extra_arrayCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaExtraArrayManager->mediaExtraArrayCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$media_extra_fields = $this->_mediaExtraFieldManager->getAllMediaExtraFieldsDb();
		$this->mergeErrorArray($media_extra_fields);

		include ('CoreBundle/views/media/media_extra_array_create.php');
	}

	public function editAction() {
		$media_extra_array_data = $this->_mediaExtraArrayManager->getMediaExtraArrayByIdDb($_GET['media_extra_array_id']);
		$media_extra_fields = $this->_mediaExtraFieldManager->getAllMediaExtraFieldsDb();

		$this->mergeErrorArray($media_extra_array_data);
		$this->mergeErrorArray($media_extra_fields);

		if (count($this->_errorArray) == 0) {

			while ($media_extra_array_data_temp = $media_extra_array_data['data']->fetch_assoc()) {
				$media_extra_array = $media_extra_array_data_temp;
			}

			if (isset($_POST['id_media_extra_array_create_mediastorage']) && (strcmp($_POST['id_media_extra_array_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaExtraArrayManager->media_extra_arrayCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaExtraArrayManager->mediaExtraArrayEditDb($media_extra_array);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_extra_array_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_extra_array_id'])) {

			$return_value = $this->_mediaExtraArrayManager->removeMediaExtraArrayByIdDb($_GET['media_extra_array_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}