<?php

require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class MediaExtraFieldController {

	private $_mediaExtraFieldManager;
	private $_organizationManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();
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
	// 	$mediaExtraFields = $this->_mediaExtraFieldManager->getAllMediaExtraFieldsWithMediaExtraFieldLanguageAndLanguageDb();

	// 	$this->mergeErrorArray($mediaExtraFields);

	// 	include ('CoreBundle/views/mediaExtraField/mediaExtraField_list.php');
	// }

	public function createAction() {
		$media_extra_field = array();

		if (isset($_POST['id_media_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_extra_field_create_mediastorage'], '984156') == 0)) {
			$media_extra_field = $this->_mediaExtraFieldManager->formatMediaExtraFieldArrayWithPostData();
			$return_value['error'] = $this->_mediaExtraFieldManager->mediaExtraFieldCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaExtraFieldManager->mediaExtraFieldCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();
		$enums = $this->_mediaExtraFieldManager->getEnumOfTypeDb();

		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($languages);
		$this->mergeErrorArray($enums);

		$enums = $enums['data'];

		include ('CoreBundle/views/media/media_extra_field_create.php');
	}

	public function editAction() {
		$media_extra_field_data = $this->_mediaExtraFieldManager->getMediaExtraFieldByIdDb($_GET['media_extra_field_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();
		$enums = $this->_mediaExtraFieldManager->getEnumOfTypeDb();

		$this->mergeErrorArray($media_extra_field_data);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($media_extra_field_data_temp = $media_extra_field_data['data']->fetch_assoc()) {
				$media_extra_field = $media_extra_field_data_temp;
			}

			if (isset($_POST['id_media_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_extra_field_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_mediaExtraFieldManager->mediaExtraFieldCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaExtraFieldManager->mediaExtraFieldEditDb($media_extra_field);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/media/media_extra_field_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_extra_field_id'])) {

			$return_value = $this->_mediaExtraFieldManager->removeMediaExtraFieldByIdDb($_GET['media_extra_field_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}