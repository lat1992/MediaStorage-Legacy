<?php

require_once('CoreBundle/models/MediaExtraField.php');
require_once('CoreBundle/managers/MediaExtraArrayManager.php');

class MediaExtraFieldManager {

	private $_mediaExtraFieldModel;

	public function __construct() {
		$this->_mediaExtraFieldModel = new MediaExtraField();
	}

	/*public function getAllMediaExtraFieldsWithMediaExtraFieldLanguageAndLanguageDb() {
		return $this->_mediaExtraFieldModel->findAllMediaExtraFieldsWithMediaExtraFieldLanguageAndLanguage();
	}*/

	public function getAllMediaExtraFieldsDb() {
		return $this->_mediaExtraFieldModel->findAllMediaExtraFields();
	}

	public function getAllMediaExtraFieldsWithOrganizationDb($id_organization) {
		return $this->_mediaExtraFieldModel->findAllMediaExtraFieldsWithOrganizationAndIdLanguage($id_organization, $_SESSION['id_language_mediastorage']);
	}

	public function formatSelectOrganizationWithPostData() {
		$media_extra_field = array();

		$media_extra_field['id_organization'] = $_POST['id_organization_mediastorage'];

		return $media_extra_field;
	}

	public function formatMediaExtraFieldArrayWithPostData() {
		$media_extra_field = array();
		$translate = array();

		$cpt = 0;
		foreach ($_POST['media_extra_field_language_data_mediastorage'] as $key => $value) {
			if ($value) {
				$translate[$cpt]['id_language'] = $key;
				$translate[$cpt]['data'] = $value;
				$cpt++;
			}
		}
		$_POST['media_extra_field_data_mediastorage'] = $translate;
		$media_extra_field['translates'] = $_POST['media_extra_field_language_data_mediastorage'];

		$media_extra_field['id_organization'] = $_POST['id_organization_mediastorage'];
		$media_extra_field['type'] = $_POST['type_mediastorage'];
		$media_extra_field['mandatory'] = $_POST['mandatory_mediastorage'];
		return $media_extra_field;
	}

	public function mediaExtraFieldCreateFormCheck() {
		$error_media_extra_field = array();

		if (strcmp($_POST['type_mediastorage'], 'Text') && strcmp($_POST['type_mediastorage'], 'Date') && strcmp($_POST['type_mediastorage'], 'Array_multiple') && strcmp($_POST['type_mediastorage'], 'Array_unique') && strcmp($_POST['type_mediastorage'], 'Boolean')) {
			$error_media_extra_field[] = BAD_CHOICE;
		}

		foreach ($_POST['media_extra_field_language_data_mediastorage'] as $key => $value) {
			if ($value) {
				if (strlen($value) > 20)
					$error_media_extra_field[] = INVALID_NAME_TOO_LONG;
			}
		}

		return $error_media_extra_field;
	}

	public function MediaExtraFieldEditFormCheck() {
		$error_media_extra_field = array();

		if (strcmp($_POST['type_mediastorage'], 'Text') && strcmp($_POST['type_mediastorage'], 'Date') && strcmp($_POST['type_mediastorage'], 'Array_multiple') && strcmp($_POST['type_mediastorage'], 'Array_unique') && strcmp($_POST['type_mediastorage'], 'Boolean')) {
			$error_media_extra_field[] = BAD_CHOICE;
		}

		foreach ($_POST['media_extra_field_language_data_mediastorage'] as $key => $value) {
			if ($value) {
				if (strlen($value) > 20)
					$error_media_extra_field[] = INVALID_NAME_TOO_LONG;
			}
		}

		return $error_media_extra_field;
	}

	public function mediaExtraFieldCreateDb() {
		return $this->_mediaExtraFieldModel->createNewMediaExtraField($_POST);
	}

	public function getMediaExtraFieldByIdDb($media_extra_field_id) {
		return $this->_mediaExtraFieldModel->findMediaExtraFieldById($media_extra_field_id);
	}

	public function mediaExtraFieldEditDb($media_extra_field_id, $media_extra_field_data) {
		return $this->_mediaExtraFieldModel->updateMediaExtraFieldWithId($media_extra_field_id, $media_extra_field_data);
	}

	public function removeMediaExtraFieldByIdDb($media_extra_field_id) {
		$_mediaExtraArrayManager = new MediaExtraArrayManager();
		$_mediaExtraArrayManager->removeMediaExtraArrayByFieldIdDb($media_extra_field_id);
		return $this->_mediaExtraFieldModel->deleteMediaExtraFieldById($media_extra_field_id);
	}

	public function getEnumOfTypeDb() {
		$data = $this->_mediaExtraFieldModel->findEnumOfType();
		if (!empty($data['error']))
			return $data;

		$enum_string;
		while ($data_temp = $data['data']->fetch_assoc()) {
			$enum_string = $data_temp['Type'];
		}

		$enum_string = substr($enum_string, 6, -2);
		$enums['data'] = explode("','", $enum_string);

		return $enums;
	}

	public function getAllMediaExtraFieldByOrganizationAndType($type) {
		return $this->_mediaExtraFieldModel->findAllMediaExtraFieldByOrganizationAndType($type, $_SESSION['id_organization'], $_SESSION['id_language_mediastorage']);
	}

	public function prepareDataForView($media_extra_data) {
		$media_extra = array();

		while($media_extra_temp = $media_extra_data['data']->fetch_assoc()) {

			$id_language = intval($media_extra_temp['id_language']);
			$id_info_field = intval($media_extra_temp['id']);

			$media_extra[$id_info_field]['data'][] = $media_extra_temp;
			$media_extra[$id_info_field]['type'] = $media_extra_temp['type'];
			$media_extra[$id_info_field]['display_in_card'] = $media_extra_temp['display_in_card'];
		}

		return $media_extra;
	}

	public function getDataForTableByMediaId($media_id) {

	}
}