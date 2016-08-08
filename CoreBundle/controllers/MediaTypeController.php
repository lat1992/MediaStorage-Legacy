<?php

require_once('CoreBundle/managers/MediaTypeManager.php');

class MediaTypeController {

	private $_mediaTypeManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaTypeManager = new MediaTypeManager();

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

	public function createAction() {
		$media_type = array();

		if (isset($_POST['id_media_type_create_mediastorage']) && (strcmp($_POST['id_media_type_create_mediastorage'], '984156') == 0)) {
			$media_type = $this->_mediaTypeManager->formatMediaTypeArrayWithPostData();
			$return_value['error'] = $this->_mediaTypeManager->mediaTypeCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaTypeManager->mediaTypeCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		include ('CoreBundle/views/media/media_type_create.php');
	}

	public function editAction() {
		$media_type_data = $this->_mediaTypeManager->getMediaTypeByIdDb($_GET['media_type_id']);

		$this->mergeErrorArray($media_type_data);

		if (count($this->_errorArray) == 0) {

			while ($media_type_data_temp = $media_type_data['data']->fetch_assoc()) {
				$media_type = $media_type_data_temp;
			}

			if (isset($_POST['id_media_type_create_mediastorage']) && (strcmp($_POST['id_media_type_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaTypeManager->mediaTypeCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaTypeManager->mediaTypeEditDb($media_type);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_type_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_type_id'])) {

			$return_value = $this->_mediaTypeManager->removeMediaTypeByIdDb($_GET['media_type_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}