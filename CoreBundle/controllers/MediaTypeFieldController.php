<?php

require_once('CoreBundle/managers/MediaTypeFieldManager.php');
require_once('CoreBundle/managers/MediaTypeManager.php');
require_once('CoreBundle/managers/MediaInfoExtraFieldManager.php');

class MediaTypeFieldController {

	private $_mediaTypeFieldManager;
	private $_mediaTypeManager;
	private $_mediaInfoExtraFieldManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaTypeFieldManager = new MediaTypeFieldManager();
		$this->_mediaTypeManager = new MediaTypeManager();
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
		$media_type_fields = $this->_mediaTypeFieldManager->getAllMediaTypeFieldsWithMediaTypeFieldLanguageAndLanguageDb();

		$this->mergeErrorArray($media_type_fields);

		include ('CoreBundle/views/media_type_field/media_type_field_list.php');
	}

	public function createAction() {
		$media_type_field = array();

		if (isset($_POST['id_media_type_field_create_mediastorage']) && (strcmp($_POST['id_media_type_field_create_mediastorage'], '984156') == 0)) {
			$media_type_field = $this->_mediaTypeFieldManager->formatMediaTypeFieldArrayWithPostData();
			$return_value['error'] = $this->_mediaTypeFieldManager->mediaTypeFieldCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaTypeFieldManager->mediaTypeFieldCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$media_types = $this->_mediaTypeManager->getAllMediaTypesDb();
		$media_info_extra_fields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsDb();

		$this->mergeErrorArray($media_types);
		$this->mergeErrorArray($media_info_extra_fields);

		include ('CoreBundle/views/media/media_type_field_create.php');
	}

	public function editAction() {
		$media_type_field_data = $this->_mediaTypeFieldManager->getMediaTypeFieldByIdDb($_GET['media_type_field_id']);
		$media_types = $this->_mediaTypeManager->getAllMediaTypesDb();
		$media_info_extra_fields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsDb();

		$this->mergeErrorArray($media_type_field_data);
		$this->mergeErrorArray($media_types);
		$this->mergeErrorArray($media_info_extra_fields);

		if (count($this->_errorArray) == 0) {

			while ($media_type_field_data_temp = $media_type_field_data['data']->fetch_assoc()) {
				$media_type_field = $media_type_field_data_temp;
			}

			if (isset($_POST['id_media_type_field_create_mediastorage']) && (strcmp($_POST['id_media_type_field_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaTypeFieldManager->mediaTypeFieldCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaTypeFieldManager->mediaTypeFieldEditDb($media_type_field);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_type_field_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_type_field_id'])) {

			$return_value = $this->_mediaTypeFieldManager->removeMediaTypeFieldByIdDb($_GET['media_type_field_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}