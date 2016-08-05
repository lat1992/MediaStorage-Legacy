<?php

require_once('CoreBundle/managers/MediaInfoExtraFieldManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class MediaInfoExtraFieldController {

	private $_mediaInfoExtraFieldManager;
	private $_organizationManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaInfoExtraFieldManager = new MediaInfoExtraFieldManager();
		$this->_organizationManager = new OrganizationManager();
		$this->_languageManager = new LanguageManager();

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
	// 	$mediaInfoExtraFields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsWithMediaInfoExtraFieldLanguageAndLanguageDb();

	// 	$this->mergeErrorArray($mediaInfoExtraFields);

	// 	include ('CoreBundle/views/mediaInfoExtraField/mediaInfoExtraField_list.php');
	// }

	public function createAction() {
		$media_info_extra_field = array();

		if (isset($_POST['id_media_info_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_field_create_mediastorage'], '984156') == 0)) {
			$media_info_extra_field = $this->_mediaInfoExtraFieldManager->formatMediaInfoExtraFieldArrayWithPostData();
			$return_value['error'] = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();
		$enums = $this->_mediaInfoExtraFieldManager->getEnumOfTypeDb();

		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/media/media_info_extra_field_create.php');
	}

	public function editAction() {
		$media_info_extra_field_data = $this->_mediaInfoExtraFieldManager->getMediaInfoExtraFieldByIdDb($_GET['media_info_extra_field_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();
		$enums = $this->_mediaInfoExtraFieldManager->getEnumOfTypeDb();

		$this->mergeErrorArray($media_info_extra_field_data);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($media_info_extra_field_data_temp = $media_info_extra_field_data['data']->fetch_assoc()) {
				$media_info_extra_field = $media_info_extra_field_data_temp;
			}

			if (isset($_POST['id_media_info_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_field_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldEditDb($media_info_extra_field);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_info_extra_field_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_info_extra_field_id'])) {

			$return_value = $this->_mediaInfoExtraFieldManager->removeMediaInfoExtraFieldByIdDb($_GET['media_info_extra_field_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}